<?php
$this->assign('title', 'Lib-on | Login');
?>
<div class="min-vh-100 d-flex align-items-center py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5">
                <div class="card border-0 soft-shadow">
                    <div class="card-body p-4 p-lg-5">
                        <h1 class="h3 fw-bold mb-1">Acessar conta</h1>
                        <p class="text-secondary mb-4">Entre para consultar seu acervo, IA e reservas.</p>

                        <?= $this->Form->create(null, ['class' => 'd-grid gap-3']) ?>
                        <?= $this->Form->control('email', [
                            'label' => 'E-mail',
                            'type' => 'email',
                            'class' => 'form-control',
                            'placeholder' => 'nome@exemplo.com',
                            'required' => true,
                        ]) ?>
                        <?= $this->Form->control('password', [
                            'label' => 'Senha',
                            'type' => 'password',
                            'class' => 'form-control',
                            'placeholder' => 'Digite sua senha',
                            'required' => true,
                        ]) ?>
                        <?= $this->Form->button('Entrar', ['class' => 'btn btn-primary btn-lg w-100']) ?>
                        <?= $this->Form->end() ?>

                        <div class="d-flex justify-content-between mt-3">
                            <?= $this->Html->link('Voltar para página inicial', ['controller' => 'Pages', 'action' => 'home'], ['class' => 'small text-decoration-none']) ?>
                            <?= $this->Html->link('Criar novo cadastro', ['controller' => 'Users', 'action' => 'register'], ['class' => 'small fw-semibold text-decoration-none']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
