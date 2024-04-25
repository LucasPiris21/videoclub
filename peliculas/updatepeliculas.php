<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
} 
$id=$_POST['id_pelicula'];
$Ntitulo=$_POST['titulo'];
$Nyear=$_POST['year'];
$Ngenero=$_POST['genero'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="UPDATE `peliculas` SET `id_pelicula`='$id',`titulo`='$Ntitulo',`year`='$Nyear',`genero`='$Ngenero' WHERE `id_pelicula`='$id'";
$consulta=mysqli_query($conexion,$query);
header("Location:peliculas.php");
?>