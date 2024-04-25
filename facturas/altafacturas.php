<?php
session_start();
	if (empty($_SESSION['estado'])) {
header("location:../index.php");
} 
$id_pedido=$_POST['id_pedido'];
$cuit_proveedor=$_POST['cuit_proveedor'];
$monton=$_POST['monton'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="INSERT INTO `facturas`(`id_factura`, `monton`, `estado`, `id_pedido`, `cuit_proveedor`) VALUES ('','$monton','0','$id_pedido','$cuit_proveedor')"; // 0: Pendiente; 1: Pagada
$consulta=mysqli_query($conexion,$query);
header("Location:facturas.php");
?>