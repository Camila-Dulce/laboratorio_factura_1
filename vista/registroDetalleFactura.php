<?php

// Incluir los archivos necesarios
require_once __DIR__ . '/../controllers/DataBaseController.php';
require_once __DIR__ . '/../controllers/DetalleFacturaController.php';
require_once __DIR__ . '/../models/DetalleFactura.php';

use App\controllers\DetalleFacturaController;
use App\models\DetalleFactura;

$result = false;
$detalleFactura = null;

// Verificar que los valores existen en $_POST antes de usarlos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['refencia'], $_POST['idArticulo'], $_POST['precioUnitario'], $_POST['idCliente'])) {
        // Captura de datos del formulario
        $refencia = $_POST['refencia'];
        $idArticulo = $_POST['idArticulo'];
        $precioUnitario = $_POST['precioUnitario'];
        $idCliente = $_POST['idCliente'];

        // Crear el objeto DetalleFactura
        $detalleFactura = new DetalleFactura($refencia, $idArticulo, $precioUnitario);

        // Crear el controlador y llamar a la función crear
        $controller = new DetalleFacturaController();
        $result = $controller->crear($detalleFactura, $idCliente);
    } else {
        echo "Error: faltan datos del formulario.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Fecha</title>
</head>
<body>
    <h1><?php echo $result ? 'Datos guardados' : 'No se pudo guardar el registro'; ?></h1>
    <br>
    <?php if ($detalleFactura): ?>
        <ul>
            <li><strong>Cantidad:</strong> <?php echo $detalleFactura->idArticulo; ?></li>
            <li><strong>Precio:</strong> <?php echo $detalleFactura->precioUnitario; ?></li>
            <li><strong>ID Artículo:</strong> <?php echo $detalleFactura->idArticulo; ?></li>
            <li><strong>Referencia Factura:</strong> <?php echo $detalleFactura->refencia; ?></li>
        </ul>
    <?php endif; ?>
    <a href="../vista/inicio.php">Volver</a>
</body>
</html>


