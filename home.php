<?php
include("includes/auth.php");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FocusFlow - Dashboard</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet">

    <link
    rel="stylesheet"
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

                    <button class="add-task-btn">
                        <i class="fa-solid fa-plus"></i>
                        Nova tarefa
                    </button>
                </div>

                <div class="task-section">
                    <h3>Tarefas de Hoje</h3>

                    <div class="task-card">
                        <input type="checkbox">
                        <div>
                            <strong>Estudar PHP</strong>
                            <p>Revisar autenticação e sessões.</p>
                        </div>
                    </div>

                    <div class="task-card">
                        <input type="checkbox">
                        <div>
                            <strong>Projeto da Faculdade</strong>
                            <p>Montar dashboard inicial.</p>
                        </div>
                    </div>

                    <div class="task-card">
                        <input type="checkbox">
                        <div>
                            <strong>Treino</strong>
                            <p>Push day às 19h.</p>
                        </div>
                    </div>
                </div>

                <div class="add-task-box">
                    <input type="text" placeholder="Adicionar nova tarefa...">
                    <button>
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>

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
                            <strong>12</strong>
                            <span>Tarefas</span>
                        </div>

                        <div>
                            <strong>5</strong>
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