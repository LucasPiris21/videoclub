<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
}
if ($_SESSION['cargo']=="Empleado") {
	header("location:../main.php");
}
$cuit=$_POST['cuit'];
$nombre=$_POST['nombre'];
$telefono=$_POST['telefono'];
$direccion=$_POST['direccion'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="INSERT INTO `proveedores`(`cuit`, `nombre`, `telefono`, `direccion`) VALUES ('$cuit','$nombre','$telefono','$direccion')";
$consulta=mysqli_query($conexion,$query);
header("Location:proveedores.php");
?>