<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
}
if ($_SESSION['cargo']=="Empleado") {
	header("location:../main.php");
}
$cuit=$_POST['cuit'];
$Nnombre=$_POST['nombre'];
$Ntelefono=$_POST['telefono'];
$Ndireccion=$_POST['direccion'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="UPDATE `proveedores` SET `cuit`='$cuit',`nombre`='$Nnombre',`telefono`='$Ntelefono',`direccion`='$Ndireccion' WHERE `cuit`='$cuit'";
$consulta=mysqli_query($conexion,$query);
header("Location:proveedores.php");
?>