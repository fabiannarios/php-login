<?php
require'basededatos.php';

$message = '';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
	$sql = "INSERT INTO usuarios (email, password) VALUES (:email, :password)";
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(':email',$_POST['email']);
	$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
	$stmt->bindParam(':password',$password);
	
	if ($stmt->execute()) {
		$message = 'Usuario creado con exito';
	} else {
		$message = 'Ocurrio un error al crear su password';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="uff-8">
<title>Registrarse</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

<?php require 'partials/header.php' ?>

<?php if(!empty($message)): ?>
<p><?= $message ?></p>
<?php endif; ?>

<h1>Registrate</h1>
<span>o <a href="pantalladeinicio.php">inicia sesion</a></span>

<form action="registrarse.php" method="POST">
<input type="text" name="email" placeholder="Introduzca un email">
<input type="password" name="password" placeholder="Introduzca su Password">
<input type="password" name="confirm_password" placeholder="Confirmar su Password">
<input type="submit" value=iniciar>
</form>

</body>
</html>