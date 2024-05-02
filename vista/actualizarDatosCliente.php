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
            echo "Cliente actualizado correctamente.";
        } else {
            echo "Error al actualizar el cliente.";
        }

        // Cerrar la conexión
        $db->close();
    } else {
        echo "Todos los campos son requeridos.";
    }
} else {
    echo "Acceso no permitido.";
}
?>
<br>
<a href="listaClientes.php">Volver</a>

