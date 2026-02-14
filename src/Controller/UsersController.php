<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\DatabaseService;
use App\Service\LibraryService;
use Cake\Http\Response;

class UsersController extends AppController
{
    public function login(): ?Response
    {
        if ($this->request->is('post')) {
            $email = trim((string)$this->request->getData('email'));
            $password = (string)$this->request->getData('password');

            if ($email === '' || $password === '') {
                $this->Flash->error('Preencha e-mail e senha para continuar.');

                return null;
            }

            $library = new LibraryService(new DatabaseService());

            if (!$library->authenticateUser($email, $password)) {
                $this->Flash->error('Credenciais inválidas. Se não tiver conta, faça seu cadastro.');

                return null;
            }

            $this->Flash->success(sprintf('Bem-vindo(a), %s!', $email));

            return $this->redirect(['controller' => 'Pages', 'action' => 'home']);
        }

        return null;
    }

    public function register(): ?Response
    {
        if ($this->request->is('post')) {
            $name = trim((string)$this->request->getData('name'));
            $email = trim((string)$this->request->getData('email'));
            $password = (string)$this->request->getData('password');
            $confirmPassword = (string)$this->request->getData('confirm_password');

            if ($name === '' || $email === '' || $password === '' || $confirmPassword === '') {
                $this->Flash->error('Preencha todos os campos do cadastro.');

                return null;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->Flash->error('Informe um e-mail válido.');

                return null;
            }

            if ($password !== $confirmPassword) {
                $this->Flash->error('As senhas não coincidem.');

                return null;
            }

            if (mb_strlen($password) < 6) {
                $this->Flash->error('A senha deve ter no mínimo 6 caracteres.');

                return null;
            }

            $library = new LibraryService(new DatabaseService());
            $created = $library->registerUser($name, $email, $password);

            if (!$created) {
                $this->Flash->error('Este e-mail já está cadastrado. Faça login ou use outro e-mail.');

                return null;
            }

            $this->Flash->success('Cadastro realizado com sucesso. Agora você pode entrar no sistema.');

            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }

        return null;
    }
}
