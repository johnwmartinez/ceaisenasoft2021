<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindBug</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container contenedor">
        <div class="row">
                <div class="col-5 opcion">
                    <h2>Nuevo Juego</h2>
                    <div class="container">
                    <div class="row form-group act">
                        <label for="nombre" class="col-12 col-md-4 h3">Nombre</label>
                        <div class="col-12 col-md-8">
                        <form action="">
                            <input  id="nombre" type="text" name="nombre" class="form-control">
                            <input id="submit1" type="submit" style="display:none">
                        </form>
                        <label for="submit1" class="act">
                            <img src="../img/play.png" alt="">
                        </label>
                        </div>
                    </div>
                </div>
                </div>
                <div class="col-2"></div>
                <div class="col-5 opcion1">
                <h2>Unirse a partida</h2>
                    <div class="container">
                        <div class="row form-group act">
                            <form action="">
                                <label for="nombre2" class="col-12 col-md-4 h3">Nombre</label>
                                    <div class="col-12 col-md-8">
                                        <input  id="nombre2" type="text" name="nombre" class="form-control">
                                    </div>
                                <label for="codigo" class="col-12 col-md-4 h3">Codigo</label>
                                    <div class="col-12 col-md-8"> 
                                        <input  id="codigo" type="text" name="codigo" class="form-control">
                                    </div>
                                <input id="submit2" type="submit" style="display:none">
                            </form>
                                <label for="submit2" class="act">
                                    <img src="../img/play.png" alt="">
                                </label>
                        </div>
                     </div>
                    </div>
                </div>
            </div>
    </div>
</body>
</html>