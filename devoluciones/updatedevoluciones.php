<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
}
$dni=$_POST['dni'];
$id_pelicula=$_POST['pelicula'];
$id_copia=$_POST['copia'];
$fecha_devolucion=new DateTime($_POST['fecha_devolucion']);
$estado_actual=$_POST['estado_actual'];
$estado_actualizado=$_POST['estado_actualizado'];
date_default_timezone_set("America/Buenos_Aires");
$date = new DateTime();
switch ($estado_actualizado) {
	case '2':
		$conexion=mysqli_connect('localhost','root','','videoclub');
		$query="UPDATE `copias` SET `disponibilidad`='0' WHERE `id_pelicula`='$id_pelicula' AND `id_copia`='$id_copia'";
		$consulta=mysqli_query($conexion,$query);
		$cantquery="SELECT COUNT(*) as copies FROM `copias` WHERE `id_pelicula`=$id_pelicula AND `disponibilidad`=0";
		$updatedcant=mysqli_fetch_array(mysqli_query($conexion,$cantquery));
		$updatequery="UPDATE `peliculas` SET `cant_copias`='$updatedcant[copies]' WHERE `id_pelicula`='$id_pelicula'";
		$update=mysqli_query($conexion,$updatequery);
		if ($estado_actual==1) {
			$diff=(date_diff($fecha_devolucion,$date))->format("%d");
			$sancion=$diff*10;
			$query2="UPDATE `devoluciones` SET `sancion`='$sancion' WHERE `dni_cliente`='$dni' AND `id_pelicula`='$id_pelicula' AND `id_copia`='$id_copia' AND `estado`='1'";
			$consulta2=mysqli_query($conexion,$query2);
		}
		$query3="UPDATE `devoluciones` SET `estado`='2' WHERE `dni_cliente`='$dni' AND `id_pelicula`='$id_pelicula' AND `id_copia`='$id_copia' AND `estado`<>'2'";
		$consulta3=mysqli_query($conexion,$query3);
		header("location:devoluciones.php");
		break;
	default:
		header("location:devoluciones.php");
		break;
}
?>