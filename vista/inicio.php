<?php
require_once '../controllers/ArticuloController.php';

use App\controllers\ClienteController;
use App\models\Cliente;

$articuloController = new App\controllers\ArticuloController();
$articulos = $articuloController->read();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturación</title>
</head>
<body>
    <form action="validacionCliente.php" method="post">     
        <!-- Datos del cliente -->
        <h2>Datos del Cliente</h2>
        <label for="nombreCompleto">Nombre Completo:</label>
        <input type="text" name="nombreCompleto" id="nombreCompleto" required>
        <br>
        <label for="tipoDocumento">Tipo de documento:</label><br>
        <select id="tipoDocumento" name="tipoDocumento" required>
        <option value="cc">Cédula de ciudadania</option>
        <option value="Carnet de extranjería">Carnet de extranjería</option>
        <option value="NIT">NIT</option>
        <option value="TI">Tarjeta de identidad</option>
        </select><br><br>
        <br>
        <label for="numeroDocumento">Número Documento:</label>
        <input type="text" name="numeroDocumento" id="numeroDocumento" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="telefono">Teléfono:</label>
        <input type="tel" name="telefono" id="telefono" required>
        <br>
        <input type="submit" value="Validar Cliente">
    </form>
    <form action="listaClientes.php" method="GET">
    <input type="submit" value="Actualizar Datos">
</form>

    <h1>Crear Factura</h1>
    <form action="../vista/registroFactura.php" method="post">
        <!-- Datos de la factura -->
        <label for="refencia">Referencia:</label>
        <input type="text" name="refencia" id="refencia" required>
        <br>
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" id="fecha" value="<?php echo date('Y-m-d'); ?>" required>
        <br>
        <label for="idCliente">cliente:</label>
        <input type="text" name="idCliente" id="idCliente"   required>
        <br>
        <label for="estado">Estado:</label>
        <select name="estado" id="estado" required>
            <option value="Pagada">Pagada</option>
            <option value="Error">Error</option>
            <option value="Cambio">Cambio</option>
            <option value="Devolución">Devolución</option>
        </select>
        <br>
        <label for="descuento">descuento:</label>
        <input type="text" name="descuento" id="descuento"   required>
        <br>
        <input type="submit" value="Generar Factura">
    </form>

    <h1>Lista de Artículos</h1>
    <ul>
        <?php foreach ($articulos as $articulo): ?>
            <li>
                <strong>Nombre:</strong> <?php echo $articulo->get('nombre'); ?>, 
                <strong>Precio:</strong> <?php echo $articulo->get('precio'); ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <form action="DetalleFacturaController.php" method="post">     
        <!-- Detalles de la factura -->
        <h2>Detalles de la Factura</h2>
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" required>
        <br>
        <input type="submit" value="Generar Factura">
    </form>

</body>
</html>

