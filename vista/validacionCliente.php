<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="styleSheet" href="comun.css">
    <title>Registro de Cliente</title>
</head>
<body>
    <?php
    require_once '../controllers/DataBaseController.php';
    require_once '../controllers/ClienteController.php';

    use App\controllers\ClienteController;
    use App\controllers\DataBaseController;

    // Crear instancia de la clase ClienteController
    $clienteController = new ClienteController();

    // Recuperar los datos del formulario
    $nombreCompleto = $_POST['nombreCompleto'];
    $tipoDocumento = $_POST['tipoDocumento'];
    $numeroDocumento = $_POST['numeroDocumento'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    // Verificar si el cliente ya está registrado
    if ($clienteController->verificarCliente($numeroDocumento)) {
        echo 'El cliente ya está registrado en la base de datos. <a href="../vista/pestañaFactura.php">Crear factura</a>';
    } else {
        // Registrar al cliente
        if ($clienteController->registrarCliente($nombreCompleto, $tipoDocumento, $numeroDocumento, $email, $telefono)) {
            echo 'Cliente registrado exitosamente. <a href="../vista/pestañaFactura.php">Crear factura</a>';
        } else {
            echo 'Error al registrar el cliente. <a href="../vista/pestañaCliente.php">Volver a intentar</a>';
        }
    }
    ?>
    <br>
</body>
</html>


