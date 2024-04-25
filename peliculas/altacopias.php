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
?>