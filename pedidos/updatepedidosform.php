<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
}
$conexion=mysqli_connect('localhost','root','','videoclub');
$id_pedido=$_GET['id'];
$query0="SELECT * FROM `pedidos` WHERE `id_pedido`='$id_pedido'";
$consulta0=mysqli_query($conexion,$query0);
$pedido=mysqli_fetch_array($consulta0);
$id_pedido=$pedido[0];
$dni_personal=$pedido[1];
$cuit_proveedor=$pedido[2];
$query1="SELECT * FROM `detalle` WHERE `id_pedido`='$id_pedido'";
$consulta1=mysqli_query($conexion,$query1);
$query2="SELECT COUNT(*) as cantidad FROM `detalle` WHERE `id_pedido`='$id_pedido'";
$consulta2=mysqli_query($conexion,$query2);
$pedido=mysqli_fetch_array($consulta2);
$query3="SELECT `id_pelicula`, `titulo`, `year` FROM `peliculas`";
$consulta3=mysqli_query($conexion,$query3);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width initial-scale=1.0" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<title>Modificar pedido</title>
</head>
<body>
<div class="container-sm form main">
	<div class="row justify-content-center">
		<div class="col-auto"><img src="../images/logovasmall.png" class="img-fluid"></div>
	</div>
	<br>
	<div class="row justify-content-center">
		<h3>MODIFICAR PEDIDO</h3>
	</div>
	<br>	
	<div class="row justify-content-start">
		<div class="col-md-8">
			<form method="post" id="formpedido" action="updatepedidos.php">
				<div class="form-group row col-md-12">
					<input type='number' name='id_pedido' value='<?php echo $id_pedido; ?>' hidden>
					<input type='number' name='cantidad_detalle' value='<?php echo $pedido['cantidad']; ?>' hidden>
					<div class="col">
						<label for="dni_personal">DNI_Personal</label>
						<datalist id="dni">
						<?php
							$query="SELECT `dni`, `nombre` FROM `personal`";
							$consulta=mysqli_query($conexion,$query);
							while ($fila=mysqli_fetch_array($consulta)) {
								echo "<option value='$fila[0]'>$fila[1]</option>";
							}
						?>
						</datalist>
						<br>
						<input type="text" class="form-control" name="dni_personal" list="dni" value="<?php echo $dni_personal; ?>">
					</div>
					<div class="col-md-4">
						<label for="cuit_proveedor">Proveedor:</label>
						<datalist id="proveedor">
						<?php
							$query2="SELECT `cuit`, `nombre` FROM `proveedores`";
							$consulta2=mysqli_query($conexion,$query2);
							while ($fila2=mysqli_fetch_array($consulta2)) {
								echo "<option value='$fila2[0]'>$fila2[1]</option>";
							}
						?>
						</datalist>
						<br>
						<input class="form-control" name="cuit_proveedor" list="proveedor" value="<?php echo $cuit_proveedor; ?>">
					</div>
				</div>
				<?php
					while ($detalle=mysqli_fetch_array($consulta1)) {
						echo "<div class='form-group row col-md-12'>";
						echo "<input type='number' name='id_detalle[]' value='$detalle[1]' hidden>";
							echo "<div class='col-md-3'>";
								echo "<label for='ejemplares'>N° Ejemplares </label>";
								echo "<input type='number' class='form-control col-sm-10' id='ejemplares' name='ejemplares[]' value='$detalle[2]'>";
							echo "</div>";
							echo "<div class='col'>";
								echo "<datalist id='pelicula'>";
								while ($fila3=mysqli_fetch_array($consulta3)) {
									echo "<option value='$fila3[0]'>'$fila3[1] ($fila3[2])'</option>";
								}
								echo "</datalist>";
								echo "<label for='pelicula'>Película seleccionada: </label>";
								echo "<input type='text' class='form-control' name='pelicula[]' list='pelicula' value='$detalle[3]'>";
							echo "</div>";
						echo "</div>";
					}
				?>
			</form>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-auto my-4">
			<button type="submit" form="formpedido" class="btn btn-danger">Enviar</button>
		</div>
		<div class="col-auto my-4">
			<a href="pedidos.php" class="btn btn-danger">Cancelar</a>
		</div>
	</div>
</div>
</div>
</body>
</html>
