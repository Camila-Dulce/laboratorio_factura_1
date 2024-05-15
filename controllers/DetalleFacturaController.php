<?php

namespace App\controllers;

use App\models\DetalleFactura;
use App\controllers\DataBaseController; // Corregido

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
            $referencia = " " ;
            $Detallefactura->set('cantidad', $item['cantidad']);
            $Detallefactura->set('precioUnitario', $item['precioUnitario']);
            $Detallefactura->set('idArticulo', $item['idArticulo']);
            $Detallefactura->set('refenciaFactuara', $item['refenciaFactuara']);
            array_push($Detallefacturas, $Detallefactura);
        }
        $dataBase->close();
        return $Detallefacturas;
    }

    function crear($DetalleFactura) // Corregido el nombre del parámetro
    {
        $sql = "INSERT INTO detallefacturas (cantidad, precioUnitario, idArticulo, refenciaFactura ) VALUES (";
        $sql .= "'".$DetalleFactura->get('cantidad')."',"; // Corregido
        $sql .= "'".$DetalleFactura->get('precioUnitario')."',"; // Corregido
        $sql .= "'".$DetalleFactura->get('idArticulo')."',"; // Corregido
        $sql .= "'".$DetalleFactura->get('refenciaFactura')."'"; // Corregido
        $sql .= ")";
        $dataBase = new DataBaseController();
        $result = $dataBase->execSql($sql);
        $dataBase->close();
        return $result;
    }
}
?>
