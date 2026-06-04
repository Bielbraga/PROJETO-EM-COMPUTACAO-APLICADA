<?php
include("conexao.php");

function criarTarefa($usuario_id, $titulo, $descricao = null, $categoria = null, $prazo = null, $urgencia = 'media')
{
    global $conn;

    $sql = "INSERT INTO tarefas (
                usuario_id,
                titulo,
                descricao,
                categoria,
                prazo,
                urgencia
            )
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "isssss",
        $usuario_id,
        $titulo,
        $descricao,
        $categoria,
        $prazo,
        $urgencia
    );

    return $stmt->execute();
}

function listarTarefas($usuario_id)
{
    global $conn;

    $sql = "SELECT * FROM tarefas
            WHERE usuario_id = ?
            AND status = 'pendente'
            ORDER BY data_criacao DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();

    return $stmt->get_result();
}

function listarConcluidas($usuario_id)
{
    global $conn;

    $sql = "SELECT * FROM tarefas
            WHERE usuario_id = ?
            AND status = 'concluida'
            ORDER BY data_criacao DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();

    return $stmt->get_result();
}

function contarTarefas($usuario_id)
{
    global $conn;

    $sql = "SELECT COUNT(*) as total
            FROM tarefas
            WHERE usuario_id = ?
            AND status = 'pendente'";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $dados = $resultado->fetch_assoc();

    return $dados['total'];
}

function contarConcluidas($usuario_id)
{
    global $conn;

    $sql = "SELECT COUNT(*) as total
            FROM tarefas
            WHERE usuario_id = ?
            AND status = 'concluida'";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $dados = $resultado->fetch_assoc();

    return $dados['total'];
}

function concluirTarefa($tarefa_id, $usuario_id)
{
    global $conn;

    $sql = "UPDATE tarefas
            SET status = 'concluida'
            WHERE id = ?
            AND usuario_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $tarefa_id, $usuario_id);

    return $stmt->execute();
}

function excluirTarefa($tarefa_id, $usuario_id)
{
    global $conn;

    $sql = "DELETE FROM tarefas
            WHERE id = ?
            AND usuario_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $tarefa_id, $usuario_id);

    return $stmt->execute();
}
function marcarImportante($tarefa_id, $usuario_id)
{
    global $conn;

    $sql = "UPDATE tarefas
            SET importante = 1
            WHERE id = ?
            AND usuario_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $tarefa_id, $usuario_id);

    return $stmt->execute();
}

function removerImportante($tarefa_id, $usuario_id)
{
    global $conn;

    $sql = "UPDATE tarefas
            SET importante = 0
            WHERE id = ?
            AND usuario_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $tarefa_id, $usuario_id);

    return $stmt->execute();
}

function listarImportantes($usuario_id)
{
    global $conn;

    $sql = "SELECT *
            FROM tarefas
            WHERE usuario_id = ?
            AND importante = 1
            AND status = 'pendente'
            ORDER BY prazo ASC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();

    return $stmt->get_result();
}
function restaurarTarefa($tarefa_id, $usuario_id)
{
    global $conn;

    $sql = "UPDATE tarefas
            SET status = 'pendente'
            WHERE id = ?
            AND usuario_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $tarefa_id, $usuario_id);

    return $stmt->execute();
}
function buscarTarefa($id, $usuario_id)
{
    global $conn;

    $sql = "SELECT * FROM tarefas
            WHERE id = ?
            AND usuario_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id, $usuario_id);
    $stmt->execute();

    return $stmt->get_result()->fetch_assoc();
}

function editarTarefa(
    $id,
    $usuario_id,
    $titulo,
    $prazo,
    $urgencia
)
{
    global $conn;

    $sql = "UPDATE tarefas
            SET titulo = ?,
                prazo = ?,
                urgencia = ?
            WHERE id = ?
            AND usuario_id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "sssii",
        $titulo,
        $prazo,
        $urgencia,
        $id,
        $usuario_id
    );

    return $stmt->execute();
}
function pesquisarTarefas($usuario_id, $busca)
{
    global $conn;

    $sql = "
        SELECT *
        FROM tarefas
        WHERE usuario_id = ?
        AND status = 'pendente'
        AND titulo LIKE ?
        ORDER BY data_criacao DESC
    ";

    $stmt = $conn->prepare($sql);

    $texto = "%" . $busca . "%";

    $stmt->bind_param(
        "is",
        $usuario_id,
        $texto
    );

    $stmt->execute();

    return $stmt->get_result();
}
function listarTarefasFiltradas($usuario_id, $urgencia)
{
    global $conn;

    $sql = "
        SELECT *
        FROM tarefas
        WHERE usuario_id = ?
        AND status = 'pendente'
        AND urgencia = ?
        ORDER BY data_criacao DESC
    ";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "is",
        $usuario_id,
        $urgencia
    );

    $stmt->execute();

    return $stmt->get_result();
}
function listarPrazosTarefas($usuario_id)
{
    global $conn;

    $sql = "
        SELECT prazo
        FROM tarefas
        WHERE usuario_id = ?
        AND prazo IS NOT NULL
        AND status = 'pendente'
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();

    return $stmt->get_result();
}
?>