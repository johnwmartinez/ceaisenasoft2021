function mostrar_esconder(clase, accion){
    let action = (accion == 'mostrar') ? 'block' : 'none'
    document.querySelector(clase).style.display = action
}

function estructuraFrontend( conf )
{
    /* Módulo 1: Pantalla inicial */
    if(conf.pantalla_inicial == 1)
        mostrar_esconder('.creacionPartidas', 'mostrar')
    else
        mostrar_esconder('.creacionPartidas', 'esconder')
    if(conf.arena_partidas == 1)
        mostrar_esconder('.arenaPartida', 'mostrar')
    else
        mostrar_esconder('.arenaPartida', 'esconder')

}
let ventanaEstatica = 0
function consultaAPI() {

    const data = new FormData();
    data.append('processing', 'SENASOFT');

    fetch('api/', {
            method: 'POST',
            body: data
        })
        .then(response => response.json())
        .then(data => {
            if (data) {
                
                // Variables de diseño
                let pantalla_inicial = 0
                let arena_partidas = 0

                // Codigo 100: Mostramos la pantalla inicial
                if(data.codigo == 100){
                    document.querySelector('.arena_pruebas').innerHTML = '...'
                    pantalla_inicial = 1
                }
                if(data.codigo == 202){ /* Partida en progreso */
                    document.querySelector('.arena_pruebas').innerHTML = data.mensaje
                    arena_partidas = 1
                    /* Armamos el Frontend */
                    /* 1. Jugadores */
                    let arenaJugadores = '<h3>Contrincantes: </h3>'
                    data.frontend.contrincantes.forEach(function( cadaU ){
                        arenaJugadores += `
                        <div class="jugador">
                            <div class="foto"></div>
                            <div class="" style="color:orange">${cadaU.nombre}</div>
                        </div>
                        `
                    })
                    document.querySelector('.arenajugadores').innerHTML = arenaJugadores

                    /* 2. Turno */
                    let arenaTurno = ''
                    arenaTurno += `<div class="jugadorIndv">${data.frontend.turno.nombre}</div>`
                    document.querySelector('.arenaTurno').innerHTML = arenaTurno
                    
                    /* 3. Última pregunta de un jugador */
                    let arenaPreguntaJugador = '';
                    if(data.frontend.preguntas[0] == 0){
                        arenaPreguntaJugador = ``
                    }else{
                        arenaPreguntaJugador += `
                        <div class="pregunta">
                            <div class="h2">
                                <h2>Ultima pregunta:</h2>
                                <div class="jugadorIndv">${data.frontend.preguntas.nombre} preguntó por las cartas ${data.frontend.preguntas.carta_1}, ${data.frontend.preguntas.carta_2} y ${data.frontend.preguntas.carta_3}</div>
                            </div>
                        </div>
                        `
                    }
                    document.querySelector('.arenaPreguntaJugador').innerHTML = arenaPreguntaJugador
                    
                    /* 4. La tabla del jugador */
                    let arenaTabla = '<h3>Tabla de cartas: </h3>'
                    arenaTabla += `<div class="tabla-html">${data.frontend.tablas}</div>`
                    document.querySelector('.arenaTabla').innerHTML = arenaTabla
                    
                    /* 5. Categorías para los selects */
                    if(ventanaEstatica == 0){
                        /* Llenamos el select de programador */
                        let programador = '<option></option>'
                        data.frontend.categorias.programador.forEach(function( cadaU ){
                            programador += `
                            <option value="${cadaU.idcarta}">${cadaU.nombre}</option>
                            `
                        })
                        document.querySelectorAll('select[name=programador]').forEach(function( cadaSelect ){
                            cadaSelect.innerHTML = programador
                        })
                        /* Llenamos el select de modulo */
                        let modulo = '<option></option>'
                        data.frontend.categorias.modulo.forEach(function( cadaU ){
                            modulo += `
                            <option value="${cadaU.idcarta}">${cadaU.nombre}</option>
                            `
                        })
                        document.querySelectorAll('select[name=modulo]').forEach(function( cadaSelect ){
                            cadaSelect.innerHTML = modulo
                        })
                        /* Llenamos el select de tipo error */
                        let tipo_error = '<option></option>'
                        data.frontend.categorias.tipo_error.forEach(function( cadaU ){
                            tipo_error += `
                            <option value="${cadaU.idcarta}">${cadaU.nombre}</option>
                            `
                        })
                        document.querySelectorAll('select[name=tipo_error]').forEach(function( cadaSelect ){
                            cadaSelect.innerHTML = tipo_error
                        })
                    }

                    if(data.frontend.turno.turno == data.frontend.turno.yomismo){
                        document.querySelector('.arenaAtaque').style.display = 'block'
                    }else{
                        document.querySelector('.arenaAtaque').style.display = 'none'
                    }

                    /* 6. Cartas del usuario */
                    if(ventanaEstatica == 0){
                        let arenaCartas = ''
                        arenaCartas += `
                        <div class="col-md-3 col-3">
                            <div class="tarjeta">
                                <img src="assets/img/${data.frontend.cartas.ruta1}" alt="" class="imageT">
                                <h3>${data.frontend.cartas.carta1}</h3>
                            </div>
                        </div>`
                        arenaCartas += `
                        <div class="col-md-3 col-3">
                            <div class="tarjeta">
                                <img src="assets/img/${data.frontend.cartas.ruta2}" alt="" class="imageT">
                                <h3>${data.frontend.cartas.carta2}</h3>
                            </div>
                        </div>`
                        arenaCartas += `
                        <div class="col-md-3 col-3">
                            <div class="tarjeta">
                                <img src="assets/img/${data.frontend.cartas.ruta3}" alt="" class="imageT">
                                <h3>${data.frontend.cartas.carta3}</h3>
                            </div>
                        </div>`
                        arenaCartas += `
                        <div class="col-md-3 col-3">
                            <div class="tarjeta">
                                <img src="assets/img/${data.frontend.cartas.ruta4}" alt="" class="imageT">
                                <h3>${data.frontend.cartas.carta4}</h3>
                            </div>
                        </div>`
                        document.querySelector('.arenaCartas').innerHTML = arenaCartas


                    }
                    ventanaEstatica = 1
                }
                if(data.codigo == 203){ /* Partida finalizada */
                    const salida = `
                        ${data.mensaje}
                        <a href="#" class="reiniciar_partida">Reiniciar partida</a>
                    `;
                    document.querySelector('.arena_pruebas').innerHTML = salida
                    document.querySelector('.reiniciar_partida').addEventListener('click', function( event ){
                        event.preventDefault()
                        reiniciar_partida()
                    })

                }
                const codigos_respuesta = [201] /* Cuando esperamos a que la partida inicie */
                if(codigos_respuesta.includes( data.codigo )){
                    pantalla_inicial = 1
                    document.querySelector('.modEsperando').classList.add("mostrarModal")
                    document.querySelector('.modEsperando .printCodigo').innerHTML = `El código de la partida es: <strong>${data.codigo_partida}</strong>` 
                    document.querySelector('.arena_pruebas').innerHTML = data.mensaje
                    
                }

                /* Cambios de diseño */
                let salidaDiseno = {
                    pantalla_inicial: pantalla_inicial,
                    arena_partidas: arena_partidas,
                };
                estructuraFrontend(salidaDiseno)
            } else {
                throw "Error en consulta AJAX";
            }

        })
        .then(function(texto) {
            //console.log(texto);
        })
        .catch(function(err) {
            console.log(err);
        });
    
}
const Intervalo = setInterval("consultaAPI()", 5000)
consultaAPI()  // Inicializamos la llamada a la función que se va a ejecutar cada 5 segundos


