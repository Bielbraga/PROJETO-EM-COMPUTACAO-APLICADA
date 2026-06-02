<?php
include("includes/auth.php");
include("includes/tarefas.php");

$usuario_id = $_SESSION['id'];

/* concluir */
if (isset($_GET['concluir'])) {
    concluirTarefa($_GET['concluir'], $usuario_id);

    header("Location: tarefas.php");
    exit();
}

/* excluir */
if (isset($_GET['excluir'])) {
    excluirTarefa($_GET['excluir'], $usuario_id);

    header("Location: tarefas.php");
    exit();
}

$tarefasPendentes = listarTarefas($usuario_id);
$tarefasConcluidas = listarConcluidas($usuario_id);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FocusFlow - Tarefas</title>

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

        <div class="tasks-page">

            <div class="tasks-column">

                <div class="section-card">
                    <h2>Tarefas Pendentes</h2>

                    <?php if ($tarefasPendentes->num_rows > 0): ?>

                        <?php while ($tarefa = $tarefasPendentes->fetch_assoc()): ?>

                            <div class="task-card">

                                <a href="tarefas.php?concluir=<?php echo $tarefa['id']; ?>">
                                    <input type="checkbox">
                                </a>

                                <div class="task-content">
                                    <strong><?php echo htmlspecialchars($tarefa['titulo']); ?></strong>

                                    <?php if (!empty($tarefa['descricao'])): ?>
                                        <p><?php echo htmlspecialchars($tarefa['descricao']); ?></p>
                                    <?php endif; ?>
                                </div>

                                <a href="tarefas.php?excluir=<?php echo $tarefa['id']; ?>" class="delete-btn">
                                    <i class="fa-solid fa-trash"></i>
                                </a>

                            </div>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <p>Nenhuma tarefa pendente.</p>

                    <?php endif; ?>

                </div>

            </div>

            <div class="tasks-column">

                <div class="section-card">
                    <h2>Concluídas</h2>

                    <?php if ($tarefasConcluidas->num_rows > 0): ?>

                        <?php while ($tarefa = $tarefasConcluidas->fetch_assoc()): ?>

                            <div class="task-card completed">

                                <div class="task-content">
                                    <strong><?php echo htmlspecialchars($tarefa['titulo']); ?></strong>
                                </div>

                                <a href="tarefas.php?excluir=<?php echo $tarefa['id']; ?>" class="delete-btn">
                                    <i class="fa-solid fa-trash"></i>
                                </a>

                            </div>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <p>Nenhuma tarefa concluída.</p>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>