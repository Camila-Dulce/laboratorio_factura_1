<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Cliente</title>
    <link rel="stylesheet" type="text/css" href="actualizarDat.css">

</head>
<body>
    <div class="container">
        <h1>Actualizar Cliente</h1>
        <?php

        use App\controllers\ClienteController;
        use App\controllers\Database;

        // Verificar si se han recibido los datos del formulario de modificación
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verificar si se han recibido los datos necesarios del formulario
            if (isset($_POST['cliente_id']) && !empty($_POST['cliente_id']) &&
                isset($_POST['nombreCompleto']) && !empty($_POST['nombreCompleto']) &&
                isset($_POST['tipoDocumento']) && !empty($_POST['tipoDocumento']) &&
                isset($_POST['numeroDocumento']) && !empty($_POST['numeroDocumento']) &&
                isset($_POST['email']) && !empty($_POST['email']) &&
                isset($_POST['telefono']) && !empty($_POST['telefono'])) {

                // Obtener los datos del formulario
                $cliente_id = $_POST['cliente_id'];
                $nombreCompleto = $_POST['nombreCompleto'];
                $tipoDocumento = $_POST['tipoDocumento'];
                $numeroDocumento = $_POST['numeroDocumento'];
                $email = $_POST['email'];
                $telefono = $_POST['telefono'];

                // Conexión a la base de datos
                require_once '../controllers/dataBaseActualizacion.php';
                require_once '../controllers/clienteActualizacion.php';
                
                $host = 'localhost';
                $user = 'root';
                $pwd = '';
                $datab = 'facturacion_tienda_db';

                $db = new Database($host, $user, $pwd, $datab);
                $db->connect();

                $clienteController = new ClienteController($db);

                // Actualizar la información del cliente en la base de datos
                if ($clienteController->actualizarCliente($cliente_id, $nombreCompleto, $tipoDocumento, $numeroDocumento, $email, $telefono)) {
                    echo "<p class='success'>Cliente actualizado correctamente.</p>";
                } else {
                    echo "<p class='error'>Error al actualizar el cliente.</p>";
                }

                // Cerrar la conexión
                $db->close();
            } else {
                echo "<p class='error'>Todos los campos son requeridos.</p>";
            }
        } else {
            echo "<p class='error'>Acceso no permitido.</p>";
        }

        ?>
         <a class="volver-btn" href="listaClientes.php">Volver</a>
    </div>
</body>
</html>

