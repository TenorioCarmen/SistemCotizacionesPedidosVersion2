@extends('template')

@section('title', 'Panel')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')

    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {

                let message = "{{ session('success') }}";
                Swal.fire(message);

            });
        </script>
    @endif

    <div class="container-fluid px-4">
        <h1 class="mt-4">Panel</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Panel</li>
        </ol>
        <div class="row">
            <!----Clientes--->
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <i class="fa-solid fa-people-group"></i><span class="m-1">Clientes</span>
                            </div>
                            <div class="col-4">
                                <?php
                                
                                use App\Models\Cliente;
                                
                                $clientes = count(Cliente::all());
                                ?>
                                <p class="text-center fw-bold fs-4">{{ $clientes }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('clientes.index') }}">Ver más</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <!----Categoria--->
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <i class="fa-solid fa-tag"></i><span class="m-1">Categorías</span>
                            </div>
                            <div class="col-4">
                                <?php
                                
                                use App\Models\Categoria;
                                
                                $categorias = count(Categoria::all());
                                ?>
                                <p class="text-center fw-bold fs-4">{{ $categorias }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('categorias.index') }}">Ver más</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <!----Cotizaciones--->
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <i class="fa-solid fa-store"></i><span class="m-1">Cotizaciones</span>
                            </div>
                            <div class="col-4">
                                <?php
                                
                                use App\Models\Cotizacione;
                                
                                $cotizaciones = count(Cotizacione::all());
                                ?>
                                <p class="text-center fw-bold fs-4">{{ $cotizaciones }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('cotizaciones.index') }}">Ver más</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <!----Producto--->
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <i class="fa-brands fa-shopify"></i><span class="m-1">Productos</span>
                            </div>
                            <div class="col-4">
                                <?php
                                
                                use App\Models\Producto;
                                
                                $productos = count(Producto::all());
                                ?>
                                <p class="text-center fw-bold fs-4">{{ $productos }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('productos.index') }}">Ver más</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            <!----Proveedore--->
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <i class="fa-solid fa-user-group"></i><span class="m-1">Proveedores</span>
                            </div>
                            <div class="col-4">
                                <?php
                                
                                use App\Models\Proveedore;
                                
                                $proveedores = count(Proveedore::all());
                                ?>
                                <p class="text-center fw-bold fs-4">{{ $proveedores }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="{{ route('proveedores.index') }}">Ver más</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>

            

        </div>

    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <!---script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script--->
    <!---script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script--->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush
