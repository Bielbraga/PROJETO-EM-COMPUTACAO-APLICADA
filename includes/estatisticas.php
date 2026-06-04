<?php
include("conexao.php");

function totalTarefas($usuario_id)
{
    global $conn;

    $sql = "SELECT COUNT(*) AS total
            FROM tarefas
            WHERE usuario_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();

    return $stmt->get_result()->fetch_assoc()['total'];
}

function totalConcluidas($usuario_id)
{
    global $conn;

    $sql = "SELECT COUNT(*) AS total
            FROM tarefas
            WHERE usuario_id = ?
            AND status = 'concluida'";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();

    return $stmt->get_result()->fetch_assoc()['total'];
}

function totalImportantes($usuario_id)
{
    global $conn;

    $sql = "SELECT COUNT(*) AS total
            FROM tarefas
            WHERE usuario_id = ?
            AND importante = 1";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();

    return $stmt->get_result()->fetch_assoc()['total'];
}

function totalHabitos($usuario_id)
{
    global $conn;

    $sql = "SELECT COUNT(*) AS total
            FROM habitos
            WHERE usuario_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();

    return $stmt->get_result()->fetch_assoc()['total'];
}

function totalFaculdade($usuario_id)
{
    global $conn;

    $sql = "SELECT COUNT(*) AS total
            FROM faculdade
            WHERE usuario_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();

    return $stmt->get_result()->fetch_assoc()['total'];
}
?>