<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<script src="<?php echo base_url(); ?>js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/estilos.css">
	<title>Constancia de no adeudo</title>
</head>
<body id="bodyVisorConstancia">
	<div id="divEspecificacionesConstancia">
		<h4 id="h4NombreDocumento">Constancia de no adeudo.pdf</h4>
		<?php echo form_open('ConstanciaController/descargarConstancia'); ?>
			<input id="imgDescargaArchivo" title="boton enviar" alt="boton enviar" src="<?php echo base_url(); ?>/recursosGraficos/descargar.png" type="image" />
			<!--<img id="imgDescargaArchivo" src="<?php echo base_url(); ?>/recursosGraficos/descargar.png" alt="imagen descarga">-->
		</form>
	</div>
	<div id="divPadreContenidoConstancia">
		<div id="divContenidoConstancia" class="">
			<div id="divTituloConstancia" class="centerText bold size">
				<label>Constancia de no adeudo en línea</label>
			</div>
			<div id="divDatosAlumno">
				<div>
					<label class="bold size">A quien corresponda:</label>
				</div>
				<div class="espacioAlineacionElemento">
					<label class="size">El sistema bibliotecario de la Universidad Veracruzana ha verificado que:</label>
				</div>
				<div class="espacioAlineacionElemento">
					<label class="bold size">Nombre:</label>
					<label class="size"><?php echo $nombreAlumno; ?></label>
				</div>
				<div>
					<label class="bold size">Matricula:</label>
					<label class="size"><?php echo $matricula; ?></label>
				</div>
				<div>
					<label class="bold size">Carrera:</label>
					<label class="size"><?php echo $carrera; ?></label>
				</div>
				<div>
					<label class="bold size">Tramite:</label>
					<label class="size"><?php echo $tramite; ?></label>
				</div>
				<div>
					<label class="bold size">Biblioteca:</label>
					<label class="size"><?php echo $facultad; ?></label>
				</div>
				<div class="espacioAlineacionElemento">
					<div>
						<label class="bold size">No tiene adeudos en las bibliotecas universitarias.</label>
					</div>
					<div class="espacioAlineacionElemento">
						<label class="size">Por lo que a petición del(a) interesado(a) y para fines legales que al(a) mismo(a) convengan.
							Se extiende la presente CONSTANCIA en la ciudad de <?php echo $ciudadEstudio; ?> a los <?php echo $diaActual; ?>
							dias del mes de <?php echo $mesActual; ?> del <?php echo $anoActual; ?>.
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>