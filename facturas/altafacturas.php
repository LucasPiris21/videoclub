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
$id_pedido=$_POST['id_pedido'];
$cuit_proveedor=$_POST['cuit_proveedor'];
$monton=$_POST['monton'];
$conexion=mysqli_connect('localhost','root','','videoclub');
//Para verificar que el pedido o el proveedor exista en la base de datos
$query0="SELECT * FROM `pedidos` WHERE `id_pedido`='$id_pedido'";
$consulta0=mysqli_query($conexion,$query0);
$query1="SELECT * FROM `proveedores` WHERE `cuit`='$cuit_proveedor'";
$consulta1=mysqli_query($conexion,$query1);
if (mysqli_num_rows($consulta0)==0) {
	echo "<body>";
		echo "<div class='container-sm main'>";
			echo "<center>";
				echo "El pedido no existe en la base de datos";
			 	echo "<br><br>";
			 	echo "<a href='altafacturasform.php' class='btn btn-danger'>Volver</a>";
		 	echo "</center>";
		echo "</div>";
	echo "</body>";
} elseif (mysqli_num_rows($consulta1)==0) {
	echo "<body>";
		echo "<div class='container-sm main'>";
			echo "<center>";
				echo "El proveedor no existe en la base de datos";
			 	echo "<br><br>";
			 	echo "<a href='altafacturasform.php' class='btn btn-danger'>Volver</a>";
		 	echo "</center>";
		echo "</div>";
	echo "</body>";
} else {
	$query="INSERT INTO `facturas`(`id_factura`, `monton`, `estado`, `id_pedido`, `cuit_proveedor`) VALUES ('','$monton','0','$id_pedido','$cuit_proveedor')"; // 0: Pendiente; 1: Pagada
	$consulta=mysqli_query($conexion,$query);
	header("Location:facturas.php");
}
?>