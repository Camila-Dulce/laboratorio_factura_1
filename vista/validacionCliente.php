<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Cliente</title>
</head>
<body>
    <?php
     include '../controllers/Database.php';
     include '../controllers/Cliente.php';

     use App\controllers\ClienteController;
    use App\controllers\DatabaseController;


    // Datos de conexión
    $host = 'localhost';
    $user = 'root';
    $pwd = '';
    $datab = 'facturacion_tienda_db';

    // Crear instancia de la clase Database y conectarse a la base de datos
    $db = new Database($host, $user, $pwd, $datab);
    $db->connect();

    // Crear instancia de la clase Cliente
    $cliente = new cliente($db);

    // Recuperar los datos del formulario
    $nombreCompleto = $_POST['nombreCompleto'];
    $tipoDocumento = $_POST['tipoDocumento'];
    $numeroDocumento = $_POST['numeroDocumento'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    // Verificar si el cliente ya está registrado
    if ($cliente->verificarCliente($numeroDocumento)) {
        echo 'El cliente ya está registrado en la base de datos. <a href="../vista/pestañaFactura.php">crear factur</a>';
    } else {
        // Registrar al cliente
        if ($cliente->registrarCliente($nombreCompleto, $tipoDocumento, $numeroDocumento, $email, $telefono)) {
            echo 'Cliente registrado exitosamente. <a href="../vista/pestañaFactura.php">Crear factura</a>';
        } else {
            echo 'Error al registrar el cliente. <a href="../vista/pestañaCliente.php">Volver a intentar</a>';
        }
    }

    // Cerrar la conexión
    $db->close();
    ?>
    <br>
</body>
</html>


