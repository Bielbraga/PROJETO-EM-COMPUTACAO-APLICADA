<?php
include("includes/auth.php");
include("includes/tarefas.php");

$usuario_id = $_SESSION['id'];

$tarefas = listarImportantes($usuario_id);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FocusFlow - Importante</title>

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
                        <h1>⭐ Importante</h1>
                        <p>Suas tarefas marcadas como prioridade.</p>
                    </div>
                </div>

                <div class="task-section">

                    <h3>Tarefas Importantes</h3>

                    <?php if ($tarefas->num_rows > 0): ?>

                        <?php while ($tarefa = $tarefas->fetch_assoc()): ?>

                            <div class="task-card">

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

                                    <span style="font-size:22px;">
                                        ⭐
                                    </span>

                                </div>

                            </div>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <div class="empty-state">
                            <p>Nenhuma tarefa importante encontrada.</p>
                        </div>

                    <?php endif; ?>

                </div>

            </div>

            <div class="dashboard-right">

                <div class="info-card">

                    <h4>Resumo</h4>

                    <div class="stats">

                        <div>

                            <strong>
                                <?php echo $tarefas->num_rows; ?>
                            </strong>

                            <span>Importantes</span>

                        </div>

                    </div>

                </div>

                <div class="info-card">

                    <h4>Dica</h4>

                    <p>
                        Marque apenas tarefas realmente prioritárias para manter o foco.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>