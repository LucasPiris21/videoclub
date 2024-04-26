<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
}
$id=$_GET['id']
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width initial-scale=1.0" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<title>Agregar copia</title>
</head>
<body>
<div class="container-sm form main">
	<div class="row justify-content-center">
		<div class="col-auto"><img src="../images/logovasmall.png" class="img-fluid"></div>
	</div>
	<br>
	<div class="row justify-content-center">
		<h3>AGREGAR COPIA</h3>
	</div>
	<br>	
	<div class="row justify-content-center">
		<div class="col-md-8">
			<form method="post" action="altacopias.php">
				<input type="number" name="id_pelicula" id="id_pelicula" value="<?php echo $id; ?>" hidden>
				<div class="form-group row">
					<div class="col">
						<label for="cantidad">Cantidad de copias:</label>
						<input type="number" class="form-control" name="cantidad" id="cantidad" min="1" pattern="^[0-9]+" required>
					</div>
					<div class="col-7">
						<label for="proveedor">Proveedor:</label>
						<datalist id="proveedor">
						<?php
							$conexion=mysqli_connect('localhost','root','','videoclub');
							$query="SELECT `cuit`, `nombre` FROM `proveedores`";
							$consulta=mysqli_query($conexion,$query);
							while ($fila=mysqli_fetch_array($consulta)) {
								echo "<option value='$fila[0]'>$fila[1]</option>";
							}
						?>
						</datalist>
						<br>
						<input type="number" class="form-control" name="proveedor" list="proveedor" min="1" pattern="^[0-9]+" required>
					</div>
				</div>
				<div class="form-group row justify-content-center">
					<div class="col-auto my-4">
						<button type="submit" class="btn btn-danger">Enviar</button>
					</div>
					<div class="col-auto my-4">
						<?php
							echo "<a href='copias.php' class='btn btn-danger'>Cancelar</a>";
						?>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
</body>
</html>
