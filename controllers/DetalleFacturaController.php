<?php

namespace App\controllers;

use App\models\DetalleFactura;
use App\models\Articulo;

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
            $Detallefactura->set('id', $item['id']);
            $Detallefactura->set('cantidad', $item['cantidad']);
            $Detallefactura->set('precioUnitario', $item['precioUnitario']);
            $Detallefactura->set('idArticulo', $item['idArticulo']);
            $Detallefactura->set('refenciaFactuara', $item['refenciaFactuara']);
            array_push($Detallefacturas, $Detallefactura);
        }
        $dataBase->close();
        return $Detallefacturas;
    }

    function crearDetalleFactura($Detallefactura)
    {
        $sql = "insert into detallefactura(cantidad)values";
        $sql .= "(";
        $sql .= "'".$Detallefactura->get('cantidad')."',";
        $sql .= ")";
        $dataBase = new DataBaseController();
        $result = $dataBase->execSql($sql);
        $dataBase->close();
        return $result;
    }
}
?>
