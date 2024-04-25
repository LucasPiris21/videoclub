<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
}
date_default_timezone_set("America/Buenos_Aires");
$date = date('o-m-d'); 
$enddate =  strtotime('+14 day', strtotime($date));
$enddate = date('o-m-d', $enddate);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width initial-scale=1.0" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<title>Agregar bono</title>
</head>
<body>
<div class="container-sm form mainform">
	<div class="row justify-content-center">
		<div class="col-auto"><img src="../images/logovasmall.png" class="img-fluid"></div>
	</div>
	<br>	
	<div class="row justify-content-center">
		<div class="col-md-8">
			<center><h3>AGREGAR BONO</h3></center>
			<form method="post" action="altabonos.php">
				<div class="form-group">
					<label for="credito">Credito</label>
					<input type="number" class="form-control" id="credito" name="credito">
				</div>
				<div class="form-group">
					<label for="periodo">Periodo</label>
					<input type="number" class="form-control" id="periodo" name="periodo">
				</div>
				<div class="form-group">
					<label for="fecha_emision">Fecha de Emisión</label>
					<input type="date" class="form-control" id="fecha_emision" name="fecha_emision" value="<?php echo $date; ?>" readonly>
				</div>
				<div class="form-group">
					<label for="fecha_vencimiento">Fecha de Vencimiento</label>
					<input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" value="<?php echo $enddate; ?>" readonly>
				</div>
				<div class="form-group">
					<label for="dni_cliente">DNI del Cliente</label>
					<datalist id="dni_cliente">
						<?php
							$conexion=mysqli_connect('localhost','root','','videoclub');
							$query="SELECT `dni`, `nombre` FROM `clientes`";
							$consulta=mysqli_query($conexion,$query);
							while ($fila=mysqli_fetch_array($consulta)) {
								echo "<option value='$fila[0]'>$fila[1]</option>";
							}
						?>
					</datalist>
					<br>
					<input class="form-control" name="dni_cliente" list="dni_cliente">
				</div>
				<div class="form-group">
					<label for="dni_personal">DNI del Personal</label>
					<datalist id="dni_personal">
						<?php
							$conexion=mysqli_connect('localhost','root','','videoclub');
							$query="SELECT `dni`, `nombre` FROM `personal`";
							$consulta=mysqli_query($conexion,$query);
							while ($fila=mysqli_fetch_array($consulta)) {
								echo "<option value='$fila[0]'>$fila[1]</option>";
							}
						?>
					</datalist>
					<br>
					<input class="form-control" name="dni_personal" list="dni_personal">
				</div>
				<div class="row justify-content-center">
					<div class="col-auto">
					<button type="submit" class="btn btn-danger">Enviar</button>
					</div>
					<div class="col-auto">
						<a href="bonos.php" class="btn btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
</body>
</html>