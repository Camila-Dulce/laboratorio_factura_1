<?php
require_once '../controllers/DataBaseController.php';
require_once '../controllers/GenerarFacturaController.php';

use App\controllers\GenerarFacturaController;

// Obtener los valores enviados desde el formulario
$clienteId = isset($_GET['clienteId']) ? intval($_GET['clienteId']) : null;
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
$descuento = 0; // Calcula el descuento según tus reglas de negocio
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
            <li>ID Cliente: <?php echo $cliente['id']; ?></li>
            <li>Nombre Completo: <?php echo $cliente['nombreCompleto']; ?></li>
            <li>Tipo de Documento: <?php echo $cliente['tipoDocumento']; ?></li>
            <li>Número de Documento: <?php echo $cliente['numeroDocumento']; ?></li>
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
        while($detalle = $detalles->fetch_assoc()) {
            $valor = $detalle['cantidad'] * $detalle['precioUnitario'];
            $subtotal += $valor;
            echo "<tr>";
            echo "<td>{$detalle['cantidad']}</td>";
            echo "<td>{$detalle['idArticulo']}</td>";
            echo "<td>{$detalle['precioUnitario']}</td>";
            echo "<td>{$valor}</td>";
            echo "</tr>";
        }
        $total = $subtotal - $descuento;
        ?>
    </table>

    <h3>Subtotal: <?php echo $subtotal; ?></h3>
    <h3>Descuento: <?php echo $descuento; ?></h3>

    <table>
        <tr>
            <td>Total: <?php echo $total; ?></td>
        </tr>
    </table>

    <br>
    <a href="pestañaFactura.php">Volver</a>
</body>
</html>












