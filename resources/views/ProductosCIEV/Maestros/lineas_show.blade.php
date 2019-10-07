@extends('layouts.dashboard')

@section('page_title', 'Maestros')

@section('module_title', 'Lineas')

@section('subtitle', 'sbutitulo.')

@section('breadcrumbs')
    {{ Breadcrumbs::render('Prod_ciev_maestros_lineas') }}
@stop

@section('content')
    @inject('TipoProductos','App\Services\TipoProductos')
    <div class="col-lg-4">
        <div class="form-group">
            <a class="btn btn-primary" href="javascript:void(0)" id="CrearLineas">Crear Nueva Linea</a>
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
                                <th>#</th>
                                <th>Tipo de Producto</th>
                                <th>Codigo de linea</th>
                                <th>Nombre</th>
                                <th>Abreviatura</th>
                                <th>Comentarios</th>
                                <th width="280px">Opciones</th>
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
                            <label for="name" class="col-sm-6 control-label">Tipo de Producto:</label>
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
                            <label for="name" class="col-sm-6 control-label">Codigo de Linea:</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="cod" name="cod" placeholder="Enter value" value="" maxlength="50" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nombre:</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Abreviatura:</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="abreviatura" name="abreviatura" placeholder="Enter Name" value="" maxlength="50" required="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Comentarios:</label>
                            <div class="col-sm-12">
                                <textarea id="coments" name="coments" required="" placeholder="Enter Details" class="form-control"> </textarea>
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


    @push('javascript')
        <script type="text/javascript">
            $(function () {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var table = $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('ProdCievCod.index') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'tipoproducto_id', name: 'tipoproducto_id'},
                        {data: 'cod', name: 'cod'},
                        {data: 'name', name: 'name'},
                        {data: 'abreviatura', name: 'abreviatura'},
                        {data: 'coments', name: 'coments'},
                        {data: 'opciones', name: 'opciones', orderable: false, searchable: false},
                    ],
                    language: {
                        // traduccion de datatables
                        processing: "Procesando...",
                        search: "Buscar&nbsp;:",
                        lengthMenu: "Mostrar _MENU_ registros",
                        info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                        infoFiltered: "(filtrado de un total de _MAX_ registros)",
                        infoPostFix: "",
                        loadingRecords: "Cargando...",
                        zeroRecords: "No se encontraron resultados",
                        emptyTable: "Ningún registro disponible en esta tabla :C",
                        paginate: {
                            first: "Primero",
                            previous: "Anterior",
                            next: "Siguiente",
                            last: "Ultimo"
                        },
                        aria: {
                            sortAscending: ": Activar para ordenar la columna de manera ascendente",
                            sortDescending: ": Activar para ordenar la columna de manera descendente"
                        }
                    }
                });

                $('#CrearLineas').click(function () {
                    $('#saveBtn').val("create-linea");
                    $('#linea_id').val('');
                    $('#lineaForm').trigger("reset");
                    $('#modelHeading').html("Crear Nueva Linea");
                    $('#Lineamodal').modal('show');
                });

                $('body').on('click', '.editLinea', function () {

                    var linea_id = $(this).data('id');
                    $.get("{{ route('ProdCievCod.index') }}" +'/' + linea_id +'/edit', function (data) {
                        $('#modelHeading').html("Editar Linea");
                        $('#saveBtn').val("edit-linea");
                        $('#Lineamodal').modal('show');
                        $('#linea_id').val(data.id);
                        $('#cod').val(data.cod);
                        $('#tipoproducto_id').val(data.tipoproducto_id);
                        $('#name').val(data.name);
                        $('#abreviatura').val(data.abreviatura);
                        $('#coments').val(data.coments);
                    })
                });


                $('#saveBtn').click(function (e) {
                    e.preventDefault();
                    //$(this).html('Guardando...');
                    $.ajax({
                        data: $('#lineaForm').serialize(),
                        url: "{{ route('ProdCievCod.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {

                            $('#lineaForm').trigger("reset");
                            $('#Lineamodal').modal('hide');
                            table.draw();
                            toastr.success("Registro Guardado con Exito!");
                         //   $(this).html('Crear');
                        },
                        error: function (data) {
                            console.log('Error:', data);
                            $('#saveBtn').html('Guardar Cambios');
                        }
                    });
                });

                $('body').on('click', '.deleteLinea', function () {

                    var linea_id = $(this).data("id");
                    if(confirm("¿Esta seguro de Eliminar?")) {
                         $.ajax({
                             type: "DELETE",
                             url: "{{ route('ProdCievCod.store') }}" + '/' + linea_id,
                             success: function (data) {
                                 table.draw();
                                 toastr.success("Registro Eliminado con exito");
                             },
                             error: function (data) {
                                 console.log('Error:', data);
                                 toastr.danger("Error al eliminar el registro");
                             }
                         });
                    }
                });
            });
        </script>
        {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />--}}
        {{--<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">--}}
        {{--<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">--}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    @endpush
@endsection

