<?php
// Incluir archivos necesarios
require_once '../controllers/dataBaseActualizacion.php';
require_once '../controllers/clienteActualizacion.php';

use App\controllers\ClienteController;
use App\controllers\Database;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="styleSheet" href="comun.css">
    <title>Modificar Cliente</title>
</head>
<body>
    <h1>Modificar Información del Cliente</h1>

    <?php
    // Verificar si se ha proporcionado un ID de cliente válido en la URL
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $cliente_id = $_GET['id'];

        // Conexión a la base de datos
        $host = 'localhost';
        $user = 'root';
        $pwd = '';
        $datab = 'facturacion_tienda_db';

        $db = new Database($host, $user, $pwd, $datab);
        $db->connect();

        $clienteController = new ClienteController($db);

        // Obtener la información del cliente con el ID proporcionado
        $cliente = $clienteController->getClienteById($cliente_id);

        if ($cliente) {
            // Mostrar el formulario con la información actual del cliente y poder modificar
    ?>
            <form action="actualizarDatosCliente.php" method="post">
                <input type="hidden" name="cliente_id" value="<?php echo $cliente['id']; ?>">

                <label for="nombreCompleto">Nombre Completo:</label>
                <input type="text" name="nombreCompleto" value="<?php echo $cliente['nombreCompleto']; ?>" required>
                <br>

                <label for="tipoDocumento">Tipo Documento:</label>
                <input type="text" name="tipoDocumento" value="<?php echo $cliente['tipoDocumento']; ?>" required>
                <br>

                <label for="numeroDocumento">Número Documento:</label>
                <input type="text" name="numeroDocumento" value="<?php echo $cliente['numeroDocumento']; ?>" required>
                <br>

                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo $cliente['email']; ?>" required>
                <br>

                <label for="telefono">Teléfono:</label>
                <input type="tel" name="telefono" value="<?php echo $cliente['telefono']; ?>" required>
                <br>

                <input type="submit" value="Actualizar">
            </form>
    <?php
        } else {
            echo "Cliente no encontrado.";
        }
    } else {
        echo "ID de cliente no proporcionado.";
    }
    ?>

    <br>
    <a href="listaClientes.php">Volver</a>
</body>
</html>
