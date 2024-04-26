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
$conexion=mysqli_connect('localhost','root','','videoclub');
$id_bono=$_POST['id_bono'];
$credito=$_POST['credito'];
$periodo=$_POST['periodo'];
$dni_cliente=$_POST['dni_cliente'];
$id_pelicula=$_POST['pelicula'];
//Para verificar que la película exista en la base de datos
for ($a=0; $a < $credito ; $a++) {
 	$query0="SELECT * FROM `peliculas` WHERE `id_pelicula`=$id_pelicula[$a]";
 	$consulta0=mysqli_query($conexion,$query0);
 	if (mysqli_num_rows($consulta0)==0) {
 		echo "<body>";
			echo "<div class='container-sm main'>";
				echo "<center>";
				echo "Una de las peliculas no existe en la base de datos";
			 	echo "<br><br>";
			 	echo "<a href='altaalquileresform.php' class='btn btn-danger'>Volver</a>";
			 	echo "</center>";
			echo "</div>";
		echo "</body>";
 	} else {
		date_default_timezone_set("America/Buenos_Aires");
		$fecha = date('o-m-d'); 
		for ($i=0; $i <$credito ; $i++) {
			if ($id_pelicula[$i]<>'') {
		//INSERT en la base de datos de alquileres
				$querycopia="SELECT `id_copia` FROM `copias` WHERE `disponibilidad`='0' AND `id_pelicula`=$id_pelicula[$i] LIMIT 1 ";
				$id_copia=mysqli_fetch_array(mysqli_query($conexion,$querycopia));
		 		$query="INSERT INTO `alquileres`(`dni_cliente`, `id_pelicula`, `id_copia`, `fecha`) VALUES ('$dni_cliente','$id_pelicula[$i]','$id_copia[0]','$fecha')";
		 		$consulta=mysqli_query($conexion,$query);
		//UPDATE disponibilidad de la base de datos COPIAS teniendo en cuenta el id_pelicula e id_copia
			 	$querydisponibilidad="UPDATE `copias` SET `disponibilidad`='1' WHERE `id_pelicula`=$id_pelicula[$i] AND `id_copia`=$id_copia[0]";
			 	$consulta2=mysqli_query($conexion,$querydisponibilidad);
		//UPDATE cant_copias de la base de datos PELICULAS
			 	$querycantcopias="SELECT COUNT(*) as copies FROM `copias` WHERE `id_pelicula`=$id_pelicula[$i] AND `disponibilidad`=0";
			 	$cant=mysqli_fetch_array(mysqli_query($conexion,$querycantcopias));
			 	$updatecant="UPDATE `peliculas` SET `cant_copias`='$cant[copies]' WHERE `id_pelicula`=$id_pelicula[$i]";
			 	$consulta3=mysqli_query($conexion,$updatecant);
		//UPDATE credito_disponible de la base de datos BONOS
			 	$querycreddisp="UPDATE `bono` SET `credito_disponible`=`credito_disponible`-1 WHERE `id_bono`=$id_bono";
			 	$consulta4=mysqli_query($conexion,$querycreddisp);
		//INSERT en la base de datos DEVOLUCIONES
				$fechadevol = strtotime("+$periodo day", strtotime($fecha));
				$fechadevol = date('o-m-d', $fechadevol);
				$querydevol="INSERT INTO `devoluciones`(`dni_cliente`, `id_pelicula`, `id_copia`, `fecha_devolucion_max`, `estado`, `sancion`) VALUES ('$dni_cliente','$id_pelicula[$i]','$id_copia[0]','$fechadevol','0','')";
				$consulta5=mysqli_query($conexion,$querydevol);
			}
		}
		header("Location:alquileres.php");
 	}
}
?>