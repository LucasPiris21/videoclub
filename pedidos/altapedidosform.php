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
	<title>Agregar pedido</title>
</head>
<body>
<div class="container-sm form main">
	<div class="row justify-content-center">
		<div class="col-auto"><img src="../images/logovasmall.png" class="img-fluid"></div>
	</div>
	<br>
	<div class="row justify-content-center">
		<h3>AGREGAR PEDIDO</h3>
	</div>
	<br>	
	<div class="row justify-content-start">
		<div class="col-md-8">
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<div class="form-group row col-md-12">
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
						<input type="text" class="form-control" name="dni_personal" list="dni" value="<?php if (isset($_POST['confirmar'])) { $dni_personal=$_POST['dni_personal']; echo $dni_personal; }?>">
					</div>
					<div class="col">
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
						<input class="form-control" name="cuit_proveedor" list="proveedor" value="<?php if (isset($_POST['confirmar'])) { $cuit_proveedor=$_POST['cuit_proveedor']; echo $cuit_proveedor; }?>">
					</div>
					<div class="col">
						<label for="cantidad">Cantidad:</label>
						<input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php if (isset($_POST['confirmar'])) { $cantidad=$_POST['cantidad']; echo $cantidad; }?>">
					</div>
					<div class="col">
						<br>
						<button type="submit" name="confirmar" class="btn btn-danger">Confirmar</button>
					</div>
				</div>
			</form>
		<?php
			if (isset($_POST['confirmar'])) {
				$dni_personal=$_POST['dni_personal'];
				$cuit_proveedor=$_POST['cuit_proveedor'];
				$cantidad=$_POST['cantidad'];
				$query3="SELECT `id_pelicula`, `titulo`, `year` FROM `peliculas`";
				$consulta3=mysqli_query($conexion,$query3);
				echo "<form method='post' id='formpedido' action='altapedidos.php'>";
					echo "<input class='form-control' name='dni_personal' value='$dni_personal' hidden>";
					echo "<input class='form-control' name='cuit_proveedor' value='$cuit_proveedor' hidden>";
					echo "<input class='form-control' name='cantidad' value='$cantidad' hidden>";
					for ($i=0; $i <$cantidad ; $i++) { 
						echo "<div class='form-group row col-md-12'>";
							echo "<div class='col-md-3'>";
								echo "<label for='ejemplares'>N° Ejemplares </label>";
								echo "<input type='number' class='form-control col-sm-10' id='ejemplares' name='ejemplares[]'>";
							echo "</div>";
							echo "<div class='col'>";
								echo "<datalist id='pelicula'>";
								while ($fila3=mysqli_fetch_array($consulta3)) {
									echo "<option value='$fila3[0]'>'$fila3[1] ($fila3[2])'</option>";
								}
								echo "</datalist>";
								echo "<label for='pelicula'>Seleccione las películas: </label>";
								echo "<input type='text' class='form-control' name='pelicula[]' list='pelicula'>";
							echo "</div>";
						echo "</div>";
					}
			echo "</form>";
			}
		?>
		</div>
	</div>
	<?php
	if (isset($_POST['confirmar'])) {
		echo "<div class='row justify-content-center'>";
			echo "<button type='submit' form='formpedido' class='btn btn-danger'>Enviar</button>";
		echo "</div>";	
	}
	?>
	<div class="row justify-content-center">
		<div class="col-auto my-4">
			<a href="pedidos.php" class="btn btn-danger">Cancelar</a>
		</div>
	</div>
</div>
</div>
</body>
</html>
