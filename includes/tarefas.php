<?php
include("conexao.php");

function criarTarefa($usuario_id, $titulo, $descricao = null, $categoria = null)
{
    global $conn;

    $sql = "INSERT INTO tarefas (usuario_id, titulo, descricao, categoria)
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $usuario_id, $titulo, $descricao, $categoria);

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
            WHERE usuario_id = ?";

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
?>