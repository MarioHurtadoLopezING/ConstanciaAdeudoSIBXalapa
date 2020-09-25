<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script src="<?php echo base_url(); ?>js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/estilos.css">
	<title>Solicitud de constancia de no adeudo</title>
</head>
<body>
    <div>
        <img src="<?php echo base_url(); ?>recursosGraficos/logoUV.png" id="imgLogoUV" alt="Logo institucional uv">
    </div>
    <div>
        <h1 class="centerText">UNIVERSIDAD VERACRUZANA</h1>
        <H2 class="centerText">CONSTANCIA DE NO ADEUDO</H2>
        <H3 class="centerText">SELECCIONE EL TRÁMITE</H3>
    </div>
    <?php echo form_open('ConstanciaController/generarConstancia'); ?>
        <div class="centerText">
            <label>Tramite:</label>
            <select name="tipoConstancia">
                <option value="inscripcion">Inscripción</option>
                <option value="otro">Otros (Titulación, baja temporal o definitiva)</option>
            </select>
        </div>
        <div class="centerText">
            <label>Opciones de impresión:</label>
            <input type="radio" value="color" name="selectorImpresion" checked/>
            <label>Color</label>
            <input type="radio" value="grises" name="selectorImpresion"/>
            <label>Escala de grises</label>
        </div>
        <div class="centerText">
            <input type="submit" name="btnGuardar" value="Guardar">
        </div>
    </form>
</body>
</html>