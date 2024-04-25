<?php
session_start();
if (empty($_SESSION['estado'])) {
	header("location:index.php");
}
date_default_timezone_set("America/Buenos_Aires");
$date = date('d-m-o');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width initial-scale=1.0" />
	<title>Videoclub Alfa</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container-sm user">
	  		<div class="row justify-content-between row-fluid">
	  			<div class="col-auto"><b><u>Usuario</b></u>: <?php echo $_SESSION['nombre']; ?></div>
				<div class="col-auto"><b><u>Rol</b></u>: <?php echo $_SESSION['cargo']; ?></div>
				<div class="col-auto"><b><u>Fecha</u></b>:<?php echo $date; ?></div>	
	  			<div class="col-auto"><a href="logout.php" title="Cerrar sesión"><img src="images/exiticon.png" class="img-fluid exit"></a></div>
	  		</div>
  		</div>
	</div>
	<div class="container-sm main">
		<br>
		<div class="row justify-content-around row-fluid">
	  		<div class="col-auto"><a href="clientes/clientes.php"><img src="images/iconoclientes.png" class="img-fluid mainicon"></a></div>
	  		<div class="col-auto"><a href="bonos/bonos.php"><img src="images/iconobonos.png" class="img-fluid mainicon"></a></div>
	  		<div class="col-auto"><a href="alquileres/alquileres.php"><img src="images/iconoalquileres.png" class="img-fluid mainicon"></a></div>
		</div>
		<br>
		<div class="row justify-content-around row-fluid">
	  		<div class="col-auto"><a href="peliculas/peliculas.php"><img src="images/iconopeliculas.png" class="img-fluid mainicon"></a></div>
	  		<div class="col-auto"><a href="devoluciones/devoluciones.php"><img src="images/iconodevoluciones.png" class="img-fluid mainicon"></a></div>
	  		<div class="col-auto"><a href="proveedores/proveedores.php"><img src="images/iconoproveedores.png" class="img-fluid mainicon"></a></div>
		</div>
		<br>
		<div class="row justify-content-around row-fluid">
	  		<div class="col-auto"><a href="pedidos/pedidos.php"><img src="images/iconopedidos.png" class="img-fluid mainicon"></a></div>
	  		<div class="col-auto"><a href="facturas/facturas.php"><img src="images/iconofacturas.png" class="img-fluid mainicon"></a></div>
	  		<div class="col-auto"><a href="pagos/pagos.php"><img src="images/iconopagos.png" class="img-fluid mainicon"></a></div>
		</div>
		<?php
		if ($_SESSION['cargo']<>"Empleado") {
			echo "<br>";
			echo '<div class="row justify-content-center row-fluid">';
				echo '<div class="col-auto"><a href="personal/personal.php"><img src="images/iconopersonal.png" class="img-fluid mainicon"></a></div>';
			echo '</div>';
		}
		?>
		<br><br>
		<div class="row justify-content-center row-fluid">
	  		<div class="col-auto logo"><img src="images/logova1.png" class="img-fluid mx-auto d-block logo"></div>
		</div>
	</div>
</body>
</html>