<?php
session_start();

require 'basededatos.php';

if (isset($_SESSION['usuario_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM usuarios WHERE id = :id');
    $records->bindParam(':id', $_SESSION['usuario_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $usuario = null;

    if (count($results)> 0 ){
        $usuario = $results;
    }

}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="uff-8">
<title>Bienvenido</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

<?php require 'partials/header.php' ?>

<?php if (!empty($usuario)):?>
    <br>Hola. <?= $usuario['email'] ?>
    <br>Tu estas satisfactoriamente registrado en la sesion</br>
    <a href="pantalladeinicio.php">cerrar sesion</a>

    <?php else: ?>

<h1>Por favor inicie sesión o regístrese</h1>

<a href="pantalladeinicio.php">Iniciar sesión</a>
<a href="registrarse.php">Regístrarse</a>
<?php endif;?>
</body>
</html>