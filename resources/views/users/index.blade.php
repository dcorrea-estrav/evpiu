@extends('layouts.architectui')

@section('page_title', 'Usuarios')

@section('action_recaptcha')
    {!! htmlScriptTagJsApi([ 'action' => 'usuarios' ]) !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped first">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>E-mail</th>
                                    <th>Nick</th>
                                    <th>Creado en</th>
                                    <th>Actualizado en</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->created_at->format('d M Y h:i:s') }}</td>
                                    <td>{{ $user->updated_at->format('d M Y h:i:s') }}</td>
                                    <td>
                                        <div class="btn-group ml-auto float-right">
                                            @can('users.list')
                                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-outline-light">
                                                <i class="fas fa-eye"></i> Ver
                                            </a>
                                            @endcan
                                            @can('users.edit')
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-light">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @endcan
                                            @can('users.destroy')
                                            <div class="btn btn-sm btn-outline-light delete" data-id="{{ $user->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </div>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('modal')
    @can('users.destroy')
        <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fas fa-trash"></i> Eliminar usuario</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>¿Estás seguro de que deseas eliminar este usuario?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="#" id="delete_form" method="POST">
                            @csrf
                            @method('delete')
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-danger delete-confirm"
                                   value="Sí, eliminar este usuario">
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    @endcan
@endsection
@push('javascript')
    <script>
        $(document).ready(function () {
            $('.table').DataTable({
                "order": [],
                "columns": [
                    { "orderable": true, "searchable": false },
                    { "orderable": true, "searchable": true },
                    { "orderable": true, "searchable": true },
                    { "orderable": true, "searchable": true },
                    { "orderable": true, "searchable": false },
                    { "orderable": true, "searchable": false },
                    { "orderable": false, "searchable": false },
                ]
            });
        });

        $('td').on('click', '.delete', function (e) {
            $('#delete_form')[0].action = '{{ route('users.destroy', ['user' => '__user']) }}'.replace('__user', $(this).data('id'));

            $('#delete_modal').modal('show');
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

@endpush
