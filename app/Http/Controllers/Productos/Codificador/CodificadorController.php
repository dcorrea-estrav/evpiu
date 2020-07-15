<?php

namespace App\Http\Controllers\Productos\Codificador;

use App\CodCaracteristica;
use App\CodCodigo;
use App\CodLinea;
use App\CodMaterial;
use App\CodMedida;
use App\CodSublinea;
use App\CodTipoProducto;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CodificadorController extends Controller
{
    /**
     * Lista tipos de producto
     *
     * @return Factory|View
     */
    public function index(){
        $data = DB::table('cod_codigos')
            ->leftJoin('cod_tipo_productos','cod_codigos.cod_tipo_producto_id','=','cod_tipo_productos.id')
            ->leftJoin('cod_lineas','cod_codigos.cod_lineas_id','=','cod_lineas.id')
            ->leftJoin('cod_sublineas','cod_codigos.cod_sublineas_id','=','cod_sublineas.id')
            ->leftJoin('cod_medidas','cod_codigos.cod_medidas_id','=','cod_medidas.id')
            ->leftJoin('cod_materials','cod_codigos.cod_materials_id','=','cod_materials.id')
            ->leftJoin('cod_caracteristicas','cod_codigos.cod_caracteristicas_id','=','cod_caracteristicas.id')
            ->select('cod_codigos.codigo as codigo','cod_codigos.coments as coment','cod_codigos.descripcion as desc','cod_codigos.usuario','cod_codigos.usuario_aprobo',
                'cod_codigos.arte','cod_codigos.estado','cod_codigos.area','cod_codigos.costo_base','cod_codigos.generico','cod_codigos.created_at',
                'cod_codigos.updated_at','cod_tipo_productos.name as tp','cod_lineas.name as lin','cod_sublineas.name as subl','cod_medidas.denominacion as med','cod_materials.name as mat',
                'cod_caracteristicas.name as car','cod_codigos.id as id')
            ->get();

        $tipo_productos = CodTipoProducto::orderBy('name', 'asc')->get();
        $lineas = CodLinea::orderBy('name', 'asc')->get();

        return view('aplicaciones.productos.codificador.index', compact('data', 'tipo_productos', 'lineas'));
    }


    /**
     * Elimina un registro
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id){
        try {
            CodCodigo::find($id)->delete();
            return response()->json('Registro eliminado',200);
        }catch (\Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }


    /**
     * Guarda registro
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request){
        if ($request->ajax()){
            try {
                CodCodigo::create([
                    'codigo'                    => $request->codigo,
                    'coments'                   => $request->coments,
                    'cod_tipo_producto_id'      => $request->tipo_producto,
                    'cod_lineas_id'             => $request->linea,
                    'cod_sublineas_id'          => $request->sublinea,
                    'cod_medidas_id'            => $request->medida,
                    'cod_caracteristicas_id'    => $request->caracteristica,
                    'cod_materials_id'          => $request->material,
                    'descripcion'               => $request->descripcion,
                    'usuario'                   => Auth::user()->id
                ]);
                return response()->json('Registro guardado', 200);
            }catch (\Exception $e){
                return response()->json($e->getMessage(),500);
            }
        }
    }


    /**
     * Lista sublineas
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function listar_sublineas(Request $request){
        if ($request->ajax()){
            try {
               $data = CodSublinea::where('lineas_id', '=', $request->id)
                   ->orderBy('name', 'asc')
                   ->get();

               return response()->json($data,200);
            }catch (\Exception $e){
                return response()->json($e->getMessage(),500);
            }
        }
    }


    /**
     * Lista de materiales, medidas, caracteristicas
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function listar_caracteristicas_materiales_medidas(Request $request){
        if ($request->ajax()){
            try {
                $caracteristicas = CodCaracteristica::where('car_lineas_id', '=', $request->linea_id)
                    ->where('car_sublineas_id', '=', $request->sublinea_id)
                    ->orderBy('name', 'asc')
                    ->get();

                $materiales = CodMaterial::where('mat_lineas_id', '=', $request->linea_id)
                    ->where('mat_sublineas_id', '=', $request->sublinea_id)
                    ->orderBy('name', 'asc')
                    ->get();

                $medidas = CodMedida::where('med_lineas_id', '=', $request->linea_id)
                    ->where('med_sublineas_id', '=', $request->sublinea_id)
                    ->orderBy('denominacion', 'asc')
                    ->get();

                return response()->json([
                    'caracteristicas' => $caracteristicas,
                    'materiales' => $materiales,
                    'medidas' => $medidas]
                    ,200);
            }catch (\Exception $e){
                return response()->json($e->getMessage(),500);
            }
        }
    }


    /**
     * obtiene los datos necesarios para crear
     * la descripcion y el codigo del producto
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function obtener_datos_generacion_cod_desc(Request $request){
        if ($request->ajax()){
            try {
                $tipo_producto = CodTipoProducto::where('id', '=', $request->tipo_producto)
                    ->pluck('cod')
                    ->first();

                $linea = CodLinea::where('id', '=', $request->linea)
                    ->select('abreviatura','cod')
                    ->first();

                $sublinea = CodSublinea::where('id', '=', $request->sublinea)
                    ->select('abreviatura','cod')
                    ->first();

                $caracteristica = CodCaracteristica::where('id', '=', $request->caracteristica)
                    ->select('abreviatura','cod')
                    ->first();

                $material = CodMaterial::where('id', '=', $request->material)
                    ->select('abreviatura','cod')
                    ->first();

                $medida = CodMedida::where('id', '=', $request->medida)
                    ->select('denominacion','cod')
                    ->first();

                $lista_codigos =  CodCodigo::pluck('codigo')->toArray();


                return response()->json([
                    'tipo_producto'     =>  $tipo_producto,
                    'linea'             =>  $linea,
                    'sublinea'          =>  $sublinea,
                    'caracteristica'    =>  $caracteristica,
                    'material'          =>  $material,
                    'medida'            =>  $medida,
                    'lista_codigos'     =>  $lista_codigos
                ],200);

            }catch (\Exception $e){
                return response()->json($e->getMessage(),500);
            }
        }
    }

    /**
     * valida que el codigo no este repedito
     * esto se usa como seguridad adicional por si
     * el gnerador de codigo falla y crea uno repetido
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function validar_codigo(Request $request){
        if ($request->ajax()){
            try {
                $data = CodCodigo::where('codigo', '=', $request->codigo)
                    ->count();

                if ($data == 0){
                    return response()->json(true,200);
                }else{
                    return response()->json(false,200);
                }
            }catch (\Exception $e){
                return response()->json($e->getMessage(),500);
            }
        }

    }







}
