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
        <div class="row">
            <!-- Inicio del apartado de nuevo juego -->
                <div class="col-5 opcion elements">
                    <h2>Nuevo Juego</h2>
                    <div class="container ab">
                    <div class="row form-group act">
                        <label for="nombre" class="col-12 col-md-4 h3">Nombre</label>
                        <div class="col-12 col-md-8">
                        <form action="">
                            <input  id="nombre" type="text" name="nombre" required class="form-control">
                            <input id="submit1" type="submit" style="display:none">
                        </form>
                    </div>
                        <label for="submit1" class="act container-img">
                            <img src="../img/play.png" class="img" alt="">
                        </label>
                    </div>
                </div>
                </div>
                <!-- fin del apartado de nuevo juego -->
            <!-- Inicio del apartado de unirse a un juego -->
                <div class="col-2"></div>
                <div class="col-5 opcion1 elements">
                <h2>Unirse a partida</h2>
                    <div class="container ab">
                        <div class="row form-group act act2">
                            <label for="nombre2" class="col-12 col-md-4 h3">Nombre</label>
                            <div class="col-12 col-md-8">
                                        <form action="" method="POST">
                                        <input required  id="nombre2" type="text" name="nombre" class="form-control ">
                                    </div>
                                <label for="codigo" class="col-12 col-md-4 h3">Codigo</label>
                                    <div class="col-12 col-md-8"> 
                                        <input required id="codigo" type="text" name="codigo" class="form-control ">
                                    </div>
                                <input id="submit2" type="submit" style="display:none">
                            </form>
                                <label for="submit2" class="act container-img">
                                    <img src="../img/play.png" alt="" class="img">
                                </label>
                        </div>
                     </div>
                    </div>
                </div>
            <!-- fin del apartado de unirse a un juego -->
            <!-- Ventana emergente de cargando -->
            <div id="sobre" class="row sobre">
                <div class="">
                    <h2>Espera mientras te unimos a la partida</h2>
                    <div class="padre">
                    <div class="preloader"></div>
                </div>
            </div>
            <!-- Fin Ventana emergente de cargando -->
            <!-- Ventana emergente de error -->
            <div id="sobre" class="row sobre">
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
    <!-- fin pagina -->
</body>
</html>