// acá tienen que ir todas las funciones y ser llamadas desde los botones o de donde sea
function getSeleccionado(cual) {
    const rbs = document.querySelectorAll(`input[name=${cual}]`);
    for (const rb of rbs) {
        if (rb.checked) {
            return rb.value;
        }
    }
    return false;
};

async function leerArchivo(cual) {
    const fName = getSeleccionado(cual);
    if (!fName) {
        return;
    }
    const response = await fetch(fName, {
        method: "POST"
    });

    switch (fName) {
        case "php/nfs.php":
            // equivalente a file_get_contents para javascript ------ 
            fetch("php/nfs.php").then((resp) => resp.text()).then(function (data) {
                contenidoVariable.innerHTML = data;
            });

            // tablapractica();

            break;
        default:
    }


};

function file_get_contents(filename) {
    console.log("entró en la función");
    console.log(filename);
    fetch(filename).then((resp) => resp.text()).then(function (data) {
        console.log(data);
        archivo = data;
        return data;

    });
}

async function getTextFromStream(readableStream) {
    const reader = readableStream.getReader();
    const utf8Decoder = new TextDecoder();
    let nextChunk;
    let resultStr = '';
    while (!(nextChunk = await reader.read()).done) {
        let partialData = nextChunk.value;
        resultStr += utf8Decoder.decode(partialData);
    }
    return resultStr;
};

function mostrarSeleccionado() {
    for (const rb of rbs) {
        if (rb.checked) {
            selectedValue = rb.value;
            contenidoVariable.innerHTML = "Selección: " + selectedValue;
            return;
        }
    }
    contenidoVariable.innerHTML = "No hay un archivo seleccionado.";
};

// Para lector de jsons
function readFileAsync(file) {
    return new Promise((resolve, reject) => {
        let reader = new FileReader();
        reader.onload = () => {
            resolve(reader.result);
        };
        reader.onerror = reject;
        reader.readAsText(file);
    })
}

// Tabla carrera
async function get_jsonc() {
    try {
        let file = document.getElementById('inputc').files[0];
        let json = await readFileAsync(file);
        // console.log(json);
        var formJson = new FormData();
        formJson.append("json", json);
        fetch("php/nfs/nfstablac.php",
            {
                method: "POST",
                body: formJson
            })
            .then(response => response.text())
            .then((formJson) => {
                var datos = JSON.parse(formJson);
                table = $('#tablacarrera').DataTable();
                table.destroy();
                $('#tablacarrera').DataTable({
                    data: datos,
                    columns: [
                        { data: 'Posicion' },
                        { data: 'Piloto' },
                        { data: 'TTotal' },
                        { data: 'MVuelta' },
                        { data: 'CVueltas' },
                        { data: 'Consistencia' }
                    ]
                });
            })
    } catch (err) {
        console.log(err);
    }
}

// Tabla qualy
async function get_jsonq() {
    try {
        let file = document.getElementById('inputq').files[0];
        let json = await readFileAsync(file);
        var formJson = new FormData();
        formJson.append("json", json);
        fetch("php/nfs/nfstablaq.php",
            {
                method: "POST",
                body: formJson
            })
            .then(response => response.text())
            .then((formJson) => {
                let datos = JSON.parse(formJson);
                table = $('#tablaclasificacion').DataTable();
                table.destroy();
                $('#tablaclasificacion').DataTable({
                    data: datos,
                    columns: [
                        { data: 'Posicion' },
                        { data: 'Piloto' },
                        { data: 'Diferencia' },
                        { data: 'MVuelta' },
                        { data: 'Sector1' },
                        { data: 'Sector2' },
                        { data: 'Sector3' }
                    ]
                });
            })
    } catch (err) {
        console.log(err);
    }
}

// Tabla práctica
async function get_jsonp() {
    try {
        let file = document.getElementById('inputp').files[0];
        let json = await readFileAsync(file);
        var formJson = new FormData();
        formJson.append("json", json);
        fetch("php/nfs/nfstablap.php",
            {
                method: "POST",
                body: formJson
            })
            .then(response => response.text())
            .then((formJson) => {
                let datos = JSON.parse(formJson);
                table = $('#tablapractica').DataTable();
                table.destroy();
                $('#tablapractica').DataTable({
                    data: datos,
                    columns: [
                        { data: 'Posicion' },
                        { data: 'Piloto' },
                        { data: 'Diferencia' },
                        { data: 'MVuelta' },
                        { data: 'Sector1' },
                        { data: 'Sector2' },
                        { data: 'Sector3' }
                    ]
                });
            })
    } catch (err) {
        console.log(err);
    }
}

