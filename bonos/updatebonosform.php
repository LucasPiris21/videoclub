<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
} 
$id_bono=$_GET['id'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="SELECT * FROM `bono` WHERE `id_bono`='$id_bono'";
$consulta=mysqli_query($conexion,$query);
$fila=mysqli_fetch_array($consulta);
$id_bono=$fila[0];
$credito=$fila[1];
$credito_disponible=$fila[2];
$periodo=$fila[3];
$fecha_emision=$fila[4];
$fecha_vencimiento=$fila[5];
$dni_cliente=$fila[6];
$dni_personal=$fila[7];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width initial-scale=1.0" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<title>Modificar bono</title>
</head>
<body>
<div class="container-sm form mainform">
	<div class="row justify-content-center">
		<div class="col-auto"><img src="../images/logovasmall.png" class="img-fluid"></div>
	</div>
	<br>
	<div class="row justify-content-center">
		<div class="col-md-8">
			<center><h3>MODIFICAR BONO</h3></center>
			<form method="post" action="updatebonos.php">
				<div class="form-group">
					<label for="id_bono">ID_Bono</label>
					<input type="text" class="form-control" id="id_bono" name="id_bono" value="<?php echo $id_bono; ?>" readonly>
				</div>
				<div class="form-group">
					<label for="credito">Credito</label>
					<input type="number" class="form-control" id="credito" name="credito" min="1" pattern="^[0-9]+" value="<?php echo $credito; ?>" required>
				</div>
				<input type="text" class="form-control" id="credito_disponible" name="credito_disponible" value="<?php echo $credito_disponible; ?>" hidden>
				<div class="form-group">
					<label for="periodo">Periodo</label>
					<input type="number" class="form-control" id="periodo" name="periodo" min="1" pattern="^[0-9]+" value="<?php echo $periodo; ?>" required>
				</div>
				<div class="form-group">
					<label for="fecha_emision">Fecha de Emision</label>
					<input type="text" class="form-control" id="fecha_emision" name="fecha_emision" value="<?php echo $fecha_emision; ?>" readonly>
				</div>
				<div class="form-group">
					<label for="fecha_vencimiento">Fecha de Vencimiento</label>
					<input type="text" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" value="<?php echo $fecha_vencimiento; ?>" readonly>
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
					<input type="number" class="form-control" id="dni_cliente" name="dni_cliente" min="1" pattern="^[0-9]+" list="dni_cliente" value="<?php echo $dni_cliente; ?>" required>
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
					<input type="number" class="form-control" id="dni_personal" name="dni_personal" min="1" pattern="^[0-9]+" list="dni_personal" value="<?php echo $dni_personal; ?>" required>
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
</body>
</html>
