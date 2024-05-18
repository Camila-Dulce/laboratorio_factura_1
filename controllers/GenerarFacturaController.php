<?php
namespace App\controllers;

use App\controllers\DataBaseController;

class GenerarFacturaController
{
    private $dbController;

    public function __construct()
    {
        $this->dbController = new DataBaseController();
    }

    public function getFacturaData($clienteId, $referencia)
    {
        // Obtener los datos de la factura utilizando la columna 'referencia'
        $facturaSql = "SELECT * FROM facturas WHERE refencia = '$referencia'";
        $facturaResult = $this->dbController->execSql($facturaSql);

        if ($facturaResult === false) {
            die("Error en la consulta de factura: " . $this->dbController->getLastError());
        }

        $factura = $facturaResult->fetch_assoc();
        if (!$factura) {
            die("No se encontraron datos de la factura.");
        }

        // Obtener los detalles de la factura utilizando la columna 'refenciaFactura'
        $detallesSql = "SELECT * FROM detallefacturas WHERE refenciaFactura = '$referencia'";
        $detallesResult = $this->dbController->execSql($detallesSql);

        if ($detallesResult === false) {
            die("Error en la consulta de detalles de factura: " . $this->dbController->getLastError());
        }

        // Obtener los datos del cliente utilizando la columna 'idCliente'
        $clienteSql = "SELECT * FROM clientes WHERE id = '$clienteId'";
        $clienteResult = $this->dbController->execSql($clienteSql);

        if ($clienteResult === false) {
            die("Error en la consulta de cliente: " . $this->dbController->getLastError());
        }

        $cliente = $clienteResult->fetch_assoc();
        if (!$cliente) {
            die("No se encontraron datos del cliente.");
        }

        return [
            'factura' => $factura,
            'detalles' => $detallesResult,
            'cliente' => $cliente
        ];
    }
}

?>










