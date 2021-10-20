<?php
require_once 'vendor/autoload.php';
require_once('lib/db.php');
require_once("lib/funciones.php");
require_once("lib/config.php");

require_once("Modelos/Participantes.php");
require_once("Controladores/ParticipantesControlador.php");
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
if(isset($_POST["nombre"]))
{
    $partida = new Partidas();
    $partida->crearPartida();
    $jugadores = new Participantes();
    $jugadores->crearParticipante($_POST["nombre"]);
}
?>
    <div class="contenedor">
        <?php
        if(!isset($_SESSION["codigo"]))
        {
            ?>
        <form action="#" method="POST" enctype="multipart/form-data">

            <div>
                <input type="text" name="nombre" value="" placeholder="Nombre del usuario">
            </div>
            <div>
                <input type="submit" value="Enviar">
            </div>

        </form>
            <?php
        }else{
            var_dump($_SESSION["codigo"]);
        }
        ?>
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
        const Intervalo = setInterval("consultaAPI()", 5000)
    </script>


</body>
</html>