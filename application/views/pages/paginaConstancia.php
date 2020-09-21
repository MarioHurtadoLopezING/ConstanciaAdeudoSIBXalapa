<!DOCTYPE html>
<html>
<head>
	<title>Pagina</title>
	<style type="text/css">
		body{
			background-color: #6A6767;
			font-family: Arial, Helvetica, sans-serif;
		}
		#divSelector{
			width: 100%;
			height: 3em;
			background-color: #403F3F;
			position: absolute;
			top: 0;
			right: 0;
			font-family: sans-serif;
			color: white;
			position: fixed;
			 max-height: 3em;
		}
		#divContenidoConstancia{
			margin-top: 4em;
			height: 47.19125051em;
			width: 68.54750em;
			background-color: rgb(255, 255, 255); 
			background-image: url('imagenFondo.jpeg'); 
			position: relative;
			
		}
		
		#h4NombreDocumento{
			margin-left: 3em;
			display:inline-block;
		}
		#imgDescargarDocumento{
			position: absolute;
			display: inline-block;
    		width:100%;
		}
		label{
			display: block;
			
			font-size: 14pt;
			font-weight: bolder;

		}
		
	</style>
</head>
<body>
	<div id="divSelector">
		<h4 id="h4NombreDocumento">CONVOCATORIA.pdf</h4>
			<img src="descargar.png" width="25px" height="25px" alt="imagen descarga">
	</div>
	<center>
		<div id="divContenidoConstancia">
			<center><label style="position: absolute; width: 50%; margin: auto; margin-top: 8em; margin-left: 15em;">Constancia de no adeudo en línea</label></center>
			<label style="position: absolute; width: 40%;margin: auto; margin-top: 11em; margin-left: 0em;">A quien corresponda:</label>
			<label style="font-weight: normal; position: absolute; width: 77%; margin-top: 14em; margin-left: 0em;">El sistema bibliotecario de la Universidad Veracruzana ha verificado que:</label>
			<div style="position: absolute; width: 45%; margin-top: 20em; margin-left: 0em;">
				<label style="display: inline-block;">Nombre:</label>
				<label style="font-weight: normal; display: inline-block; ">Mario Hurtado López</label>
			</div>
			<div style="position: absolute; width: 39%; margin-top: 22em; margin-left: 0em;">
				<label style="display: inline-block;">Matricula:</label>
				<label style="font-weight: normal; display: inline-block; ">S15011633</label>
			</div>
			<div style="position: absolute; width: 46%; margin-top: 24em; margin-left: 0em;">
				<label style="display: inline-block;">Carrera:</label>
				<label style="font-weight: normal; display: inline-block; ">Ingeniería de Software</label>
			</div>
			<div style="position: absolute; width: 37%; margin-top: 26em; margin-left: 0em;">
				<label style="display: inline-block;">Trámite:</label>
				<label style="font-weight: normal; display: inline-block; ">Inscripción</label>
			</div>
			<div style="position: absolute; width: 55%;  margin-top: 28em; margin-left: 0em;">
				<label style="display: inline-block;">Biblioteca:</label>
				<label style="font-weight: normal; display: inline-block; ">Dirección General de bibliotecas</label>
			</div>
			<div style="position: absolute; width: 62%;  margin-top: 31em; margin-left: 0em;">
				<label style="display: inline-block;">No tiene adeudos en las bibliotecas universitarias</label>
			</div>
			<div style="position: absolute; width: 80%;  margin-top: 33em; margin-left: 0em;">
				<label style="font-weight: normal; display: inline-block; ">Dirección General de bibliotecas</label>
			</div>
		</div>

	</center>
</body>
</html>