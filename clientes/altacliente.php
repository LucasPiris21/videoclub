<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
</html>
<?php
session_start();
	if (empty($_SESSION['estado'])) {
header("location:../index.php");
} 
$dni=$_POST['dni'];
$nombre=$_POST['nombre'];
$telefono=$_POST['telefono'];
$email=$_POST['email'];
$conexion=mysqli_connect('localhost','root','','videoclub');
// Verificar que el DNI del Cliente se encuentre en la base de datos
$query0 = "SELECT * FROM `clientes` WHERE `dni`='$dni'";
$consulta0 = mysqli_query($conexion,$query0);
if (mysqli_num_rows($consulta0) > 0) {
	echo "<body>";
		echo "<div class='container-sm main'>";
			echo "<center>";
				echo "El DNI del cliente ya existe en la base de datos";
			 	echo "<br><br>";
			 	echo "<a href='altaclienteform.php' class='btn btn-danger'>Volver</a>";
		 	echo "</center>";
		echo "</div>";
	echo "</body>";
} else {
	$query="INSERT INTO `clientes`(`dni`, `nombre`, `telefono`, `email`) VALUES ('$dni','$nombre','$telefono','$email')";
	$consulta=mysqli_query($conexion,$query);
	header("Location:clientes.php");
}
?>