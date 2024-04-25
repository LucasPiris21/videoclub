<?php
session_start();
	if (empty($_SESSION['estado'])) {
header("location:../index.php");
} 
$dni=$_POST['dni'];
$nombre=$_POST['nombre'];
$telefono=$_POST['telefono'];
$email=$_POST['email'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="INSERT INTO `clientes`(`dni`, `nombre`, `telefono`, `email`) VALUES ('$dni','$nombre','$telefono','$email')";
$consulta=mysqli_query($conexion,$query);
header("Location:clientes.php");
?>