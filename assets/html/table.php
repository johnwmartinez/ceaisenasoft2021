<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindBug</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"/>
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Inicio de la pagina -->
    <div class="container contenedor">
        <div class="row contenido">
            <!-- Jugadores -->
            <div class="col-md-3 padreJ">
                <div class="jugador">
                    <div class="foto" style="background-color:orange"></div>
                    <div class="" style="color:orange">Juan</div>
                </div>
                <div class="jugador">
                    <div class="foto" style="background-color:#207633"></div>
                    <div class="" style="color:#207633">Roberto</div>
                </div>
                <div class="jugador">
                    <div class="foto" style="background-color:#a32983"></div>
                    <div class="" style="color:#a32983">Adriana</div>
                </div>
            </div>
            <!-- Fin jugadores -->
            <!-- Turnos -->
            <div class="col-md-3 turno">
                <h2>Turno de: Juan</h2>
            </div>
            <!-- Fin Turnos -->
            <!-- Ultima pregunta -->
                <div class="col-md-6 pregunta">
                    <div class="h2">
                        <h2>Ultima pregunta:</h2>
                        <h2>¿Pedro en el modulo nomina error 404?</h2>
                    </div>
                </div>
            <!-- Fin Ultima pregunta -->
            <!--lista -->
            <div class="col-md-3 p-0" style="background-color: #d1c5a3">
                <i class="fas fa-angle-double-right actiL" onclick=""></i>

            </div>
            <!-- lista -->
        </div>
    </div>
    <!-- Fin de la pagina -->
</body>
</html>