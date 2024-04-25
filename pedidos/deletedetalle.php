<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
}
$idp=$_GET['idp'];
$idd=$_GET['idd'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="DELETE FROM `detalle` WHERE `id_pedido`='$idp' AND `id_detalle`='$idd'";
$consulta=mysqli_query($conexion,$query);
header("Location:pedidos.php");
?>