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

    // switch(fName){
    //     case "php/nfs.php":
    //         const json = await response.json();
    //         contenidoVariable.innerHTML = json["html"];
    //         tablapractica();
    //         let myScript = document.createElement("script");
    //         // myScript.setAttribute("id", "myScript");
    //         myScript.innerHTML = json["js"];
    //         document.body.appendChild(myScript);
    //         // console.log(json["js"]);
    //         break;
    //         default:
    // }

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

// function get(fName) {
//     fetch(fName).then((resp) => resp.text()).then(function(data) {
//         temp = data;
//     });
// }

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

async function get_jsonp() {
    let formData = new FormData();
    formData.append('file', inputp.files[0]);
    let response = await fetch(
        'php/bd/cargajson.php', {
        method: 'POST',
        body: formData
    });
    console.log(response.statusText);
}
// async function get_jsonq() {
//     let formData = new FormData();
//     formData.append('file', inputq.files[0]);
//     let response = await fetch(
//         'php/bd/cargajson.php', {
//         method: 'POST',
//         body: formData
//     });
//     console.log(response.statusText);
// }
// pasar valores

// function get_jsonc() {

//     // let formData = new FormData();
//     // formData.append('file', inputc.files[0]);
//     // // let response = await fetch(
//     // //     'php/bd/cargajson.php', {
//     // //         method: 'POST',
//     // //         body: formData
//     // //     });
//     // console.log(formData);

//     let fileReader = new FileReader();
//     fileReader.readAsText(document.getElementById("inputc").files[0]);
//     let json = "";
//     fileReader.onload = function () {
//       json = fileReader.result;
//       console.log(json);
//     };




//     $('#tablacarrera').DataTable({
//         "processing": true,
//         "serverSide": false,
//         "ajax": {
//             "url": "php/nfs/nfsprocc.php",
//             "type": "POST",
//             "data": {
//                 "data": json
//             }
//         }
//     });


// }

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

async function save_weekend() {
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