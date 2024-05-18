<?php
require_once '../controllers/ArticuloController.php';
require_once '../controllers/FacturaController.php';

use App\controllers\ArticuloController;
use App\controllers\FacturaController;

$articuloController = new ArticuloController();
$articulos = $articuloController->read();

$facturaController = new FacturaController();
$numFacturas = $facturaController->getCount() + 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Lista de Artículos</h1>
    <ul>
        <?php foreach ($articulos as $articulo): ?>
            <li>
                <strong>Numero De Serie:</strong> <?php echo $articulo->get('id'); ?>, 
                <strong>Nombre:</strong> <?php echo $articulo->get('nombre'); ?>, 
                <strong>Precio:</strong> <?php echo $articulo->get('precio'); ?><strong>$</strong>
            </li>
        <?php endforeach; ?>
    </ul>

    <form action="../vista/registroDetalleFactura.php" method="post">     
        <!-- Detalles de la factura -->
        <h1 id="refenciaFactura">Referencia de la factura que se guardan los productos: <?php echo $numFacturas=$numFacturas-1; ?></h1>
        <input type="hidden" name="refenciaFactura" value="<?php echo $numFacturas; ?>">
        <h2>Detalles de la Factura</h2>
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" required>
        <br>
        <label for="idArticulo">ID Artículo:</label>
        <input type="number" name="idArticulo" id="idArticulo" required>
        <br>
        <input type="submit" value="Generar Factura">
    </form>
</body>
</html>