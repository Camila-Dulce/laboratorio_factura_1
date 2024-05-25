<?php

require_once '../controllers/FacturaController.php';
require_once '../controllers/DataBaseController.php'; 

use App\controllers\FacturaController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $refencia = $_POST['referencia'];
    $nuevoEstado = $_POST['nuevoEstado'];
    
    $facturaController = new FacturaController();

    if ($facturaController->actualizarEstadoFactura($refencia, $nuevoEstado)) {
        echo 'Estado de la factura actualizado exitosamente. Deseas ver todas las facturas de estado pagadas <a href=".php">Volver</a>';
    } else {
        echo 'Error al actualizar el estado de la factura. <a href="detalleFactura.php">Volver</a>';
    }
} else {
    echo 'Método de solicitud no válido. <a href="detalleFactura.php">Volver</a>';
}
?>
