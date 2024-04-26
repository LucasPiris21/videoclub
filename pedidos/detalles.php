<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
}
$referer=$_SERVER['HTTP_REFERER'];
if ($referer=='http://localhost/Videoclub%20Alfa/pedidos/pedidos.php' or $referer=='http://localhost/Videoclub%20Alfa/facturas/facturas.php') {
	$_SESSION['id']=$_GET['id'];
}
$conexion=mysqli_connect('localhost','root','','videoclub');
$query="SELECT * FROM `detalle` WHERE `id_pedido`='$_SESSION[id]'";
$consulta=mysqli_query($conexion,$query);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width initial-scale=1.0" />
	<title>Detalle del pedido N°<?php echo $_SESSION['id']; ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container-sm main">
		<div class="row justify-content-start">
			<div class="col-md-auto">
				<h2>Detalle del pedido N°<?php echo $_SESSION['id']; ?></h2>
			</div>
		</div>
		<div class="row justify-content-start">
			<div class="col-md-10">
				<div class="table-responsive">
					<table class="table table-dark">
						<thead>
							<tr>
								<th scope="col">ID_Pedido</th>
								<th scope="col">ID_Detalle</th>
								<th scope="col">Número de Ejemplares</th>
								<th scope="col">ID_Pelicula</th>
								<th class="text-center" colspan=2 scope="col">Funciones</th>
							</tr>
						</thead>
						<tbody id="myTable">
							<?php while ($fila=mysqli_fetch_array($consulta)) {
								echo "<tr>";
									echo "<td>";
										echo $fila[0];
									echo "</td>";
									echo "<td>";
										echo $fila[1];
									echo "</td>";
									echo "<td>";
										echo $fila[2];
									echo "</td>";
									echo "<td>";
										echo $fila[3];
									echo "</td>";
									echo "<td class='text-center'>";
										echo '<a href="deletedetalle.php?idp='.$fila[0].'&idd='.$fila[1].'" class="btn btn-danger">Eliminar</a>';
									echo "</td>";
								echo "</tr>";
							 }?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
