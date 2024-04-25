<?php
session_start();
	if (empty($_SESSION['estado'])) {
header("location:../index.php");
} 
$titulo=$_POST['titulo'];
$year=$_POST['año'];
$genero=$_POST['genero'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="INSERT INTO `peliculas`(`id_pelicula`, `titulo`, `year`, `genero`, `cant_copias`) VALUES ('','$titulo','$year','$genero','')";
$consulta=mysqli_query($conexion,$query);
header("Location:peliculas.php");
?>