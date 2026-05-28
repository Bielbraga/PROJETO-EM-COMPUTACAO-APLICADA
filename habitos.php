<?php
include("includes/auth.php");
include("includes/habitos.php");

$usuario_id = $_SESSION['id'];

/* criar hábito */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome'])) {

    $nome = trim($_POST['nome']);
    $frequencia = $_POST['frequencia'];

    if (!empty($nome)) {
        criarHabito($usuario_id, $nome, $frequencia);
    }

    header("Location: habitos.php");
    exit();
}

/* marcar hábito */
if (isset($_GET['concluir'])) {

    registrarHabitoHoje($_GET['concluir']);

    header("Location: habitos.php");
    exit();
}

$habitos = listarHabitos($usuario_id);

$totalHabitos = contarHabitos($usuario_id);
$concluidosHoje = contarHabitosConcluidosHoje($usuario_id);

$progresso = 0;

if ($totalHabitos > 0) {
    $progresso = round(($concluidosHoje / $totalHabitos) * 100);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FocusFlow - Hábitos</title>

    <link rel="stylesheet" href="./css/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>

<div class="dashboard-layout">

    <?php include("includes/sidebar.php"); ?>

    <div class="main-content">

        <?php include("includes/header.php"); ?>

        <div class="section-card">

            <h2>Meus Hábitos</h2>

            <form method="POST" class="task-form">

                <input
                    type="text"
                    name="nome"
                    placeholder="Novo hábito"
                    required
                >

                <select name="frequencia">

                    <option value="diario">
                        Diário
                    </option>

                    <option value="semanal">
                        Semanal
                    </option>

                </select>

                <button type="submit">
                    <i class="fa-solid fa-plus"></i>
                    Adicionar
                </button>

            </form>

            <hr>

            <?php while($habito = $habitos->fetch_assoc()): ?>

                <?php
                $feitoHoje = habitoConcluidoHoje($habito['id']);
                ?>

                <div class="task-card">

                    <?php if(!$feitoHoje): ?>

                        <form method="GET">

                            <input
                                type="hidden"
                                name="concluir"
                                value="<?php echo $habito['id']; ?>"
                            >

                            <input
                                type="checkbox"
                                onchange="this.form.submit()"
                            >

                        </form>

                    <?php else: ?>

                        <input
                            type="checkbox"
                            checked
                            disabled
                        >

                    <?php endif; ?>

                    <div>

                        <strong>
                            <?php echo htmlspecialchars($habito['nome']); ?>
                        </strong>

                        <div class="task-meta">

                            <span class="priority-baixa">

                                <?php echo ucfirst($habito['frequencia']); ?>

                            </span>

                        </div>

                    </div>

                </div>

            <?php endwhile; ?>

        </div>

        <div class="section-card mt-4">

            <h3>Progresso de Hoje</h3>

            <h1>
                <?php echo $progresso; ?>%
            </h1>

            <p>

                <?php echo $concluidosHoje; ?>

                de

                <?php echo $totalHabitos; ?>

                hábitos concluídos

            </p>

        </div>

    </div>

</div>

</body>
</html>