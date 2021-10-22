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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
    <link href="assets/css/style.css" rel="stylesheet">

    <style>
        h1,
        h2,
        h3,
        h4,
        h5 {
            margin: 0 auto;
            margin-bottom: 10px;
        }

        .arenaPartida>div {
            background: #eee;
            margin-bottom: 10px;
            padding: 10px;
        }

        .modErrorConexion {
            display: none;
        }

        .modEsperando {
            display: none;
        }

        .mostrarModal {
            display: block;
        }

        .printCodigo {
            text-align: center;
        }

        .jugador:nth-child(1) .foto{ background-color:orange; }
        .jugador:nth-child(2) .foto{ background-color:#207633; }
        .jugador:nth-child(3) .foto{ background-color:#a32983; }
        


    </style>
</head>

<body>

    <?php
    if (isset($_GET["limpiar"])) {
        unset($_SESSION["codigo"]);
    }
    ?>
    <div class="logo">
        <img src="assets/img/logo.png" alt="Logo" style="width:250px; height:90px; object-fit:cover;"><br />

    </div>

    <div class="creacionPartidas">

        <!-- Inicia formularios acceso -->
        <div class="container contenedor">
            <div class="row">
                <!-- Inicio del apartado de nuevo juego -->
                <div class="col-5 opcion elements">
                    <h2>Nuevo Juego</h2>
                    <div class="container ab">
                        <div class="row form-group act">
                            <label for="nombre" class="col-12 col-md-4 h3">Nombre</label>
                            <div class="col-12 col-md-8">
                                <form action="#" method="POST" enctype="multipart/form-data" class="formAcceso">
                                    <div>
                                        <input type="text" name="nombre" value="" placeholder="Nombre del usuario" required>
                                    </div>
                                    <div>
                                        <label for="submit1" class="act container-img">
                                            <img src="assets/img/play.png" class="img" alt="">
                                        </label>
                                        <input id="submit1" type="submit" value="Enviar" style="visibility:hidden;">
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fin del apartado de nuevo juego -->
                <!-- Inicio del apartado de unirse a un juego -->
                <div class="col-2"></div>
                <div class="col-5 opcion1 elements">
                    <h2>Unirse a partida</h2>
                    <div class="container ab">


                        <form action="#" method="POST" enctype="multipart/form-data" class="formAcceso">

                            <div class="row form-group act act2">
                                <label for="nombre2" class="col-12 col-md-4 h3">Nombre</label>
                                <div class="col-12 col-md-8">
                                    <input type="text" id="nombre2" name="nombre" value="" placeholder="Nombre del usuario" class="form-control" required>
                                </div>
                                <label for="codigo" class="col-12 col-md-4 h3">Codigo</label>
                                <div class="col-12 col-md-8">
                                    <input type="text" id="codigo" name="codigo" value="" maxlength="5" placeholder="Código de partida" pattern="^[A-Fa-f0-9]+$" class="form-control" required>
                                </div>

                                <input id="submit2" type="submit" style="display:none">
                                <label for="submit2" class="act container-img">
                                    <img src="assets/img/play.png" alt="" class="img">
                                </label>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
            <!-- fin del apartado de unirse a un juego -->
            <!-- Ventana emergente de cargando -->

            <div id="sobre1" class="row sobreIND modEsperando">
                <div class="">
                    <h2>Esperando otros jugadores</h2>
                    <div class="printCodigo">
                        Cargando, por favor espere...
                    </div>
                    <div class="padre">
                        <div class="preloader"></div>
                    </div>
                </div>
                <!-- Fin Ventana emergente de cargando -->
                <!-- Ventana emergente de error -->
                <div id="sobre2" class="row sobreIND modErrorConexion">
                    <div class="">
                        <h2>No se ha podido conectar con la partida</h2>
                        <div class="padre">
                            <div class="animate__animated animate__flipInX errorX"><i class="fas fa-times" style="font-size:100px"></i></div>
                        </div>
                    </div>
                    <!-- Fin Ventana emergente de error -->

                </div>
            </div>
        </div>
        <!-- Termina formularios acceso -->


    </div>

    <div class="arenaPartida">


        <!-- Inician estilo de Arena Partida -->


        <div class="container contenedor">
            <div class="row contenido">
                <div>
                    <div class="row">
                        <!-- Jugadores -->
                        <div class="col-md-3">
                            <div class="arenajugadores">
                            </div> 
                        </div>
                        <!-- Fin jugadores -->
                        <!-- Turnos -->
                        <div class="col-md-3 turno">
                            <h3><span class="arenaTurno"></span></h3>


                            <!-- PILAS PILAS PILAS -->
                            <form action="" class="form1 formPreguntar">
                                <input name="programadores" type="radio" id="Antonio">
                                <input name="programadores" type="radio" id="Carlos">
                                <input name="programadores" type="radio" id="Carolina">
                                <input name="programadores" type="radio" id="Juan">
                                <input name="programadores" type="radio" id="Juanita">
                                <input name="programadores" type="radio" id="Manuel">
                                <input name="programadores" type="radio" id="Pedro">
                                <input name="modulos" type="radio" id="comprobante">
                                <input name="modulos" type="radio" id="contabilidad">
                                <input name="modulos" type="radio" id="facturacion">
                                <input name="modulos" type="radio" id="nomina">
                                <input name="modulos" type="radio" id="recibo">
                                <input name="modulos" type="radio" id="usuarios">
                                <input name="errores" type="radio" id="ecoding">
                                <input name="errores" type="radio" id="error404">
                                <input name="errores" type="radio" id="memory">
                                <input name="errores" type="radio" id="null">
                                <input name="errores" type="radio" id="stack">
                                <input name="errores" type="radio" id="syntax">
                                <input type="submit" id="submit">

                            </form>
                            <form action="" class="form1 formAcusar">
                                <input name="programadores" type="radio" id="AntonioA">
                                <input name="programadores" type="radio" id="CarlosA">
                                <input name="programadores" type="radio" id="CarolinaA">
                                <input name="programadores" type="radio" id="JuanA">
                                <input name="programadores" type="radio" id="JuanitaA">
                                <input name="programadores" type="radio" id="ManuelA">
                                <input name="programadores" type="radio" id="PedroA">
                                <input name="modulos" type="radio" id="comprobanteA">
                                <input name="modulos" type="radio" id="contabilidadA">
                                <input name="modulos" type="radio" id="facturacionA">
                                <input name="modulos" type="radio" id="nominaA">
                                <input name="modulos" type="radio" id="reciboA">
                                <input name="modulos" type="radio" id="usuariosA">
                                <input name="errores" type="radio" id="ecodingA">
                                <input name="errores" type="radio" id="error404A">
                                <input name="errores" type="radio" id="memoryA">
                                <input name="errores" type="radio" id="nullA">
                                <input name="errores" type="radio" id="stackA">
                                <input name="errores" type="radio" id="syntaxA">
                                <input type="submit" id="submitA">

                            </form>
                        </div>
                        <!-- Fin Turnos -->
                        <!-- Ultima pregunta -->
                        <div class="col-md-6 arenaPreguntaJugador"> 
                        </div>

                    </div>
                    <!-- Fin Ultima pregunta -->


                    <!--lista -->
                    <div class="row">

                        <div class="col-md-4" style="background-color: #d1c5a3">
                            <div class="arenaTabla"></div>
                        </div>

                        <div class="col-md-8">
                            <!-- Eleccion preguntar acusar -->
                            <div class="arenaAtaque">

                                <div class="row elecc">
                                    <div class="col-md-6 ele1">
                                        <h1><a href="#" class="btnPreguntar">Preguntar</a></h1>
                                    </div>
                                    <div class="col-md-6 ele2">
                                        <h1><a href="#" class="btnAcusar">Acusar</a></h1>
                                    </div>
                                </div>
                                <!-- Fin eleccion preguntar acusar -->
                                <!-- Opcion preguntar -->
                                <div class="row pt-3 preguntarVentana" style="background-color: #49618f">
                                    <div id="sobre" class="sobre">
                                        <div class="col pintar2 ele11">
                                            <div class="row">
                                                <div class="col-md-12 headerP">
                                                    <h2>Haz tu Pregunta!</h2>
                                                </div>
                                            </div>
                                            <div class="row fotosElec table-responsive">
    
                                                <div class="salidaPreguntas">
                                                
                                                    <div class="arenaPreguntaIndividual">
                                                        <form action="#" name="preguntar">
                                                            <div>
                                                                <select name="programador" id="programador2" required></select>
                                                            </div>
                                                            <div>
                                                                <select name="modulo" id="modulo2" required></select>
                                                            </div>
                                                            <div>
                                                                <select name="tipo_error" id="tipo_error2" required></select>
                                                            </div>
                                                            <div>
                                                                <input type="submit" value="Preguntar?">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>   
    
                                                <div class="d-grid gap-2">
                                                    <label for="submit" class="btn btn-lg btn-success">Aceptar</label>
                                                </div>
    
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Fin opcion preguntar -->
                                <!-- Opcion acusar -->
                                <div class="row pt-3 acusarVentana" style="background-color: #49618f">
                                    <div id="sobre" class="sobre">
                                        <div class="col pintar2 ele11">
                                            <div class="row">
                                                <div class="col-md-12 headerA">
                                                    <h2>Haz tu acusación!</h2>
                                                </div>
                                            </div>
                                            <div class="row fotosElec table-responsive">
    
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
    
    
                                                <div class="d-grid gap-2">
                                                    <label for="submitA" class="btn btn-lg btn-success">Aceptar</label>
                                                </div>
    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <!-- fin opcion acusar -->
                            <!-- mis tarjetas -->
                            <div class="row arenaCartas" style="background-color:#407671">
                            </div>
                            <!--Fin mis tarjetas  -->
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6 pintar">
                <div class="row">
                    <div class="col-md-10">
                        <h2>Instrucciones</h2>
                    </div>
                    <div class="col-md-2">
                        <i class="far fa-times-circle cerrar"></i>
                    </div>
                </div>
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="padin">
                                <h3>El sistema selecciona aleatoriamente un programador, un módulo del sistema y un tipo de error, estos se dejan de manera secreta en el juego, dichas cartas son las que debemos adivinar dentro del desarrollo del juego. Una vez conectados todos los jugadores, el sistema revuelve (baraja), aleatoriamente los 3 tipos de cartas y las reparte equitativamente a los jugadores (4 para cada uno), el juego inicia con la persona que creó el juego y los turnos van en el orden de las conexiones de los demás jugadores.</h3>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="padin">
                                <h3>En tu turno puedes:</h3>
                                <h3>-Hacer una pregunta, sospechando de un programador, un modulo y el error que generó el problema en el sistema. Si los jugadores tienen alguna de las cartas sobre las que has preguntado, debe enseñarte una de ellas en secreto. ¡Nunca te deben enseñar más de una carta!, si no tiene ninguna de las cartas sobre las que has preguntado, simplemente dirá: “No puedo contestar”</h3>
                                <h3>-Hacer una acusación, seleccionando un programador, un módulo y un error. Si tu acusación es correcta, serás el ganador del juego, pero si no es cierta, simplemente vas a perder el turno</h3>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="padin">
                                <h3>En la hoja de notas el sistema va registrando los datos de las cartas que puede determinar qué tiene otro jugador, para posteriormente poder hacer una acusación</h3>
                                <h3>La hoja de notas te va a ayudar a tener mas certeza a la hora de hacer una acusación, dado que vas descartando las cartas que tienen los otros jugadores.</h3>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>




        <!-- Termina estilo de Arena Partida -->





        

        <div class="arenaAyudas">
            <button class="btnAyuda">Boton Ayuda</button>
        </div>
    </div>

    <div class="arena_pruebas">
    </div>
    <script src="assets/js/processing.js"></script>

</body>

</html>