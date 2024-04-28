<?php

namespace App\controllers;

use App\models\Factura;

class FacturaController
{
    function read()
    {
        $dataBase = new DataBaseController();
        $sql = "select * from contactos";
        $result = $dataBase->execSql($sql);
        $facturas = [];
        if ($result->num_rows == 0) {
            return $facturas;
        }
        while ($item = $result->fetch_assoc()) {
            $factura = new Factura();
    protected $referencia = " " ;
            $factura->set('referencia', $item['referencia']);
            $factura->set('fecha', $item['fecha']);
            $factura->set('idCliente', $item['idCliente']);
            $factura->set('estado', $item['estado']);
            $factura->set('descuento', $item['descuento']);
            array_push($facturas, $factura);
        }
        $dataBase->close();
        return $facturas;
    }

    function create($factura)
    {
        $sql = "insert into factura(refencia,fecha,estado,descuento)values";
        $sql .= "(";
        $sql .= "'".$factura->get('referencia')."',";
        $sql .= "'".$factura->get('fecha')."',";
        $sql .= "'".$factura->get('estado')."',";
        $sql .= "'".$factura->get('descuento')."'";
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