function ingresarNuevoUsuario(datos)
{
    /* Función en JS que permite el acceso a un nuevo usuario 
    (en partida nueva o existente) */
    const nombre = datos.querySelector('input[name=nombre]').value
    const codigo = (datos.querySelector('input[name=codigo]')) ? datos.querySelector('input[name=codigo]').value : undefined

    /* Abrimos la modal */
    document.querySelector('.modEsperando').classList.add("mostrarModal")
    //document.querySelector('.modErrorConexion').classList.remove("mostrarModal")

    /* Construímos el FormData para envío por post */
    const data = new FormData();
    data.append('accion', 'ingresarNuevoUsuario');
    if(!(codigo == undefined)){
        data.append('codigo', codigo);
    }
    data.append('nombre', nombre);

    fetch('api/', {
            method: 'POST',
            body: data
        })
        .then(response => response.json())
        .then(data => {
            if (data) {
                /* Analizamos el regreso de data para saber en qué pantalla estamos */
                return data
                consultaAPI()
            } else {
                throw "Error en consulta AJAX";
            }

        })
        .then(function(texto) {
            console.log(texto);
        })
        .catch(function(err) { /* Capturo el error, si lo hay */
            console.log(err);
        });
}

function acusar_preguntar(datos, metodo)
{
    /* Construimos las variables */
    console.log(datos)
    const programador = datos.querySelector('select[name=programador]').value
    const modulo = datos.querySelector('select[name=modulo]').value
    const tipo_error = datos.querySelector('select[name=tipo_error]').value

    /* Construímos el FormData para envío por post */
    const data = new FormData();
    if(metodo == "acusar"){
        data.append('accion', 'acusarUsuario');
    }
    if(metodo == "preguntar"){
        data.append('accion', 'preguntarCartas');
    }
    data.append('programador', programador);
    data.append('modulo', modulo);
    data.append('tipo_error', tipo_error);

    fetch('api/', {
            method: 'POST',
            body: data
        })
        .then(response => response.json())
        .then(data => {
            if (data) {
                /* Analizamos el regreso de data para saber en qué pantalla estamos */
                //return data
                console.log(data)
                consultaAPI()
            } else {
                throw "Error en consulta AJAX";
            }

        })
        .then(function(texto) {
            console.log(texto);
        })
        .catch(function(err) { /* Capturo el error, si lo hay */
            console.log(err);
        });

}

