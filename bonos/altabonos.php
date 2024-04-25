<?php
session_start();
	if (empty($_SESSION['estado'])) {
header("location:../index.php");
} 
$credito=$_POST['credito'];
$periodo=$_POST['periodo'];
$fecha_emision=$_POST['fecha_emision'];
$fecha_vencimiento=$_POST['fecha_vencimiento'];
$dni_cliente=$_POST['dni_cliente'];
$dni_personal=$_POST['dni_personal'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="INSERT INTO `bono`(`id_bono`, `credito`, `credito_disponible`, `periodo`, `fecha_emision`, `fecha_vencimiento`, `dni_cliente`, `dni_personal`) VALUES ('','$credito','$credito','$periodo','$fecha_emision','$fecha_vencimiento','$dni_cliente','$dni_personal')";
$consulta=mysqli_query($conexion,$query);
header("Location:bonos.php");
?>