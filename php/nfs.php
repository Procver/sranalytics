<h1 id="firstHeading" class="firstHeading">Nuevo fin de semana</h1>
<h2 id="SecondHeading" class="SecondHeading">Cargar nuevo fin de semana / carrera</h2>
<main>
    <legend>Tipo de fin de semana</legend>
    <ul class="nav nav-tabs" id="tiposFecha" onclick="tab_tipoFecha()">
        <li class="active"><a data-toggle="tab" href="#tlibre">Fecha libre</a></li>
        <li><a data-toggle="tab" href="#texistente">Torneo Existente</a></li>
        <li><a data-toggle="tab" href="#tnuevo">Torneo Nuevo</a></li>
    </ul>

    <div class="tab-content">
        <div id="tlibre" class="tab-pane fade in active">
            <h3>FECHA LIBRE</h3>
        </div>
        <div id="texistente" class="tab-pane fade">
            <h3>SELECCIONE TORNEO</h3>
            <?php
            require_once 'nfs/torneoexistente.php';
            ?>
            <div class="custom-select d-flex col-4">
                <select id=seleccionaTorneo>
                    <option>-- Seleccionar Torneo --</option>
                    <?php foreach ($resultados as $opciones) { ?>
                        <option><?php echo $opciones["Name"]; ?></option>
                    <?php } ?>
                </select>
            </div>
            <hr>
        </div>
        <div id="tnuevo" class="tab-pane fade">
            <h3>INGRESE NOMBRE DE NUEVO TORNEO</h3>
            <input type="text" id="torneoNuevo" oninput="check_tournament()">
            <br>
            <label id="informaExistente"></label>
            <br>
        </div>
    </div>
    <hr>
    <!-- <div class="container"> -->
    <!-- <form enctype="multipart/form-data"> -->
    <input type="file" id="inputp" name="cargajson">
    <button id='uploadp' type='button' onclick="get_jsonp()" value="upload">Cargar práctica</button>
    <br> <!-- Line break no funciona -->
    </p>
    <input type="file" id="inputq" name="cargajson">
    <button id='uploadq' type='button' onclick="get_jsonq()" value="upload">Cargar qualy</button>
    <br> <!-- Line break no funciona -->
    </p>
    <input type="file" id="inputc" name="cargajson">
    <button id='uploadc' type='button' onclick="get_jsonc()" value="upload">Cargar carrera</button>
    <!-- </form> -->
    </p>
    <button id='saveweekend' type="button" onclick="save_weekend()">Guardar fin de semana</button>
    <!-- </div> -->


    <ul class="nav nav-tabs" id="sesiones">
        <li class="active"><a data-toggle="tab" href="#practica">Práctica</a></li>
        <li><a data-toggle="tab" href="#clasificacion">Clasificación</a></li>
        <li><a data-toggle="tab" href="#carrera">Carrera</a></li>
    </ul>

    <div class="tab-content">
        <div id="practica" class="tab-pane fade in active">
            <h3>Práctica</h3>
            <table id="tablapractica" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Posición</th>
                        <th>Piloto</th>
                        <th>Diferencia</th>
                        <th>Tiempo</th>
                        <th>Sector 1</th>
                        <th>Sector 2</th>
                        <th>Sector 3</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Posición</th>
                        <th>Piloto</th>
                        <th>Diferencia</th>
                        <th>Tiempo</th>
                        <th>Sector 1</th>
                        <th>Sector 2</th>
                        <th>Sector 3</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div id="clasificacion" class="tab-pane fade">
            <h3>Clasificación</h3>
            <table id="tablaclasificacion" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Posición</th>
                        <th>Piloto</th>
                        <th>Diferencia</th>
                        <th>Tiempo</th>
                        <th>Sector 1</th>
                        <th>Sector 2</th>
                        <th>Sector 3</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Posición</th>
                        <th>Piloto</th>
                        <th>Diferencia</th>
                        <th>Tiempo</th>
                        <th>Sector 1</th>
                        <th>Sector 2</th>
                        <th>Sector 3</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div id="carrera" class="tab-pane fade">
            <h3>Carrera</h3>
            <table id="tablacarrera" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Posición</th>
                        <th>Piloto</th>
                        <th>Tiempo Total</th>
                        <th>Mejor vuelta</th>
                        <th>Cantidad de vueltas</th>
                        <th>Consistencia</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Posición</th>
                        <th>Piloto</th>
                        <th>Tiempo Total</th>
                        <th>Mejor vuelta</th>
                        <th>Cantidad de vueltas</th>
                        <th>Consistencia</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</main>