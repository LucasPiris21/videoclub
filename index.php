<?php
session_start();
$falla=0;
if (isset($_SESSION['estado'])) {
	header("location:main.php");
}
if (isset($_POST['submit'])) {
	$dni=$_POST['dni'];
	$contrasena=$_POST['password'];
	$conexion=mysqli_connect('localhost','root','','videoclub');
	$query="SELECT `nombre`, `cargo` FROM `personal` WHERE `dni`='$dni' AND `contrasena`='$contrasena'";
	$consulta=mysqli_query($conexion,$query);
	if (mysqli_num_rows($consulta)<>0) {
		$fila=mysqli_fetch_array($consulta);
		//var_dump($fila);
	 	$_SESSION['nombre']=$fila[0];
	 	$_SESSION['cargo']=$fila[1];
	 	$_SESSION['estado']="activado";
	 	//echo $_SESSION['nombre'];
	 	//echo $_SESSION['cargo'];
	 	header("location:main.php");
	} else {
		session_destroy();
		$falla=1;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width initial-scale=1.0" />
	<title>Inicio de sesión</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="abs-center">
	<div class="container-sm form">
		<div class="row justify-content-between indexform">
			<div class="col align-self-center">
				<img src="images/logoindex.png" class="img-fluid logo">
			</div>
		</div>
		<div class="row justify-content-between indexform" style="height: 150%;">
			<div class="col align-self-center">
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<center>
						Iniciar Sesión
					</center>
					<br>
					<div class="form-group">
						<label for="dni">DNI:</label><br>
						<input class="form-control" type="text" name="dni" placeholder="Ingrese DNI"><br>
					<div class="form-group">
						<label for="password">Contraseña:</label><br>
						<input class="form-control" type="password" name="password" placeholder="Ingrese contraseña"><br>
						<center>
							<button type="submit" name="submit" class="btn btn-danger">Iniciar sesión</button>
						</center>
						<?php
							if ($falla==1) {
								echo "<div style='margin-top:20px; text-align:center; font-size: small; color:red'>Usuario o contraseña incorrectos</div>";
							}
						?>
				</form>
			</div>
		</div>
	</div>
	</div>
</body>
</html>