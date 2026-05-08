<div class="topbar">

    <div class="search-box">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" placeholder="Pesquisar tarefas...">
    </div>

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