<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Generador de Factura</title>
</head>
<body>

<h2>Generador de Factura</h2>

<form id="facturaForm" action="procesar_factura.php" method="post">
    <label for="nombreCompleto">Nombre completo:</label><br>
    <input type="text" id="nombreCompleto" name="nombreCompleto" required><br><br>
    
    <label for="numeroDocumento">Número de documento:</label><br>
    <input type="text" id="numeroDocumento" name="numeroDocumento" required><br><br>
    
    <label for="tipoDocumento">Tipo de documento:</label><br>
    <select id="tipoDocumento" name="tipoDocumento" required>
        <option value="cc">Cédula de ciudadania</option>
        <option value="Carnet de extranjería">Carnet de extranjería</option>
        <option value="NIT">NIT</option>
        <option value="TI">Tarjeta de identidad</option>
        <option value="otro">Otro</option>
    </select><br><br>
    
    <label for="telefono">Teléfono:</label><br>
    <input type="tel" id="telefono" name="telefono" required><br><br>
    
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>
    
    <label for="productos">Productos:</label><br>
    <select id="productos" name="productos[]" multiple required>
        <option value="Producto1">Producto 1</option>
        <option value="Producto2">Producto 2</option>
        <option value="Producto3">Producto 3</option><label for="tipoDocumento">Tipo de documento:</label><br>
    <select id="tipoDocumento" name="tipoDocumento" required>
        <option value="cc">Cédula de ciudadania</option>
        <option value="Carnet de extranjería">Carnet de extranjería</option>
        <option value="NIT">NIT</option>
        <option value="TI">Tarjeta de identidad</option>
        <option value="otro">Otro</option>
    </select><br><br>
    </select><br><br>
    
    <label for="cantidad">Cantidad:</label><br>
    <input type="number" id="cantidad" name="cantidad" required><br><br>
    
    <input type="submit" value="Generar Factura">
</form>


</body>
</html>
