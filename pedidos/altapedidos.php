<?php
session_start();
	if (empty($_SESSION['estado'])) {
		header("location:../index.php");
	}
$dni_personal=$_POST['dni_personal'];
$cuit_proveedor=$_POST['cuit_proveedor'];
$cantidad=$_POST['cantidad'];
$id_pelicula=$_POST['pelicula'];
$ejemplares=$_POST['ejemplares'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="INSERT INTO `pedidos`(`id_pedido`, `dni_personal`, `cuit_proveedor`) VALUES ('','$dni_personal','$cuit_proveedor')";
$consulta=mysqli_query($conexion,$query) or die ('Error: '.mysqli_error($conexion)); 
$id_pedido=mysqli_insert_id($conexion);
$detallequery="SELECT COUNT(*) as id FROM `detalle` WHERE `id_pedido`=$id_pedido";
$id_detalle=mysqli_fetch_array(mysqli_query($conexion,$detallequery));
for ($i=0; $i <$cantidad ; $i++) { 
   	$query2="INSERT INTO `detalle`(`id_pedido`, `id_detalle`, `nro_ejemplares`, `id_pelicula`) VALUES ('$id_pedido','$id_detalle[id]','$ejemplares[$i]','$id_pelicula[$i]')";
  	$consulta2=mysqli_query($conexion,$query2);
  	$id_detalle['id']++;
   }
 header("location:pedidos.php");
?>