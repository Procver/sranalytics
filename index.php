<!DOCTYPE html>
<html lang="es-ES">

<head>
    <title>Sim racing analytics</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
</head>

<body>

        <!-- <div class="btn-group" data-toggle="buttons"> -->
            <label class="btn btn-primary">
            <input type="radio" name="cual_php" id="cual_portada" value="php/portada.php" checked onclick="leerArchivo('cual_php')"> Sim racing analytics
            </label>
            <label class="btn btn-primary">
            <input type="radio" name="cual_php" id="cual_nfs" value="php/nfs.php" onclick="leerArchivo('cual_php')">Nuevo fin de semana
            </label>
            <label class="btn btn-primary">
            <input type="radio" name="cual_php" id="cual_ege" value="php/ege.php" onclick="leerArchivo('cual_php')">Estadisticas generales
            </label>
            <label class="btn btn-primary">
            <input type="radio" name="cual_php" id="cual_pil" value="php/pil.php" onclick="leerArchivo('cual_php')">Pilotos
            </label>
        <!-- </div> -->


    <!-- <h2>Contenido a mostrar</h2> -->
    <div id="contenidoVariable"></div>
    <script src="js/funciones.js"></script>
    <!-- <script src="js/nfspractica.js"></script> -->

</body>
</html>