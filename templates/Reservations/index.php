<?php
$this->assign('title', 'Lib-on | Reservas');
?>
<div class="container py-5">
    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card border-0 soft-shadow">
                <div class="card-body p-4">
                    <h1 class="h4 fw-bold">Gerador de ticket de reserva</h1>
                    <p class="text-secondary">Reserve um livro e gere um ticket automaticamente para o usuário.</p>

                    <?= $this->Form->create(null, ['class' => 'row g-3']) ?>
                    <div class="col-md-6">
                        <?= $this->Form->control('user_name', ['label' => 'Nome do usuário', 'class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('user_email', ['label' => 'E-mail do usuário', 'type' => 'email', 'class' => 'form-control']) ?>
                    </div>
                    <div class="col-12">
                        <?= $this->Form->control('book_id', [
                            'label' => 'Livro',
                            'type' => 'select',
                            'options' => array_column(array_map(fn($book) => [
                                'id' => $book['id'],
                                'label' => $book['title'] . ' — ' . $book['author'] . ' (' . $book['available_copies'] . ' disponíveis)'
                            ], $books), 'label', 'id'),
                            'empty' => 'Selecione um livro',
                            'class' => 'form-select',
                        ]) ?>
                    </div>
                    <div class="col-12">
                        <?= $this->Form->button('Reservar e gerar ticket', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card border-0 soft-shadow h-100">
                <div class="card-body p-4">
                    <h2 class="h5 fw-semibold">Ticket gerado</h2>
                    <?php if (!empty($ticket)): ?>
                        <div class="alert alert-success mb-0">
                            <p class="mb-1"><strong>Código:</strong> <?= h($ticket['ticket_code']) ?></p>
                            <p class="mb-1"><strong>Livro:</strong> <?= h($ticket['book_title']) ?></p>
                            <p class="mb-1"><strong>Usuário:</strong> <?= h($ticket['user_name']) ?> (<?= h($ticket['user_email']) ?>)</p>
                            <p class="mb-0"><strong>Emitido em:</strong> <?= h($ticket['issued_at']) ?></p>
                        </div>
                    <?php else: ?>
                        <p class="text-secondary mb-0">Após confirmar a reserva, o ticket aparecerá aqui.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
