<?php

namespace App\Http\Controllers;

use App\CodLinea;
use Carbon\Carbon;
use Couchbase\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;
use XMLWriter;


class RequerimientosController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->estado == 1) {
                if ($request->perfil == 1 || $request->perfil == 3 || $request->perfil == 4){
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->orderBy('estado', 'desc')
                        ->get();
                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm addRender " name="addRender" id="'.$row->id.'" disabled><i class="fas fa-file-upload"></i></button>'.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }
                if ($request->perfil == 2 ||$request->perfil == 999){
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->orderBy('estado', 'desc')
                        ->get();
                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm addRender" name="addRender" id="'.$row->id.'"><i class="fas fa-file-upload"></i> Cargar</button>'.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }
            }


            if ($request->estado == 2) {
                if ($request->perfil == 1 || $request->perfil == 3 || $request->perfil == 4){
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->orderBy('estado', 'desc')
                        ->get();
                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<a href="/Requerimientoss/'.$row->id.'/edit" class="btn btn-sm btn-outline-light" id="ver"><i class="fas fa-file-signature"></i> Ver</a>'.'</div>';

                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }
                if ($request->perfil == 2 ||$request->perfil == 999){
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->orderBy('estado', 'desc')
                        ->get();
                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<a href="/Requerimientoss/'.$row->id.'/edit" class="btn btn-sm btn-outline-light" id="ver"><i class="fas fa-file-signature"></i> Ver</a>'.'</div>';

                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }
            }

            /* Ojo falta el estado 2 para los vendedores */
            if ($request->estado == 3) {
                if ($request->perfil == 3 || $request->perfil == 2 || $request->perfil == 999){
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->orderBy('estado', 'desc')
                        ->get();

                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm Ver_PorPlano" name="Ver_PorPlano" id="'.$row->id.'" ><i class="fas fa-eye"></i> Ver</button>'.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }
                if ($request->perfil == 1){
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->orderBy('estado', 'desc')
                        ->get();

                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm Ver_PorPlano" name="Ver_PorPlano" id="'.$row->id.'" disabled><i class="fas fa-eye"></i> Ver</button>'.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }
            }

            if ($request->estado == 4) {
                if ($request->perfil == 1){
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->where('diseñador','=', $request->asignado)
                        ->orderBy('estado', 'desc')
                        ->get();

                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm Ver_Asignado" name="Ver_Asignado" id="'.$row->id.'"><i class="fas fa-eye"></i> Ver</button>'.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }
                if ($request->perfil == 2 || $request->perfil == 999){
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->orderBy('estado', 'desc')
                        ->get();

                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm Ver_Asignado" name="Ver_Asignado" id="'.$row->id.'"><i class="fas fa-eye"></i> Ver</button>'.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }
                if ($request->perfil == 3 || $request->perfil == 4){
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->orderBy('estado', 'desc')
                        ->get();

                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm Ver_Asignado" name="Ver_Asignado" id="'.$row->id.'" disabled><i class="fas fa-eye"></i> Ver</button>'.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }
            }

            if ($request->estado == 5) {
                if ($request->perfil == 1){
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->where('diseñador','=', $request->asignado)
                        ->orderBy('estado', 'desc')
                        ->get();

                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm Ver_iniciado" name="Ver_iniciado" id="'.$row->id.'"><i class="fas fa-eye"></i> Ver</button>'.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }
                if ($request->perfil == 2 || $request->perfil == 999)
                {
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->orderBy('estado', 'desc')
                        ->get();

                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm Ver_iniciado" name="Ver_iniciado" id="'.$row->id.'"><i class="fas fa-eye"></i> Ver</button>'.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }
                if ($request->perfil == 3 || $request->perfil == 4)
                {
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->orderBy('estado', 'desc')
                        ->get();

                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm Ver_iniciado" name="Ver_iniciado" id="'.$row->id.'" disabled><i class="fas fa-eye"></i> Ver</button>'.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }
            }

            if ($request->estado == 6) {
                if ($request->perfil == 4 || $request->perfil == 2 || $request->perfil == 999){
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->orderBy('estado', 'desc')
                        ->get();

                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm Ver_Renderizando" name="Ver_Renderizando" id="'.$row->id.'"><i class="fas fa-eye"></i> Ver</button>'.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }
                if ($request->perfil == 1 || $request->perfil == 3){
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->orderBy('estado', 'desc')
                        ->get();

                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm Ver_Renderizando" name="Ver_Renderizando" id="'.$row->id.'" disabled><i class="fas fa-eye"></i> Ver</button>'.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }
            }

            /* Ojo falta el estado 7 para los vendedores */
            /*if ($request->estado == 7) {
                $data =  DB::table('encabezado_requerimientos')
                    ->where('estado','=',$request->estado)
                    ->orderBy('estado', 'desc')
                    ->get();

                return Datatables::of($data)
                    ->addColumn('opciones', function($row){
                        $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm Ver_PorAprobar" name="Ver_PorAprobar" id="'.$row->id.'"><i class="fas fa-eye"></i> Ver</button>'.'</div>';
                        return $btn;
                    })
                    ->rawColumns(['opciones'])
                    ->make(true);
            }*/

            if ($request->estado == 8) {
                if ($request->perfil == 1 || $request->perfil == 2 || $request->perfil == 999 ){
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->where('diseñador','=',$request->asignado)
                        ->orderBy('estado', 'desc')
                        ->get();

                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm Ver_PorCorregir" name="Ver_PorCorregir" id="'.$row->id.'"><i class="fas fa-eye"></i> Ver</button>'.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }
                if ($request->perfil == 3 || $request->perfil == 4){
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->where('diseñador','=',$request->asignado)
                        ->orderBy('estado', 'desc')
                        ->get();

                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm Ver_PorCorregir" name="Ver_PorCorregir" id="'.$row->id.'" disabled><i class="fas fa-eye"></i> Ver</button>'.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }

            }

            if ($request->estado == 9) {
                if ($request->perfil == 1){
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->where('diseñador','=',$request->asignado)
                        ->orderBy('estado', 'desc')
                        ->get();

                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm Ver_Aprobados" name="Ver_Aprobados" id="'.$row->id.'"><i class="fas fa-eye"></i> Ver</button>'.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }
                if ($request->perfil == 3 || $request->perfil == 4 ){
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->orderBy('estado', 'desc')
                        ->get();

                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm Ver_Aprobados" name="Ver_Aprobados" id="'.$row->id.'" disabled><i class="fas fa-eye"></i> Ver</button>'.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }
                if ($request->perfil == 2 || $request->perfil == 999 ){
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->orderBy('estado', 'desc')
                        ->get();

                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm Ver_Aprobados" name="Ver_Aprobados" id="'.$row->id.'" ><i class="fas fa-eye"></i> Ver</button>'.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }
            }

            if ($request->estado == 10) {
                if ($request->perfil == 1){
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->where('diseñador','=',$request->asignado)
                        ->orderBy('estado', 'desc')
                        ->get();

                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm Ver_Cerrados" name="Ver_Cerrados" id="'.$row->id.'"><i class="fas fa-eye"></i> Ver</button>'.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }
                if ($request->perfil == 3 || $request->perfil == 4 ){
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->where('diseñador','=',$request->asignado)
                        ->orderBy('estado', 'desc')
                        ->get();

                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm Ver_Cerrados" name="Ver_Cerrados" id="'.$row->id.'" disabled><i class="fas fa-eye"></i> Ver</button>'.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }
                if ($request->perfil == 2 || $request->perfil == 999 ){
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->where('diseñador','=',$request->asignado)
                        ->orderBy('estado', 'desc')
                        ->get();

                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm Ver_Cerrados" name="Ver_Cerrados" id="'.$row->id.'" ><i class="fas fa-eye"></i> Ver</button>'.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }

            }

            if ($request->estado == 11) {
                if ($request->perfil == 1){
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->where('diseñador','=',$request->asignado)
                        ->orderBy('estado', 'desc')
                        ->get();

                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm Ver_Anulados" name="Ver_Anulados" id="'.$row->id.'"><i class="fas fa-eye"></i> Ver</button>'.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }
                if ($request->perfil == 3 || $request->perfil == 4){
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->orderBy('estado', 'desc')
                        ->get();

                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm Ver_Anulados" name="Ver_Anulados" id="'.$row->id.'" disabled><i class="fas fa-eye"></i> Ver</button>'.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }
                if ($request->perfil == 2 || $request->perfil == 999){
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->orderBy('estado', 'desc')
                        ->get();

                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm Ver_Anulados" name="Ver_Anulados" id="'.$row->id.'" ><i class="fas fa-eye"></i> Ver</button>'.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }

            }

            if ($request->estado == 12) {
                if ($request->perfil == 1){
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->where('diseñador','=',$request->asignado)
                        ->orderBy('estado', 'desc')
                        ->get();

                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm Ver_SinAprobar" name="Ver_SinAprobar" id="'.$row->id.'"><i class="fas fa-eye"></i> Ver</button>'.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }
                if ($request->perfil == 3 || $request->perfil == 4){
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->orderBy('estado', 'desc')
                        ->get();

                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm Ver_SinAprobar" name="Ver_SinAprobar" id="'.$row->id.'" disabled><i class="fas fa-eye"></i> Ver</button>'.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }
                if ($request->perfil == 2 || $request->perfil == 999){
                    $data =  DB::table('encabezado_requerimientos')
                        ->where('estado','=',$request->estado)
                        ->orderBy('estado', 'desc')
                        ->get();

                    return Datatables::of($data)
                        ->addColumn('opciones', function($row){
                            $btn = '<div class="btn-group ml-auto">'.'<button class="edit btn btn-light btn-sm Ver_SinAprobar" name="Ver_SinAprobar" id="'.$row->id.'" ><i class="fas fa-eye"></i> Ver</button>'.'</div>';
                            return $btn;
                        })
                        ->rawColumns(['opciones'])
                        ->make(true);
                }
            }
        }
        return view('Requerimientos.Requerimiento');

    }

    public function SearchMarcas(Request $request)
    {
        $query = $request->get('query');
        $results = array();

        $queries = DB::connection('EVPIUM')->table('Marcas')
            ->where('NombreMarca', 'LIKE', '%'.$query.'%')
            ->take(20)
            ->get();

        foreach ($queries as $q) {
            $results[] = [
                'value' =>  trim($q->NombreMarca),
            ];
        }
        return response()->json($results);
    }

    public function SearchProductsMax(Request $request)
    {
        $query = $request->get('query');
        $results = array();

        $queries = DB::connection('MAX')->table('CIEV_V_Inventario')
            ->where('Descripcion', 'LIKE', '%'.$query.'%')
            ->orWhere('Pieza', 'LIKE', '%'.$query.'%')->take(10)
            ->get();

        foreach ($queries as $q) {
            $results[] = [
                'value' => trim($q->Descripcion),
            ];
        }
        return response()->json($results);
    }

    public function getlineas(Request $request)
    {
        if ($request->ajax()){
            $getlineas = DB::table('cod_lineas')->get();
            foreach ($getlineas as $linea){
                $getlineasArray[$linea->id] = $linea->name;
            }
            return response()->json($getlineasArray);
        }
    }

    public function getsublineas(Request $request)
    {
        if ($request->ajax()){
            $getsublineas = DB::table('cod_sublineas')
                ->where('lineas_id','=',$request->lineas_id)
                ->get();
            foreach ($getsublineas as $sblinea){
                $getsublineasArray[$sblinea->id] = $sblinea->name;
            }
            return response()->json($getsublineasArray);
        }
    }

    public function GetDescription(Request $request){
        $linea = DB::table('cod_lineas')->where('id','=',$request->linea)->select('abreviatura')->get();
        $sublinea = DB::table('cod_sublineas')->where('id','=',$request->sublinea)->select('abreviatura')->get();
        $caracteristica = DB::table('cod_caracteristicas')->where('id','=',$request->caracteristica)->select('abreviatura')->get();
        $material = DB::table('cod_materials')->where('id','=',$request->material)->select('abreviatura')->get();
        $medida = DB::table('cod_medidas')->where('id','=',$request->medida)->select('denominacion')->get();

        $data = $linea[0]->abreviatura.' '.$sublinea[0]->abreviatura.' '.$caracteristica[0]->abreviatura.' '.$material[0]->abreviatura.' '.$medida[0]->denominacion;

        return response()->json($data);
    }

    public function NewRequerimiento(Request $request)
    {
        $requerimiento = DB::table('encabezado_requerimientos')->insertGetId([
            'producto'      => $request->Producto,
            'informacion'   => $request->Informacion,
            'vendedor_id'   => $request->Vendedor,
            'cliente'       => $request->Cliente,
            'marca'         => $request->Marca,
            'render'        => $request->Render,
            'estado'        => '2',
            'created_at'    => Carbon::now(),
            'Updated_at'    => Carbon::now(),
            'usuario'       => $request->Creado
        ]);

        DB::table('transacciones_requerimientos')->insert([
            'idReq'         =>  $requerimiento,
            'tipo'          => 'Nuevo Requerimiento',
            'descripcion'   => 'se creo un nuevo requerimiento',
            'usuario'       => $request->Creado,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);

        DB::table('transacciones_requerimientos')->insert([
            'idReq'         =>  $requerimiento,
            'tipo'          =>  'Cambio de estado',
            'descripcion'   =>  'Requerimiento enviado para revision.',
            'usuario'       =>  'System',
            'created_at'    =>  Carbon::now(),
            'updated_at'    =>  Carbon::now()
        ]);


        $path = public_path().'/requerimientos/'.$requerimiento;
        File::makeDirectory($path, $mode= 0777, true,true);
    }

    public function RequerimientoSaveFile(Request $request)
    {
        dd($request);
        /*File::makeDirectory('/path/to/directory');*/
        $imageName = $request->file->getClientOriginalName();
        $request->file->move(public_path('upload'), $imageName);

        return response()->json(['uploaded' => '/upload/'.$imageName]);
    }

    public function GetDisenador(Request $request)
    {
        if ($request->ajax()){
            $diseñador =  DB::table('users')->where('cod_designer','<>',null)->get();
        }
        return response()->json($diseñador);
    }

    public function AsignarDisenador(Request $request)
    {
        DB::table('encabezado_requerimientos')->where('id','=',$request->id_requerimiento)->update([
            'diseñador_id'  => $request->Usuario_diseñador,
            'estado'        => '3'
        ]);

        $ObtenerNombre = DB::table('users')->where('cod_designer','=',$request->Usuario_diseñador)->select('name')->get();

        DB::table('transacciones_requerimientos')->insert([
            'idReq'         => $request->id_requerimiento,
            'tipo'          => 'Aprobacion de requerimiento',
            'descripcion'   => 'Requerimiento aprobado',
            'usuario'       => $request->User,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);

        DB::table('transacciones_requerimientos')->insert([
            'idReq'         => $request->id_requerimiento,
            'tipo'          => 'Asignacion de requerimiento',
            'descripcion'   => 'Requerimiento asignado a '.$ObtenerNombre[0]->name,
            'usuario'       => $request->User,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);

    }

    public function MisRequerimientos(Request $request)
    {
        if ($request->ajax()){
            $data =  DB::table('encabezado_requerimientos')
                ->leftJoin('users','encabezado_requerimientos.diseñador_id','=','users.cod_designer')
                ->where('usuario','=',$request->Username)
                ->select('encabezado_requerimientos.id','encabezado_requerimientos.producto','encabezado_requerimientos.informacion',
                    'encabezado_requerimientos.marca','encabezado_requerimientos.usuario','encabezado_requerimientos.estado','encabezado_requerimientos.created_at',
                    'encabezado_requerimientos.updated_at','users.name')
                ->orderBy('estado', 'desc')
                ->get();
            return Datatables::of($data)
                ->addColumn('opciones', function($row){
                    $btn = '<div class="btn-group ml-auto">'.'<button class="btn btn-light btn-sm addComment " name="addComment" id="'.$row->id.'" ><i class="fas fa-comments"></i></button>';
                    $btn = $btn.'<button class="btn btn-light btn-sm Anular " name="Anular" id="'.$row->id.'" ><i class="fas fa-ban"></i></button>';
                    $btn = $btn.'<button class="btn btn-light btn-sm Coments " name="Coments" id="'.$row->id.'" ><i class="fas fa-eye"></i></button>'.'</div>';
                    return $btn;
                })
                ->rawColumns(['opciones'])
                ->make(true);
        }
        return view('Requerimientos.mis_requerimientos');
    }

    public function MisRequerimientosAddComent(Request $request)
    {
        DB::table('transacciones_requerimientos')->insert([
            'idReq'         => $request->idReq,
            'tipo'          => 'Comentario',
            'descripcion'   => $request->coments,
            'usuario'       => $request->user,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
    }

    public function MisRequerimientosAnular(Request $request)
    {
        DB::table('encabezado_requerimientos')->where('id','=',$request->id)->update([
            'estado'        => '3'
        ]);

        DB::table('transacciones_requerimientos')->insert([
            'idReq'         => $request->id,
            'tipo'          => 'Anular',
            'descripcion'   => 'El Usuario '.$request->Username.' anulo el requerimiento.',
            'usuario'       => $request->Username,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
    }

    public function RequerimientosComentariosDetalles(Request $request)
    {
        $datos = DB::table('transacciones_requerimientos')->where('idReq','=',$request->id)->get();

        $encabezado = DB::table('encabezado_requerimientos')->where('id','=',$request->id)->get();

        $propuestasReq = DB::table('propuestas_requerimientos')->where('idRequerimiento','=',$request->id)->get();

        return response()->json(['Datos' => $datos,'encabezado' => $encabezado,'propuestas' => $propuestasReq]);
    }

    public function VerRequerimiento($numero)
    {
        $var = $numero;
        return view('Requerimientos.ficha_tecnica', ["var" => $var] );
    }

    public function CambiarEstadoRequeEd(Request $request)
    {
        DB::table('encabezado_requerimientos')->where('id','=',$request->id)->update([
            'estado' => $request->result['value'][0]['state']
        ]);

        DB::table('transacciones_requerimientos')->insert([
            'idReq'         => $request->id,
            'tipo'          => 'Cambio de estado',
            'descripcion'   => 'El Usuario '.$request->Username.' Cambio el estado del requerimiento.',
            'usuario'       => $request->Username,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
    }

    public function ObtenerDiseñadores(Request $request)
    {
        $valores = DB::table('users')
            ->where('cod_designer','<>', null)
            ->select('name','cod_designer')->get();

        $Array = [];
        foreach ($valores as $val){
            $Array[$val->cod_designer] = $val->name;
        }

        return response()->json($Array);
    }

    public function CambiarDiseñadorRequeEd(Request $request)
    {
        DB::table('encabezado_requerimientos')->where('id','=',$request->id)->update([
            'diseñador_id' => $request->result['value']
        ]);

        DB::table('transacciones_requerimientos')->insert([
            'idReq'         => $request->id,
            'tipo'          => 'Cambio de diseñador',
            'descripcion'   => 'El Usuario '.$request->Username.' Cambio el diseñador asignado al requerimiento.',
            'usuario'       => $request->Username,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
    }

    public function GuardarPropuestaReq(Request $request)
    {
        DB::table('propuestas_requerimientos')->insertGetId([
            'idRequerimiento'   =>  $request->id,
            'articulo'          =>  $request->result['value'][0]['Articulo'],
            'relieve'           =>  $request->result['value'][0]['Relieve'],
            'usuario'           =>  $request->Username,
            'estado'            =>  '1',
            'created_at'        =>  Carbon::now(),
            'updated_at'        =>  Carbon::now()
        ]);

        DB::table('transacciones_requerimientos')->insert([
            'idReq'         =>  $request->id,
            'tipo'          =>  'Nueva propuesta',
            'descripcion'   =>  'El Usuario '.$request->Username.' Creo una nueva propuesta.',
            'usuario'       =>  $request->Username,
            'created_at'    =>  Carbon::now(),
            'updated_at'    =>  Carbon::now()
        ]);
    }

    public function ListaPropuestaReq(Request $request)
    {
        $data = DB::table('propuestas_requerimientos')
            ->where('idRequerimiento','=',$request->id)
            ->get();

        return DataTables::of($data)
        ->addColumn('opciones', function($row){
            $btn = '<div class="btn-group ml-auto">'.'<button class="btn btn-light btn-sm Crear2D" name="Crear2D" id="'.$row->id.'"><i class="fas fa-cube"></i> 2D</button>';
            $btn = $btn.'<button class="btn btn-light btn-sm Crear3D" name="Crear3D" id="'.$row->id.'"><i class="fas fa-cubes"></i> 3D</button>';
            $btn = $btn.'<button class="btn btn-light btn-sm CrearPlano" name="CrearPlano" id="'.$row->id.'"><i class="far fa-file"></i> Plano</button>'.'</div>';
            return $btn;
        })
        ->rawColumns(['opciones'])
        ->make(true);
    }

    public function Upload2DReq(Request $request)
    {
        if ($request->hasFile('fileToUpload')) {
            $files = $request->file('fileToUpload');
            $destinationPath = 'requerimientos/'.'RQ-'.$request->Numero.'/propuestas/'.'PP-'.$request->Prop.'/2D/';
            $profilefile = $request->Prop.'.'.$files->getClientOriginalExtension(); /*$files->getClientOriginalName()*/;
            $files->move($destinationPath, $profilefile);
            $insert['fileToUpload'] = "$profilefile";
            /*$file_name = $request->file('fileToUpload')->getClientOriginalName();
            $earn_proof = $request->file('fileToUpload')->storeAs("requerimientos"/*.$request->id."/"*/
        }
        return response()->json(['result' => true], 200);
    }

    public function Upload3DReq(Request $request)
    {
        if ($request->hasFile('fileToUpload')) {
            $files = $request->file('fileToUpload');
            $destinationPath = 'requerimientos/'.'RQ-'.$request->Numero.'/propuestas/'.'PP-'.$request->Prop.'/3D/';
            $profilefile = $request->Prop.'.'.$files->getClientOriginalExtension(); /*$files->getClientOriginalName()*/;
            $files->move($destinationPath, $profilefile);
            $insert['fileToUpload'] = "$profilefile";
            /*$file_name = $request->file('fileToUpload')->getClientOriginalName();
            $earn_proof = $request->file('fileToUpload')->storeAs("requerimientos"/*.$request->id."/"*/
        }
        return response()->json(['result' => true], 200);
    }

    public function UploadPlanoReq(Request $request)
    {
        if ($request->hasFile('fileToUpload')) {
            $files = $request->file('fileToUpload');
            $destinationPath = 'requerimientos/'.'RQ-'.$request->Numero.'/propuestas/'.'PP-'.$request->Prop.'/Plano/';
            $profilefile = $request->Prop.'.'.$files->getClientOriginalExtension(); /*$files->getClientOriginalName()*/;
            $files->move($destinationPath, $profilefile);
            $insert['fileToUpload'] = "$profilefile";
            /*$file_name = $request->file('fileToUpload')->getClientOriginalName();
            $earn_proof = $request->file('fileToUpload')->storeAs("requerimientos"/*.$request->id."/"*/
        }
        return response()->json(['result' => true], 200);
    }

    public function UploadfilesSupport(Request $request)
    {
        //
    }




}
