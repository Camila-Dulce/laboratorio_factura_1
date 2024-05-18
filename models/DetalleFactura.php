<?php

namespace App\models;

class DetalleFactura
{
    public $refencia;
    public $idArticulo;
    public $precioUnitario;

    function __construct($refencia, $idArticulo, $precioUnitario)
    {
        $this->refencia = $refencia;
        $this->idArticulo = $idArticulo;
        $this->precioUnitario = $precioUnitario;
    }
}

