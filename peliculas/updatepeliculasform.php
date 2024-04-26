<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
} 
$id=$_GET['id'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="SELECT * FROM `peliculas` WHERE `id_pelicula`='$id'";
$consulta=mysqli_query($conexion,$query);
$fila=mysqli_fetch_array($consulta);
$id_pelicula=$fila[0];
$titulo=$fila[1];
$year=$fila[2];
$genero=$fila[3];
$cant_copias=$fila[4];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width initial-scale=1.0" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<title>Modificar pelicula</title>
</head>
<body>
<div class="container-sm form mainform">
	<div class="row justify-content-center">
		<div class="col-auto"><img src="../images/logovasmall.png" class="img-fluid"></div>
	</div>
	<br>
	<div class="row justify-content-center">
		<div class="col-md-8">
			<center><h3>MODIFICAR PELICULA</h3></center>
			<form method="post" action="updatepeliculas.php">
				<div class="form-group">
					<label for="id_pelicula">ID_Película</label>
					<input type="text" class="form-control" id="id_pelicula" name="id_pelicula" value="<?php echo $id_pelicula?>" readonly>
				</div>
				<div class="form-group">
					<label for="titulo">Título</label>
					<input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $titulo?>" required>
				</div>
				<div class="form-group">
					<label for="year">Año</label>
					<input type="text" class="form-control" id="year" name="year" value="<?php echo $year?>" min="1" pattern="^[0-9]+" required>
				</div>
				<div class="form-group">
					<label for="genero">Género</label>
					<input type="text" class="form-control" id="genero" name="genero" value="<?php echo $genero?>" required>
				</div>
				<div class="row justify-content-center">
					<div class="col-auto">
					<button type="submit" class="btn btn-danger">Enviar</button>
					</div>
					<div class="col-auto">
						<a href="peliculas.php" class="btn btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>
