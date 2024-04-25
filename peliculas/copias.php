<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
}
$referer=$_SERVER['HTTP_REFERER'];
if ($referer=='http://localhost/Videoclub%20Alfa/peliculas/peliculas.php') {
 	$_SESSION['id']=$_GET['id'];
 	$_SESSION['titulo']=$_GET['titulo'];
 	$conexion=mysqli_connect('localhost','root','','videoclub');
	$query="SELECT * FROM `copias` WHERE `id_pelicula`='$_SESSION[id]'";
	$consulta=mysqli_query($conexion,$query);
} elseif (strstr($referer, 'copias')) {
	$conexion=mysqli_connect('localhost','root','','videoclub');
	$query="SELECT * FROM `copias` WHERE `id_pelicula`='$_SESSION[id]'";
	$consulta=mysqli_query($conexion,$query);
} else {
 	header("location:peliculas.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width initial-scale=1.0" />
	<title>Copias de <?php echo $_SESSION['titulo']; ?></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container-sm main">
		<div class="row justify-content-start">
			<div class="col-md-auto">
				<h2>Copias de <?php echo $_SESSION['titulo']; ?></h2>
			</div>
		</div>
		<div class="row justify-content-start">
			<div class="col-md-10">
				<div class="table-responsive">
					<table class="table table-dark">
						<thead>
							<tr>
								<th scope="col">ID_Pelicula</th>
								<th scope="col">ID_Copia</th>
								<th scope="col">Disponibilidad</th>
								<th scope="col">Cuit_Proveedor</th>
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
										if ($fila[2]==0) {
											echo "<p style='background-color:green';>Disponible</p>";
										} else {
											echo "<p style='background-color:red';> No disponible</p>";
										}
									echo "</td>";
									echo "<td>";
										echo $fila[3];
									echo "</td>";
									echo "<td class='text-center'>";
										echo '<a href="deletecopias.php?idp='.$fila[0].'&idc='.$fila[1].'" class="btn btn-danger">Eliminar</a>';
									echo "</td>";
								echo "</tr>";
							 }?>
						</tbody>
					</table>
				</div>
				<div class="row justify-content-star">
						<div class="col-md-auto align-self-center">
							<a href='altacopiasform.php?id=<?php echo $_SESSION["id"]; ?>' class="add btn btn-danger">Agregar Copia</a>
						</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
