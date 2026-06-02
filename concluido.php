<?php
include("includes/auth.php");
include("includes/tarefas.php");

$usuario_id = $_SESSION['id'];
if (isset($_GET['restaurar'])) {

    restaurarTarefa(
        $_GET['restaurar'],
        $usuario_id
    );

    header("Location: concluido.php");
    exit();
}

$tarefas = listarConcluidas($usuario_id);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FocusFlow - Concluídas</title>

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

        <div class="task-section">

            <h2>✅ Tarefas Concluídas</h2>

            <?php if ($tarefas->num_rows > 0): ?>

                <?php while ($tarefa = $tarefas->fetch_assoc()): ?>

                    <div class="task-card completed">

                        <div class="task-content">

                            <strong>
                                <?php echo htmlspecialchars($tarefa['titulo']); ?>
                            </strong>

                            <div class="task-meta">

                                <?php if (!empty($tarefa['prazo'])): ?>
                                    <span class="task-deadline">
                                        📅 <?php echo date('d/m/Y', strtotime($tarefa['prazo'])); ?>
                                    </span>
                                <?php endif; ?>

                                <span class="priority-badge priority-<?php echo $tarefa['urgencia']; ?>">

                                    <?php
                                    if ($tarefa['urgencia'] === 'alta') {
                                        echo '🔴 Alta';
                                    } elseif ($tarefa['urgencia'] === 'media') {
                                        echo '🟡 Média';
                                    } else {
                                        echo '🟢 Baixa';
                                    }
                                    ?>

                                </span>

                            </div>

                        </div>

                        <div class="task-actions">

                            <a
                                href="concluido.php?restaurar=<?php echo $tarefa['id']; ?>"
                                class="edit-btn"
                                title="Restaurar tarefa"
                            >
                                ↩️
                            </a>

                        </div>

                    </div>

                <?php endwhile; ?>

            <?php else: ?>

                <p>Nenhuma tarefa concluída.</p>

            <?php endif; ?>

        </div>

    </div>

</div>

</body>
</html>