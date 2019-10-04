<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodMedida extends Model
{
    protected $fillable = ['cod','name','denominacion','interior','exterior',
        'largo','lado_1','lado_2','coments','abreviatura','med_lineas_id','med_sublineas_id'
    ];

    public function Codlineas ()
    {
        return $this->belongsTo(CodLinea::class); // pertecene a linea
    }

    public function CodSublineas ()
    {
        return $this->belongsTo(CodSublinea::class); // pertecene a linea
    }
}
