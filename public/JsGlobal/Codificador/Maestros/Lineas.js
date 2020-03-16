$(document).ready(function() {
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/LineasIndex",
            columns: [
                {data: 'tp', name: 'tp'},
                {data: 'cod', name: 'cod'},
                {data: 'name', name: 'name'},
                {data: 'abrev', name: 'abrev'},
                {data: 'coment', name: 'coment'},
                {data: 'update', name: 'update'},
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

        $('body').on('click','.CrearLineas', function () {
            $('#lineaForm').trigger("reset");
            $('#saveBtn').val("create-linea");
            $('#linea_id').val('');
            $('#modelHeading').html("NUEVA LINEA");
            $('#Lineamodal').modal('show');
            document.getElementById("codigo").readOnly = false;

            jQuery.extend(jQuery.validator.messages, {
                required: "Este campo es obligatorio.",
                remote: "Este codigo ya existe.",
                email: "Por favor, escribe una dirección de correo válida",
                url: "Por favor, escribe una URL válida.",
                date: "Por favor, escribe una fecha válida.",
                dateISO: "Por favor, escribe una fecha (ISO) válida.",
                number: "Por favor, escribe un número entero válido.",
                digits: "Por favor, escribe sólo dígitos.",
                creditcard: "Por favor, escribe un número de tarjeta válido.",
                equalTo: "Por favor, escribe el mismo valor de nuevo.",
                accept: "Por favor, escribe un valor con una extensión aceptada.",
                maxlength: jQuery.validator.format("Por favor, no escribas más de {0} caracteres."),
                minlength: jQuery.validator.format("Por favor, no escribas menos de {0} caracteres."),
                rangelength: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
                range: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1}."),
                max: jQuery.validator.format("Por favor, escribe un valor menor o igual a {0}."),
                min: jQuery.validator.format("Por favor, escribe un valor mayor o igual a {0}."),
                selectcheck: "Por favor seleccione una opcion!"
            });

            jQuery.validator.addMethod("selectcheck", function (value) {
                return (value != '');
            }, "Por favor, seleciona una opcion.");

            $("#lineaForm").validate({
                ignore: "",
                rules: {
                    tipoproducto_id: {
                        selectcheck: true
                    },
                    codigo: {
                        remote: {
                            url: '/GetUniqueCodLines',
                            type: 'POST',
                            data: {
                                'codigo': function () {
                                    return $('#codigo').val();
                                }
                            },
                            dataType: 'json',
                            async: false,
                        },
                        required: true,
                        minlength: 1,
                        maxlength: 2,
                    },
                    name: "required",
                    abreviatura: "required",
                },
                highlight: function (element) {
                    $(element).closest('.form-control').removeClass('is-valid').addClass('is-invalid');
                },
                unhighlight: function (element) {
                    $(element).closest('.form-control').removeClass('is-invalid');
                },
                submitHandler: function (form) {
                    $(this).html('Guardando...');
                    $.ajax({
                        data: $('#lineaForm').serialize(),
                        url: "/LineasPost",
                        type: "POST",
                        dataType: 'json',
                        success: function () {
                            $('#lineaForm').trigger("reset");
                            $('#Lineamodal').modal('hide');
                            table.draw();
                            swal.fire({
                                title: 'Guardado!',
                                text: "¡Registro guardado con exito!",
                                icon: 'success',
                            })
                        },
                        error: function (data) {
                            console.log('Error:', data);
                            $('#saveBtn').html('Guardar Cambios');
                        }
                    });
                }
            });
        });

        var linea_id;
        $('body').on('click', '.editLinea', function () {
            document.getElementById("codigo").readOnly = true;
            $('#edit_lineaForm').trigger("reset");
            linea_id = $(this).data('id');
            $.get("/ProdCievCod" + '/' + linea_id + '/edit', function (data) {
                $('#edit_modalHeading').html("Editar " + data.name );
                $('#saveBtn').val("edit-linea");
                $('#edit_linea_modal').modal('show');
              //  $('#edor_linea_id').val(data.id);
                $('#edit_codigo').val(data.cod);
                $('#edit_tipoproducto_id').val(data.tipoproducto_id);
                $('#edit_name').val(data.name);
                $('#edit_abreviatura').val(data.abreviatura);
                $('#edit_coments').val(data.coments);
            });
            jQuery.extend(jQuery.validator.messages, {
                required: "Este campo es obligatorio.",
                remote: "Este codigo ya existe.",
                email: "Por favor, escribe una dirección de correo válida",
                url: "Por favor, escribe una URL válida.",
                date: "Por favor, escribe una fecha válida.",
                dateISO: "Por favor, escribe una fecha (ISO) válida.",
                number: "Por favor, escribe un número entero válido.",
                digits: "Por favor, escribe sólo dígitos.",
                creditcard: "Por favor, escribe un número de tarjeta válido.",
                equalTo: "Por favor, escribe el mismo valor de nuevo.",
                accept: "Por favor, escribe un valor con una extensión aceptada.",
                maxlength: jQuery.validator.format("Por favor, no escribas más de {0} caracteres."),
                minlength: jQuery.validator.format("Por favor, no escribas menos de {0} caracteres."),
                rangelength: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
                range: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1}."),
                max: jQuery.validator.format("Por favor, escribe un valor menor o igual a {0}."),
                min: jQuery.validator.format("Por favor, escribe un valor mayor o igual a {0}."),
                selectcheck: "Por favor seleccione una opcion!"
            });

            jQuery.validator.addMethod("selectcheck", function (value) {
                return (value != '');
            }, "Por favor, seleciona una opcion.");

            $("#lineaForm").validate({
                ignore: "",
                rules: {
                    tipoproducto_id: {
                        selectcheck: true
                    },
                    codigo: {
                        required: true,
                        minlength: 1,
                        maxlength: 2,
                    },
                    name: "required",
                    abreviatura: "required",
                },
                highlight: function (element) {
                    $(element).closest('.form-control').removeClass('is-valid').addClass('is-invalid');
                },
                unhighlight: function (element) {
                    $(element).closest('.form-control').removeClass('is-invalid');
                },
                submitHandler: function (form) {
                    $(this).html('Guardando...');
                    $.ajax({
                        data: $('#lineaForm').serialize(),
                        url: "/LineasPost",
                        type: "POST",
                        dataType: 'json',
                        success: function () {
                            $('#lineaForm').trigger("reset");
                            $('#Lineamodal').modal('hide');
                            table.draw();
                            swal.fire({
                                title: 'Guardado!',
                                text: "¡Registro guardado con exito!",
                                icon: 'success',
                            })
                        },
                        error: function (data) {
                            console.log('Error:', data);
                            $('#saveBtn').html('Guardar Cambios');
                        }
                    });
                }
            });
        });

        $('body').on('click', '.deleteLinea', function () {
            var linea_id = $(this).data("id");
            Swal.fire({
                title: '¿Esta seguro de Eliminar?',
                text: "¡Esta accion no se puede revertir!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "DELETE",
                        url: "ProdCievCod" + '/' + linea_id,
                        success: function (data) {
                            Swal.fire({
                                title: 'Eliminado!',
                                text: "El registro ha sido eliminado.",
                                icon: 'success',
                            });
                            table.draw();
                        },
                        error: function (data) {
                            Swal.fire(
                                'Error al eliminar!',
                                'Hubo un error al eliminar. Verifique que este registro no tenga Sublineas relacionadas, si el problema persiste contacte con el area de sistemas',
                                'error'
                            )
                        }
                    });
                } else  {
                    result.dismiss === Swal.DismissReason.cancel
                }
            })
        });

        $('#Lineamodal').on('hide.bs.modal', function (event) {
            $('#saveBtn').html('Guardar');
            $('.form-control').removeClass('is-invalid');
            $('.error').remove();
            $('#lineaForm').trigger("reset");
        });


        $("#edit_lineaForm").validate({
            ignore: "",
            rules: {
                tipoproducto_id: {
                    selectcheck: true
                },
                name: "required",
                abreviatura: "required",
            },
            highlight: function (element) {
                $(element).closest('.form-control').removeClass('is-valid').addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).closest('.form-control').removeClass('is-invalid');
            },
            submitHandler: function (form) {
                $(this).html('Guardando...');
                var form_data = $('#edit_lineaForm').serializeArray();
                var id = {
                    name: 'id',
                    value:  linea_id
                };
                form_data.push(id);

                $.ajax({
                    data: form_data,
                    url: "/lines_update",
                    type: "POST",
                    dataType: 'json',
                    success: function () {
                        $('#edit_lineaForm').trigger("reset");
                        $('#edit_linea_modal').modal('hide');
                        table.draw();
                        swal.fire({
                            title: 'Guardado!',
                            text: "¡Registro guardado con exito!",
                            icon: 'success',
                        })
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Guardar Cambios');
                    }
                });
            }
        });
    });
});
