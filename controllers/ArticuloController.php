<?php

namespace App\controllers;

require_once '../models/Articulo.php'; // Corregir ruta de acceso
require_once 'DataBaseController.php';

use App\models\Articulo;
use App\controllers\DataBaseController;

class ArticuloController
{
    function read()
    {
        $dataBase = new DataBaseController();
        $sql = "select * from contactos";
        $result = $dataBase->execSql($sql);
        $Articulos = [];
        if ($result->num_rows == 0) {
            return $Articulos;
        }
        while ($item = $result->fetch_assoc()) {
            $Articulo = new Articulo();
            protected $referencia = " " ;
            $Articulo->set('idArticulo', $item['idArticulo']);
            $Articulo->set('nombreArticulo', $item['nombreArticulo']);
            $Articulo->set('precio', $item['precio']);
            array_push($Articulos, $Articulo);
        }
        $dataBase->close();
        return $Articulos;
    }
}
?>
