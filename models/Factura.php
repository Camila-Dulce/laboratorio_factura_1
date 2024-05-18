<?php
namespace App\models;

class Factura extends Model
{
    protected $refencia = 0; 
    protected $fecha = "";
    protected $idCliente = 0;
    protected $estado = "";
    protected $descuento = "";


    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'idCliente');
    }

    public function detalleFactura()
    {
        return $this->hasMany(DetalleFactura::class, 'refenciaFactura');
    }
}
?>