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


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encuentra el Bug - Juego realizado en PHP y Javascript</title>
</head>
<body>

<?php
if(isset($_GET["limpiar"]))
{
    unset($_SESSION["codigo"]);
}
?>
<div class="logo">
    <img src="assets/img/logo.png" alt="Logo" style="width:250px; height:90px; object-fit:cover;">
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
        
        }
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

                        // Codigo 100: Mostramos la pantalla inicial
                        if(data.codigo == 100){
                            document.querySelector('.arena_pruebas').innerHTML = 'Mostramos pantalla inicial porque no tiene variable sesión creada'
                            pantalla_inicial = 1
                        }
                        if(data.codigo == 100){
                            document.querySelector('.arena_pruebas').innerHTML = 'Mostramos pantalla inicial porque no tiene variable sesión creada'
                        }
                        const codigos_respuesta = [201, 202, 203] /* Códigos de respuestas de estado de partida */
                        if(codigos_respuesta.includes( data.codigo )){
                            document.querySelector('.arena_pruebas').innerHTML = data.mensaje
                        }

                        /* Cambios de diseño */
                        let salidaDiseno = {
                            pantalla_inicial: pantalla_inicial,
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
    </script>


</body>
</html>