function reiniciar_partida()
{

    /* Construímos el FormData para envío por post */
    const data = new FormData();
    data.append('accion', 'reiniciarJuego');
    fetch('api/', {
            method: 'POST',
            body: data
        })
        .then(response => response.json())
        .then(data => {
            if (data) {
                consultaAPI()
            } else {
                throw "Error en consulta AJAX";
            }
        })
        .then(function(texto) {
            console.log(texto);
        })
        .catch(function(err) { /* Capturo el error, si lo hay */
            console.log(err);
        });

}

/* Capturamos los formularios de acceso */
document.querySelectorAll('.formAcceso').forEach(function(cadaForm){
    cadaForm.addEventListener('submit', function( event ){
        event.preventDefault()
        /* función JS para crear usuario por AJAX */
        ingresarNuevoUsuario(this)
    })
})

/* Botón de acusación */
document.querySelector('form[name=acusacion]').addEventListener('submit', function( event ){
    event.preventDefault()
    acusar_preguntar(this, 'acusar') /* Mandamos a la función la data del form */
    document.querySelector('.elecc').style.display = 'block'
})

/* Botón de preguntar cartas */
document.querySelector('form[name=preguntar]').addEventListener('submit', function( event ){
    event.preventDefault()
    acusar_preguntar(this, 'preguntar') /* Mandamos a la función la data del form */
    document.querySelector('.elecc').style.display = 'block'
})

document.querySelector('.btnPreguntar').addEventListener('click', function( event ){
    event.preventDefault()
    document.querySelector('.preguntarVentana').classList.add("mostrar");
    document.querySelector('.elecc').style.display = 'none'
})
document.querySelector('.btnAcusar').addEventListener('click', function( event ){
    event.preventDefault()
    document.querySelector('.acusarVentana').classList.add("mostrar");
    document.querySelector('.elecc').style.display = 'none'
})

