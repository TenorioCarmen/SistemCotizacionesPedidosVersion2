@extends('template')

@section('title','Editar proveedor')

@push('css')

@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Editar Proveedor</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('proveedores.index')}}">Proveedores</a></li>
        <li class="breadcrumb-item active">Editar proveedor</li>
    </ol>


    <!-- Aquí se muestran los mensajes de error si existen -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="card text-bg-light">
        <form action="{{ route('proveedores.update',['proveedore'=>$proveedore->id]) }}" method="post">
            @method('PATCH')
            @csrf
            <div class="card-header">
                <p>Tipo de proveedor: <span class="fw-bold">{{ strtoupper($proveedore->persona->tipo_persona)}}</span></p>
                <input type="hidden" name="tipo_persona" value="{{ $proveedore->persona->tipo_persona }}">

            </div>
            <div class="card-body">

                <div class="row g-3">

                    <!-------Razón social------->
                    <div class="col-12">
                        @if ($proveedore->persona->tipo_persona == 'natural')
                        <label id="label-natural" for="razon_social" class="form-label">Nombres y apellidos:</label>
                        @else
                        <label id="label-juridica" for="razon_social" class="form-label">Nombre de la empresa:</label>
                        @endif

                        <input required type="text" name="razon_social" id="razon_social" class="form-control" value="{{old('razon_social',$proveedore->persona->razon_social)}}">

                        @error('razon_social')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="ciudad" class="form-label">Ciudad:</label>
                        <input required type="text" name="ciudad" id="ciudad" class="form-control" value="{{old('ciudad',$proveedore->persona->ciudad)}}">
                        @error('ciudad')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="calle" class="form-label">Calle:</label>
                        <input required type="text" name="calle" id="calle" class="form-control" value="{{old('calle',$proveedore->persona->calle)}}">
                        @error('calle')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="nro_vivienda" class="form-label">Nro vivienda:</label>
                        <input required type="text" name="nro_vivienda" id="nro_vivienda" class="form-control" value="{{old('nro_vivienda',$proveedore->persona->nro_vivienda)}}">
                        @error('nro_vivienda')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="telefono" class="form-label">Telefono:</label>
                        <input required type="text" name="telefono" id="telefono" class="form-control" value="{{old('telefono',$proveedore->persona->telefono)}}">
                        @error('telefono')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email:</label>
                        <input required type="text" name="email" id="email" class="form-control" value="{{old('email',$proveedore->persona->email)}}">
                        @error('email')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                </div>

            </div>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')

@endpush