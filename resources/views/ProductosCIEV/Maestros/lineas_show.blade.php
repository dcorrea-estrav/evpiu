@extends('layouts.architectui')

@section('page_title', 'Maestros (Lineas)')

@section('module_title', 'Lineas')

@section('subtitle', 'Subdivisión de los tipos de productos y se definen según su aplicabilidad en el en el entorno productivo y comercial.')

@section('content')
    @inject('TipoProductos','App\Services\TipoProductos')
    @can('maestro.linea.view')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-0 float-right">
                        @can('lineas.new')
                            <a class="btn btn-primary CrearLineas" href="javascript:void(0)" id="CrearLineas"><i class="fas fa-plus-circle"></i> Nuevo</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped first data-table">
                            <thead>
                                <tr>
                                    <th>TIPO DE PRODUCTO</th>
                                    <th>CODIGO</th>
                                    <th>NOMBRE</th>
                                    <th>ABREVIATURA</th>
                                    <th>COMENTARIOS</th>
                                    <th>ACTUALIZADO</th>
                                    <th>ACCIONES</th>
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
    @else
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-exclamation-triangle fa-4x" style="color: red"></i>
                <h3 class="card-title" style="color: red"> ACCESO DENEGADO </h3>
                <h3 class="card-text" style="color: red">No tiene permiso para usar esta aplicación, por favor comuníquese a la ext: 102 o escribanos al correo electrónico: auxsistemas@estradavelasquez.com para obtener acceso.</h3>
            </div>
        </div>
    @endcan

    @push('javascript')
        <script type="text/javascript" src="/JsGlobal/Codificador/Maestros/Lineas.js"></script>
    @endpush
@endsection
@section('modal')
    <div class="modal fade" id="Lineamodal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="lineaForm" name="lineaForm" class="form-horizontal">
                    <div class="modal-body">
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
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="Crear">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal animated slideInDown" id="edit_linea_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="edit_modalHeading"> </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit_lineaForm" name="edit_lineaForm" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_tipoproducto_id" class="col-sm-6 control-label">Tipo de producto:</label>
                            <div class="col-sm-12">
                                <select class="form-control" name="edit_tipoproducto_id" id="edit_tipoproducto_id" >
                                    @foreach( $TipoProductos->get() as $index => $TipoProducto)
                                        <option value="{{ $index }}" {{ old('edit_TipoProducto_id') == $index ? 'selected' : ''}}>
                                            {{ $TipoProducto }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-6 control-label">Codigo:</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="edit_codigo" name="edit_codigo" disabled onkeyup="this.value=this.value.toUpperCase();">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nombre:</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="edit_name" name="edit_name" onkeyup="this.value=this.value.toUpperCase();">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Abreviatura:</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="edit_abreviatura" name="edit_abreviatura" onkeyup="this.value=this.value.toUpperCase();">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Comentarios:</label>
                            <div class="col-sm-12">
                                <textarea id="edit_coments" name="edit_coments"  class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="saveBtnEdit">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
