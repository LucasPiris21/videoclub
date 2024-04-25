<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
}
if ($_SESSION['cargo']=="Empleado") {
	header("location:../main.php");
}
$filaid=$_GET['id'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="DELETE FROM `proveedores` WHERE `cuit`='$filaid'";
$consulta=mysqli_query($conexion,$query);
//echo "$filaid";
header("Location:proveedores.php");
?>