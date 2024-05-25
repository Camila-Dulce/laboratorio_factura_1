<?php
require_once '../controllers/DataBaseController.php';
require_once '../controllers/GenerarFacturaController.php';

use App\controllers\GenerarFacturaController;
use App\controllers\DataBaseController;

// Obtener los valores enviados desde el formulario
$referencia = isset($_GET['referencia']) ? $_GET['referencia'] : null;
$idCliente = isset($_GET['idCliente']) ? $_GET['idCliente'] : null;

if ($referencia === null || $idCliente === null) {
    die("Error: Referencia o ID de cliente no proporcionados.");
}

$facturaController = new GenerarFacturaController();
$facturaData = $facturaController->getFacturaData($idCliente, $referencia);

if (!$facturaData) {
    die("Error: No se encontraron datos de la factura.");
}

$factura = $facturaData['factura'];
$detalles = $facturaData['detalles'];
$cliente = $facturaData['cliente'];

$subtotal = 0;

// Calcular el subtotal
while ($detalle = $detalles->fetch_assoc()) {
    $valor = $detalle['cantidad'] * $detalle['precioUnitario'];
    $subtotal += $valor;
}

// Calcular el descuento basado en el subtotal
$descuento = 0;
$porcentajeDescuento = 0;

if ($subtotal > 650000) {
    $porcentajeDescuento = 8;
} elseif ($subtotal > 200000) {
    $porcentajeDescuento = 4;
} elseif ($subtotal > 100000) {
    $porcentajeDescuento = 2;
}

$descuento = ($subtotal * $porcentajeDescuento) / 100;
$total = $subtotal - $descuento;

// Actualizar el descuento en la base de datos
$conn = (new DataBaseController())->getConexion();
$updateSql = "UPDATE facturas SET descuento = ? WHERE refencia = ? AND idCliente = ?";
$stmtUpdate = $conn->prepare($updateSql);
$stmtUpdate->bind_param("dsi", $descuento, $referencia, $cliente['id']);
$stmtUpdate->execute();
$stmtUpdate->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Factura</title>
    <link rel="stylesheet" type="text/css" href="detalleFac.css">
</head>
<body>
    <h1>Factura</h1>
    <div class="container">
        <div class="flex-container">
            <div>
                <h3>Número de Factura: <?php echo htmlspecialchars($factura['refencia']); ?></h3>
                <h3>Fecha: <?php echo htmlspecialchars($factura['fecha']); ?></h3>
            </div>
            <div>
                <h3>Cliente</h3>
                <ul>
                    <li>ID Cliente: <?php echo htmlspecialchars($cliente['id']); ?></li>
                    <li>Nombre Completo: <?php echo htmlspecialchars($cliente['nombreCompleto']); ?></li>
                    <li>Tipo de Documento: <?php echo htmlspecialchars($cliente['tipoDocumento']); ?></li>
                    <li>Email: <?php echo htmlspecialchars($cliente['email']); ?></li>
                    <li>Teléfono: <?php echo htmlspecialchars($cliente['telefono']); ?></li>
                </ul>
            </div>
        </div>

        <div class="table-container">
            <table>
                <colgroup span="4" class="columns"></colgroup>
                <tr>
                    <th>Cantidad</th>
                    <th>Descripción</th>
                    <th>Precio unitario</th>
                    <th>Valor</th>
                </tr>
                <?php
                $detalles->data_seek(0);
                while ($detalle = $detalles->fetch_assoc()) {
                    $valor = $detalle['cantidad'] * $detalle['precioUnitario'];
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($detalle['cantidad']) . "</td>";
                    echo "<td>" . htmlspecialchars($detalle['idArticulo']) . "</td>";
                    echo "<td>" . htmlspecialchars($detalle['precioUnitario']) . "</td>";
                    echo "<td>" . htmlspecialchars($valor) . "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>

        <h3>Subtotal: <?php echo htmlspecialchars($subtotal); ?></h3>
        <?php if ($porcentajeDescuento > 0): ?>
            <h3>Descuento (<?php echo htmlspecialchars($porcentajeDescuento); ?>%): <?php echo htmlspecialchars($descuento); ?></h3>
        <?php endif; ?>
        <h3>Total: <?php echo htmlspecialchars($total); ?></h3>

        <a href="historialFacturas.php" class="volver-btn">Volver</a>
    </div>
</body>
</html>













