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
$id_pelicula=$_POST['id_pelicula'];
$cantidad=$_POST['cantidad'];
$proveedor=$_POST['proveedor'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$cantquery="SELECT COUNT(*) as copies FROM `copias` WHERE `id_pelicula`=$id_pelicula";
$base=mysqli_fetch_array(mysqli_query($conexion,$cantquery));
//Para verificar que el proveedor exista en la base de datos
$query0="SELECT * FROM `proveedores` WHERE `cuit`=$proveedor";
$consulta0=mysqli_query($conexion,$query0);
if (mysqli_num_rows($consulta0)==0) {
	echo "<body>";
		echo "<div class='container-sm main'>";
			echo "<center>";
			echo "El proveedor no existe en la base de datos";
		 	echo "<br><br>";
		 	echo "<a href='altacopiasform.php?id=".$id_pelicula."' class='btn btn-danger'>Volver</a>";
		 	echo "</center>";
		echo "</div>";
	echo "</body>";
} else {
	for ($i=0; $i <$cantidad ; $i++) {
		$query="INSERT INTO `copias`(`id_pelicula`, `id_copia`, `disponibilidad`, `cuit_proveedor`) VALUES ('$id_pelicula','$base[copies]','0','$proveedor')";
		$consulta=mysqli_query($conexion,$query);
		$base['copies']++; 
	}
	$cantquery="SELECT COUNT(*) as copies FROM `copias` WHERE `id_pelicula`=$id_pelicula AND `disponibilidad`=0";
	$updatedcant=mysqli_fetch_array(mysqli_query($conexion,$cantquery));
	$updatequery="UPDATE `peliculas` SET `cant_copias`='$updatedcant[copies]' WHERE `id_pelicula`='$id_pelicula'";
	$update=mysqli_query($conexion,$updatequery);
	header("Location:copias.php");
}
?>