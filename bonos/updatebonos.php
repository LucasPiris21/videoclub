<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
} 
$id_bono=$_POST['id_bono'];
$Ncredito=$_POST['credito'];
$credito_disponible=$_POST['credito_disponible'];
$Nperiodo=$_POST['periodo'];
$Nfecha_emision=$_POST['fecha_emision'];
$Nfecha_vencimiento=$_POST['fecha_vencimiento'];
$Ndni_cliente=$_POST['dni_cliente'];
$Ndni_personal=$_POST['dni_personal'];
$diff=$Ncredito-$credito_disponible;
$Ncredito_disponible=$credito_disponible+$diff;
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="UPDATE `bono` SET `id_bono`='$id_bono',`credito`='$Ncredito',`credito_disponible`='$Ncredito_disponible',`periodo`='$Nperiodo',`fecha_emision`='$Nfecha_emision',`fecha_vencimiento`='$Nfecha_vencimiento',`dni_cliente`='$Ndni_cliente',`dni_personal`='$Ndni_personal' WHERE `id_bono`='$id_bono'";
$consulta=mysqli_query($conexion,$query);
header("Location:bonos.php");