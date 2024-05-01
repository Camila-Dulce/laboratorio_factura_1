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
        $sql = "SELECT * FROM articulos";
        $result = $dataBase->execSql($sql);
        $articulos = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $articulo = new Articulo();
                if (isset($row['idArticulo'])) {
                    $articulo->set('idArticulo', $row['idArticulo']);
                }
                if (isset($row['nombreArticulo'])) {
                    $articulo->set('nombreArticulo', $row['nombreArticulo']);
                }
                array_push($articulos, $articulo);
            }
        }

        $dataBase->close();
        return $articulos;
    }
}
?>
