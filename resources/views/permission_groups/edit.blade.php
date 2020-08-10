@extends('layouts.architectui')

@section('page_title', 'Modificar grupo de permisos')

@section('action_recaptcha')
    {!! htmlScriptTagJsApi([ 'action' => 'permisos_grupo_permisos_editar' ]) !!}
@endsection

@section('content')
    @can('permission_groups.edit')
    <form action="{{ route('permission_groups.update', $permissionGroup->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="section-block" id="basicform">
                    <h3 class="section-title">Modificar grupo de permisos</h3>
                    <p>Este formulario te ayudará a actualizar la información de un grupo de permisos existente en la aplicación.</p>
                </div>
                <div class="card">
                    <h5 class="card-header">Modificar grupo de permisos: {{ $permissionGroup->name }}</h5>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Nombre del usuario <span class="text-secondary">*</span></label>
                            <input id="u_name" name="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $permissionGroup->name }}">

                            @if ($errors->has('name'))
                            <div class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body border-top">
                        <h4>Permisos asociados ({{ $permissionGroup->permissions->count() }})</h4>
                        <div class="row">
                            @forelse ($permissionGroup->permissions as $groupPermission)
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6">
                                <label class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="assigned_perms[]" value="{{ $groupPermission->id }}" checked>
                                    <span class="custom-control-label">{{ $groupPermission->description ?: 'Sin descripción' }}</span>
                                </label>
                            </div>
                            @empty
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <p class="card-text">Este grupo no cuenta con permisos asociados.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="card-body border-top">
                        <h4>Permisos disponibles ({{ $availablePermissions->count() }})</h4>
                        <div class="row">
                            @forelse ($availablePermissions as $id => $description)
                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6">
                                <label class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="avail_perms[]" value="{{ $id }}">
                                    <span class="custom-control-label">{{ $description ?: 'Sin descripción' }}</span>
                                </label>
                            </div>
                            @empty
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <p class="card-text">No hay permisos disponibles para asociar al grupo.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-sm-12 pl-0">
                            <p class="text-right">
                                <a href="{{ route('permission_groups.index') }}" class="btn btn-sm btn-secondary" role="button">Volver</a>
                                <button class="btn btn-sm btn-primary" type="submit">Guardar cambios</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @else
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-exclamation-triangle fa-4x" style="color: red"></i>
                <h3 class="card-title" style="color: red"> ACCESO DENEGADO </h3>
                <h3 class="card-text" style="color: red">No tiene permiso para usar esta aplicación, por favor comuníquese a la ext: 102 o escribanos al correo electrónico: auxsistemas@estradavelasquez.com para obtener acceso.</h3>
            </div>
        </div>
    @endcan
@stop
