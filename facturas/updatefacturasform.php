<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
} 
$id_factura=$_GET['id'];
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="SELECT * FROM `facturas` WHERE `id_factura`='$id_factura'";
$consulta=mysqli_query($conexion,$query);
$fila=mysqli_fetch_array($consulta);
$monton=$fila[1];
$estado=$fila[2];
$id_pedido=$fila[3];
$cuit_proveedor=$fila[4];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width initial-scale=1.0" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<title>Modificar cliente</title>
</head>
<body>
<div class="container-sm form mainform">
	<div class="row justify-content-center">
		<div class="col-auto"><img src="../images/logovasmall.png" class="img-fluid"></div>
	</div>
	<br>
	<div class="row justify-content-center">
		<div class="col-md-8">
			<center><h3>MODIFICAR FACTURA</h3></center>
			<form method="post" action="updatefacturas.php" id="factura">
				<div class="form-group">
					<label for="id_factura">ID_Factura</label>
					<input type="text" class="form-control" id="id_factura" name="id_factura" value="<?php echo $id_factura?>" readonly>
				</div>
				<div class="form-group">
					<label for="monton">Montón</label>
					<input type="number" class="form-control" id="monton" name="monton" value="<?php echo $monton?>">
				</div>
				<div class="form-group">
					<label for="estado">Estado</label>
					<select name="estado" form="factura" class="form-control">
						<?php  
							switch ($fila[2]) {
								case '0':
									echo "<option value='0' selected>Pendiente";
									echo "<option value='1'>Pagada";
									break;
								case '1':
									echo "<option value='0'>Pendiente";
									echo "<option value='1' selected>Pagada";
									break;
							}
							
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="id_pedido">ID_Pedido</label>
						<datalist id="pedido">
						<?php
							$query1="SELECT `id_pedido` FROM `pedidos`";
							$consulta1=mysqli_query($conexion,$query1);
							while ($fila1=mysqli_fetch_array($consulta1)) {
								echo "<option value='$fila1[0]'></option>";
							}
						?>
						</datalist>
						<input type="text" class="form-control" name="id_pedido" list="pedido" value="<?php echo $fila[3] ?>">
				</div>
				<div class="form-group">
					<label for="cuit_proveedor">Cuit_Proveedor</label>
					<datalist id="proveedor">
						<?php
							$query2="SELECT `cuit`, `nombre` FROM `proveedores`";
							$consulta2=mysqli_query($conexion,$query2);
							while ($fila2=mysqli_fetch_array($consulta2)) {
								echo "<option value='$fila2[0]'>$fila2[1]</option>";
							}
						?>
						</datalist>
						<input class="form-control" name="cuit_proveedor" list="proveedor" value="<?php echo $cuit_proveedor?>">
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
</body>
</html>
