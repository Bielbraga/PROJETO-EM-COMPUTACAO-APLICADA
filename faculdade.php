<?php
include("includes/auth.php");
include("includes/faculdade.php");

$usuario_id = $_SESSION['id'];

/* adicionar atividade */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['atividade'])) {

    $disciplina = trim($_POST['disciplina']);
    $atividade = trim($_POST['atividade']);
    $prazo = $_POST['prazo'] ?? null;

    if (!empty($disciplina) && !empty($atividade)) {

        criarAtividade(
            $usuario_id,
            $disciplina,
            $atividade,
            $prazo
        );
    }

    header("Location: faculdade.php");
    exit();
}

/* concluir atividade */
if (isset($_GET['concluir'])) {

    concluirAtividade(
        $_GET['concluir'],
        $usuario_id
    );

    header("Location: faculdade.php");
    exit();
}

/* excluir atividade */
if (isset($_GET['excluir'])) {

    excluirAtividade(
        $_GET['excluir'],
        $usuario_id
    );

    header("Location: faculdade.php");
    exit();
}

$atividades = listarAtividades($usuario_id);

$totalAtividades = contarAtividades($usuario_id);
$totalConcluidas = contarConcluidasFaculdade($usuario_id);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FocusFlow - Faculdade</title>

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
                        <h1>📚 Faculdade</h1>
                        <p>Gerencie trabalhos, atividades e prazos acadêmicos.</p>
                    </div>
                </div>

                <div class="task-section">

                    <h3>Atividades Pendentes</h3>

                    <?php if ($atividades->num_rows > 0): ?>

                        <?php while ($atividade = $atividades->fetch_assoc()): ?>

                            <div class="task-card">

                                <form method="GET" style="margin:0;">

                                    <input
                                        type="hidden"
                                        name="concluir"
                                        value="<?php echo $atividade['id']; ?>"
                                    >

                                    <input
                                        type="checkbox"
                                        onchange="this.form.submit()"
                                    >

                                </form>

                                <div class="task-content">

                                    <strong>
                                        <?php echo htmlspecialchars($atividade['atividade']); ?>
                                    </strong>

                                    <div class="task-meta">

                                        <span class="priority-baixa">
                                            📘 <?php echo htmlspecialchars($atividade['disciplina']); ?>
                                        </span>

                                        <?php if (!empty($atividade['prazo'])): ?>

                                            <span class="task-deadline">
                                                📅 <?php echo date('d/m/Y', strtotime($atividade['prazo'])); ?>
                                            </span>

                                        <?php endif; ?>

                                    </div>

                                </div>

                                <div class="task-actions">

                                    <a
                                        href="faculdade.php?excluir=<?php echo $atividade['id']; ?>"
                                        class="delete-btn"
                                        onclick="return confirm('Deseja excluir esta atividade?')"
                                    >
                                        🗑️
                                    </a>

                                </div>

                            </div>

                        <?php endwhile; ?>

                    <?php else: ?>

                        <p>Nenhuma atividade cadastrada.</p>

                    <?php endif; ?>

                </div>

                <form method="POST" class="task-form">

                    <input
                        type="text"
                        name="disciplina"
                        placeholder="Disciplina"
                        required
                    >

                    <input
                        type="text"
                        name="atividade"
                        placeholder="Atividade"
                        required
                    >

                    <input
                        type="date"
                        name="prazo"
                    >

                    <button type="submit">
                        <i class="fa-solid fa-plus"></i>
                        Adicionar
                    </button>

                </form>

            </div>

            <div class="dashboard-right">

                <div class="info-card">

                    <h4>Resumo</h4>

                    <div class="stats">

                        <div>
                            <strong><?php echo $totalAtividades; ?></strong>
                            <span>Total</span>
                        </div>

                        <div>
                            <strong><?php echo $totalConcluidas; ?></strong>
                            <span>Concluídas</span>
                        </div>

                    </div>

                </div>

                <div class="info-card">

                    <h4>Dicas</h4>

                    <ul>
                        <li>📘 Organize por disciplina</li>
                        <li>📝 Atualize os prazos</li>
                        <li>🎯 Priorize entregas próximas</li>
                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>