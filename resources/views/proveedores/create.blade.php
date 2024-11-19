@extends('template')

@section('title', 'Crear Proveedor')

@push('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<style>
    #box-razon-social {
        display: none;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Crear Proveedor</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('proveedores.index') }}">Proveedores</a></li>
        <li class="breadcrumb-item active">Crear Proveedor</li>
    </ol>

    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
        <form action="{{ route('proveedores.store') }}" method="post">
            @csrf
            <div class="row g-3">

                <!----Tipo de persona----->
                <div class="col-md-6">
                    <label for="tipo_persona" class="form-label">Tipo de proveedor:</label>
                    <select class="form-select" name="tipo_persona" id="tipo_persona">
                        <option value="" selected disabled>Seleccione una opción</option>
                        <option value="natural" {{ old('tipo_persona') == 'natural' ? 'selected' : '' }}>Persona natural</option>
                        <option value="juridica" {{ old('tipo_persona') == 'juridica' ? 'selected' : '' }}>Persona jurídica</option>
                    </select>
                    @error('tipo_persona')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>
                <!-------Razón social------->
                <div class="col-12" id="box-razon-social">
                    <label id="label-natural" for="razon_social" class="form-label">Nombres y apellidos:</label>
                    <label id="label-juridica" for="razon_social" class="form-label">Nombre de la empresa:</label>

                    <input required type="text" name="razon_social" id="razon_social" class="form-control" value="{{old('razon_social')}}">

                    @error('razon_social')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="ciudad" class="form-label">Ciudad:</label>
                    <input required type="text" name="ciudad" id="ciudad" class="form-control" value="{{old('ciudad')}}">
                    @error('ciudad')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="calle" class="form-label">Calle:</label>
                    <input required type="text" name="calle" id="calle" class="form-control" value="{{old('calle')}}">
                    @error('calle')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="nro_vivienda" class="form-label">Nro vivienda:</label>
                    <input required type="text" name="nro_vivienda" id="nro_vivienda" class="form-control" value="{{old('nro_vivienda')}}">
                    @error('nro_vivienda')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="telefono" class="form-label">Telefono:</label>
                    <input required type="text" name="telefono" id="telefono" class="form-control" value="{{old('telefono')}}">
                    @error('telefono')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email:</label>
                    <input required type="text" name="email" id="email" class="form-control" value="{{old('email')}}">
                    @error('email')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>
            </div>    

            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('#tipo_persona').on('change', function() {
            let selectValue = $(this).val();
            //natural //juridica
            if (selectValue == 'natural') {
                $('#label-juridica').hide();
                $('#label-natural').show();
            } else {
                $('#label-natural').hide();
                $('#label-juridica').show();
            }

            $('#box-razon-social').show();
        });
    });
</script>
@endpush