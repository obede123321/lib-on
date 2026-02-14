<?php
declare(strict_types=1);

namespace App\Service;

use DateTimeImmutable;

class LibraryService
{
    public function __construct(private readonly DatabaseService $database)
    {
    }

    public function listBooks(): array
    {
        $pdo = $this->database->connection();

        return $pdo->query('SELECT id, title, author, available_copies FROM books ORDER BY title ASC')->fetchAll();
    }

    public function reserveBook(int $bookId, string $name, string $email): ?array
    {
        $pdo = $this->database->connection();

        $bookStmt = $pdo->prepare('SELECT id, title, available_copies FROM books WHERE id = ?');
        $bookStmt->execute([$bookId]);
        $book = $bookStmt->fetch();

        if (!$book || (int)$book['available_copies'] <= 0) {
            return null;
        }

        $pdo->beginTransaction();

        $reservationStmt = $pdo->prepare('INSERT INTO reservations (book_id, user_name, user_email) VALUES (?, ?, ?)');
        $reservationStmt->execute([$bookId, $name, $email]);
        $reservationId = (int)$pdo->lastInsertId();

        $ticketCode = $this->generateTicketCode($reservationId);
        $ticketStmt = $pdo->prepare('INSERT INTO reservation_tickets (reservation_id, ticket_code) VALUES (?, ?)');
        $ticketStmt->execute([$reservationId, $ticketCode]);

        $updateBookStmt = $pdo->prepare('UPDATE books SET available_copies = available_copies - 1 WHERE id = ?');
        $updateBookStmt->execute([$bookId]);

        $pdo->commit();

        return [
            'reservation_id' => $reservationId,
            'ticket_code' => $ticketCode,
            'book_title' => $book['title'],
            'user_name' => $name,
            'user_email' => $email,
            'issued_at' => (new DateTimeImmutable())->format('d/m/Y H:i'),
        ];
    }

    public function registerUser(string $name, string $email, string $password): bool
    {
        if ($this->userExists($email)) {
            return false;
        }

        $pdo = $this->database->connection();
        $stmt = $pdo->prepare('INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)');

        return $stmt->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT)]);
    }

    public function authenticateUser(string $email, string $password): bool
    {
        $pdo = $this->database->connection();
        $stmt = $pdo->prepare('SELECT password_hash FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if (!$user) {
            return false;
        }

        return password_verify($password, (string)$user['password_hash']);
    }

    public function userExists(string $email): bool
    {
        $pdo = $this->database->connection();
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);

        return (bool)$stmt->fetch();
    }

    public function saveAiConsultation(string $question, string $answer): void
    {
        $pdo = $this->database->connection();
        $stmt = $pdo->prepare('INSERT INTO ai_consultations (question, answer) VALUES (?, ?)');
        $stmt->execute([$question, $answer]);
    }

    public function answerWithAssistantKnowledge(string $question): string
    {
        $normalized = mb_strtolower(trim($question));

        if (str_contains($normalized, 'renova')) {
            return 'Para renovar um livro, acesse a área de reservas, localize seu empréstimo e solicite renovação antes da data de vencimento.';
        }

        if (str_contains($normalized, 'atraso') || str_contains($normalized, 'multa')) {
            return 'Em caso de atraso, o sistema pode aplicar regras internas de multa. Recomendo regularizar o mais rápido possível para liberar novas reservas.';
        }

        if (str_contains($normalized, 'reserva')) {
            return 'Você pode reservar na nova área de reservas. Após confirmar, o ticket é gerado automaticamente com código único para atendimento.';
        }

        return 'Posso ajudar com temas como reserva, renovação, disponibilidade e regras de empréstimo. Faça uma pergunta mais específica sobre a biblioteca.';
    }

    private function generateTicketCode(int $reservationId): string
    {
        return sprintf('LIB-%06d-%s', $reservationId, strtoupper(bin2hex(random_bytes(2))));
    }
}
