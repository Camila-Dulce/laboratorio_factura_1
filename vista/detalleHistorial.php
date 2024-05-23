<?php

require_once '../controllers/DataBaseController.php';
require_once '../controllers/HistorialController.php';

use App\controllers\GenerarFacturaController;

// Obtener el estado seleccionado del formulario
$estado = isset($_GET['estado']) ? $_GET['estado'] : '';

$facturaController = new GenerarFacturaController();
$facturas = $facturaController->getFacturasByEstado($estado);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Historial</title>
</head>
<body>
<h1>Detalle del Historial de Facturas - Estado: <?php echo htmlspecialchars($estado); ?></h1>
<?php
if (!empty($facturas)) {
    echo "<table border='1'>
            <tr>
                <th>Referencia</th>
                <th>Fecha</th>
                <th>ID Cliente</th>
                <th>Estado</th>
                <th>Descuento</th>
            </tr>";
    foreach ($facturas as $factura) {
        echo "<tr>
                <td>" . htmlspecialchars($factura['referencia']) . "</td>
                <td>" . htmlspecialchars($factura['fecha']) . "</td>
                <td>" . htmlspecialchars($factura['idCliente']) . "</td>
                <td>" . htmlspecialchars($factura['estado']) . "</td>
                <td>" . htmlspecialchars($factura['descuento']) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No se encontraron facturas con el estado seleccionado.</p>";
}
?>
</body>
</html>


