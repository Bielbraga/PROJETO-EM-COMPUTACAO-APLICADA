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
if (isset($_GET['excluir'])) {

    excluirTarefa(
        $_GET['excluir'],
        $usuario_id
    );

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
$editar = null;

if (isset($_GET['editar'])) {

    $editar = buscarTarefa(
        $_GET['editar'],
        $usuario_id
    );
}
if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['editar_tarefa'])
)
{
    editarTarefa(
        $_POST['id'],
        $usuario_id,
        $_POST['titulo'],
        $_POST['prazo'],
        $_POST['urgencia']
    );

    header("Location: home.php");
    exit();
}
$busca = $_GET['busca'] ?? '';
$filtro = $_GET['filtro'] ?? '';
if (!empty($busca)) {

    $tarefas = pesquisarTarefas(
        $usuario_id,
        $busca
    );

}
elseif (!empty($filtro)) {

    $tarefas = listarTarefasFiltradas(
        $usuario_id,
        $filtro
    );

}
else {

    $tarefas = listarTarefas($usuario_id);

}
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

    <div class="task-filters">

        <a href="home.php">
            Todas
        </a>

        <a href="home.php?filtro=alta">
            🔴 Alta
        </a>

        <a href="home.php?filtro=media">
            🟡 Média
        </a>

        <a href="home.php?filtro=baixa">
            🟢 Baixa
        </a>

    </div>

    <h2>Tarefas de Hoje</h2>

    <?php if ($tarefas->num_rows > 0): ?>

<?php while ($tarefa = $tarefas->fetch_assoc()): ?>

    <div class="task-card">
            <?php if ($editar): ?>

<div class="section-card">

    <h3>Editar Tarefa</h3>

    <form method="POST" class="task-form">

        <input
            type="hidden"
            name="id"
            value="<?php echo $editar['id']; ?>"
        >

        <input
            type="text"
            name="titulo"
            value="<?php echo htmlspecialchars($editar['titulo']); ?>"
            required
        >

        <input
            type="date"
            name="prazo"
            value="<?php echo $editar['prazo']; ?>"
        >

        <select name="urgencia">

            <option value="baixa">Baixa</option>
            <option value="media">Média</option>
            <option value="alta">Alta</option>

        </select>

        <button
            type="submit"
            name="editar_tarefa"
        >
            Salvar
        </button>

    </form>

</div>

<?php endif; ?>
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
            <div class="task-actions">

    <a
        href="home.php?editar=<?php echo $tarefa['id']; ?>"
        class="edit-btn"
    >
        ✏️
    </a>

    <a
        href="home.php?excluir=<?php echo $tarefa['id']; ?>"
        class="delete-btn"
        onclick="return confirm('Excluir tarefa?')"
    >
        🗑️
    </a>

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

    <?php
    $prazos = listarPrazosTarefas($usuario_id);

$diasComPrazo = [];

while ($prazo = $prazos->fetch_assoc()) {

    $dia = date(
        'j',
        strtotime($prazo['prazo'])
    );

    $diasComPrazo[] = $dia;
}

    $mesAtual = date('m');
    $anoAtual = date('Y');

    $primeiroDia = mktime(
        0,
        0,
        0,
        $mesAtual,
        1,
        $anoAtual
    );

    $diasNoMes = date('t', $primeiroDia);

    $diaSemana = date('N', $primeiroDia);

    ?>

    <div class="calendar-grid">

        <div>Seg</div>
        <div>Ter</div>
        <div>Qua</div>
        <div>Qui</div>
        <div>Sex</div>
        <div>Sáb</div>
        <div>Dom</div>

        <?php

        for ($i = 1; $i < $diaSemana; $i++) {
            echo "<div></div>";
        }

for ($dia = 1; $dia <= $diasNoMes; $dia++) {

    $classe = '';

    if ($dia == date('d')) {
        $classe = 'calendar-today';
    }

    if (in_array($dia, $diasComPrazo)) {
        $classe .= ' calendar-task';
    }

    echo "<div class='$classe'>$dia</div>";
}

        ?>

    </div>

</div>

            </div>

        </div>

    </div>

</div>

</body>
</html>