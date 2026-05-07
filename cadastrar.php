<?php
include("includes/conexao.php");

if(isset($_POST['nome'])){

    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios(nome,email,senha)
            VALUES(?,?,?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("sss",$nome,$email,$senha);

    $stmt->execute();

    header("Location:index.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

<meta charset="UTF-8">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="css/style.css">

<title>Cadastro</title>

</head>

<body>

<div class="overlay">

<div class="login-card">

<h2>Criar Conta</h2>

<form method="POST">

<div class="mb-3">
<input type="text" name="nome" class="form-control" placeholder="Nome" required>
</div>

<div class="mb-3">
<input type="email" name="email" class="form-control" placeholder="E-mail" required>
</div>

<div class="mb-4">
<input type="password" name="senha" class="form-control" placeholder="Senha" required>
</div>

<button class="btn-login">
Cadastrar
</button>

</form>

</div>

</div>

</body>
</html>