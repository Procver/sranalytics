<h1 id="firstHeading" class="firstHeading">Nuevo fin de semana</h1>
<h2 id="SecondHeading" class="SecondHeading">Cargar nuevo fin de semana / carrera</h2>
<main>
    <div class="container">
        <fieldset>
            <legend>Tipo de carrera</legend>
            <label for="tipocarrera">Carrera</label>
            <select id="tipocarrera" onchange="seleccionaTipo();" onfocus="this.selectedIndex = 'ninguna'">
                <option name="tipo" value="ninguna">--seleccionar--</option>
                <option name="tipo" value="libre">Libre</option>
                <option name="tipo" value="texistente">Torneo existente</option>
                <option name="tipo" value="tnuevo">Torneo nuevo</option>
            </select>

            <div class="texistente">
                <!-- PONER FECHAS Y DAR SELECCIÓN DE TORNEO -->

                <!-- CAMBIAR -->
                <h3>SELECCIONE TORNEO</h3>
                <div class="custom-select d-flex col-4">
                    <select>
                        <option value="0">Seleccione torneo:</option>
                        <option value="1">Copa de Marcas Brasil</option>
                        <option value="2">F1 2007</option>
                    </select>
                </div>
                <hr>
            </div>

            <div class="tnuevo">
                <!-- PONER FECHAS Y DAR INGRESO DE NOMBRE DE TORNEO -->

                <!-- CAMBIAR -->
                <h3>INGRESE NOMBRE DE NUEVO TORNEO</h3>
                <input type="text">
            </div>

        </fieldset>

    </div>
    <hr>
    <!-- <div class="container"> -->
    <!-- <form enctype="multipart/form-data"> -->
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


    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#practica">Práctica</a></li>
        <li><a data-toggle="tab" href="#clasificacion">Clasificación</a></li>
        <li><a data-toggle="tab" href="#carrera">Carrera</a></li>
    </ul>

    <div class="tab-content">
        <!-- <div id="practica" class="tab-pane fade in active">
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

        </div> -->
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