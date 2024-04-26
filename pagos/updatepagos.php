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
$id_pago=$_POST['id_pago'];
$Nmonton=$_POST['monton'];
$Ndni_personal=$_POST['dni_personal'];
$Nid_factura=$_POST['id_factura'];
$conexion=mysqli_connect('localhost','root','','videoclub');
//Para verificar que el personal exista en la base de datos
$query0="SELECT * FROM `personal` WHERE `dni`='$Ndni_personal'";
$consulta0=mysqli_query($conexion,$query0);
if (mysqli_num_rows($consulta0)==0) {
	echo "<body>";
		echo "<div class='container-sm main'>";
			echo "<center>";
				echo "El personal no existe en la base de datos";
			 	echo "<br><br>";
			 	echo "<a href='updatepagosform.php?id=".$id_pago."' class='btn btn-danger'>Volver</a>";
		 	echo "</center>";
		echo "</div>";
	echo "</body>";
} else {
	$query="UPDATE `pagos` SET `id_pago`='$id_pago',`monton`='$Nmonton',`dni_personal`='$Ndni_personal',`id_factura`='$Nid_factura' WHERE `id_pago`='$id_pago'";
	$consulta=mysqli_query($conexion,$query);
	header("Location:pagos.php");
}
// echo $ncuil;
// echo "<br>";
// echo $nnombre;
// echo "<br>";
// echo $ntelefono;
// echo "<br>";
// echo $ndomicilio;
?>