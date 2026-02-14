<?php
declare(strict_types=1);

namespace App\Service;

use PDO;

class DatabaseService
{
    private string $databasePath;

    public function __construct(?string $databasePath = null)
    {
        $baseDir = dirname(__DIR__, 2) . '/var/data';
        if (!is_dir($baseDir)) {
            mkdir($baseDir, 0775, true);
        }

        $this->databasePath = $databasePath ?? ($baseDir . '/libon.sqlite');
        $this->bootstrap();
    }

    public function connection(): PDO
    {
        $pdo = new PDO('sqlite:' . $this->databasePath);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;
    }

    private function bootstrap(): void
    {
        $pdo = $this->connection();

        $pdo->exec(
            'CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                email TEXT NOT NULL UNIQUE,
                password_hash TEXT NOT NULL,
                created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
            )'
        );

        $pdo->exec(
            'CREATE TABLE IF NOT EXISTS books (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                title TEXT NOT NULL,
                author TEXT NOT NULL,
                available_copies INTEGER NOT NULL DEFAULT 0,
                created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
            )'
        );

        $pdo->exec(
            'CREATE TABLE IF NOT EXISTS reservations (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                book_id INTEGER NOT NULL,
                user_name TEXT NOT NULL,
                user_email TEXT NOT NULL,
                status TEXT NOT NULL DEFAULT "reserved",
                created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY(book_id) REFERENCES books(id)
            )'
        );

        $pdo->exec(
            'CREATE TABLE IF NOT EXISTS reservation_tickets (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                reservation_id INTEGER NOT NULL,
                ticket_code TEXT NOT NULL UNIQUE,
                generated_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY(reservation_id) REFERENCES reservations(id)
            )'
        );

        $pdo->exec(
            'CREATE TABLE IF NOT EXISTS ai_consultations (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                question TEXT NOT NULL,
                answer TEXT NOT NULL,
                created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
            )'
        );

        $userCount = (int)$pdo->query('SELECT COUNT(*) AS total FROM users')->fetch()['total'];
        if ($userCount === 0) {
            $stmt = $pdo->prepare('INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)');
            $stmt->execute(['Administrador', 'admin@libon.local', password_hash('123456', PASSWORD_DEFAULT)]);
        }

        $count = (int)$pdo->query('SELECT COUNT(*) AS total FROM books')->fetch()['total'];
        if ($count === 0) {
            $stmt = $pdo->prepare('INSERT INTO books (title, author, available_copies) VALUES (?, ?, ?)');
            $seedBooks = [
                ['Dom Casmurro', 'Machado de Assis', 4],
                ['O Pequeno Príncipe', 'Antoine de Saint-Exupéry', 7],
                ['1984', 'George Orwell', 3],
            ];

            foreach ($seedBooks as $book) {
                $stmt->execute($book);
            }
        }
    }
}
