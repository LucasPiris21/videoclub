<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
} 
$filaid=$_GET['id'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="DELETE FROM `peliculas` WHERE `id_pelicula`='$filaid'";
$consulta=mysqli_query($conexion,$query);
$query2="DELETE FROM `copias` WHERE `id_pelicula`='$filaid'";
$consult2a=mysqli_query($conexion,$query2);
header("Location:peliculas.php");
?>