<?php

namespace App\Http\Controllers;

use App\CodLinea;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProdCievCodController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CodLinea::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Editar" class="edit btn btn-primary btn-sm editLinea" id="edit-btn">Editar</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Eliminar" class="btn btn-danger btn-sm deleteLinea">Eliminar</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('ProductosCIEV.Maestros.lineas_show');
    }

    public function store(Request $request)
    {
        CodLinea::updateOrCreate(['id' => $request->linea_id],
            ['cod' => $request->cod ,'name' => $request->name, 'abreviatura' => $request->abreviatura, 'coments' => $request->coments,]);

        return response()->json(['success'=>'Linea Guardada Correctamente.']);
    }

    public function edit($id)
    {
        $codlinea = CodLinea::find($id);
        return response()->json($codlinea);
    }

    public function destroy($id)
    {
        CodLinea::find($id)->delete();

        return response()->json(['success'=>'Product deleted successfully.']);
    }


}
