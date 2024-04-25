<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
} 
if ($_SESSION['cargo']=="Empleado") {
	header("location:../main.php");
}
$dni=$_POST['dni'];
$Nnombre=$_POST['nombre'];
$Ntelefono=$_POST['telefono'];
$Ncargo=$_POST['cargo'];
$Ncontrasena=$_POST['contrasena'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="UPDATE `personal` SET `dni`='$dni',`nombre`='$Nnombre',`telefono`='$Ntelefono',`cargo`='$Ncargo',`contrasena`='$Ncontrasena' WHERE `dni`='$dni'";
$consulta=mysqli_query($conexion,$query);
header("Location:personal.php");
?>