<?php
$paginaAtual = basename($_SERVER['PHP_SELF']);
?>

<div class="sidebar">

    <div class="logo-area">
        <div class="logo-icon">
            <i class="fa-solid fa-check"></i>
        </div>
        <span class="logo-text">FocusFlow</span>
    </div>

    <nav class="menu">

        <a href="home.php" class="menu-item <?= ($paginaAtual == 'home.php') ? 'active' : '' ?>">
            <i class="fa-solid fa-house"></i>
            <span>Meu Dia</span>
        </a>

        <a href="tarefas.php" class="menu-item <?= ($paginaAtual == 'tarefas.php') ? 'active' : '' ?>">
            <i class="fa-solid fa-list-check"></i>
            <span>Tarefas</span>
        </a>

        <a href="importante.php" class="menu-item <?= ($paginaAtual == 'importante.php') ? 'active' : '' ?>">
            <i class="fa-solid fa-star"></i>
            <span>Importante</span>
        </a>

        <a href="concluidas.php" class="menu-item <?= ($paginaAtual == 'concluidas.php') ? 'active' : '' ?>">
            <i class="fa-solid fa-circle-check"></i>
            <span>Concluídas</span>
        </a>

        <a href="pessoal.php" class="menu-item <?= ($paginaAtual == 'pessoal.php') ? 'active' : '' ?>">
            <i class="fa-solid fa-user"></i>
            <span>Pessoal</span>
        </a>

        <a href="faculdade.php" class="menu-item <?= ($paginaAtual == 'faculdade.php') ? 'active' : '' ?>">
            <i class="fa-solid fa-graduation-cap"></i>
            <span>Faculdade</span>
        </a>

    </nav>

    <div class="logout-area">
        <a href="logout.php" class="logout-btn">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Sair</span>
        </a>
    </div>

</div>