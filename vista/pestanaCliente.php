<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente</title>
    <link rel="stylesheet" type="text/css" href="pestanaCl.css">
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
            <option value="CC">Cédula de ciudadania</option>
            <option value="CE">Carnet de extranjería</option>
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
    <br>
    <a href="pestanaFactura.php">Volver</a>
</body>
</html>