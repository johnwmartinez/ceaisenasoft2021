<?php
include_once("lib/funciones.php");
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

    <div class="contenedor">
        <form action="#" method="POST" enctype="multipart/form-data">

            <div>
                <input type="text">
            </div>

        </form>
    </div>

    <script>
        function hola() {

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
                        throw "Error en la llamada Ajax";
                    }

                })
                .then(function(texto) {
                    console.log(texto);
                })
                .catch(function(err) {
                    console.log(err);
                });
        }
        const Intervalo = setInterval("hola()", 5000)
    </script>


<?php
echo 
?>
</body>
</html>