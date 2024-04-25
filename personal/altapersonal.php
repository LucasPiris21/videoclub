<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
}
if ($_SESSION['cargo']=="Empleado") {
	header("location:../main.php");
}
$dni=$_POST['dni'];
$nombre=$_POST['nombre'];
$telefono=$_POST['telefono'];
$cargo=$_POST['cargo'];
$contrasena=$_POST['contrasena'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="INSERT INTO `personal`(`dni`, `nombre`, `telefono`, `cargo`, `contrasena`) VALUES ('$dni','$nombre','$telefono','$cargo','$contrasena')";
$consulta=mysqli_query($conexion,$query);
header("Location:personal.php");
?>