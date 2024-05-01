<?php
require_once '../controllers/ArticuloController.php';

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
    <h1>Crear Factura</h1>
    <form action="FacturaController.php" method="post">
        <!-- Datos de la factura -->
        <label for="referencia">Referencia:</label>
        <input type="text" name="referencia" id="referencia" required>
        <br>
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" id="fecha" value="<?php echo date('Y-m-d'); ?>" required>
        <br>
        <label for="estado">Estado:</label>
        <select name="estado" id="estado" required>
            <option value="Pagada">Pagada</option>
            <option value="Error">Error</option>
            <option value="Cambio">Cambio</option>
            <option value="Devolución">Devolución</option>
        </select>
        <br>

        <!-- Datos del cliente -->
        <h2>Datos del Cliente</h2>
        <label for="nombreCompleto">Nombre Completo:</label>
        <input type="text" name="nombreCompleto" id="nombreCompleto" required>
        <br>
        <label for="tipoDocumento">Tipo Documento:</label>
        <input type="text" name="tipoDocumento" id="tipoDocumento" required>
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

        <!-- Detalles de la factura -->
        <h2>Detalles de la Factura</h2>
        <label for="articulo">Artículo:</label>
        <ul>
            <?php foreach ($articulos as $articulo): ?>
                <li>
                    <input type="radio" name="articulo" id="<?php echo $articulo->get('idArticulo'); ?>" value="<?php echo $articulo->get('idArticulo'); ?>">
                    <label for="<?php echo $articulo->get('idArticulo'); ?>"><?php echo $articulo->get('nombreArticulo') . " - $" . $articulo->get('precio'); ?></label>
                </li>
            <?php endforeach; ?>
        </ul>
        <br>
        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" required>
        <br>
        <input type="submit" value="Generar Factura">
    </form>
</body>
</html>
