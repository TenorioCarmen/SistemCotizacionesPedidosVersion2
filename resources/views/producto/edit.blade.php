@extends('template')

@section('title', 'Editar productos')

@push('css')
<style>
    #descripcion{
        resize: none;
    }
</style> 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> 
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4 text-center">Editar Producto</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Productos</a></li>
        <li class="breadcrumb-item active">Editar producto</li>
    </ol>

    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
        <form action="{{route('productos.update',['producto'=>$producto])}}" method="post" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="card-body">
                <div class="row g-4">

                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre',$producto->nombre)}}">
                        @error('nombre')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>

                </div>
                
                <div class="col-12">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <textarea name="descripcion" id="descripcion" rows="3" class="form-control">{{old('descripcion',$producto->descripcion)}}</textarea>
                    @error('descripcion')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="precio_unitario" class="form-label">Precio unitario:</label>
                        <input type="text" name="precio_unitario" id="precio_unitario" class="form-control" value="{{old('precio_unitario',$producto->precio_unitario)}}">
                        @error('precio_unitario')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="talla" class="form-label">Talla:</label>
                        <input type="text" name="talla" id="talla" class="form-control" value="{{old('talla',$producto->talla)}}">
                        @error('talla')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="color" class="form-label">Color:</label>
                        <input type="text" name="color" id="color" class="form-control" value="{{old('color',$producto->color)}}">
                        @error('color')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="genero" class="form-label">Género:</label>
                        <input type="text" name="genero" id="genero" class="form-control" value="{{old('genero',$producto->genero)}}">
                        @error('genero')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>
                </div> 
                <div class="row g-4">
                    <div class="col-sm-4 mb-2">
                        <label for="costo_mano_obra" class="form-label">Costo mano de obra:</label>
                        <input type="number" name="costo_mano_obra" id="costo_mano_obra" class="form-control"
                            step="0.1" value="{{old('costo_mano_obra',$producto->costo_mano_obra)}}">
                        @error('costo_mano_obra')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="img_path" class="form-label">Imagen:</label>
                        <input type="file" name="img_path" id="img_path" class="form-control" accept="Image/*">
                        @error('img_path')
                        <small class="text-danger">{{'*'.$message}}</small>
                        @enderror
                    </div>
                </div>  

                <div class="col-md-6 mb-2">
                    <label for="categorias" class="form-label">Categorías:</label>
                    <select data-size="4" multiple title="Seleccione una categoria" data-live-search="true"  name="categorias[]" id="categorias" class="form-control selectpicker show-tick">
                        @foreach ($categorias as $item)
                        @if (in_array($item->id,$producto->categorias->pluck('id')->toArray()))
                        <option selected value="{{$item->id}}" {{ (in_array($item->id , old('categorias',[]))) ? 'selected' : '' }}>{{$item->nombre}}</option>
                        @else
                        <option value="{{$item->id}}" {{ (in_array($item->id , old('categorias',[]))) ? 'selected' : '' }}>{{$item->nombre}}</option>
                        @endif
                        @endforeach 
                    </select>
                    @error('categorias')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

            </div>
            <div class="card-footer text-center mt-4">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
@endpush