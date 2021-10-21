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
        <div>
            <div class="row">
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
                        <form action="" class="form1">
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
            <div class="row">
                <div class="col-md-1 p-0 bA">
                    <i class="fas fa-angle-double-right activo " title="Abrir lista" onclick=""></i>
                    <i class="fas fa-angle-double-left inactivo " title="Cerrar lista" onclick=""></i>
                </div>
                <div class="row flotante2" style="background-color: #d1c5a3">
                    <table class="table table-bordered table-hover table-sm tabla">
                        <th>Cartas</th>
                        <th>Jugador</th>
                        <tr>
                            <td>Pedro</td>
                            <td>Adriana</td>
                        </tr>
                        <tr>
                            <td>Juan</td>
                            <td>Roberto</td>
                        </tr>
                        <tr>
                            <td>Carlos</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Juanita</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Antonio</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Carolina</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Manuel</td>
                            <td></td>
                        </tr>
                        <tr class="table-active">
                            <td>Nomina</td>
                            <td></td>
                        </tr>
                        <tr class="table-active">
                            <td>Facturación</td>
                            <td>Adriana</td>
                        </tr>
                        <tr class="table-active">
                            <td>Recibos</td>
                            <td></td>
                        </tr>
                        <tr class="table-active">
                            <td>Comprobante contable</td>
                            <td>Roberto</td>
                        </tr>
                        <tr class="table-active">
                            <td>Usuarios</td>
                            <td></td>
                        </tr>
                        <tr class="table-active">
                            <td>Contabilidad</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>404</td>
                            <td>Roberto</td>
                        </tr>
                        <tr>
                            <td>Stack Overflow</td>
                            <td>Adriana</td>
                        </tr>
                        <tr>
                            <td>Memory out of range</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Null pointer</td>
                            <td>Adriana</td>
                        </tr>
                        <tr>
                            <td>Syntax error</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Encoding error</td>
                            <td></td>
                        </tr>
                    </table>
                </div>
                <!-- <div class="col-md-8"></div> -->
            </div>
                <!-- fin lista -->
                <!-- Tarjetas -->
                <div class="row margenT">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-3 col-3">
                            <div class="tarjeta">
                                <img src="../img/programadores/Antonio.png" alt="" class="imageT">
                                <h3>Antonio</h3>
                            </div>
                        </div>
                        <div class="col-md-3 col-3">
                            <div class="tarjeta">
                                <img src="../img/programadores/Manuel.png" alt="" class="imageT">
                                <h3>Manuel</h3>
                            </div>
                        </div>
                        <div class="col-md-3 col-3">
                            <div class="tarjeta">
                                <img src="../img/programadores/Carlos.png" alt="" class="imageT">
                                <h3>Carlos</h3>
                            </div>
                        </div>
                        <div class="col-md-3 col-3">
                            <div class="tarjeta">
                                <img src="../img/programadores/Pedro.png" alt="" class="imageT">
                                <h3>Pedro</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin tarjetas -->
                <!-- Instrucciones -->
                <div class="col-md-3 p-0 instru">
                    <i class="fas fa-question activoI " title="Instrucciones" onclick=""></i>
                </div>
                <div id="sobre" class="row sobre">
                <div class="col-md-6 pintar">
                    <div class="row">
                        <div class="col-md-10">
                            <h2 >Instrucciones</h2>
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
                <!-- Fin instrucciones -->
                <!-- Eleccion mi turno -->
                <div id="sobre" class="row sobre">
                    <div class="col-md-6 pintar2">
                        <!-- <div class="row">
                            <div class="col-md-10">
                                <h2 >Haz tu eleccion!</h2>
                            </div>
                            <div class="col-md-2">
                                <i class="far fa-times-circle cerrar"></i>
                            </div>
                        </div> -->
                        <div class="row elecc">
                            <div class="col-md-6 ele1">
                                <h1>Preguntar</h1>
                            </div>
                            <div class="col-md-6 ele2">
                                <h1>Acusar</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin eleccion mi turno -->
                <!-- Hacer pregunta -->
                <div id="sobre" class="row sobre">
                    <div class="col-md-6 pintar2 ele11">
                            
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div>
                                            <label for="Antonio"><img src="../img/programadores/Antonio.png" title="Antonio" class="imagenE activoP" alt=""></label>
                                            <p>Antonio</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <label for="Carlos"><img src="../img/programadores/Carlos.png" title="Carlos" class="imagenE" alt=""></label>
                                            <p>Carlos</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <label for="Carolina"><img src="../img/programadores/Carolina.png" title="Carolina" class="imagenE" alt=""></label>
                                            <p>Carolina</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div>
                                            <label for="Juan"><img src="../img/programadores/Juan.png" title="Juan" class="imagenE" alt=""></label>
                                            <p>Juan</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <label for="Juanita"><img src="../img/programadores/Juanita.png" title="Juanita" class="imagenE" alt=""></label>
                                            <p>Juanita</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <label for="Manuel"><img src="../img/programadores/Manuel.png" title="Manuel" class="imagenE" alt=""></label>
                                            <p>Manuel</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div>
                                            <label for="Pedro"><img src="../img/programadores/Pedro.png" title="Pedro" class="imagenE" alt=""></label>
                                            <p>Pedro</p>
                                        </div>
                                    </div>     
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div>
                                            <label for="comprobante"><img src="../img/modulos/comprobante_contable.png" title="Comprobante contable" class="imagenE" alt=""></label>
                                            <p style="margin-top:7px">comprobante</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <label for="contabilidad"><img src="../img/modulos/contabilidad.png" title="Contabilidad" class="imagenE" alt=""></label>
                                            <p style="font-size:14px;">contabilidad</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <label for="facturacion"><img src="../img/modulos/facturacion.png" title="Facturacion" class="imagenE" alt=""></label>
                                            <p style="margin-top:7px">facturacion</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div>
                                            <label for="nomina"><img src="../img/modulos/nomina.png" title="Nomina" class="imagenE" alt=""></label>
                                            <p>nomina</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <label for="recibo"><img src="../img/modulos/recibo.png" title="Recibo" class="imagenE" alt=""></label>
                                            <p>recibo</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <label for="usuarios"><img src="../img/modulos/usuarios.png" title="Usuarios" class="imagenE" alt=""></label>
                                            <p>usuarios</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                    <div style="opacity:0">
                                            <label for=""><img src="../img/modulos/usuarios.png" title="" class="imagenE" alt=""></label>
                                            <p>usuarios</p>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div>
                                            <label for="ecoding"><img src="../img/errores/ecodingError.png" title="Ecoding Error" class="imagenE" alt=""></label>
                                            <p>ecoding</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <label for="error404"><img src="../img/errores/error404.png" title="Error 404" class="imagenE" alt=""></label>
                                            <p>error404</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <label for="memory"><img src="../img/errores/memoryOutOfRange.png" title="Memory Out Of Range" class="imagenE" alt=""></label>
                                            <p>memory</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div>
                                            <label for="null"><img src="../img/errores/nullPointer.png" title="Null Pointer" class="imagenE" alt=""></label>
                                            <p>null</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <label for="stack"><img src="../img/errores/stackOverflow.png" title="Stack Overflow" class="imagenE" alt=""></label>
                                            <p>stack</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div>
                                            <label for="syntax"><img src="../img/errores/syntaxError.png" title="Syntax Error" class="imagenE" alt=""></label>
                                            <p>syntax</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                    <div style="opacity:0">
                                            <label for=""><img src="../img/modulos/usuarios.png" title="" class="imagenE" alt=""></label>
                                            <p>usuarios</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <label for="submit" class="btn btn-lg btn-success">Aceptar</label>
                            </div>
                    </div>
                </div>                    
                <!-- Fin Hacer pregunta -->
            </div>    
        </div>
    </div>
    </div>
    <!-- Fin de la pagina -->
</body>
</html>