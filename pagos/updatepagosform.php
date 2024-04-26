<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
} 
$id_pago=$_GET['id'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="SELECT * FROM `pagos` WHERE `id_pago`='$id_pago'";
$consulta=mysqli_query($conexion,$query);
$fila=mysqli_fetch_array($consulta);
$monton=$fila[1];
$dni_personal=$fila[2];
$id_factura=$fila[3];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width initial-scale=1.0" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<title>Modificar pago</title>
</head>
<body>
<div class="container-sm form mainform">
	<div class="row justify-content-center">
		<div class="col-auto"><img src="../images/logovasmall.png" class="img-fluid"></div>
	</div>
	<br>
	<div class="row justify-content-center">
		<div class="col-md-8">
			<center><h3>MODIFICAR PAGO</h3></center>
			<form method="post" action="updatepagos.php">
				<div class="form-group">
					<label for="id_pago">ID_Pago</label>
					<input type="text" class="form-control" id="id_pago" name="id_pago" value="<?php echo $id_pago?>" readonly>
				</div>
				<div class="form-group">
					<label for="monton">Montón</label>
					<input type="number" class="form-control" id="monton" name="monton" value="<?php echo $monton?>" min="1" pattern="^[0-9]+" required>
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
						<input type="number" class="form-control" name="dni_personal" list="personal" value="<?php echo $dni_personal?>" min="1" pattern="^[0-9]+" required>
				</div>
				<div class="form-group">
					<label for="id_factura">ID_Factura</label>
						<input type="number" class="form-control" name="id_factura" value="<?php echo $id_factura?>" readonly>
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
</body>
</html>
