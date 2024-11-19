@extends('template')

@section('title', 'Crear Cotización')

@push('css')
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Crear Cotización</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Crear Cotización</li>
        </ol>
    </div>

    <form action="{{ route('cotizaciones.store') }}" method="POST">
        @csrf

        <div class="container-lg mt-4">
            <div class="row gy-4">
                <!------Detalles de la cotización---->
                <div class="col-xl-8">
                    <div class="text-white bg-primary p-1 text-center">
                        Detalles de la Cotización
                    </div>
                    <div class="p-3 border border-3 border-primary">
                        <div class="row">
                            <!-----Producto---->
                            <div class="col-12 mb-4">
                                <select name="producto_id" id="producto_id" class="form-control selectpicker"
                                    data-live-search="true" data-size="1" title="Busque un producto aquí">
                                    <!--<option value="" data-costo-mano-obra="0">Seleccionar Producto</option>--->
                                    @foreach ($productos as $item)
                                        <option value="{{ $item->id }}"
                                            data-precio-unitario="{{ $item->precio_unitario }}"
                                            data-costo-mano-obra="{{ $item->costo_mano_obra }}">
                                            {{ $item->codigo . ' ' . $item->nombre }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>

                            <!-----Precio base---->
                            <div class="col-sm-4 mb-2">
                                <label for="precio_unitario" class="form-label">Precio base:</label>
                                <input type="number" name="precio_unitario" id="precio_unitario" class="form-control"
                                    step="0.1" readonly>
                            </div>

                            <!-----Cantidad---->
                            <div class="col-sm-4 mb-2">
                                <label for="cantidad" class="form-label">Cantidad:</label>
                                <input type="number" name="cantidad" id="cantidad" class="form-control">
                            </div>

                            <!-- Costo de mano de obra -->
                            <div class="col-sm-4 mb-2">
                                <label for="costo_mano_obra" class="form-label">Costo mano de obra:</label>
                                <input type="number" name="costo_mano_obra" id="costo_mano_obra" class="form-control"
                                    step="0.1" readonly>
                            </div>
                            <!-----Costo de materiales---->
                            <div class="col-sm-4 mb-2">
                                <label for="costo_materiales" class="form-label">Costo de Materiales:</label>
                                <input type="number" name="costo_materiales" id="costo_materiales" class="form-control"
                                    step="0.1">
                            </div>
                            <!-- Tiempo de entrega -->
                            <div class="col-sm-4 mb-2">
                                <label for="tiempo_entrega" class="form-label">Tiempo de entrega (días):</label>
                                <input type="number" name="tiempo_entrega" id="tiempo_entrega" class="form-control">
                            </div>

                            <!-- Costo de urgencia -->
                            <div class="col-sm-4 mb-2">
                                <label for="costo_urgencia" class="form-label">Costo de urgencia:</label>
                                <input type="number" name="costo_urgencia" id="costo_urgencia" class="form-control"
                                    step="0.1" readonly>
                            </div>
                            <!--Estado de cotización-->
                            <div class="col-md-6 mb-2">
                                <label for="estado">Estado</label>
                                <select name="estado" id="estado" class="form-control" required>
                                    <option value="pendiente">Pendiente</option>
                                    <option value="aprobada">Aprobada</option>
                                    <option value="rechazada">Rechazada</option>
                                    <option value="vencida">Vencida</option>
                                </select>
                            </div>
                            <!-----botón para agregar--->
                            <div class="col-12 mb-4 mt-2 text-end">
                                <button id="btn_agregar" class="btn btn-primary" type="button">Agregar</button>
                            </div>

                            <!-----Tabla para el detalle de la cotización--->
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="tabla_detalle" class="table table-hover">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th class="text-white">#</th>
                                                <th class="text-white">Prenda</th>
                                                <th class="text-white">Precio base</th>
                                                <th class="text-white">Cantidad</th>
                                                <th class="text-white">Costo Mano de Obra</th>
                                                <th class="text-white">Costo de Materiales</th>
                                                <th class="text-white">Costo de Urgencia</th>
                                                <th class="text-white">Subtotal</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th></th>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th colspan="4">Sumas</th>
                                                <th colspan="2"><span id="sumas">0</span></th>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th colspan="4">Impuesto %</th>
                                                <th colspan="2"><input type="number" id="impuestos_input" value="18"
                                                        step="0.1"> <span id="impuestos_display">0</span></th>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th colspan="4">Total</th>
                                                <th colspan="2"><input type="hidden" name="total" value="0"
                                                        id="inputTotal"> <span id="total">0</span></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <!--Boton para cancelar cotización-->
                            <div class="col-12 mt-2">
                                <button id="cancelar" type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Cancelar Cotización
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

                <!-----Datos generales---->
                <div class="col-xl-4">
                    <div class="text-white bg-success p-1 text-center">
                        Datos Generales
                    </div>
                    <div class="p-3 border border-3 border-success">
                        <div class="row">
                            <!--Cliente-->
                            <!--Cliente-->
                            <div class="col-12 mb-2">
                                <label for="cliente_id" class="form-label">Cliente:</label>
                                <select name="cliente_id" id="cliente_id" class="form-control selectpicker show-tick"
                                    data-live-search="true" title="Selecciona" data-size='2'>
                                    @foreach ($clientes as $item)
                                        <option value="{{ $item->id }}">{{ $item->persona->razon_social }}</option>
                                    @endforeach
                                </select>
                                @error('cliente_id')
                                    <small class="text-danger">{{ '*' . $message }}</small>
                                @enderror
                            </div>


                            <!--Impuesto---->
                            <div class="col-sm-6 mb-2">
                                <label for="impuestos" class="form-label">Impuesto(IGV):</label>
                                <input readonly type="text" name="impuestos" id="impuestos"
                                    class="form-control border-success">
                                @error('impuestos')
                                    <small class="text-danger">{{ '*' . $message }}</small>
                                @enderror
                            </div>
                            <!--Fecha--->
                            <div class="col-sm-6 mb-2">
                                <label for="fecha_hora" class="form-label">Fecha:</label>
                                <input readonly type="date" name="fecha" id="fecha"
                                    class="form-control border-success" value="<?php echo date('Y-m-d'); ?>">
                                <?php
                                use Carbon\Carbon;
                                
                                $fecha_hora = Carbon::now()->toDateTimeString();
                                ?>
                                <input type="hidden" name="fecha_hora" value="{{ $fecha_hora }}">
                            </div>

                            <!--Botones--->
                            <div class="col-12 mt-4 text-center">
                                <button type="submit" class="btn btn-success" id="guardar">Realizar
                                    Cotización</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para cancelar la cotización -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Advertencia</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Seguro que quieres cancelar la cotización?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button id="btnCancelarCotizacion" type="button" class="btn btn-danger"
                            data-bs-dismiss="modal">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#producto_id').change(function() {
                actualizarDatosProducto();
            });
    
            $('#tiempo_entrega').change(function() {
                actualizarCostoUrgencia();
            });

            $('#btn_agregar').click(function() {
                agregarProducto();
            });

            $('#btnCancelarCotizacion').click(function() {
                cancelarCotizacion();
            });

            disableButtons();

            $('#impuestos').val(impuestos + '%');
        });

        // Variables
        let cont = 0;
        let subtotal = [];
        let sumas = 0;
        let igv = 0;
        let total = 0;

        // Constantes
        const impuestos = 18;


        function cancelarCotizacion() {
            // Eliminar el tbody de la tabla
            $('#tabla_detalle tbody').empty();

            //Añadir una nueva fila a la tabla
            let fila = '<tr>' +
                '<th></th>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '</tr>';
            $('#tabla_detalle').append(fila);
            // Reiniciar valores de las variables
            cont = 0;
            subtotal = [];
            sumas = 0;
            igv = 0;
            total = 0;

            // Mostrar los campos calculados
            $('#sumas').html(sumas);
            $('#igv').html(igv);
            $('#total').html(total);
            $('#impuestos').val(impuestos + '%');
            $('#inputTotal').val(total);

            limpiarCampos();
            disableButtons();
        }

        function disableButtons() {
            if (total == 0) {
                $('#guardar').hide();
                $('#cancelar').hide();
            } else {
                $('#guardar').show();
                $('#cancelar').show();
            }
        }

        function actualizarDatosProducto() {
            let producto = $('#producto_id option:selected');
            let precio = producto.data('precio-unitario');
            let costoManoObra = producto.data('costo-mano-obra');
    
            $('#precio_unitario').val(precio);
            $('#costo_mano_obra').val(costoManoObra);
        }
    
        function actualizarCostoUrgencia() {
            let tiempoEntrega = $('#tiempo_entrega').val();
            let costoUrgencia = 0;
    
            if (tiempoEntrega <= 3 && tiempoEntrega > 0) {
                costoUrgencia = 50;
            } else if (tiempoEntrega > 3 && tiempoEntrega <= 7) {
                costoUrgencia = 30;
            }
    
            $('#costo_urgencia').val(costoUrgencia);
        }
    
        function agregarProducto() {
            // Obtener valores de los campos
            const productoId = $('#producto_id').val();
            let nombreProducto = ($('#producto_id option:selected').text()).split('')[1];
            let cantidad = $('#cantidad').val();
            let precio = $('#precio_unitario').val();
            let costoMateriales = $('#costo_materiales').val();
            let costoManoObra = $('#costo_mano_obra').val();
            let tiempoEntrega = $('#tiempo_entrega').val();
            let costoUrgencia = $('#costo_urgencia').val();
            // Validaciones 
            // 1. Para que los campos no estén vacíos
            if (nombreProducto != '' && nombreProducto != undefined && cantidad != '' && costoMateriales != '' && costoManoObra != '') {
                // 2. Para que los valores ingresados sean los correctos
                if (parseInt(cantidad) > 0 && (cantidad % 1 == 0) && parseFloat(costoMateriales) >= 0 && parseFloat(costoManoObra) >= 0) {
                    // Calcular valores
                    let subtotalProducto = round((cantidad * precio) + (cantidad * costoManoObra) + (cantidad * costoMateriales) + parseFloat(costoUrgencia));
                    subtotal[cont] = subtotalProducto;
                    sumas += subtotal[cont];
                    igv = round(sumas / 100 * impuestos);
                    total = round(sumas + igv);

                    // Crear la fila
                    let fila = '<tr id="fila' + cont + '">' +
                        '<th>' + (cont + 1) + '</th>' +
                        '<td><input type="hidden" name="arrayidproducto[]" value="' + productoId + '">' +
                        nombreProducto + '</td>' +
                        '<td><input type="hidden" name="arraycantidad[]" value="' + cantidad + '">' + cantidad + '</td>' +
                        '<td>' + precio + '</td>' +
                        '<td><input type="hidden" name="arraycostomanoobra[]" value="' + costoManoObra + '">' +
                        costoManoObra + '</td>' +
                        '<td><input type="hidden" name="arraycostomateriales[]" value="' + costoMateriales + '">' +
                        costoMateriales + '</td>' +
                        '<td>' + costoUrgencia + '</td>' +
                        '<td>' + subtotalProducto + '</td>' +
                        '<td><button class="btn btn-danger" type="button" onClick="eliminarProducto(' + cont +
                        ')"><i class="fa-solid fa-trash"></i></button></td>' +
                        '</tr>';

                    // Acciones después de añadir la fila
                    $('#tabla_detalle').append(fila);
                    limpiarCampos();
                    cont++;
                    disableButtons();

                    // Mostrar los campos calculados
                    $('#sumas').html(sumas);
                    $('#igv').html(igv);
                    $('#total').html(total);
                    $('#impuestos').val(igv);
                    $('#inputTotal').val(total);
                } else {
                    showModal('Valores incorrectos');
                }
            } else {
                showModal('Le faltan campos por llenar');
            }
        }

        function eliminarProducto(indice) {
            // Calcular valores
            sumas -= round(subtotal[indice]);
            igv = round(sumas / 100 * impuestos);
            total = round(sumas + igv);

            // Mostrar los campos calculados
            $('#sumas').html(sumas);
            $('#igv').html(igv);
            $('#total').html(total);
            $('#impuestos').val(igv);
            $('#inputTotal').val(total);

            // Eliminar la fila de la tabla
            $('#fila' + indice).remove();
            disableButtons();
        }

        function limpiarCampos() {
            let select = $('#producto_id');
            $('#producto_id').val('');
            $('#cantidad').val('');
            $('#precio_unitario').val('');
            $('#costo_materiales').val('');
            $('#costo_mano_obra').val('');
            $('#tiempo_entrega').val('');
            $('#costo_urgencia').val('');
        }

        function round(num, decimales = 2) {
            var signo = (num >= 0 ? 1 : -1);
            num = num * signo;
            if (decimales === 0) // con 0 decimales
                return signo * Math.round(num);
            num = num.toString().split('e');
            num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
            num = num.toString().split('e');
            return signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
        }

        function showModal(message, icon = 'error') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: icon,
                title: message
            })
        }
    </script>
@endpush
