<?php
require_once 'vendor/autoload.php';
require_once('lib/db.php');
require_once("lib/funciones.php");
require_once("lib/config.php");

require_once("Modelos/Jugadores.php");
require_once("Controladores/JugadoresControlador.php");

require_once("Modelos/Partidas.php");
require_once("Controladores/PartidasControlador.php");

require_once("Modelos/Cartas.php");
require_once("Controladores/CartasControlador.php");

require_once("Modelos/PartidaSecreto.php");
require_once("Controladores/PartidaSecretoControlador.php");

require_once("Modelos/PartidaJugadorCartas.php");
require_once("Controladores/PartidaJugadorCartasControlador.php");

require_once("Modelos/PartidaJugadorTabla.php");
require_once("Controladores/PartidaJugadorTablaControlador.php");

require_once("Modelos/PartidasPreguntas.php");
require_once("Controladores/PartidasPreguntasControlador.php");


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuentra el Bug - Juego realizado en PHP y Javascript</title>
    <style>
        h1, h2, h3, h4, h5
        {
            margin:0 auto;
            margin-bottom:10px;
        }
        .arenaPartida > div
        {
            background:#eee;
            margin-bottom:10px;
            padding:10px;
        }
    </style>
</head>
<body>

<?php
if(isset($_GET["limpiar"]))
{
    unset($_SESSION["codigo"]);
}
?>
<div class="logo">
    <img src="assets/img/logo.png" alt="Logo" style="width:250px; height:90px; object-fit:cover;"><br />
    <?php echo time(); ?>
</div>

    <div class="creacionPartidas">

        <div class="contenedor" style="background:#eee;">
            <?php
            // if(!isset($_SESSION["codigo"]))
            
                ?>
            <form action="#" method="POST" enctype="multipart/form-data" class="formAcceso">
                <h2>Crear nueva partida</h2>
                <div>
                    <input type="text" name="nombre" value="" placeholder="Nombre del usuario" required>
                </div>
                <div>
                    <input type="submit" value="Enviar">
                </div>
    
            </form>
                <?php
           
            ?>
        </div>
    
        <div class="contenedor" style="background:#ddd;">
            <form action="#" method="POST" enctype="multipart/form-data" class="formAcceso">
                <h2>Ingresar a partida</h2>
                <div>
                    <input type="text" name="codigo" value="" maxlength="5" placeholder="Código de partida" pattern="^[A-Fa-f0-9]+$" required>
                </div>
                <div>
                    <input type="text" name="nombre" value="" placeholder="Nombre del usuario" required>
                </div>
                <div>
                    <input type="submit" value="Enviar">
                </div>
    
            </form>
        </div>
    </div>

    <div class="arenaPartida">
        <div class="arenajugadores">
        </div>
        <div class="arenaTurno">
        </div>
        <div class="arenaPreguntaJugador">
        </div>
        <div class="arenaTabla">
        </div>
        <div class="arenaAtaque">
            <div class="arenaAcusacion" style="margin-bottom:20px;">
                <form action="#" name="acusacion">
                    <div>
                        <select name="programador" id="programador" required></select>
                    </div>
                    <div>
                        <select name="modulo" id="modulo" required></select>
                    </div>
                    <div>
                        <select name="tipo_error" id="tipo_error" required></select>
                    </div>
                    <div>
                        <input type="submit" value="Acusar!">
                    </div>
                </form>
            </div>
            <div class="arenaPreguntaIndividual">
                <form action="#" name="preguntar">
                    <div>
                        <select name="programador" id="programador2"></select>
                    </div>
                    <div>
                        <select name="modulo" id="modulo2"></select>
                    </div>
                    <div>
                        <select name="tipo_error" id="tipo_error2"></select>
                    </div>
                    <div>
                        <input type="submit" value="Preguntar?">
                    </div>
                </form>
            </div>
        </div>
        <div class="arenaCartas">
        </div>
        <div class="arenaAyudas">
            <button class="btnAyuda">Boton Ayuda</button>
        </div>
    </div>

    <div class="arena_pruebas">
        Aquí vamos a imprimir como van las pruebas de mi aplicativo
    </div>

    <script>
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
                            document.querySelector('.arena_pruebas').innerHTML = 'Mostramos pantalla inicial porque no tiene variable sesión creada'
                            pantalla_inicial = 1
                        }
                        if(data.codigo == 202){ /* Partida en progreso */
                            document.querySelector('.arena_pruebas').innerHTML = data.mensaje
                            arena_partidas = 1
                            /* Armamos el Frontend */
                            /* 1. Jugadores */
                            let arenaJugadores = '<h3>Contrincantes: </h3>'
                            data.frontend.contrincantes.forEach(function( cadaU ){
                                arenaJugadores += `<div class="jugadorIndv">${cadaU.nombre}</div>`
                            })
                            document.querySelector('.arenajugadores').innerHTML = arenaJugadores

                            /* 2. Turno */
                            let arenaTurno = '<h3>Turno de: </h3>'
                            arenaTurno += `<div class="jugadorIndv">${data.frontend.turno.nombre}</div>`
                            document.querySelector('.arenaTurno').innerHTML = arenaTurno
                            
                            /* 3. Última pregunta de un jugador */
                            let arenaPreguntaJugador = '<h3>Pregunta: </h3>';
                            if(data.frontend.preguntas[0] == 0){
                                arenaPreguntaJugador = `</div>`
                            }else{
                                
                                arenaPreguntaJugador += `<div class="jugadorIndv">${data.frontend.preguntas.nombre} preguntó por las cartas ${data.frontend.preguntas.carta_1}, ${data.frontend.preguntas.carta_2} y ${data.frontend.preguntas.carta_3}</div>`
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
                            /* 6. Cartas del usuario */
                            if(ventanaEstatica == 0){
                                let arenaCartas = '<h3>Cartas jugador: </h3>'
                                arenaCartas += `<div class="carta-${data.frontend.cartas.idcarta1}">${data.frontend.cartas.carta1}</div>`
                                arenaCartas += `<div class="carta-${data.frontend.cartas.idcarta2}">${data.frontend.cartas.carta2}</div>`
                                arenaCartas += `<div class="carta-${data.frontend.cartas.idcarta3}">${data.frontend.cartas.carta3}</div>`
                                arenaCartas += `<div class="carta-${data.frontend.cartas.idcarta4}">${data.frontend.cartas.carta4}</div>`
                                document.querySelector('.arenaCartas').innerHTML = arenaCartas
                            }
                            
                        }
                        const codigos_respuesta = [201, 203] /* Códigos de respuestas de estado de partida */
                        if(codigos_respuesta.includes( data.codigo )){
                            document.querySelector('.arena_pruebas').innerHTML = data.mensaje
                        }

                        /* Cambios de diseño */
                        let salidaDiseno = {
                            pantalla_inicial: pantalla_inicial,
                            arena_partidas: arena_partidas,
                        };
                        estructuraFrontend(salidaDiseno)
                        ventanaEstatica = 1
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

        function acusar(datos)
        {
            /* Construimos las variables */
            console.log(datos)
            const programador = datos.querySelector('select[name=programador]').value
            const modulo = datos.querySelector('select[name=modulo]').value
            const tipo_error = datos.querySelector('select[name=tipo_error]').value

            /* Construímos el FormData para envío por post */
            const data = new FormData();
            data.append('accion', 'acusarUsuario');
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
            acusar(this) /* Mandamos a la función la data del form */
        })
    </script>


</body>
</html>