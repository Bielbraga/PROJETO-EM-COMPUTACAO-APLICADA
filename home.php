<?php
include("includes/auth.php");
include("includes/tarefas.php");

$usuario_id = $_SESSION['id'];

/* adicionar tarefa */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['titulo'])) {

    $titulo = trim($_POST['titulo']);
    $prazo = $_POST['prazo'] ?? null;
    $urgencia = $_POST['urgencia'] ?? 'media';

    if (!empty($titulo)) {
        criarTarefa(
            $usuario_id,
            $titulo,
            null,
            null,
            $prazo,
            $urgencia
        );
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
if (isset($_GET['favoritar'])) {

    marcarImportante(
        $_GET['favoritar'],
        $usuario_id
    );

    header("Location: home.php");
    exit();
}

if (isset($_GET['desfavoritar'])) {

    removerImportante(
        $_GET['desfavoritar'],
        $usuario_id
    );

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

        <form method="GET" style="margin: 0;">
            <input
                type="hidden"
                name="concluir"
                value="<?php echo $tarefa['id']; ?>"
            >

            <input
                type="checkbox"
                onchange="this.form.submit()"
            >
        </form>

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

            <?php if ($tarefa['importante']): ?>

                <a
                    href="home.php?desfavoritar=<?php echo $tarefa['id']; ?>"
                    class="edit-btn"
                >
                    ⭐
                </a>

            <?php else: ?>

                <a
                    href="home.php?favoritar=<?php echo $tarefa['id']; ?>"
                    class="edit-btn"
                >
                    ☆
                </a>

            <?php endif; ?>

        </div>

    </div>

<?php endwhile; ?>
<?php else: ?>

    <p>Nenhuma tarefa cadastrada.</p>

<?php endif; ?>
</div>

                <form method="POST" class="task-form">

                    <input
                        type="text"
                        name="titulo"
                        placeholder="Título da tarefa"
                        required
                    >

                    <input
                        type="date"
                        name="prazo"
                    >

                    <select name="urgencia">
                        <option value="baixa">🟢 Baixa</option>
                        <option value="media" selected>🟡 Média</option>
                        <option value="alta">🔴 Alta</option>
                    </select>

                    <button type="submit">
                        <i class="fa-solid fa-plus"></i>
                        Adicionar
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