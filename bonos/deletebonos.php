<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
} 
$filaid=$_GET['id'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="DELETE FROM `bono` WHERE `id_bono`='$filaid'";
$consulta=mysqli_query($conexion,$query);
//echo "$filaid";
header("Location:bonos.php");
?>