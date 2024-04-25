<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
} 
$filaid=$_GET['id'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="DELETE FROM `detalle` WHERE `id_pedido`='$filaid'";
$consulta=mysqli_query($conexion,$query);
$query2="DELETE FROM `pedidos` WHERE `id_pedido`='$filaid'";
$consulta2=mysqli_query($conexion,$query2);
header("Location:pedidos.php");
?>