<?php
session_start();
$id_pedido=$_POST['id_pedido'];
$cantidad_detalle=$_POST['cantidad_detalle'];
$Ndni_personal=$_POST['dni_personal'];
$Ncuit_proveedor=$_POST['cuit_proveedor'];
$id_detalle=$_POST['id_detalle'];
$nejemplares=$_POST['ejemplares'];
$npelicula=$_POST['pelicula'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="UPDATE `pedidos` SET `id_pedido`='$id_pedido',`dni_personal`='$Ndni_personal',`cuit_proveedor`='$Ncuit_proveedor' WHERE `id_pedido`='$id_pedido'";
$consulta=mysqli_query($conexion,$query);
for ($i=0; $i < $cantidad_detalle; $i++) { 
	$query2="UPDATE `detalle` SET `id_pedido`='$id_pedido',`id_detalle`='$id_detalle[$i]',`nro_ejemplares`='$nejemplares[$i]',`id_pelicula`='$npelicula[$i]' WHERE `id_pedido`='$id_pedido' AND `id_detalle`='$id_detalle[$i]'";
	$consulta2=mysqli_query($conexion,$query2);
}
header("location:pedidos.php");
?>