@extends('template')

@section('title', 'pedidos')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush
@push('css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .row-not-space {
            width: 110px;
        }
    </style>
@endpush

@section('content')

    @if (session('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "Operacion exitosa"
            });
        </script>
    @endif

    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Pedidos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Pedidos</li>
        </ol>

        <div class="mb-4">
            <a href="{{ route('pedidos.create') }}">
                <button type="button" class="btn btn-primary">Añadir nuevo registro</button>
            </a>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla Pedidos
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Comprobante</th>
                            <th>Cliente</th>
                            <th>Fecha y hora</th>
                            <th>Prenda</th>
                            <th>Tiempo de Entrega</th>
                            <th>Tipo de Envío</th>
                            <th>User</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedidos as $item)
                            <tr>
                                <td>
                                    <p class="fw-semibold mb-1">{{$item->comprobante->tipo_comprobante}}</p>
                                    <p class="text-muted mb-0">{{$item->numero_comprobante}}</p>
                                </td>
                                <td>
                                    <p class="fw-semibold mb-1">{{ ucfirst($item->proveedore->persona->tipo_persona) }}</p>
                                    <p class="text-muted mb-0">{{$item->proveedore->persona->razon_social}}</p>
                                </td>
                                <td>
                                    <div class="row-not-space">
                                        <p class="fw-semibold mb-1"><span class="m-1"><i
                                                    class="fa-solid fa-calendar-days"></i></span>{{ \Carbon\Carbon::parse($item->fecha_hora)->format('d-m-Y') }}
                                        </p>
                                        <p class="fw-semibold mb-0"><span class="m-1"><i
                                                    class="fa-solid fa-clock"></i></span>{{ \Carbon\Carbon::parse($item->fecha_hora)->format('H:i') }}
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">{{ $item->producto->nombre}}</p>
                                    <p class="text-muted small mb-0">{{ $item->producto->descripción}}</p>
                                    <p class="text-muted small mb-0">{{ $item->producto->categoria->nombre}}</p>
                                    <p class="text-muted small mb-0">{{ $item->producto->cantidad}}</p>
                                    <p class="text-muted small mb-0">{{ $item->producto->color}}</p>
                                    <p class="text-muted small mb-0">{{ $item->producto->talla}}</p>
                                </td>
                                <td>
                                    <p>{{ $pedido->tiempo_entrega ?? 'No especificado' }}</p>
                                </td>
                                <td>
                                    <p>{{ $pedido->tipo_envio ?? 'No especificado' }}</p>
                                </td>
                                <td>
                                    {{ $item->user->name }}
                                </td>
                                <td>
                                    {{ $item->total }}
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                                        <form action="{{ route('pedidos.show', ['pedido' => $item]) }}" method="get">
                                            <button type="submit" class="btn btn-success">
                                                Ver
                                            </button>
                                        </form>

                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#confirmModal-{{ $item->id }}">Eliminar</button>

                                    </div>
                                </td>
                            </tr>

                            <!-- Modal de confirmación-->
                            <div class="modal fade" id="confirmModal-{{ $item->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Seguro que quieres eliminar el registro?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                            <form action="{{ route('ventas.destroy', ['venta' => $item->id]) }}"
                                                method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Confirmar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script>
        // Simple-DataTables
        // https://github.com/fiduswriter/Simple-DataTables/wiki
        window.addEventListener('DOMContentLoaded', event => {
            const dataTable = new simpleDatatables.DataTable("#datatablesSimple", {})
        });
    </script>
@endpush
