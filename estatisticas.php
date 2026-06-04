<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("includes/auth.php");
include("includes/estatisticas.php");

$usuario_id = $_SESSION['id'];

$totalTarefas = totalTarefas($usuario_id);
$totalConcluidas = totalConcluidas($usuario_id);
$totalImportantes = totalImportantes($usuario_id);
$totalHabitos = totalHabitos($usuario_id);
$totalFaculdade = totalFaculdade($usuario_id);

$taxaConclusao = 0;

if ($totalTarefas > 0) {
    $taxaConclusao = round(
        ($totalConcluidas / $totalTarefas) * 100
    );
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FocusFlow - Estatísticas</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="dashboard-layout">

    <?php include("includes/sidebar.php"); ?>

    <div class="main-content">

        <?php include("includes/header.php"); ?>

        <div class="welcome-card">
            <div>
                <h1>📊 Estatísticas</h1>
                <p>Acompanhe seu desempenho no FocusFlow.</p>
            </div>
        </div>

        <div class="stats-grid">

            <div class="info-card">
                <h4>📋 Tarefas</h4>
                <h2><?php echo $totalTarefas; ?></h2>
            </div>

            <div class="info-card">
                <h4>✅ Concluídas</h4>
                <h2><?php echo $totalConcluidas; ?></h2>
            </div>

            <div class="info-card">
                <h4>⭐ Importantes</h4>
                <h2><?php echo $totalImportantes; ?></h2>
            </div>

            <div class="info-card">
                <h4>🔥 Hábitos</h4>
                <h2><?php echo $totalHabitos; ?></h2>
            </div>

            <div class="info-card">
                <h4>📚 Faculdade</h4>
                <h2><?php echo $totalFaculdade; ?></h2>
            </div>

            <div class="info-card">
                <h4>📈 Taxa de Conclusão</h4>
                <h2><?php echo $taxaConclusao; ?>%</h2>
            </div>

        </div>
        <div class="info-card chart-card">
            <h4>📊 Distribuição de Produtividade</h4>

            <canvas id="productivityChart"></canvas>
        </div>

    </div>

</div>
<script>
const ctx = document.getElementById('productivityChart');

new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [
            'Tarefas',
            'Concluídas',
            'Importantes',
            'Hábitos',
            'Faculdade'
        ],
        datasets: [{
            data: [
                <?php echo $totalTarefas; ?>,
                <?php echo $totalConcluidas; ?>,
                <?php echo $totalImportantes; ?>,
                <?php echo $totalHabitos; ?>,
                <?php echo $totalFaculdade; ?>
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>
</body>
</html>