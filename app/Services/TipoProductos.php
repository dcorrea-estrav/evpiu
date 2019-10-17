<?php

namespace App\Services;

use App\CodTipoProducto;

class TipoProductos
{
    public function get()
    {
        $tipoproductos = CodTipoProducto::get();
        $tipoproductosArray[''] = 'Seleccione un tipo de producto...';
        foreach ($tipoproductos as $TipoProducto){
            $tipoproductosArray[$TipoProducto->id] = $TipoProducto->name;
        }
        return $tipoproductosArray;
    }
}
