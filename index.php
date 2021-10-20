<?php
require_once 'vendor/autoload.php';
require_once('lib/db.php');
require_once("lib/funciones.php");
require_once("lib/config.php");

require_once("Modelos/Jugadores.php");
require_once("Controladores/JugadoresControlador.php");
require_once("Modelos/Partidas.php");
require_once("Controladores/PartidasControlador.php");


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
if(isset($_POST["nombre"]))
{

}
?>
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

    <script>
        function consultaAPI() {

            const data = new FormData();
            data.append('accion', 'SENASOFT');
            data.append('idPrueba', 'SENASOFT');

            fetch('api/', {
                    method: 'POST',
                    body: data
                })
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        return data[0]["nombre"]
                    } else {
                        throw "Error en consulta AJAX";
                    }

                })
                .then(function(texto) {
                    console.log(texto);
                })
                .catch(function(err) {
                    console.log(err);
                });
        }
        //const Intervalo = setInterval("consultaAPI()", 5000)
        //consultaAPI()

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
                        return data
                    } else {
                        throw "Error en consulta AJAX";
                    }

                })
                .then(function(texto) {
                    console.log(texto);
                })
                .catch(function(err) {
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