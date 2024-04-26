<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
} 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width initial-scale=1.0" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<title>Agregar película</title>
</head>
<body>
<div class="container-sm form mainform">
	<div class="row justify-content-center">
		<div class="col-auto"><img src="../images/logovasmall.png" class="img-fluid"></div>
	</div>
	<br>	
	<div class="row justify-content-center">
		<div class="col-md-8">
			<center><h3>AGREGAR PELÍCULA</h3></center>
			<form method="post" action="altapeliculas.php">
				<div class="form-group">
					<label for="titulo">Título</label>
					<input type="text" class="form-control w-100" id="titulo" name="titulo" required>
				</div>
				<div class="form-group">
					<label for="año">Año</label>
					<input type="number" class="form-control" id="año" name="año" min="1" pattern="^[0-9]+" required>
				</div>
				<div class="form-group">
					<label for="genero">Género</label>
					<input type="text" class="form-control" id="genero" name="genero" required>
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
</div>
</body>
</html>