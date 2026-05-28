<?php
include("includes/auth.php");
include("includes/habitos.php");

$usuario_id = $_SESSION['id'];

if (isset($_GET['excluir'])) {

    excluirHabito(
        $_GET['excluir'],
        $usuario_id
    );

    header("Location: habitos.php");
    exit();
}

$habitoEditando = null;

if (isset($_GET['editar'])) {

    $idEditar = (int) $_GET['editar'];

    $resultado = listarHabitos($usuario_id);

    while ($h = $resultado->fetch_assoc()) {

        if ($h['id'] == $idEditar) {
            $habitoEditando = $h;
            break;
        }
    }
}

/* SALVAR EDIÇÃO */
if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['editar_habito'])
) {

    editarHabito(
        $_POST['id'],
        $usuario_id,
        $_POST['nome'],
        $_POST['frequencia']
    );

    header("Location: habitos.php");
    exit();
}

/* CRIAR HÁBITO */
if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['nome'])
    && !isset($_POST['editar_habito'])
) {

    $nome = trim($_POST['nome']);
    $frequencia = $_POST['frequencia'];

    if (!empty($nome)) {
        criarHabito($usuario_id, $nome, $frequencia);
    }

    header("Location: habitos.php");
    exit();
}

/* MARCAR HÁBITO */
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
                            <?php if($habitoEditando): ?>

                <form method="POST" class="task-form">

                    <input
                        type="hidden"
                        name="id"
                        value="<?php echo $habitoEditando['id']; ?>"
                    >

                    <input
                        type="hidden"
                        name="editar_habito"
                        value="1"
                    >

                    <input
                        type="text"
                        name="nome"
                        value="<?php echo htmlspecialchars($habitoEditando['nome']); ?>"
                        required
                    >

                    <select name="frequencia">

                        <option
                            value="diario"
                            <?php echo $habitoEditando['frequencia'] == 'diario' ? 'selected' : ''; ?>
                        >
                            Diário
                        </option>

                        <option
                            value="semanal"
                            <?php echo $habitoEditando['frequencia'] == 'semanal' ? 'selected' : ''; ?>
                        >
                            Semanal
                        </option>

                    </select>

                    <button type="submit">
                        <i class="fa-solid fa-pen"></i>
                        Salvar Alterações
                    </button>

                </form>

<hr>

<?php endif; ?>
            <hr>

            <?php while($habito = $habitos->fetch_assoc()): ?>

                <?php
                $feitoHoje = habitoConcluidoHoje($habito['id']);
                ?>
                <div class="task-meta">

    <span class="priority-baixa">

        <?php echo ucfirst($habito['frequencia']); ?>

    </span>

</div>
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

    <div class="task-content">

        <strong>
            <?php echo htmlspecialchars($habito['nome']); ?>
        </strong>

        <div class="task-meta">

            <span class="priority-baixa">
                <?php echo ucfirst($habito['frequencia']); ?>
            </span>

        </div>

    </div>

    <div class="task-actions">

        <a
            href="habitos.php?editar=<?php echo $habito['id']; ?>"
            class="edit-btn"
        >
            <i class="fa-solid fa-pen"></i>
        </a>

        <a
            href="habitos.php?excluir=<?php echo $habito['id']; ?>"
            class="delete-btn"
            onclick="return confirm('Deseja excluir este hábito?')"
        >
            <i class="fa-solid fa-trash"></i>
        </a>

    </div>

</div>
        <?php endwhile; ?>
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