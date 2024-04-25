<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
} 
$id_factura=$_POST['id_factura'];
$Nmonton=$_POST['monton'];
$Nestado=$_POST['estado'];
$Nid_pedido=$_POST['id_pedido'];
$Ncuit_proveedor=$_POST['cuit_proveedor'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="UPDATE `facturas` SET `id_factura`='$id_factura',`monton`='$Nmonton',`estado`='$Nestado',`id_pedido`='$Nid_pedido',`cuit_proveedor`='$Ncuit_proveedor' WHERE `id_factura`='$id_factura'";
$consulta=mysqli_query($conexion,$query);
header("Location:facturas.php");
// echo $ncuil;
// echo "<br>";
// echo $nnombre;
// echo "<br>";
// echo $ntelefono;
// echo "<br>";
// echo $ndomicilio;
?>