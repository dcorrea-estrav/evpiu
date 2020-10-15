<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoAreaPedido extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id_d', 'idPedido',
        'Cartera', 'DetalleCartera', 'cartera_fecha_resp', 'aprobo_cartera',
        'Costos', 'DetalleCostos', 'costos_fecha_resp', 'aprobo_costos',
        'Produccion', 'DetalleProduccion', 'produccion_fecha_resp', 'aprobo_produccion',
        'Bodega', 'DetalleBodega', 'bodega_fecha_resp', 'aprobo_bodega',
        'Troqueles', 'DetalleTroqueles', 'troqueles_fecha_resp', 'aprobo_troqueles'
    ];


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pedidos_detalles_area';



    /**
     * The database primary key
     *
     * @var string
     */
    public $primaryKey = 'id_d';
}
