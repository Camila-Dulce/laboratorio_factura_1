<?php

namespace App\controllers;

use App\models\DetalleFactura;

class DetalleFacturaController
{
    function read()
    {
        $dataBase = new DataBaseController();
        $sql = "select * from contactos";
        $result = $dataBase->execSql($sql);
        $Detallefacturas = [];
        if ($result->num_rows == 0) {
            return $Detallefacturas;
        }
        while ($item = $result->fetch_assoc()) {
            $Detallefactura = new DetalleFactura();
    protected $referencia = " " ;
            $Detallefactura->set('idDetalleFactura', $item['idDetalleFactura']);
            $Detallefactura->set('cantidad', $item['cantidad']);
            $Detallefactura->set('precioUnitario', $item['precioUnitario']);
            $Detallefactura->set('idArticulo', $item['idArticulo']);
            $Detallefactura->set('referenciaFactuara', $item['referenciaFactuara']);
            array_push($Detallefacturas, $Detallefactura);
        }
        $dataBase->close();
        return $Detallefacturas;
    }

    function create($Detallefactura)
    {
        $sql = "insert into detallefactura(cantidad,precioUnitario)values";
        $sql .= "(";
        $sql .= "'".$Detallefactura->get('cantidad')."',";
        $sql .= "'".$Detallefactura->get('precioUnitario')."'";
        $sql .= ")";
        $dataBase = new DataBaseController();
        $result = $dataBase->execSql($sql);
        $dataBase->close();
        return $result;
    }

    function update()
    {
    }

    function delete()
    {
    }
}
