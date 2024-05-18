<?php
require_once '../models/Model.php';
require_once '../models/DetalleFactura.php';
require_once '../controllers/DetalleFacturaController.php';
require_once '../controllers/DataBaseController.php';
require_once '../controllers/ArticuloController.php'; // Agregado

use App\controllers\DetalleFacturaController;
use App\models\DetalleFactura;
use App\controllers\ArticuloController; // Agregado

$controller = new DetalleFacturaController();
$DetalleFactura = new DetalleFactura();
$articuloController = new ArticuloController(); // Agregado

$Preciounitario = null;
$referenciaFactura = null;

$articulos = $articuloController->read(); // Agregado


foreach ($articulos as $articulo): 
    if($articulo->get('id') == $_POST['idArticulo'] ){
       $Preciounitario = $articulo->get('precio');
    }
endforeach;


$DetalleFactura->set('cantidad', $_POST['cantidad']);
$DetalleFactura->set('precioUnitario', $Preciounitario);
$DetalleFactura->set('idArticulo', $_POST['idArticulo']);
$DetalleFactura->set('refenciaFactura', $_POST['refenciaFactura']);

$result = $controller->crear($DetalleFactura);
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
    <a href="../vista/pestañaDetalleFactura.php">Agregar mas produtos a la Factura</a>
    <li><strong>cantidad:</strong> <?php echo $DetalleFactura->get('cantidad'); ?></li>
        <li><strong>Precio:</strong> <?php echo $DetalleFactura->get('precioUnitario'); ?></li>
        <li><strong>ID Aticulo:</strong> <?php echo $DetalleFactura->get('idArticulo'); ?></li>
        <li><strong>referenciaFactura:</strong> <?php echo $DetalleFactura->get('refenciaFactura'); ?></li>
</body>
</html>


