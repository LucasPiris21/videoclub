<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
} 
$filaid=$_GET['id'];
$id_factura=$_GET['fact'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="DELETE FROM `pagos` WHERE `id_pago`='$filaid'";
$consulta=mysqli_query($conexion,$query);
//Modifica el estado de la base de datos facturas
$query2="UPDATE `facturas` SET `estado`='0' WHERE `id_factura`='$id_factura'";
$consulta2=mysqli_query($conexion,$query2);
header("Location:pagos.php");
?>