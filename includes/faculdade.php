<?php
include("conexao.php");

function criarAtividade($usuario_id, $disciplina, $atividade, $prazo = null)
{
    global $conn;

    $sql = "INSERT INTO faculdade (
                usuario_id,
                disciplina,
                atividade,
                prazo
            )
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "isss",
        $usuario_id,
        $disciplina,
        $atividade,
        $prazo
    );

    return $stmt->execute();
}

function listarAtividades($usuario_id)
{
    global $conn;

    $sql = "SELECT *
            FROM faculdade
            WHERE usuario_id = ?
            AND status = 'pendente'
            ORDER BY prazo ASC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();

    return $stmt->get_result();
}

function listarConcluidasFaculdade($usuario_id)
{
    global $conn;

    $sql = "SELECT *
            FROM faculdade
            WHERE usuario_id = ?
            AND status = 'concluida'
            ORDER BY prazo ASC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();

    return $stmt->get_result();
}

function concluirAtividade($id, $usuario_id)
{
    global $conn;

    $sql = "UPDATE faculdade
            SET status = 'concluida'
            WHERE id = ?
            AND usuario_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id, $usuario_id);

    return $stmt->execute();
}

function excluirAtividade($id, $usuario_id)
{
    global $conn;

    $sql = "DELETE FROM faculdade
            WHERE id = ?
            AND usuario_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id, $usuario_id);

    return $stmt->execute();
}

function contarAtividades($usuario_id)
{
    global $conn;

    $sql = "SELECT COUNT(*) as total
            FROM faculdade
            WHERE usuario_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $dados = $resultado->fetch_assoc();

    return $dados['total'];
}

function contarConcluidasFaculdade($usuario_id)
{
    global $conn;

    $sql = "SELECT COUNT(*) as total
            FROM faculdade
            WHERE usuario_id = ?
            AND status = 'concluida'";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $dados = $resultado->fetch_assoc();

    return $dados['total'];
}
?>