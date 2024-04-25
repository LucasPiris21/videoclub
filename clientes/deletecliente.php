<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
} 
$filaid=$_GET['dni'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="DELETE FROM `clientes` WHERE `dni`='$filaid'";
$consulta=mysqli_query($conexion,$query);
//echo "$filaid";
header("Location:clientes.php");
?>