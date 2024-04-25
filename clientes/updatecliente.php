<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
} 
$dni=$_POST['dni'];
$Nnombre=$_POST['nombre'];
$Ntelefono=$_POST['telefono'];
$Nemail=$_POST['email'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="UPDATE `clientes` SET `dni`='$dni',`nombre`='$Nnombre',`telefono`='$Ntelefono',`email`='$Nemail' WHERE `dni`='$dni'";
$consulta=mysqli_query($conexion,$query);
header("Location:clientes.php");
// echo $ncuil;
// echo "<br>";
// echo $nnombre;
// echo "<br>";
// echo $ntelefono;
// echo "<br>";
// echo $ndomicilio;
?>