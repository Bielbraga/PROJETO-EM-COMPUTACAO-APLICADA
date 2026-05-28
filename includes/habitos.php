<?php
include("conexao.php");

function criarHabito($usuario_id, $nome, $frequencia = 'diario')
{
    global $conn;

    $sql = "INSERT INTO habitos (usuario_id, nome, frequencia)
            VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $usuario_id, $nome, $frequencia);

    return $stmt->execute();
}

function listarHabitos($usuario_id)
{
    global $conn;

    $sql = "SELECT *
            FROM habitos
            WHERE usuario_id = ?
            ORDER BY data_criacao DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();

    return $stmt->get_result();
}

function registrarHabitoHoje($habito_id)
{
    global $conn;

    $hoje = date('Y-m-d');

    $sqlVerifica = "SELECT id
                    FROM habitos_registro
                    WHERE habito_id = ?
                    AND data_registro = ?";

    $stmt = $conn->prepare($sqlVerifica);
    $stmt->bind_param("is", $habito_id, $hoje);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 0) {

        $sql = "INSERT INTO habitos_registro (
                    habito_id,
                    data_registro,
                    concluido
                )
                VALUES (?, ?, 1)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $habito_id, $hoje);

        return $stmt->execute();
    }

    return false;
}

function habitoConcluidoHoje($habito_id)
{
    global $conn;

    $hoje = date('Y-m-d');

    $sql = "SELECT id
            FROM habitos_registro
            WHERE habito_id = ?
            AND data_registro = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $habito_id, $hoje);
    $stmt->execute();

    return $stmt->get_result()->num_rows > 0;
}

function contarHabitos($usuario_id)
{
    global $conn;

    $sql = "SELECT COUNT(*) AS total
            FROM habitos
            WHERE usuario_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $dados = $resultado->fetch_assoc();

    return $dados['total'];
}

function contarHabitosConcluidosHoje($usuario_id)
{
    global $conn;

    $hoje = date('Y-m-d');

    $sql = "SELECT COUNT(*) AS total
            FROM habitos h
            INNER JOIN habitos_registro hr
            ON h.id = hr.habito_id
            WHERE h.usuario_id = ?
            AND hr.data_registro = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $usuario_id, $hoje);
    $stmt->execute();

    $resultado = $stmt->get_result();
    $dados = $resultado->fetch_assoc();

    return $dados['total'];
}
function editarHabito($id, $usuario_id, $nome, $frequencia)
{
    global $conn;

    $sql = "UPDATE habitos
            SET nome = ?, frequencia = ?
            WHERE id = ? AND usuario_id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssii",
        $nome,
        $frequencia,
        $id,
        $usuario_id
    );

    return $stmt->execute();
}

function excluirHabito($id, $usuario_id)
{
    global $conn;

    $sql = "DELETE FROM habitos
            WHERE id = ? AND usuario_id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ii",
        $id,
        $usuario_id
    );

    return $stmt->execute();
}
?>