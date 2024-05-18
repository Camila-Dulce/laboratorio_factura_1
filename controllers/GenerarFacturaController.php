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

    public function getFacturaData($clienteId, $facturaId)
    {
        // Obtener los datos del cliente
        $clienteSql = "SELECT * FROM clientes WHERE id = $clienteId";
        $clienteResult = $this->dbController->execSql($clienteSql);
        $cliente = $clienteResult->fetch_assoc();

        // Obtener los datos de la factura
        $facturaSql = "SELECT * FROM facturas WHERE id = $facturaId";
        $facturaResult = $this->dbController->execSql($facturaSql);
        $factura = $facturaResult->fetch_assoc();

        // Obtener los detalles de la factura
        $detallesSql = "SELECT * FROM detallefacturas WHERE refenciaFactura = '{$factura['id']}'";
        $detallesResult = $this->dbController->execSql($detallesSql);

        return [
            'cliente' => $cliente,
            'factura' => $factura,
            'detalles' => $detallesResult
        ];
    }
}
?>


