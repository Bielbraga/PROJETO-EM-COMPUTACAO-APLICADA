<div class="topbar">

<form method="GET" class="search-bar">

    <i class="fa-solid fa-magnifying-glass"></i>

    <input
        type="text"
        name="busca"
        placeholder="Pesquisar tarefas..."
        value="<?php echo htmlspecialchars($_GET['busca'] ?? ''); ?>"
    >

</form>

    <div class="top-actions">

        <button class="new-btn">
            New
        </button>

        <div class="user-info">
            <div class="user-avatar">
                <?php echo strtoupper(substr($_SESSION['nome'], 0, 1)); ?>
            </div>

            <span>
                <?php echo $_SESSION['nome']; ?>
            </span>
        </div>

    </div>

</div>