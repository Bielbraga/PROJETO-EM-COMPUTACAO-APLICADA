<?php
include("includes/auth.php");
include("includes/tarefas.php");

$usuario_id = $_SESSION['id'];

/* adicionar tarefa */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['titulo'])) {
    $titulo = trim($_POST['titulo']);

    if (!empty($titulo)) {
        criarTarefa($usuario_id, $titulo);
    }

    header("Location: home.php");
    exit();
}

/* concluir tarefa */
if (isset($_GET['concluir'])) {
    concluirTarefa($_GET['concluir'], $usuario_id);

    header("Location: home.php");
    exit();
}

$tarefas = listarTarefas($usuario_id);
$totalTarefas = contarTarefas($usuario_id);
$totalConcluidas = contarConcluidas($usuario_id);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FocusFlow - Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

<div class="dashboard-layout">

    <?php include("includes/sidebar.php"); ?>

    <div class="main-content">

        <?php include("includes/header.php"); ?>

        <div class="dashboard-content">

            <div class="dashboard-left">

                <div class="welcome-card">
                    <div>
                        <h1>Meu Dia</h1>
                        <p>Organize sua rotina e mantenha seu foco.</p>
                    </div>
                </div>

                <div class="task-section">
                    <h3>Tarefas de Hoje</h3>

                    <?php if ($tarefas->num_rows > 0): ?>

                        <?php while ($tarefa = $tarefas->fetch_assoc()): ?>

                            <div class="task-card">

                                <a href="home.php?concluir=<?php echo $tarefa['id']; ?>">
                                    <input type="checkbox">
                                </a>

                                <div>
                                    <strong><?php echo htmlspecialchars($tarefa['titulo']); ?></strong>

                                    <?php if (!empty($tarefa['descricao'])): ?>
                                        <p><?php echo htmlspecialchars($tarefa['descricao']); ?></p>
                                    <?php endif; ?>
                                </div>

                            </div>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <p>Nenhuma tarefa cadastrada.</p>

                    <?php endif; ?>
                </div>

                <form method="POST" class="add-task-box">
                    <input
                        type="text"
                        name="titulo"
                        placeholder="Adicionar nova tarefa..."
                        required
                    >

                    <button type="submit">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </form>

            </div>

            <div class="dashboard-right">

                <div class="info-card">
                    <h4>Sugestões</h4>
                    <ul>
                        <li>📘 Revisar matéria</li>
                        <li>💻 Finalizar projeto</li>
                        <li>🏃 Fazer cardio</li>
                    </ul>
                </div>

                <div class="info-card">
                    <h4>Resumo</h4>

                    <div class="stats">
                        <div>
                            <strong><?php echo $totalTarefas; ?></strong>
                            <span>Tarefas</span>
                        </div>

                        <div>
                            <strong><?php echo $totalConcluidas; ?></strong>
                            <span>Concluídas</span>
                        </div>
                    </div>
                </div>

                <div class="info-card">
                    <h4>Calendário</h4>

                    <div class="calendar-fake">
                        <span>Seg</span>
                        <span>Ter</span>
                        <span>Qua</span>
                        <span>Qui</span>
                        <span>Sex</span>
                        <span>Sáb</span>
                        <span>Dom</span>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>