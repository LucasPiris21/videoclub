<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
} 
if ($_SESSION['cargo']=="Empleado") {
	header("location:../main.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width initial-scale=1.0" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<title>Agregar personal</title>
</head>
<body>
<div class="container-sm form mainform">
	<div class="row justify-content-center">
		<div class="col-auto"><img src="../images/logovasmall.png" class="img-fluid"></div>
	</div>
	<br>	
	<div class="row justify-content-center">
		<div class="col-md-8">
			<center><h3>AGREGAR PERSONAL</h3></center>
			<form method="post" action="altapersonal.php">
				<div class="form-group">
					<label for="dni">DNI</label>
					<input type="text" class="form-control w-100" id="dni" name="dni">
				</div>
				<div class="form-group">
					<label for="nombre">Nombre</label>
					<input type="text" class="form-control" id="nombre" name="nombre">
				</div>
				<div class="form-group">
					<label for="telefono">Teléfono</label>
					<input type="text" class="form-control" id="telefono" name="telefono">
				</div>
				<div class="form-group">
					<label for="cargo">Cargo</label>
					<select name="cargo" id="cargo" class="form-control">
						<?php
						if ($_SESSION['cargo']<>"Gerente") {
							echo '<option value="Administrador">Administrador</option>';
						}
						?>
						<option value="Gerente">Gerente</option>
						<option value="Empleado">Empleado</option>
					</select>
				</div>
				<div class="form-group">
					<label for="contrasena">Contraseña</label>
					<input type="text" class="form-control" id="contrasena" name="contrasena">
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
</div>
</body>
</html>