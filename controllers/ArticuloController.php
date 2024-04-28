<?php

namespace App\controllers;

use App\models\Articulo;

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

    function create($Articulo)
    {
        $sql = "insert into articulos(nombreArticulo,precio)values";
        $sql .= "(";
        $sql .= "'".$Articulo->get('nombreArticulo')."',";
        $sql .= "'".$Articulo->get('precio')."'";
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
