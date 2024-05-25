<?php
require_once '../controllers/DataBaseController.php';
require_once '../controllers/GenerarFacturaController.php';

use App\controllers\GenerarFacturaController;
use App\controllers\DataBaseController;

// Obtener los valores enviados desde el formulario
$numeroDocumento = isset($_GET['numeroDocumento']) ? $_GET['numeroDocumento'] : null;
$referencia = isset($_GET['referencia']) ? $_GET['referencia'] : null;

if ($numeroDocumento === null || $referencia === null) {
    die("Error: Número de documento o referencia de factura no proporcionados.");
}

$facturaController = new GenerarFacturaController();
$facturaData = $facturaController->getFacturaData($numeroDocumento, $referencia);

if (!$facturaData || !$facturaData['factura']) {
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

// Depuración: Verifica los valores antes de actualizar la base de datos
echo "Descuento: $descuento\n";
echo "Referencia: $referencia\n";
echo "Cliente ID: " . $cliente['id'] . "\n";

$conn = (new DataBaseController())->getConexion();
$updateSql = "UPDATE facturas SET descuento = ? WHERE refencia = ? AND idCliente = ?";
$stmtUpdate = $conn->prepare($updateSql);

if (!$stmtUpdate) {
    die("Preparación de la declaración fallida: " . $conn->error);
}

$stmtUpdate->bind_param("dsi", $descuento, $referencia, $cliente['id']);
$stmtUpdate->execute();

if ($stmtUpdate->errno) {
    die("Error en la ejecución de la consulta: " . $stmtUpdate->error);
}

if ($stmtUpdate->affected_rows === 0) {
    die("Error: No se pudo actualizar el descuento en la base de datos.");
}

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
                <h3>Número de Factura: <?php echo $factura['refencia']; ?></h3>
                <h3>Fecha: <?php echo $factura['fecha']; ?></h3>
            </div>
            <div>
                <h3>Cliente</h3>
                <ul>
                    <li>Número de Documento: <?php echo $cliente['numeroDocumento']; ?></li>
                    <li>Nombre Completo: <?php echo $cliente['nombreCompleto']; ?></li>
                    <li>Tipo de Documento: <?php echo $cliente['tipoDocumento']; ?></li>
                    <li>Email: <?php echo $cliente['email']; ?></li>
                    <li>Teléfono: <?php echo $cliente['telefono']; ?></li>
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
                // Reiniciar el puntero del resultado de los detalles
                $detalles->data_seek(0);
                while ($detalle = $detalles->fetch_assoc()) {
                    $valor = $detalle['cantidad'] * $detalle['precioUnitario'];
                    echo "<tr>";
                    echo "<td>{$detalle['cantidad']}</td>";
                    echo "<td>{$detalle['idArticulo']}</td>";
                    echo "<td>{$detalle['precioUnitario']}</td>";
                    echo "<td>{$valor}</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>

        <h3>Subtotal: <?php echo $subtotal; ?></h3>
        <?php if ($porcentajeDescuento > 0): ?>
            <h3>Descuento (<?php echo $porcentajeDescuento; ?>%): <?php echo $descuento; ?></h3>
        <?php endif; ?>
        <h3>Total: <?php echo $total; ?></h3>

        <a href="pestañaFactura.php" class="volver-btn">Volver</a>
    </div>
</body>
</html>








