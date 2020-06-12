<?php

namespace App\Http\Controllers\FacturacionElectronica;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ConfiguracionController extends Controller
{
    /**
     * Vista de cofiguracion de facturacion electronica.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request){
        $data = DB::table('fe_configs')->first();
        return view('aplicaciones.facturacion_electronica.configuracion.index', compact('data'));
    }


    /**
     * Guarda configuracion para facturas
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function guardar_config_facturas(Request $request){
        try {
            DB::table('fe_configs')
                ->where('id','=','1')
                ->update([
                    'fac_idnumeracion'  => $request->fac_idnumeracion,
                    'fac_idambiente'    => $request->fac_idambiente,
                    'fac_idreporte'     => $request->fac_idreporte
                ]);
            return response()->json('Datos guardados correctamente',200);
        }catch (\Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }


    /**
     * Guarda configuracion para notas credito
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function guardar_config_notas_credito(Request $request){
        try {
            DB::table('fe_configs')
                ->where('id','=','1')
                ->update([
                    'nc_idnumeracion'  => $request->nc_idnumeracion,
                    'nc_idambiente'    => $request->nc_idambiente,
                    'nc_idreporte'     => $request->nc_idreporte
                ]);
            return response()->json('Datos guardados correctamente',200);
        }catch (\Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
}


