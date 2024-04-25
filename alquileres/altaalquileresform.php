<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
}
$fecha_actual= date('o-m-d');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width initial-scale=1.0" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<title>Agregar alquiler</title>
</head>
<body>
<div class="container-sm form main">
	<div class="row justify-content-center">
		<div class="col-auto"><img src="../images/logovasmall.png" class="img-fluid"></div>
	</div>
	<br>
	<div class="row justify-content-center">
		<h3>AGREGAR ALQUILER</h3>
	</div>
	<br>	
	<div class="row justify-content-start">
		<div class="col-md-8">
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<div class="form-group row">
					<div class="col-md-5">
						<label for="id_bono">Seleccione el Bono: </label>
					</div>
					<div class="col">
						<datalist id="id_bono">
						<?php
							$conexion=mysqli_connect('localhost','root','','videoclub');
							$query="SELECT `id_bono`, `credito_disponible`, `periodo`, `dni_cliente` FROM `bono` WHERE 'fecha_vencimiento'>$fecha_actual";
							$consulta=mysqli_query($conexion,$query);
							while ($fila=mysqli_fetch_array($consulta)) {
								echo "<option value='$fila[0]'>'DNI: $fila[3]; Crédito: $fila[1]; Días: $fila[2]'</option>";
							}
						?>
						</datalist>
						<input class="form-control" name="id_bono" list="id_bono" style="width:200px" value="<?php if (isset($_POST['bono'])) { $id_bono=$_POST['id_bono']; echo $id_bono; }?>">
					</div>
					<div class="col">
						<button type="submit" name="bono" class="btn btn-danger">Confirmar</button>
					</div>	
				</div>
			</form>
			<?php
			if (isset($_POST['bono'])) {
				$id_bono=$_POST['id_bono'];
				$query="SELECT `credito_disponible`, `periodo`, `dni_cliente` FROM `bono` WHERE `id_bono`='$id_bono'";
				$consulta=mysqli_query($conexion,$query);
				$fila=mysqli_fetch_array($consulta);
				$credito=$fila[0];
				$periodo=$fila[1];
				$dni_cliente=$fila[2];
				$query2="SELECT `id_pelicula`, `titulo`, `year` FROM `peliculas`";
				$consulta2=mysqli_query($conexion,$query2);
				echo "<form method='post' action='altaalquileres.php'>";
					echo "<input class='form-control' name='id_bono' value='$id_bono' hidden>";
					echo "<input class='form-control' name='credito' value='$credito' hidden>";
					echo "<input class='form-control' name='periodo' value='$periodo' hidden>";
					echo "<input class='form-control' name='dni_cliente' value='$dni_cliente' hidden>";
					echo "<div class='form-group row'>";
						echo "<div class='col'>";
							echo "<label for='pelicula'>Seleccione las películas a alquilar: </label>";
						echo "</div>";
					echo "</div>";
					for ($i=0; $i <$credito ; $i++) { 
						echo "<div class='form-group row'>";
							echo "<div class='col'>";
								echo "<datalist id='pelicula'>";
								while ($fila2=mysqli_fetch_array($consulta2)) {
									echo "<option value='$fila2[0]'>'$fila2[1] ($fila2[2])'</option>";
								}
								echo "</datalist>";
								echo "<input type='text' class='form-control' name='pelicula[]' list='pelicula'>";
							echo "</div>";
						echo "</div>";
					}
					echo "<div class='form-group row'>";
						echo "<div class='col-sm-2'>";
							echo "<button type='submit' class='btn btn-danger'>Enviar</button>";
						echo "</div>";
					echo "</div>";	
				echo "</form>";
			}
			?>
		</div>
	</div>
	<div class="row justify-content-center">
		<a href="alquileres.php" class="btn btn-danger">Cancelar</a>
	</div>
</div>
</body>
</html>
