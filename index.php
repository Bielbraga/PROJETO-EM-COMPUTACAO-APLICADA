<?php
session_start();

if(isset($_SESSION['id'])){
    header("Location: home.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>FocusFlow</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="css/style.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<body>

<div class="overlay">

<div class="login-card">

<div class="logo">
<h1>FocusFlow</h1>
</div>

<h2>Bem-vindo!</h2>

<p class="subtitle">
Acesse sua conta
</p>

<?php
if(isset($_GET['erro'])){
    echo "<div class='error'>E-mail ou senha inválidos</div>";
}
?>

<form action="login.php" method="POST">

<div class="mb-3">
<input
type="email"
name="email"
class="form-control"
placeholder="E-mail"
required
>
</div>

<div class="mb-4">
<input
type="password"
name="senha"
class="form-control"
placeholder="Senha"
required
>
</div>

<button type="submit" class="btn-login">
Entrar
</button>

</form>

<div class="text-center mt-4">

<p>
Não tem conta?
<a href="cadastrar.php" class="link">
Cadastre-se
</a>
</p>

</div>

</div>

</div>

</body>
</html>