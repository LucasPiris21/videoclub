<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
} 
$id_pago=$_POST['id_pago'];
$Nmonton=$_POST['monton'];
$Ndni_personal=$_POST['dni_personal'];
$Nid_factura=$_POST['id_factura'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="UPDATE `pagos` SET `id_pago`='$id_pago',`monton`='$Nmonton',`dni_personal`='$Ndni_personal',`id_factura`='$Nid_factura' WHERE `id_pago`='$id_pago'";
$consulta=mysqli_query($conexion,$query);
header("Location:pagos.php");
// echo $ncuil;
// echo "<br>";
// echo $nnombre;
// echo "<br>";
// echo $ntelefono;
// echo "<br>";
// echo $ndomicilio;
?>