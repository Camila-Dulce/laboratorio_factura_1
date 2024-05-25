<?php

require_once '../controllers/DataBaseController.php';
require_once '../controllers/HistorialController.php';

use App\controllers\GenerarFacturaController;

// Inicializar variables
$estado = isset($_GET['estado']) ? $_GET['estado'] : '';
$facturas = [];

if ($estado) {
    $facturaController = new GenerarFacturaController();
    $facturas = $facturaController->getFacturasByEstado($estado);
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial</title>
    <link rel="stylesheet" type="text/css" href="historialFac.css">
</head>
<body>
<h1>Historial de Facturas</h1>
<form action="historialFacturas.php" method="GET">
    <label for="estado">Seleccione el estado de la factura a consultar: </label>
    <select name="estado" id="estado">
        <option value="pagada" <?php if ($estado == 'pagada') echo 'selected'; ?>>Pagada</option>
        <option value="cambio" <?php if ($estado == 'cambio') echo 'selected'; ?>>Cambio</option>
        <option value="devolucion" <?php if ($estado == 'devolucion') echo 'selected'; ?>>Devolución</option>
        <option value="error" <?php if ($estado == 'error') echo 'selected'; ?>>Error</option>
    </select>
    <input type="submit" value="Generar Historial" />
</form>

<?php
if ($estado) {
    echo "<h2>Detalle del Historial de Facturas - Estado: " . $estado . "</h2>";

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
                    <td>" . $factura['refencia'] . "</td>
                    <td>" . $factura['fecha'] . "</td>
                    <td>" . $factura['idCliente'] . "</td>
                    <td>" . $factura['estado'] . "</td>
                    <td>" . $factura['descuento'] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No se encontraron facturas con el estado seleccionado.</p>";
    }
}
?>
<br>
    <a class="volver-btn" href="pestañaFactura.php">Volver</a>
</body>
</html>








