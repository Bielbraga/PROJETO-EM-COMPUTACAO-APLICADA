<?php

session_start();

include("includes/conexao.php");

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios WHERE email = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $email);

$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows > 0){

    $usuario = $result->fetch_assoc();

    if(password_verify($senha, $usuario['senha'])){

        $_SESSION['id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];

        header("Location: home.php");

    }else{
        header("Location: index.php?erro=1");
    }

}else{
    header("Location: index.php?erro=1");
}
?>