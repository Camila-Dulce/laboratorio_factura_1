<?php
namespace App\models;

require_once 'Model.php';

class Articulo extends Model
{
    protected $id= 0;
    protected $nombre = " ";
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