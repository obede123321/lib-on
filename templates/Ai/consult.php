<?php
$this->assign('title', 'Lib-on | Consulta IA');
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 soft-shadow">
                <div class="card-body p-4 p-lg-5">
                    <h1 class="h3 fw-bold mb-2">Consulta com Inteligência Artificial</h1>
                    <p class="text-secondary">Faça perguntas sobre reservas, renovação e uso do sistema.</p>

                    <?= $this->Form->create(null, ['class' => 'd-grid gap-3']) ?>
                    <?= $this->Form->control('question', [
                        'label' => 'Sua pergunta',
                        'type' => 'textarea',
                        'value' => $question,
                        'rows' => 4,
                        'class' => 'form-control',
                        'placeholder' => 'Ex: Como renovar um livro sem atraso?',
                    ]) ?>
                    <?= $this->Form->button('Consultar IA', ['class' => 'btn btn-primary']) ?>
                    <?= $this->Form->end() ?>

                    <?php if (!empty($answer)): ?>
                        <hr>
                        <h2 class="h5 fw-semibold">Resposta</h2>
                        <p class="mb-0"><?= h($answer) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
