
<?php  
require_once 'funciones/conexion.php';
$MiConexion=ConexionBD(); 
require_once 'funciones/autenticacion.php';

date_default_timezone_set('America/Argentina/Buenos_Aires');

// Obtener la hora actual
$horaActual = date('H:i:s');

// Obtener la fecha actual
$fechaActual = date('d/m/Y');
?>



<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/sweetalert2.css">
	<link rel="stylesheet" href="css/material.min.css">
	<link rel="stylesheet" href="css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="css/main.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')</script>
	<script src="js/material.min.js" ></script>
	<script src="js/sweetalert2.min.js" ></script>
	<script src="js/jquery.mCustomScrollbar.concat.min.js" ></script>
	<script src="js/main.js" ></script>
</head>
<body>
	<!-- Notifications area -->

	<!-- navLateral -->
<?php require_once 'inc/barralateral.inc.php';  ?>

	<!-- pageContent -->
	<section class="full-width pageContent">
		
		<!-- navBar -->
		<?php require_once 'inc/barranav.inc.php'; ?>
			<section class="full-width text-center" style="padding: 40px 0;">
		  <div id="hora"><h2 class="text-center tittles"><?php echo $horaActual; ?></h2></div>
        <div id="fecha"><h3 class="text-center tittles"><?php echo $fechaActual; ?></h3></div>
			<!-- Tiles -->
			<section class="full-width text-center" style="padding: 40px 0;">
				<div><img src="assets/img/home.png"></div>
<div>
	<h1 class="text-center tittles">EL</h1>
			<h2 class="text-center tittles">EXITO</h2>
			<h3 class="text-center tittles">SE VE</h3>
			<h4 class="text-center tittles">CLARO</h4>
			<h5 class="text-center tittles">CUANDO</h5>
			<h6 class="text-center tittles">TE ENFOCAS</h6>

      
    </div>


			
		</section>
	</section>
</body>
</html>
<script >
    setInterval(() => {
        fetch('reloj.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('hora').innerHTML = 
                    `<h2 class="text-center tittles">${data}</h2>`;
            });
    }, 1000);
</script>