// Botón guardar fin de semana
async function save_weekend() {
    try {
        let formData = new FormData();

        //Tipos de fechas
        if (tabId == "tlibre") {
            let torneo = "";
            formData.append("torneo", torneo);
        }
        if (tabId == "texistente") {
            let torneo = ($('#seleccionaTorneo').value);
            // console.log(torneo);
            if (torneo != "-- Seleccionar Torneo --") {
                formData.append("torneo", torneo);
            } else {
                alert("Seleccione un torneo existente");
            }
        }
        if (tabId == "tnuevo") {
            if ($('#informaExistente').is(':empty')){
                console.log(tabId);
                alert("Seleccione nombre de torneo");
                return;
            }
            if ($('#informaExistente').value == "El nombre del torneo ya existe"){
                alert("Seleccione nombre de torneo disponible");
                return;
            }
            if ($('#informaExistente').value == "Nombre de torneo disponible"){
                let torneo = ($('#torneoNuevo').value);
                formData.append("torneo", torneo);
            }
        }
        
        // Appends de los jsons y dates
        if (document.getElementById('inputp').files[0]) {
            let filec = document.getElementById('inputp').files[0];
            let datec = filec.name;
            datec = datec.substring(0, datec.length - 5);
            if (datec.slice(-4) != "TICE") {
                alert("El archivo de práctica no corresponde");
                return;
            }
            let jsonc = await readFileAsync(filec);
            formData.append("jsonp", jsonc);
            formData.append("datep", datec);
            if(tabId != 'tlibre'){
                torneo = "";
                formData.append("torneo", torneo);
            }
        }
        if (document.getElementById('inputq').files[0]) {
            let fileq = document.getElementById('inputq').files[0];
            let dateq = fileq.name;
            dateq = dateq.substring(0, dateq.length - 5);
            if (dateq.slice(-4) != "LIFY") {
                alert("El archivo de clasificación no corresponde");
                return;
            }
            let jsonq = await readFileAsync(fileq);
            formData.append("jsonq", jsonq);
            formData.append("dateq", dateq);
            if(tabId != 'tlibre'){
                torneo = "";
                formData.append("torneo", torneo);
            }
        }
        if (document.getElementById('inputc').files[0]) {
            let filec = document.getElementById('inputc').files[0];
            let datec = filec.name;
            datec = datec.substring(0, datec.length - 5);
            if (datec.slice(-4) != "RACE") {
                alert("El archivo de carrera no corresponde");
                return;
            }
            let jsonc = await readFileAsync(filec);
            formData.append("jsonc", jsonc);
            formData.append("datec", datec);
            if(tabId != 'tlibre'){
                torneo = "";
                formData.append("torneo", torneo);
            }
        }

        // Control de inputs vacíos
        if (!(document.getElementById('inputp').files[0]) && !(document.getElementById('inputq').files[0]) && !(document.getElementById('inputc').files[0])) {
            alert("Seleccione sesiones para guardar");
            return;
        }

        // Va a guardafinde.php y pasa los datos
        fetch("php/bd/guardafinde.php",
            {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then((formData) => console.log(formData))
    } catch (err) {
        console.log(err);
    }
}

// Control de caja de texto de torneo nuevo
async function check_tournament() {
    let existente = document.getElementById('torneoNuevo');
    let formData = new FormData();
    formData.append("existente", existente.value);
    let response = await fetch("php/nfs/torneonuevo.php",
        {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then((formData) => {
            let datos = formData;
            document.getElementById('informaExistente').innerHTML = datos;
        });
}

// Seteo del tipo de fecha según la tab seleccionada
var tabId = "tlibre";
function tab_tipoFecha() {
    setTimeout(function () {
        tabId = $('.tab-content .active').attr('id');
        // console.log(tabId);
    }, 200); //Tiene delay para esperar el foco de la pestaña
}