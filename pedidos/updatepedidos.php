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
$id_pedido=$_POST['id_pedido'];
$cantidad_detalle=$_POST['cantidad_detalle'];
$Ndni_personal=$_POST['dni_personal'];
$Ncuit_proveedor=$_POST['cuit_proveedor'];
$id_detalle=$_POST['id_detalle'];
$nejemplares=$_POST['ejemplares'];
$npelicula=$_POST['pelicula'];
$verificador=0;
$verificador2=0;
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="UPDATE `pedidos` SET `id_pedido`='$id_pedido',`dni_personal`='$Ndni_personal',`cuit_proveedor`='$Ncuit_proveedor' WHERE `id_pedido`='$id_pedido'";
$query0="SELECT * FROM `personal` WHERE `dni`='$Ndni_personal'";
$consulta0=mysqli_query($conexion,$query0);
if (mysqli_num_rows($consulta0)==0) {
	echo "<body>";
		echo "<div class='container-sm main'>";
			echo "<center>";
				echo "El personal no existe en la base de datos";
				echo "<br><br>";
				echo "<a href='updatepedidosform.php?id=".$id_pedido."' class='btn btn-danger'>Volver</a>";
				$verificador2=1;
			echo "</center>";
		echo "</div>";
	echo "</body>";
} else {
	$consulta=mysqli_query($conexion,$query);
}
if ($verificador2==0) {
	for ($i=0; $i < $cantidad_detalle; $i++) { 
		$query1="SELECT * FROM `peliculas` WHERE `id_pelicula`='$npelicula[$i]'";
		$consulta1=mysqli_query($conexion,$query1);
		if (mysqli_num_rows($consulta1)==0) {
			echo "<body>";
				echo "<div class='container-sm main'>";
					echo "<center>";
						echo "Una de las peliculas no existe en la base de datos";
					 	echo "<br><br>";
					 	echo "<a href='updatepedidosform.php?id=".$id_pedido."' class='btn btn-danger'>Volver</a>";
				 	echo "</center>";
				echo "</div>";
			echo "</body>";
			$verificador=1;
			break;
		} 
	}
	if ($verificador==0) {
		for ($i=0; $i < $cantidad_detalle; $i++) { 
			$query2="UPDATE `detalle` SET `id_pedido`='$id_pedido',`id_detalle`='$id_detalle[$i]',`nro_ejemplares`='$nejemplares[$i]',`id_pelicula`='$npelicula[$i]' WHERE `id_pedido`='$id_pedido' AND `id_detalle`='$id_detalle[$i]'";
			$consulta2=mysqli_query($conexion,$query2);
		}
		header("location:pedidos.php");
	}
}
?>