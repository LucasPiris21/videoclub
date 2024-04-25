<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:../index.php");
}
$conexion=mysqli_connect('localhost','root','','videoclub');
if (empty($_GET['submit']) or isset($_GET['clear'])) {
	$query="SELECT * FROM `peliculas`";
	$consulta=mysqli_query($conexion,$query);
} else {
	$busq=$_GET['busq'];
	$query="SELECT * FROM `peliculas` WHERE concat(id_pelicula,titulo,año,genero,cant_copias) LIKE '%$busq%'";
	$consulta=mysqli_query($conexion,$query);
}
date_default_timezone_set("America/Buenos_Aires");
$date = date('d-m-o');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width initial-scale=1.0" />
	<title>Peliculas</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container-sm user">
	  		<div class="row justify-content-between row-fluid">
	  			<div class="col-auto"><b><u>Usuario</b></u>: <?php echo $_SESSION['nombre']; ?></div>
				<div class="col-auto"><b><u>Rol</b></u>: <?php echo $_SESSION['cargo']; ?></div>
				<div class="col-auto"><b><u>Fecha</u></b>:<?php echo $date; ?></div>	
	  			<div class="col-auto"><a href="../logout.php" title="Cerrar sesión"><img src="../images/exiticon.png" class="img-fluid exit"></a></div>
	  		</div>
  		</div>
	</div>
	<div class="container-sm main">
		<div class="row align-items-start">
			<div class="col-md-auto">
				<a href="../main.php"><img src="../images/back.png" style="width:10%" class="mainicon"></a>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-auto">
				<img src="../images/peliculastitle.png">
			</div>
		</div>
		<br>
		<form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<div class="row justify-content-center search">
				<div class="col-md-10">
					<div class="input-group">
					<div class="input-group-prepend">
						<button type="submit" name="clear" class="btn btn-danger"><img src="../images/clear.png"></button>
					</div>
					<input class="form-control" placeholder="Buscar..." type="search" name="busq" value="<?php if (isset($_GET['submit'])) { echo $busq;} ?>">
					<div class="input-group-append">
						<button type="submit" name="submit" value="submit" class="btn btn-danger"><img src="../images/search.png"></button>
					</div>
					</div>
				</div>
			</div>
		</form>
		<br>
		<div class="row justify-content-center">
			<div class="col-md-10">
				<div class="table-responsive">
					<table class="table table-dark">
						<thead>
							<tr>
								<th scope="col">ID_Pelicula</th>
								<th scope="col">Título</th>
								<th scope="col">Año</th>
								<th scope="col">Género</th>
								<th scope="col">Cantidad de Copias</th>
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
									echo "<td>";
										echo '<a href="copias.php?id='.$fila[0].'&titulo='.$fila[1].'" target="_blank">'.$fila[4].'</a>';
									echo "</td>";
									echo "<td class='text-center'>";
										echo '<a href="deletepeliculas.php?id='.$fila[0].'" class="btn btn-danger">Eliminar</a>';
									echo "</td>";
									echo "<td class='text-center'>";
										echo '<a href="updatepeliculasform.php?id='.$fila[0].'" class="btn btn-danger">Modificar</a>';
									echo "</td>";
								echo "</tr>";
							 }?>
						</tbody>
					</table>
				</div>
				<div class="row justify-content-star">
						<div class="col-md-auto align-self-center">
							<a href='altapeliculasform.php' class="add btn btn-danger">Agregar Película</a>
						</div>
				</div>
			</div>
		</div>
	</div>
	<script>
	</script>
</body>
</html>