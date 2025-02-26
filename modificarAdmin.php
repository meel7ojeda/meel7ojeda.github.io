<?php 
require_once 'funciones/conexion.php';
$MiConexion=ConexionBD();
require_once 'funciones/autenticacion.php';


require_once 'funciones/selectprovincia.php';
$ListadoProvincia = ListarProvincia($MiConexion);
$CantidadProvincia= count($ListadoProvincia);

require_once 'funciones/selectJerarquia.php';
$ListadoJer = ListarJerarquia($MiConexion);
$CantidadJer= count($ListadoJer);

require_once 'verificacion.php';

require_once 'funciones/insertUser.php'; 
require_once 'funciones/mostrarUser.php';

$ListadoCli = ListarUsuarios($MiConexion);
$CantidadCli = count($ListadoCli);

require_once 'funciones/validardatos.php';
require_once 'funciones/actualizarAdmin.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MiConexion = ConexionBD();
    if ($_POST['accion'] === 'modificar') {
        $mensajeC = '';
        $mensajeE = '';

        $resultado = ModificarAdmin($MiConexion, $_POST);
         $mensajeC = "Actualizacion exitosa.";


        if (!$resultado) {
            $mensajeE = "Error al intentar actualizar cliente.";
        }
        
        mysqli_close($MiConexion);
    }
}

require_once 'funciones/AdminPorDNI.php';

if (isset($_GET['DNIadmin'])) {
    $dni = $_GET['DNIadmin'];

    $cliente = obtenerDatosAdminPorDNI($dni);

	$nombre = $cliente['NOMBRE'] ?? '';
    $apellido = $cliente['APELLIDO'] ?? '';
    $domicilio = $cliente['DOMICILIO'] ?? '';
    $ciudad = $cliente['CIUDAD'] ?? '';
    $contacto = $cliente['CONTACTO'] ?? '';
    $email = $cliente['USUARIO'] ?? '';
    $contra = $cliente['CONTRASENA'] ?? '';


} else {
    echo "No se ha proporcionado un DNI válido.";
    exit;
}


 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Modificar Administrador</title>
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
		
		<section class="full-width header-well">
			<div class="full-width header-well-icon">
				<i class="zmdi zmdi-accounts"></i>
			</div>
			<div class="full-width header-well-text">
				<p class="text-condensedLight">
					ADMINISTRADOR
				</p>
			</div>
		</section>
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
			<div class="mdl-tabs__tab-bar">
				<a href="#tabNewClient" class="mdl-tabs__tab is-active">MODIFICAR</a>
			</div>
			<div class="mdl-tabs__panel is-active" id="tabNewClient">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--12-col">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-primary text-center tittles">
								Modificar Cliente
							</div>
							<div class="full-width panel-content">

<?php
// Mostrar los mensajes solo si no están vacíos
if (!empty($mensajeC)) {
    echo "<div class='mensaje-correcto'>$mensajeC    -  <b><a href=admin.php>Volver</a></b></div>";
    }

