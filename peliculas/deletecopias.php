<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
} 
$idp=$_GET['idp'];
$idc=$_GET['idc'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="DELETE FROM `copias` WHERE `id_pelicula`='$idp' AND `id_copia`='$idc'";
$consulta=mysqli_query($conexion,$query);
$cantquery="SELECT COUNT(*) as copies FROM `copias` WHERE `id_pelicula`=$idp AND `disponibilidad`=0";
$cant=mysqli_fetch_array(mysqli_query($conexion,$cantquery));
$updatequery="UPDATE `peliculas` SET `cant_copias`='$cant[copies]' WHERE `id_pelicula`='$idp'";
$update=mysqli_query($conexion,$updatequery);
header("Location:copias.php");
?>