@extends('layouts.dashboard')

@section('page_title', 'Codigos')

@section('module_title', 'Lista de Codigos')

@section('subtitle', 'Este modulo permite ver, crear y editar Codigos.')

@section('breadcrumbs')
    {{ Breadcrumbs::render('Prod_ciev_codigos') }}
@stop
@section('content')
    @inject('TipoProductos','App\Services\TipoProductos')
    @can('codificador.view')
    <div class="col-lg-4">
        <div class="form-group">
            @can('codificador.new')
            <a class="btn btn-primary" href="javascript:void(0)" id="CrearCodigo">Crear Codigo</a>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped first data-table">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Descripcion</th>
                                    <th>Tipo Producto</th>
                                    <th>Linea</th>
                                    <th>Sublinea</th>
                                    <th>Medida</th>
                                    <th>Caracteristica</th>
                                    <th>Material</th>
                                    <th>Comentarios</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @extends('ProductosCIEV.Codificador.modal')
    @else
        <div class="alert alert-danger" role="alert">
            No tienes permisos para visualizar el Codificador.
        </div>
    @endcan

    @push('javascript')
        <script type="text/javascript" src="/JsGlobal/Codificador/Codificador.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    @endpush
@endsection
