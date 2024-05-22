<?php
require_once '../controllers/DataBaseController.php';
require_once '../controllers/GenerarFacturaController.php';

use App\controllers\GenerarFacturaController;

// Obtener los valores enviados desde el formulario
$clienteId = isset($_GET['numeroDocumento']) ? intval($_GET['numeroDocumento']) : null;
$referencia = isset($_GET['referencia']) ? $_GET['referencia'] : null;

if ($clienteId === null || $referencia === null) {
    die("Error: ID de cliente o referencia de factura no proporcionados.");
}

$facturaController = new GenerarFacturaController();
$facturaData = $facturaController->getFacturaData($clienteId, $referencia);

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
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Factura</title>
</head>
<body>
    <h1>Factura</h1>
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

    <div>
        <ul>
            <li>N° de Factura: <?php echo $factura['refencia']; ?></li>
            <li>Fecha: <?php echo $factura['fecha']; ?></li>
        </ul>
    </div>

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

    <h3>Subtotal: <?php echo $subtotal; ?></h3>
    <?php if ($porcentajeDescuento > 0): ?>
        <h3>Descuento (<?php echo $porcentajeDescuento; ?>%): <?php echo $descuento; ?></h3>
    <?php endif; ?>
    <h3>Total: <?php echo $total; ?></h3>

    <form action="actualizarEstadoFactura.php" method="post">
        <h1 id="refenciaFactura">Referencia de la factura que cambia el Estato es: <?php echo $referencia ?></h1>
        <input type="hidden" name="referencia" value="<?php echo $referencia  ?>">
        <br>
        <label for="nuevoEstado">Nuevo estado:</label>
        <select id="nuevoEstado" name="nuevoEstado" required>
            <option value="Pagada">Pagada</option>
            <option value="Error">Error</option>
            <option value="Cambio">Cambio</option>
            <option value="Devolución">Devolución</option>
        </select>
        <br>
        <input type="submit" value="Actualizar Estado">
    </form>

    <br>
    <a href="pestañaFactura.php">Volver</a>
</body>
</html>
