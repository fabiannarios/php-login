<?php

session_start();

require 'basededatos.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
	$records = $conn->prepare('SELECT id, email, password FROM usuarios WHERE email = :email');
	$records->bindParam(':email', $_POST['email']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);
	
	$message = '';
	
	if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
	 $_SESSION['id'] = $results['id'];
	 
	 header('pantallade.php');
	} else {
	$message = 'Lo sentimos, tus datos no coinciden';
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Inicie Sesión</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

<?php require 'partials/header.php' ?>

<h1>Iniciar Sesión</h1>
<span>o <a href="registrarse.php">registrarse</a></span>

<?php if (!empty($message)) : ?>
<p><?= $message ?></p>
<?php endif;?>

<form action="pantalladeinicio.php" method="post">
<input type="text" name="email" placeholder="Introduzca un email">
<input type="password" name="password" placeholder="Introduzca un Password">
<input type="submit" value=iniciar>
</form>
</body>
</html>