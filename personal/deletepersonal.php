<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
}
if ($_SESSION['cargo']=="Empleado") {
	header("location:../main.php");
}
$filaid=$_GET['dni'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="DELETE FROM `personal` WHERE `dni`='$filaid'";
$query0="UPDATE `pedidos` SET `dni_personal`= NULL WHERE `dni_personal`='$filaid'";
$query1="UPDATE `bono` SET `dni_personal`= NULL WHERE `dni_personal`='$filaid'";
$query2="UPDATE `pagos` SET `dni_personal`= NULL WHERE `dni_personal`='$filaid'";
$consulta=mysqli_query($conexion,$query);
$consulta0=mysqli_query($conexion,$query0);
$consulta1=mysqli_query($conexion,$query1);
$consulta2=mysqli_query($conexion,$query2);
//echo "$filaid";
header("Location:personal.php");
?>