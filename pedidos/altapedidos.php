<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
</html>
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
$verificador=0;
for ($i=0; $i <$cantidad ; $i++) {
	$query0="SELECT * FROM `peliculas` WHERE `id_pelicula`='$id_pelicula[$i]'";
	$consulta0=mysqli_query($conexion,$query0);
	if (mysqli_num_rows($consulta0)==0) {
		echo "<body>";
			echo "<div class='container-sm main'>";
				echo "<center>";
				echo "Una de las peliculas no existe en la base de datos";
			 	echo "<br><br>";
			 	echo "<a href='altapedidosform.php' class='btn btn-danger'>Volver</a>";
			 	echo "</center>";
			echo "</div>";
		echo "</body>";
		$verificador=1;
		break;
	}
}
if ($verificador==0) {
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
}
?>