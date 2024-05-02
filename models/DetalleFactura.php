<?php
namespace App\models;

class DetalleFactura extends Model
{
    protected $id = 0;
    protected $cantidad = 0;
    protected $precioUnitario = 0;
    protected $idArticulo = 0;
    protected $refenciaFactura = "";

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'refenciaFactura');
    }

    public function articulo()
    {
        return $this->belongsTo(Articulo::class, 'idArticulo');
    }

    public function precio()
    {
        return $this->belongsTo(Articulo::class, 'precioUnitario');
    }
}
?>