<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
} 
if ($_SESSION['cargo']=="Empleado") {
	header("location:../main.php");
}
$dni=$_GET['dni'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="SELECT * FROM `personal` WHERE `dni`='$dni'";
$consulta=mysqli_query($conexion,$query);
$fila=mysqli_fetch_array($consulta);
$nombre=$fila[1];
$telefono=$fila[2];
$cargo=$fila[3];
$contrasena=$fila[4];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width initial-scale=1.0" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<title>Modificar personal</title>
</head>
<body>
<div class="container-sm form mainform">
	<div class="row justify-content-center">
		<div class="col-auto"><img src="../images/logovasmall.png" class="img-fluid"></div>
	</div>
	<br>
	<div class="row justify-content-center">
		<div class="col-md-8">
			<center><h3>MODIFICAR PERSONAL</h3></center>
			<form method="post" action="updatepersonal.php">
				<div class="form-group">
					<label for="dni">DNI</label>
					<input type="text" class="form-control" id="dni" name="dni" value="<?php echo $dni?>" readonly>
				</div>
				<div class="form-group">
					<label for="nombre">Nombre</label>
					<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre?>">
				</div>
				<div class="form-group">
					<label for="telefono">Teléfono</label>
					<input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono?>">
				</div>
				<div class="form-group">
					<label for="cargo">Cargo</label>
					<select name="cargo" id="cargo" class="form-control">
						<?php
							switch ($cargo) {
								case 'Administrador':
									echo '<option value="Administrador" selected>Administrador</option>';
									echo '<option value="Gerente">Gerente</option>';
									echo '<option value="Empleado">Empleado</option>';
									break;
								case 'Gerente':
									echo '<option value="Administrador">Administrador</option>';
									echo '<option value="Gerente" selected>Gerente</option>';
									echo '<option value="Empleado">Empleado</option>';
									break;
								case 'Empleado':
									echo '<option value="Administrador">Administrador</option>';
									echo '<option value="Gerente">Gerente</option>';
									echo '<option value="Empleado" selected>Empleado</option>';
									break;
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="contrasena">Contraseña</label>
					<input type="text" class="form-control" id="contrasena" name="contrasena" value="<?php echo $contrasena?>">
				</div>
				<div class="row justify-content-center">
					<div class="col-auto">
					<button type="submit" class="btn btn-danger">Enviar</button>
					</div>
					<div class="col-auto">
						<a href="personal.php" class="btn btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>
