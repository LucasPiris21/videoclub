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
$id_factura=$_POST['id_factura'];
$monton=$_POST['monton'];
$dni_personal=$_POST['dni_personal'];
$conexion=mysqli_connect('localhost','root','','videoclub');
//Para verificar que la factura y el personal exista en la base de datos
$query0="SELECT * FROM `facturas` WHERE `id_factura`='$id_factura'";
$consulta0=mysqli_query($conexion,$query0);
$query1="SELECT * FROM `facturas` WHERE `id_factura`='$id_factura' and `estado`='1'";
$consulta1=mysqli_query($conexion,$query1);
$query2="SELECT * FROM `personal` WHERE `dni`='$dni_personal'";
$consulta2=mysqli_query($conexion,$query2);
if (mysqli_num_rows($consulta0)==0 or mysqli_num_rows($consulta1)>0) {
	echo "<body>";
		echo "<div class='container-sm main'>";
			echo "<center>";
				echo "La factura no existe en la base de datos o ya está pagada";
			 	echo "<br><br>";
			 	echo "<a href='altapagosform.php' class='btn btn-danger'>Volver</a>";
		 	echo "</center>";
		echo "</div>";
	echo "</body>";
} elseif (mysqli_num_rows($consulta2)==0) {
	echo "<body>";
		echo "<div class='container-sm main'>";
			echo "<center>";
				echo "El personal no existe en la base de datos";
			 	echo "<br><br>";
			 	echo "<a href='altapagosform.php' class='btn btn-danger'>Volver</a>";
		 	echo "</center>";
		echo "</div>";
	echo "</body>";
} else {
	$query="INSERT INTO `pagos`(`id_pago`, `monton`, `dni_personal`, `id_factura`) VALUES ('','$monton','$dni_personal','$id_factura')";
	$consulta=mysqli_query($conexion,$query);
	//Modifica el estado de la base de datos facturas
	$query2="UPDATE `facturas` SET `estado`='1' WHERE `id_factura`='$id_factura'";
	$consulta2=mysqli_query($conexion,$query2);
	header("Location:pagos.php");
}

?>