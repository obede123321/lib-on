<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\DatabaseService;
use App\Service\LibraryService;

class ReservationsController extends AppController
{
    public function index(): void
    {
        $library = new LibraryService(new DatabaseService());
        $books = $library->listBooks();
        $ticket = null;

        if ($this->request->is('post')) {
            $name = trim((string)$this->request->getData('user_name'));
            $email = trim((string)$this->request->getData('user_email'));
            $bookId = (int)$this->request->getData('book_id');

            if ($name === '' || $email === '' || $bookId <= 0) {
                $this->Flash->error('Preencha nome, e-mail e selecione um livro.');
            } else {
                $ticket = $library->reserveBook($bookId, $name, $email);

                if ($ticket === null) {
                    $this->Flash->error('Livro indisponível no momento. Tente outro título.');
                } else {
                    $this->Flash->success('Reserva confirmada. Ticket gerado para o usuário.');
                    $books = $library->listBooks();
                }
            }
        }

        $this->set(compact('books', 'ticket'));
    }
}
