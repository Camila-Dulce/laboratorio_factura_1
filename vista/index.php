<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Articulos</title>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
    <img class="imagen" src="https://cdn-icons-png.flaticon.com/512/6073/6073873.png"> <br>
    <form action="validacionUser.php" method="POST">
        <h1>Bienvenido</h1>
        <div>
        <label class="contenidoInput" for="usuario">Usuario:</label>
        <input class="nombreInput" type="text" id="usuario" name="usuario" placeholder="Ingrese su usuario">

        </div>
        <div>
            <label class="contenidoInput" for="password">Contraseña: </label>
            <input class="nombreInput" type="password" id="password" name="password" placeholder="Ingrese su contraseña">
        </div>
        <div>
            <input class="btnfos botonIngresar" type="submit" value="Ingresar">
        </div>
    </form>
</body>
</html>