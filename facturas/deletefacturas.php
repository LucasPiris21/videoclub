<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
} 
$filaid=$_GET['id'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="DELETE FROM `facturas` WHERE `id_factura`='$filaid'";
$consulta=mysqli_query($conexion,$query);
//echo "$filaid";
header("Location:facturas.php");
?>