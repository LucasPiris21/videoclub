<?php
session_start();
	if (empty($_SESSION['estado'])) {
header("location:../index.php");
} 
$id_factura=$_POST['id_factura'];
$monton=$_POST['monton'];
$dni_personal=$_POST['dni_personal'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="INSERT INTO `pagos`(`id_pago`, `monton`, `dni_personal`, `id_factura`) VALUES ('','$monton','$dni_personal','$id_factura')";
$consulta=mysqli_query($conexion,$query);
//Modifica el estado de la base de datos facturas
$query2="UPDATE `facturas` SET `estado`='1' WHERE `id_factura`='$id_factura'";
$consulta2=mysqli_query($conexion,$query2);
header("Location:pagos.php");
?>