if (!empty($mensajeE)) {
    echo "<div class='mensaje-alerta'>$mensajeE</div>";
}
?>
	

			<form role="form" method="POST" > <input type="hidden" name="accion" value="modificar">

									<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--12-col">
									        <legend class="text-condensedLight"><i class="zmdi zmdi-border-color"></i> &nbsp; DATOS DE USUARIO</legend><br>
									    </div>
									    


									    <div class="mdl-cell mdl-cell--12-col">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
			<input class="mdl-textfield__input" type="number" pattern="-?[0-9]*(\.[0-9]+)?" id="DNI" name="DNI" value="<?php echo htmlspecialchars($dni); ?>" readonly>
												<label class="mdl-textfield__label" for="DNIClient">DNI</label>
												<span class="mdl-textfield__error">Numero invalido</span>
											</div>
									    </div>
									    

									    <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text"  id="NombreAdmin" name="NombreAdmin" value="<?php echo htmlspecialchars($nombre); ?>">
												<label class="mdl-textfield__label" >Nombre</label>
												<span class="mdl-textfield__error">Nombre invalido</span>
											</div>
									    </div>
									    

									    <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text"  id="ApellidoAdmin" name="ApellidoAdmin" value="<?php echo htmlspecialchars($apellido); ?>">
												<label class="mdl-textfield__label" >Apellido</label>
												<span class="mdl-textfield__error">Apellido invalido</span>
											</div>
									    </div>
									   
									    <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text" id="DomicilioAdmin" name="DomicilioAdmin" value="<?php echo htmlspecialchars($domicilio); ?>">
												<label class="mdl-textfield__label" >Domicilio</label>
												<span class="mdl-textfield__error">Domicilio invalida</span>
											</div>
									    </div>
									    
									    <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text" id="CiudadAdmin" name="CiudadAdmin" value="<?php echo htmlspecialchars($ciudad); ?>">
												<label class="mdl-textfield__label" >Ciudad</label>
												<span class="mdl-textfield__error">Ciudad invalida</span>
											</div>
									    </div>


						<div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<label class="mdl-textfield__label" >Provincia</label>
				<select class="mdl-textfield__input" aria-label="Selector" id="selector" name="Provincia">
                          <?php 
            $selected='';
           for ($i=0 ; $i < $CantidadProvincia ; $i++) {
           if (!empty($_POST['Provincia']) && $_POST['Provincia'] ==  $ListadoProvincia[$i]['IDPROV']) {
            $selected = 'selected';
            }else {
            $selected='';
            }
            ?>
            <option value="<?php echo $ListadoProvincia[$i]['IDPROV']; ?>" <?php echo $selected; ?>  >
            <?php echo $ListadoProvincia[$i]['PROVINCIA']; ?>
            </option>
            <?php } ?>
            </select>            </div>
						</div>



									    <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="tel"  id="ContactoAdmin" name="ContactoAdmin" value="<?php echo htmlspecialchars($contacto); ?>">
												<label class="mdl-textfield__label" >Contacto</label>
												<span class="mdl-textfield__error">Numero de contacto invalido</span>
											</div>
									    </div>
									    

									    <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="email" id="EmailAdmin" name="EmailAdmin" value="<?php echo htmlspecialchars($email); ?>">
												<label class="mdl-textfield__label" >E-mail</label>
												<span class="mdl-textfield__error">E-mail invalido</span>
											</div>
									    </div>

									    <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text" id="ContraAdmin" name="ContraAdmin" value="<?php echo htmlspecialchars($contra); ?>">
												<label class="mdl-textfield__label" >Contraseña</label>
												<span class="mdl-textfield__error">Contraseña invalida</span>
											</div>
									    </div>



									   <div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet">
						<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<label class="mdl-textfield__label" >Jerarquia</label>
				<select class="mdl-textfield__input" aria-label="Selector" id="selector" name="Jer">
                          <?php 
            $selected='';
           for ($i=0 ; $i < $CantidadJer ; $i++) {
           if (!empty($_POST['Jer']) && $_POST['Jer'] ==  $ListadoJer[$i]['IDJER']) {
            $selected = 'selected';
            }else {
            $selected='';
            }
            ?>
            <option value="<?php echo $ListadoJer[$i]['IDJER']; ?>" <?php echo $selected; ?>  >
            <?php echo $ListadoJer[$i]['JERARQUIA']; ?>
            </option>
            <?php } ?>
            </select>            
        				</div>
						</div>
									    
 									   <input type="hidden" name="Disponibilidad" value="1">


									    
									</div>
									<p class="text-center">

										<button type="submit" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" id="btn-addClient">
											<i class="zmdi zmdi-plus"></i>
										</button>
										<div class="mdl-tooltip" for="btn-addClient">Modificar Administrador</div>
									</p>
								</form>



							</div>
						</div>
					</div>
				</div>

			</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>


	</section>
</body>
</html>