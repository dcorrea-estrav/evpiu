@extends('layouts.dashboard')

@section('page_title', 'Pronosticos')

@section('module_title', 'Pronosticos')

@section('subtitle', 'Este módulo permite ver los pronosticos de pedidos.')
{{--
@section('breadcrumbs')
    {{ Breadcrumbs::render('fact_electr_facturas') }}
@stop--}}

@section('content')
    @can('pronosticos.view')
        <div class="col-lg-12">
            <div class="form-group">
                <input type="hidden" value="3" id="Open">
                <input type="hidden" value="4" id="HideClose">
                <input type="hidden" value="5" id="Close">
                <input type="hidden" value="6" id="Anuld">
                <span><input type="button" class="btn btn-primary btn-sm" id="OpenBtn" value="¿Mostrar Abiertos?"></span>
                <span><input type="button" class="btn btn-primary btn-sm" id="OpenAndClose" value="¿Mostrar Completados?"></span>
                <span><input type="button" class="btn btn-danger btn-sm" id="CloseAnulBtn" value="¿Mostrar Cerrados y Anulados?"></span>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-responsive table-striped dataTable" id="table">
                                <thead>
                                    <tr>
                                        <th>Numero</th>
                                        <th>Fecha</th>
                                        <th>Referencia</th>
                                        <th>Descripcion</th>
                                        <th>Detalle</th>
                                        <th>Acabado</th>
                                        <th>Cantidad</th>
                                        <th>Cod. Cliente</th>
                                        <th>Cliente</th>
                                        <th>Estado</th>
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
        <div class="modal fade bd-modal-lg" id="Inventario" tabindex="-1" role="dialog" aria-labelledby="Inventario" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="InventarioTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="CodigoForm" name="CodigoForm" class="form-horizontal">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-responsive table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Referencia</th>
                                                            <th>Descripcion</th>
                                                            <th>Cant.Comprometida</th>
                                                            <th>Cant. Disponible</th>
                                                            <th>Total</th>
                                                            <th>Detalle x Lote</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td id="Referencia"></td>
                                                            <td id="Descripcion"></td>
                                                            <td id="CantComp"></td>
                                                            <td id="CantDisp"></td>
                                                            <td id="Total"></td>
                                                            <td id="Detail"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <br>
                        <div class="row" style="display: none" id="CantCompromet" >
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <span><h5>Cantidades Comprometidas</h5></span>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-responsive table-striped CantComprometTable1" id="CantComprometTable">
                                                <thead>
                                                    <tr>
                                                        <th>Orden de Venta</th>
                                                        <th>Cliente</th>
                                                        <th>Cant.Pedia</th>
                                                        <th>Cant.Enviada</th>
                                                        <th>Cant.Facturada</th>
                                                        <th>Pendiente</th>
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
                        <br>
                        <div class="row"  id="InvlotBod">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <span><h5>Detalles por Lote</h5></span>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-responsive table-striped InvlotBodTable1" id="InvlotBodTable">
                                                <thead>
                                                    <tr>
                                                        <th width="800px">Lote</th>
                                                        <th width="400px">Bodega</th>
                                                        <th>Cantidad</th>
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade bd-modal-lg" id="DetallePronostico" tabindex="-1" role="dialog" aria-labelledby="DetallePronostico" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="PronosticoTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="PronosticoForm" name="PronosticoForm" class="form-horizontal">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row" id="">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="name" class="control-label" ><b>Vendedor:&nbsp;&nbsp; </b></label>
                                                        <label class="control-label" id="Vendedor"></label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="name" class="control-label" ><b>Cliente:&nbsp;&nbsp; </b></label>
                                                        <label class="control-label" id="Cliente"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" id="data">

                                            </div>
                                        </div>
                                    </div>
                                    @can('pronosticos.close')
                                        <button class="btn btn-danger btn-sm" disabled>Cerrar Pronostico</button>
                                    @endcan
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-danger" role="alert">
            No tienes permisos para visualizar los pronosticos.
        </div>
    @endcan


    @push('javascript')
        <script>
            $(document).ready(function(){
                load_data();
                var table;

                function load_data(OpAndClo = '') {
                     table = $('#table').DataTable({
                        processing: true,
                        serverSide: true,
                        responsive: true,
                        autoWidth: true,
                        scrollY: false,
                        scrollX: false,
                        scrollCollapse: true,
                        paging: true,
                        columnDefs: [{
                            width: 200,
                            targets: 0
                        }],
                        fixedColumns: true,
                        ajax: {
                            url:'/PronosticosIndex',
                            data:{OpenAndClose:OpAndClo}
                        },
                        columns: [
                            {data: 'numero', name: 'numero', orderable: false, searchable: true,
                              render: function ( data, type, row ) {
                                return '<button  value="'+data+'" class="btn btn-link btn-sm btnNum" id="Num" >' + data + '</button>';},
                            },
                            {data: 'fecha', name: 'fecha', orderable: false, searchable: false},
                            {data: 'ref', name: 'ref', orderable: false, searchable: true,
                              render: function ( data, type, row ) {
                                return '<button  value="'+data+'" class="btn btn-link btn-sm btnRef" id="Ref" >' + data + '</button>';}
                            },
                            {data: 'descrip', name: 'descrip', orderable: false, searchable: false},
                            {data: 'detail', name: 'detail', orderable: false, searchable: false},
                            {data: 'acabado', name: 'acabado', orderable: false, searchable: false},
                            {data: 'cant', name: 'cant', orderable: false, searchable: false, render: $.fn.dataTable.render.number('.', ',', 0, '')},
                            {data: 'NumeroCli', name: 'NumeroCli', orderable: false, searchable: true},
                            {data: 'NombreCli', name: 'NombreCli', orderable: false, searchable: true},
                            {data: 'estado', name: 'estado', orderable: false, searchable: false},
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
                        },
                        rowCallback: function (row, data, index) {
                            if (data.estado == 5) {
                                $(row).find('td:eq(9)').html('<label class="alert-danger">Cancelado</label>');
                            }
                            if (data.estado == 4) {
                                $(row).find('td:eq(9)').html('<label class="alert-primary">Completado</label>');
                            }
                            if (data.estado == 3) {
                                $(row).find('td:eq(9)').html('<label class="alert-success">Abierto</label>');
                            }
                            if (data.estado == 6) {
                                $(row).find('td:eq(9)').html('<label class="alert-danger">Anulada</label>');
                            }
                        }
                     })
                }
                var OpAndClo;

                $('#OpenAndClose').click(function () {
                        OpAndClo = $('#HideClose').val();
                    if (OpAndClo != '') {
                        $('.dataTable').DataTable().destroy();
                        load_data(OpAndClo);
                    } else {
                        toastr.error("Error al consultar los pronosticos Cerrados.");
                    }
                });

                $('#OpenBtn').click(function () {
                        OpAndClo = $('#Open').val();
                    $('.dataTable').DataTable().destroy();
                        load_data(OpAndClo);
                });

                $('#CloseAnulBtn').click(function () {
                    OpAndClo = $('#Close').val();
                    $('.dataTable').DataTable().destroy();
                    load_data(OpAndClo);
                });

                $('body').on('click', '.btnRef', function () {
                    var value = $(this).val();
                    $.ajax({
                        type: "get",
                        url: '/PronosticosInventory',
                        data: {Valor: value},
                        success: function (data) {
                            var CantDisp = data[0].total - data[0].CantComp;
                            $('#InventarioTitle').html(value);
                            $('#Inventario').modal('show');
                            $('#Referencia').html(value);
                            $('#Descripcion').html(data[0].descripcion);
                            $('#CantComp').html('<button type="button" value="'+ value +'" class="btn btn-link btn-sm CantComp" id="CantComp">'+ data[0].CantComp + '</button>');
                            $('#CantDisp').html(CantDisp);
                            $('#Total').html(data[0].total);
                            $('#Detail').html('<button type="button" value="'+ value +'" class="btn btn-link btn-sm Detalle" id="Detalle">Ver</button>');
                        }
                    });
                });

                function CantComp(CantCompNum) {
                    $('.CantComprometTable1').DataTable({
                        processing: false,
                        serverSide: false,
                        searching: false,
                        paginate: false,
                        bInfo: false,
                        ajax: {
                            url:'/PronosticosCantCompr',
                            data:{Comprmetida: CantCompNum}
                        },
                        columns: [
                            {data: 'Ordvent', name: 'Ordvent', orderable: false, searchable: false},
                            {data: 'Client', name: 'Client', orderable: false, searchable: false},
                            {data: 'Pedida', name: 'Pedida', orderable: false, searchable: false},
                            {data: 'Enviada', name: 'Enviada', orderable: false, searchable: false},
                            {data: 'Factu', name: 'Factu', orderable: false, searchable: false},
                            {data: 'Pendi', name: 'Pendi', orderable: false, searchable: false},
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
                            emptyTable: "No se encontraron Cantidades Comprometidas para esta Referencia",
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
                        },
                    })
                }

                $('#CantComp').click(function () {
                    var CantCompNum = $('.CantComp').val();
                    console.log('Valor: '+ CantCompNum);
                    if(CantCompNum != '')
                    {
                        $('.CantComprometTable1').DataTable().destroy();
                        CantComp(CantCompNum);
                    }
                    else
                    {
                        alert('Fallo Dani')
                    }
                    if(document.getElementById('CantCompromet').style.display == "none"){
                        document.getElementById('CantCompromet').style.display = "block";
                    }else{
                        document.getElementById('CantCompromet').style.display = "none";
                    }
                });

                function CantLot(DetLot) {
                    $('.InvlotBodTable1').DataTable({
                        processing: false,
                        serverSide: false,
                        searching: false,
                        paginate: false,
                        bInfo: false,
                        ajax: {
                            url:'/PronosticosDetailsLots',
                            data:{Detalle: DetLot}
                        },
                        columns: [
                            {data: 'lote', name: 'lote', orderable: false, searchable: false},
                            {data: 'bodega', name: 'bodega', orderable: false, searchable: false},
                            {data: 'cantidad', name: 'cantidad', orderable: false, searchable: false},
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
                            emptyTable: "No se encontraron Cantidades Comprometidas para esta Referencia",
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
                    })
                }

                $('#Detail').click(function () {
                    var DetLot = $('.Detalle').val();
                    console.log('Valor1: '+ DetLot);
                    if(DetLot != '')
                    {
                        $('.InvlotBodTable1').DataTable().destroy();
                        CantLot(DetLot);
                    }
                    else
                    {
                        alert('Fallo Dani')
                    }
                    if(document.getElementById('InvlotBod').style.display == "none")
                    {
                        document.getElementById('InvlotBod').style.display = "block";
                    }else{
                        document.getElementById('InvlotBod').style.display = "none";
                    }
                });

            $('body').on('click', '.btnNum', function () {
                var value = $(this).val();
                $.ajax({
                    type: "get",
                    url: '/PronosticosPronostics',
                    data: {Numero: value},
                    success: function (data) {
                    	console.log(data);
                        $('#PronosticoTitle').html('Seguimiento pronostico: ' + value);
                        $('#DetallePronostico').modal('show');
                        $('#Vendedor').html(data[0].vendedor);
                        $('#Cliente').html(data[0].cliente);

                        var i = 0;
                        $(data).each(function () {
                            $('#data').append(' <div class="col-sm-4"><div class="form-group">' +
                              '<label for="name" class="control-label"><b>Orden de Produccion:&nbsp;&nbsp;</b></label>' +
                              '<label class="control-label" id="">'+ data[i].NumOrdProduct +'</label>' +
                              '</div></div><div class="col-sm-4"><div class="form-group">' +
                              '<label for="name" class="control-label"><b>Fecha de liberacion:&nbsp;&nbsp;</b></label>' +
                              '<label class="control-label" id="">'+ data[i].fechaliberacion +'</label>' +
                              '</div></div><div class="col-sm-4"><div class="form-group">' +
                              '<label for="name" class="control-label" ><b>Producto:&nbsp;&nbsp;</b></label>' +
                              '<label class="control-label" id="">'+ data[i].producto +'</label>' +
                              '</div></div><div class="col-sm-4"><div class="form-group">' +
                              '<label for="name" class="control-label" ><b>Estado de la Orden:&nbsp;&nbsp;</b></label>' +
                              '<label class="control-label" id="Estado"></label>' +
                              '</div></div><div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">' +
                              '<div class="card"><div class="card-body"><div class="table-responsive">' +
                              '<table class="table table-responsive table-striped" id="">' +
                              '<thead><tr>' +
                              '<th>Operacion</th>' +
                              '<th>Proceso</th>' +
                              '<th>Cant. en Proceso</th>' +
                              '<th>Completada</th>' +
                              '<th>Desechada</th>' +
                              '<th>Salida</th>' +
                              '<th>Entrega/Max</th>' +
                              '<th>Estado</th>' +
                              '</tr></thead>' +
                              '<tbody><tr>' +
                              '<td>'+ data[i].operacion +'</td>' +
                              '<td>'+ data[i].proceso +'</td>' +
                              '<td>'+ data[i].cantProceso +'</td>' +
                              '<td>'+ data[i].cantCompletada +'</td>' +
                              '<td>'+ data[i].cantDesechada +'</td>' +
                              '<td>'+ data[i].salida +'</td>' +
                              '<td>'+ data[i].entrega +'</td>' +
                              '<td>'+ data[i].estado +'</td>' +
                              '</tr> </tbody>' +
                              '</table></div>' +
                              '</div></div></div>');

                            i++;
                        });
                        $('#Descripcion').html();
                        $('#CantDisp').html();
                        $('#Total').html();
                    }
                });
            });
                $('#Inventario').on('show.bs.modal', function (event) {
                    document.getElementById('CantCompromet').style.display = "none";
                    document.getElementById('InvlotBod').style.display = "none";
                });
            });
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    @endpush
@stop
