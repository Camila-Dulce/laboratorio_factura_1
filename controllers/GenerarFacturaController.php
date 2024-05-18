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

    public function getFacturaData($clienteId, $facturaReferencia)
    {
        // Obtener los datos de la factura utilizando la columna 'idCliente' y 'refencia'
        $facturaSql = "SELECT * FROM facturas WHERE idCliente = $clienteId AND refencia = '$facturaReferencia'";
        $facturaResult = $this->dbController->execSql($facturaSql);
        $factura = $facturaResult->fetch_assoc();

        // Obtener los detalles de la factura utilizando la columna 'referenciaFactura'
        $detallesSql = "SELECT * FROM detallefacturas WHERE refenciaFactura = '{$factura['referencia']}'";
        $detallesResult = $this->dbController->execSql($detallesSql);

        return [
            'factura' => $factura,
            'detalles' => $detallesResult
        ];
    }
}
?>







