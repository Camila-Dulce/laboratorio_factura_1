<?php
include 'models/Model.php';
include 'models/Contacto.php';
include 'controllers/DataBaseController.php';
include 'controllers/ContactoController.php';

use App\controllers\ContactoController;

$controller = new ContactoController();
$contactos = $controller->read();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Articulos</title>
    <link rel="stylesheet" type="text/css" href="Css/index.css">
</head>
<body>
    <img class="imagen" src="recursos/imagen user.png"> <br>
    <form>
        <div>
            <label class="nombreInput">Usuario</label>
            <input class="contenidoInput" type="text" name="usuario" placeholder="Ingrese su usuario"><br>
        </div>
        <div>
            <label  class="nombreInput">Contraseña</label>
            <input class="contenidoInput" type="text" name="contrasena" placeholder="Ingrese su contraseña">
        </div>
    </form>
</body>

</html>

