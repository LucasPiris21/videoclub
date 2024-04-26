<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
}
if ($_SESSION['cargo']=="Empleado") {
	header("location:../main.php");
}
$id=$_GET['id'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="SELECT * FROM `proveedores` WHERE `cuit`='$id'";
$consulta=mysqli_query($conexion,$query);
$fila=mysqli_fetch_array($consulta);
$cuit=$fila[0];
$nombre=$fila[1];
$telefono=$fila[2];
$direccion=$fila[3];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width initial-scale=1.0" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<title>Modificar proveedor</title>
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
			<form method="post" action="updateproveedores.php">
				<div class="form-group">
					<label for="cuit">CUIT</label>
					<input type="text" class="form-control" id="cuit" name="cuit" value="<?php echo $cuit?>" readonly>
				</div>
				<div class="form-group">
					<label for="nombre">Nombre</label>
					<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre?>" readonly>
				</div>
				<div class="form-group">
					<label for="telefono">Teléfono</label>
					<input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono?>" min="1" pattern="^[0-9]+" required>
				</div>
				<div class="form-group">
					<label for="direccion">Dirección</label>
					<input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $direccion?>" required>
				</div>
				<div class="row justify-content-center">
					<div class="col-auto">
					<button type="submit" class="btn btn-danger">Enviar</button>
					</div>
					<div class="col-auto">
						<a href="proveedores.php" class="btn btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>
