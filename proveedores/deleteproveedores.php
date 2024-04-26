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
if ($_SESSION['cargo']=="Empleado") {
	header("location:../main.php");
}
$filaid=$_GET['id'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="DELETE FROM `proveedores` WHERE `cuit`='$filaid'";
$query0="SELECT * FROM `copias` WHERE `cuit_proveedor`='$filaid' AND `disponibilidad`='1'";
$consulta0 = mysqli_query($conexion,$query0);
if (mysqli_num_rows($consulta0)>0) {
	echo "<body>";
		echo "<div class='container-sm main'>";
			echo "<center>";
			echo "Una de las copias suministradas por el proveedor no ha sido devuelta";
		 	echo "<br><br>";
		 	echo "<a href='proveedores.php' class='btn btn-danger'>Volver</a>";
		 	echo "</center>";
		echo "</div>";
	echo "</body>";
} else{
	$consulta=mysqli_query($conexion,$query);
	//Actualizar cantidad de copias en la película
	$rowsquery = "SELECT `id_pelicula` FROM `peliculas`";
	$consulta1 = mysqli_query($conexion,$rowsquery);
	while ($row = mysqli_fetch_array($consulta1)) {
		$cantquery="SELECT COUNT(*) as copies FROM `copias` WHERE `id_pelicula`=$row[0] AND `disponibilidad`=0";
		$updatedcant=mysqli_fetch_array(mysqli_query($conexion,$cantquery));
		$updatequery="UPDATE `peliculas` SET `cant_copias`='$updatedcant[copies]' WHERE `id_pelicula`=$row[0]";
		$update=mysqli_query($conexion,$updatequery);
	}
	header("Location:proveedores.php");
}

?>