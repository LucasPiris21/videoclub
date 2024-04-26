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
$credito=$_POST['credito'];
$periodo=$_POST['periodo'];
$fecha_emision=$_POST['fecha_emision'];
$fecha_vencimiento=$_POST['fecha_vencimiento'];
$dni_cliente=$_POST['dni_cliente'];
$dni_personal=$_POST['dni_personal'];
$conexion=mysqli_connect('localhost','root','','videoclub');
// Verificar que el DNI del Cliente y del Personal se encuentre en la base de datos
$query0="SELECT * FROM `clientes` WHERE `dni`='$dni_cliente'";
$consulta0=mysqli_query($conexion,$query0);
$query1="SELECT * FROM `personal` WHERE `dni`='$dni_personal'";
$consulta1=mysqli_query($conexion,$query1);
if (mysqli_num_rows($consulta0)==0 or mysqli_num_rows($consulta1)==0) {
	echo "<body>";
		echo "<div class='container-sm main'>";
			echo "<center>";
			echo "El cliente o personal no existe en la base de datos";
		 	echo "<br><br>";
		 	echo "<a href='altabonosform.php' class='btn btn-danger'>Volver</a>";
		 	echo "</center>";
		echo "</div>";
	echo "</body>";
} else {
 	$query="INSERT INTO `bono`(`id_bono`, `credito`, `credito_disponible`, `periodo`, `fecha_emision`, `fecha_vencimiento`, `dni_cliente`, `dni_personal`) VALUES ('','$credito','$credito','$periodo','$fecha_emision','$fecha_vencimiento','$dni_cliente','$dni_personal')";
	$consulta=mysqli_query($conexion,$query);
	header("Location:bonos.php");
}

?>