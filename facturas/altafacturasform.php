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
	<title>Agregar factura</title>
</head>
<body>
<div class="container-sm form mainform">
	<div class="row justify-content-center">
		<div class="col-auto"><img src="../images/logovasmall.png" class="img-fluid"></div>
	</div>
	<br>	
	<div class="row justify-content-center">
		<div class="col-md-8">
			<center><h3>AGREGAR FACTURA</h3></center>
			<form method="post" action="altafacturas.php">
				<div class="form-group">
					<label for="id_pedido">ID_Pedido</label>
						<datalist id="pedido">
						<?php
							$query="SELECT `id_pedido`,`cuit_proveedor` FROM `pedidos`";
							$consulta=mysqli_query($conexion,$query);
							while ($fila=mysqli_fetch_array($consulta)) {
								echo "<option value='$fila[0]'>Proveedor: $fila[1]</option>";
							}
						?>
						</datalist>
						<input type="number" class="form-control" name="id_pedido" list="pedido" min="1" pattern="^[0-9]+" required>
				</div>
				<div class="form-group">
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
						<input type="number" class="form-control" name="cuit_proveedor" list="proveedor" min="1" pattern="^[0-9]+" required>
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
				<div class="row justify-content-center">
					<div class="col-auto">
					<button type="submit" class="btn btn-danger">Enviar</button>
					</div>
					<div class="col-auto">
						<a href="facturas.php" class="btn btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
</body>
</html>