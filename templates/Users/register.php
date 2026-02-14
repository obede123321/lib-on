<?php
$this->assign('title', 'Lib-on | Cadastro');
?>
<div class="min-vh-100 d-flex align-items-center py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-6">
                <div class="card border-0 soft-shadow">
                    <div class="card-body p-4 p-lg-5">
                        <h1 class="h3 fw-bold mb-1">Criar novo cadastro</h1>
                        <p class="text-secondary mb-4">Cadastre-se para reservar livros e acessar as consultas com IA.</p>

                        <?= $this->Form->create(null, ['class' => 'row g-3']) ?>
                        <div class="col-12">
                            <?= $this->Form->control('name', [
                                'label' => 'Nome completo',
                                'class' => 'form-control',
                                'placeholder' => 'Digite seu nome',
                                'required' => true,
                            ]) ?>
                        </div>
                        <div class="col-12">
                            <?= $this->Form->control('email', [
                                'label' => 'E-mail',
                                'type' => 'email',
                                'class' => 'form-control',
                                'placeholder' => 'nome@exemplo.com',
                                'required' => true,
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->Form->control('password', [
                                'label' => 'Senha',
                                'type' => 'password',
                                'class' => 'form-control',
                                'placeholder' => 'Mínimo 6 caracteres',
                                'required' => true,
                            ]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $this->Form->control('confirm_password', [
                                'label' => 'Confirmar senha',
                                'type' => 'password',
                                'class' => 'form-control',
                                'placeholder' => 'Repita a senha',
                                'required' => true,
                            ]) ?>
                        </div>
                        <div class="col-12 d-grid">
                            <?= $this->Form->button('Criar cadastro', ['class' => 'btn btn-primary btn-lg']) ?>
                        </div>
                        <?= $this->Form->end() ?>

                        <div class="mt-3 text-center">
                            <?= $this->Html->link('Já tem conta? Fazer login', ['controller' => 'Users', 'action' => 'login'], ['class' => 'small fw-semibold text-decoration-none']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
