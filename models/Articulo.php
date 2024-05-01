<?php
namespace App\models;

require_once 'Model.php';

class Articulo extends Model
{
    protected $idArticulo = 0;
    protected $nombreArticulo = " ";
    protected $precio = 0;

    public function detallesFactura()
    {
        return $this->hasMany(DetalleFactura::class, 'idArticulo');
    }

    public function precioUnitario()
    {
        return $this->hasOne(DetalleFactura::class, 'precioUnitario');
    }
}
?>