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

    public function getFacturaData($numeroDocumento, $referencia)
    {
        // Obtener los datos del cliente utilizando el número de documento
        $clienteSql = "SELECT * FROM clientes WHERE numeroDocumento = '$numeroDocumento'";
        $clienteResult = $this->dbController->execSql($clienteSql);

        if ($clienteResult === false) {
            die("Error en la consulta del cliente: " . $this->dbController->getLastError());
        }

        $cliente = $clienteResult->fetch_assoc();
        if (!$cliente) {
            die("No se encontraron datos del cliente.");
        }

        // Obtener los datos de la factura utilizando la referencia
        $facturaSql = "SELECT * FROM facturas WHERE refencia = '$referencia' AND idCliente = " . $cliente['id'];
        $facturaResult = $this->dbController->execSql($facturaSql);

        if ($facturaResult === false) {
            die("Error en la consulta de la factura: " . $this->dbController->getLastError());
        }

        $factura = $facturaResult->fetch_assoc();
        if (!$factura) {
            die("No se encontraron datos de la factura.");
        }

        // Obtener los detalles de la factura utilizando la referencia de la factura
        $detallesSql = "SELECT * FROM detallefacturas WHERE refenciaFactura = '$referencia'";
        $detallesResult = $this->dbController->execSql($detallesSql);

        if ($detallesResult === false) {
            die("Error en la consulta de detalles de factura: " . $this->dbController->getLastError());
        }

        return [
            'cliente' => $cliente,
            'factura' => $factura,
            'detalles' => $detallesResult
        ];
    }
}
?>










