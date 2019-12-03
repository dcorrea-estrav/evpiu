@extends('layouts.dashboard')

@section('page_title', 'Maestros (Lineas)')

@section('module_title', 'Lineas')

@section('subtitle', 'Subdivisión de los tipos de productos y se definen según su aplicabilidad en el en el entorno productivo y comercial.')

@section('breadcrumbs')
    {{ Breadcrumbs::render('Prod_ciev_maestros_lineas') }}
@stop

@section('content')
    @inject('TipoProductos','App\Services\TipoProductos')
    @can('maestro.linea.view')
    <div class="col-lg-4">
        <div class="form-group">
            @can('lineas.new')
            <a class="btn btn-primary CrearLineas" href="javascript:void(0)" id="CrearLineas">Nuevo</a>
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
                                    <th>Tipo de Producto</th>
                                    <th>Codigo de linea</th>
                                    <th>Nombre</th>
                                    <th>Abreviatura</th>
                                    <th>Comentarios</th>
                                    <th>Ultima Actualizacion</th>
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

    <div class="modal fade" id="Lineamodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="lineaForm" name="lineaForm" class="form-horizontal">
                        <input type="hidden" name="linea_id" id="linea_id">
                        <div class="form-group">
                            <label for="tipoproducto_id" class="col-sm-6 control-label">Tipo de Producto:</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="tipoproducto_id" id="tipoproducto_id" >
                                @foreach( $TipoProductos->get() as $index => $TipoProducto)
                                    <option value="{{ $index }}" {{ old('TipoProducto_id') == $index ? 'selected' : ''}}>
                                        {{ $TipoProducto }}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-6 control-label">Codigo:</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="codigo" name="codigo"  value="" onkeyup="this.value=this.value.toUpperCase();">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nombre:</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name"  value="" onkeyup="this.value=this.value.toUpperCase();">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Abreviatura:</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="abreviatura" name="abreviatura" value="" onkeyup="this.value=this.value.toUpperCase();">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Comentarios:</label>
                            <div class="col-sm-12">
                                <textarea id="coments" name="coments"  class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="Crear">Guardar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @else
        <div class="alert alert-danger" role="alert">
            No tienes permisos para visualizar las Lineas.
        </div>
    @endcan

    @push('javascript')
        <script type="text/javascript" src="/JsGlobal/Codificador/Maestros/Lineas.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.3.10/dist/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    @endpush
@endsection

