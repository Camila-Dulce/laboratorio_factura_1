<?php
include '../models/Model.php';
include '../models/Factura.php';
include '../models/Cliente.php';
include '../controllers/DataBaseController.php';
include '../controllers/FacturaController.php';
include '../controllers/ClienteController.php'; 

use App\controllers\FacturaController;
use App\models\Factura;
use App\models\Cliente;
use App\controllers\ClienteController;

$clienteController = new ClienteController();
$clientes = $clienteController->read();
$idcliente = null;

if (is_array($clientes) && count($clientes) > 0) {
    foreach ($clientes as $cliente): 
        if($cliente->get('numeroDocumento') == $_POST['numeroDocumento'] ){ 
           $idcliente = $cliente->get('id');
        }
    endforeach;
}

$controller = new FacturaController();
$factura = new Factura();
$factura->set('refencia', $_POST['refencia']);
$factura->set('fecha', $_POST['fecha']);
$factura->set('idCliente', $idcliente);
$factura->set('estado', $_POST['estado']);
$factura->set('descuento', 0);

$result = $controller->guardarFactura($factura);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Factura</title>
</head>
<body>
    <h1><?php echo $result ? 'Datos guardados' : 'No se pudo guardar el registro'; ?></h1>
    <br>
    <h2>Datos de la factura:</h2>
    <ul>
        <li><strong>Referencia:</strong> <?php echo $factura->get('refencia'); ?></li>
        <li><strong>Fecha:</strong> <?php echo $factura->get('fecha'); ?></li>
        <li><strong>ID Cliente:</strong> <?php echo $factura->get('idCliente'); ?></li>
        <li><strong>Estado:</strong> <?php echo $factura->get('estado'); ?></li>
        <li><strong>Descuento:</strong> <?php echo $factura->get('descuento'); ?></li>
    </ul>
    <br>
    <a href="../vista/inicio.php">Volver</a>
</body>
</html>
