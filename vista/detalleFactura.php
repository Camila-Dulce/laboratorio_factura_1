<?php
require_once '../controllers/DataBaseController.php';
require_once '../controllers/GenerarFacturaController.php';

use App\controllers\GenerarFacturaController;

$clienteId = 1; // Obtén el ID del cliente de la manera adecuada
$facturaId = 1; // Obtén el ID de la factura de la manera adecuada

$facturaController = new GenerarFacturaController();
$facturaData = $facturaController->getFacturaData($clienteId, $facturaId);

$cliente = $facturaData['cliente'];
$factura = $facturaData['factura'];
$detalles = $facturaData['detalles'];

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
            <li>Nombre: <?php echo $cliente['nombre']; ?></li>
            <li>Tipo de documento: <?php echo $cliente['tipo_documento']; ?></li>
            <li>Número de documento: <?php echo $cliente['numero_documento']; ?></li>
            <li>Teléfono: <?php echo $cliente['telefono']; ?></li>
            <li>Email: <?php echo $cliente['email']; ?></li>
        </ul>
    </div>

    <div>
        <ul>
            <li>N° de Factura: <?php echo $factura['id']; ?></li>
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
            $valor = $detalle['cantidad'] * $detalle['precio_unitario'];
            $subtotal += $valor;
            echo "<tr>";
            echo "<td>{$detalle['cantidad']}</td>";
            echo "<td>{$detalle['descripcion']}</td>";
            echo "<td>{$detalle['precio_unitario']}</td>";
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
    <a href="listaClientes.php">Volver</a>
</body>
</html>





