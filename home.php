<?php

session_start();

if(!isset($_SESSION['id'])){
    header("Location:index.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<title>Home</title>
</head>

<body>

<div class="container mt-5">

<h1>
Bem-vindo,
<?php echo $_SESSION['nome']; ?>
</h1>

<a href="logout.php" class="btn btn-danger mt-3">
Sair
</a>

</div>

</body>
</html>