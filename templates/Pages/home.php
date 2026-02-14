<?php
$this->assign('title', 'Lib-on | Biblioteca Digital');
?>
<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
    <div class="container py-2">
        <a class="navbar-brand fw-bold text-primary" href="#">Lib-on</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Abrir menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><?= $this->Html->link('Início', ['controller' => 'Pages', 'action' => 'home'], ['class' => 'nav-link active']) ?></li>
                <li class="nav-item"><a class="nav-link" href="#servicos">Serviços</a></li>
                <li class="nav-item"><a class="nav-link" href="#contato">Contato</a></li>
                <li class="nav-item"><?= $this->Html->link('Consulta IA', ['controller' => 'Ai', 'action' => 'consult'], ['class' => 'nav-link']) ?></li>
                <li class="nav-item"><?= $this->Html->link('Reservas', ['controller' => 'Reservations', 'action' => 'index'], ['class' => 'nav-link']) ?></li>
            </ul>
            <?= $this->Html->link('Entrar', ['controller' => 'Users', 'action' => 'login'], ['class' => 'btn btn-primary ms-lg-3']) ?>
            <?= $this->Html->link('Criar cadastro', ['controller' => 'Users', 'action' => 'register'], ['class' => 'btn btn-outline-primary ms-lg-2']) ?>
        </div>
    </div>
</nav>

<header class="hero-gradient text-white py-5 py-lg-6">
    <div class="container py-5">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <h1 class="display-4 fw-bold">Gerencie empréstimos de livros com praticidade.</h1>
                <p class="lead opacity-75">Uma experiência simples para consultar disponibilidade, renovar prazos e acompanhar seu histórico.</p>
                <div class="d-flex gap-2 flex-wrap">
                    <?= $this->Html->link('Acessar sistema', ['controller' => 'Users', 'action' => 'login'], ['class' => 'btn btn-light btn-lg']) ?>
                    <?= $this->Html->link('Gerar ticket de reserva', ['controller' => 'Reservations', 'action' => 'index'], ['class' => 'btn btn-outline-light btn-lg']) ?>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card border-0 soft-shadow">
                    <div class="card-body p-4 p-lg-5 text-dark">
                        <h2 class="h4 fw-semibold">Destaques</h2>
                        <ul class="list-unstyled mt-3 mb-0">
                            <li class="mb-2">📚 Consulta rápida de acervo</li>
                            <li class="mb-2">🔁 Renovação online de empréstimos</li>
                            <li>🔔 Avisos de prazo por e-mail</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<section id="servicos" class="py-5">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Serviços para leitores e bibliotecas</h2>
            <p class="text-secondary">Tudo o que você precisa para uma rotina de empréstimos eficiente.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 soft-shadow">
                    <div class="card-body">
                        <h3 class="h5">Aluguel</h3>
                        <p class="text-secondary mb-0">Localize títulos disponíveis e realize reservas com poucos cliques.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 soft-shadow">
                    <div class="card-body">
                        <h3 class="h5">Renovação</h3>
                        <p class="text-secondary mb-0">Evite atrasos renovando seu empréstimo diretamente pelo portal.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 soft-shadow">
                    <div class="card-body">
                        <h3 class="h5">Cadastro</h3>
                        <p class="text-secondary mb-0">Mantenha os dados dos usuários organizados e sempre atualizados.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="contato" class="py-5 bg-white border-top">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-5">
                <h2 class="h4 fw-bold">Fale com a equipe Lib-on</h2>
                <p class="text-secondary">Igarassu - PE<br>Telefone: (81) 97346-0307</p>
            </div>
            <div class="col-lg-7">
                <form class="row g-3">
                    <div class="col-md-6">
                        <label for="contactName" class="form-label">Nome</label>
                        <input id="contactName" type="text" class="form-control" placeholder="Seu nome">
                    </div>
                    <div class="col-md-6">
                        <label for="contactEmail" class="form-label">E-mail</label>
                        <input id="contactEmail" type="email" class="form-control" placeholder="nome@exemplo.com">
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
