<?php
require_once '../controllers/DataBaseController.php';
require_once '../controllers/GenerarFacturaController.php';

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
        <option value="Pagada" <?php if ($estado == 'Pagada') echo 'selected'; ?>>Pagada</option>
        <option value="Cambio" <?php if ($estado == 'Cambio') echo 'selected'; ?>>Cambio</option>
        <option value="Devolución" <?php if ($estado == 'Devolución') echo 'selected'; ?>>Devolución</option>
        <option value="Error" <?php if ($estado == 'Error') echo 'selected'; ?>>Error</option>
    </select>
    <input type="submit" value="Generar Historial" />
</form>

<?php
if ($estado) {
    echo "<h2>Detalle del Historial de Facturas - Estado: " . htmlspecialchars($estado) . "</h2>";

    if (!empty($facturas)) {
        echo "<table border='1'>
                <tr>
                    <th>Referencia</th>
                    <th>Fecha</th>
                    <th>ID Cliente</th>
                    <th>Estado</th>
                    <th>Descuento</th>
                    <th>Acciones</th>
                </tr>";
        foreach ($facturas as $factura) {
            echo "<tr>
                    <td>" . htmlspecialchars($factura['refencia']) . "</td>
                    <td>" . htmlspecialchars($factura['fecha']) . "</td>
                    <td>" . htmlspecialchars($factura['idCliente']) . "</td>
                    <td>" . htmlspecialchars($factura['estado']) . "</td>
                    <td>" . htmlspecialchars($factura['descuento']) . "</td>
                    <td><a href='detalleFactura.php?referencia=" . urlencode($factura['refencia']) . "&idCliente=" . urlencode($factura['idCliente']) . "'>Buscar</a></td>
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













