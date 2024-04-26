<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
}
$conexion=mysqli_connect('localhost','root','','videoclub');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width initial-scale=1.0" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<title>Agregar pago</title>
</head>
<body>
<div class="container-sm form mainform">
	<div class="row justify-content-center">
		<div class="col-auto"><img src="../images/logovasmall.png" class="img-fluid"></div>
	</div>
	<br>	
	<div class="row justify-content-center">
		<div class="col-md-8">
			<center><h3>AGREGAR PAGO</h3></center>
			<form method="post" action="altapagos.php">
				<div class="form-group">
					<label for="id_factura">ID_Factura</label>
						<datalist id="factura">
						<?php
							$query="SELECT `id_factura`, `cuit_proveedor` FROM `facturas` WHERE `estado`<>'1'";
							$consulta=mysqli_query($conexion,$query);
							while ($fila=mysqli_fetch_array($consulta)) {
								echo "<option value='$fila[0]'>ID: $fila[0]; Proveedor: $fila[1]</option>";
							}
						?>
						</datalist>
						<input type="number" class="form-control" name="id_factura" list="factura" min="1" pattern="^[0-9]+" required>
				</div>
				<div class="form-group">
					<label for="monton">Montón:</label>
					<div class="input-group mb-2">
						<input type="number" class="form-control" id="monton" name="monton" value="$$$" min="1" pattern="^[0-9]+" required>
						<div class="input-group-prepend">
          					<div class="input-group-text">$</div>
       					 </div>
					</div>
				</div>
				<div class="form-group">
					<label for="dni_personal">DNI_Personal</label>
						<datalist id="personal">
						<?php
							$query="SELECT `dni`, `nombre` FROM `personal`";
							$consulta=mysqli_query($conexion,$query);
							while ($fila=mysqli_fetch_array($consulta)) {
								echo "<option value='$fila[0]'>DNI: $fila[0]; Personal: $fila[1]</option>";
							}
						?>
						</datalist>
						<input type="number" class="form-control" name="dni_personal" list="personal" min="1" pattern="^[0-9]+" required>
				</div>
				<div class="row justify-content-center">
					<div class="col-auto">
					<button type="submit" class="btn btn-danger">Enviar</button>
					</div>
					<div class="col-auto">
						<a href="pagos.php" class="btn btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
</body>
</html>