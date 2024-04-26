<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
} 
$filaid=$_GET['id'];
$conexion=mysqli_connect('localhost','root','','videoclub');


$query1="DELETE FROM `detalle` WHERE `id_pedido`='$filaid'";
$consulta1=mysqli_query($conexion,$query1);
$query2="DELETE FROM `pedidos` WHERE `id_pedido`='$filaid'";
$consulta2=mysqli_query($conexion,$query2);
$query3="SELECT `id_factura` FROM `facturas` WHERE `id_pedido` = $filaid";
$consulta3=mysqli_query($conexion,$query3);
$id_factura = mysqli_fetch_array($consulta3);
if (mysqli_num_rows($consulta3)>0) {
	$query4="DELETE FROM `facturas` WHERE `id_pedido`=$filaid";
	$consulta4=mysqli_query($conexion,$query4);
	$query5="SELECT * FROM `pagos` WHERE `id_factura`=$id_factura[0]";
	$consulta5=mysqli_query($conexion,$query5);
	if (mysqli_num_rows($consulta5>0)) {
		$query6="DELETE FROM `pagos` WHERE `id_factura`DELETE FROM `pagos` WHERE `id_factura`=$id_factura[0]";
		$consulta6=mysqli_query($conexion,$query6);
	}
}
header("Location:pedidos.php");
// ?>