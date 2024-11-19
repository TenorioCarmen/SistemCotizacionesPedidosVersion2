<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCotizacionRequest;
use App\Http\Requests\UpdateCotizacionRequest;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Cotizacione;
use App\Models\Pedido;
use App\Models\Producto;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class cotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cotizaciones = Cotizacione::with('cliente.persona')->latest()->get();
        //dd($cotizaciones);
        return view('cotizaciones.index', compact('cotizaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('cotizaciones.create', compact('clientes', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function store(StoreCotizacionRequest $request)
    {
        //dd($request->all());
        //dd($request->validated());
        //dd($request);
        try {
            DB::beginTransaction(); // Iniciar una transacción para asegurar atomicidad
            //dd("Transacción iniciada");

            //Llenar tabla cotizaciones
            $cotizacion = Cotizacione::create($request->validated());
            //dd($cotizacion);
            //Carbon::now();

            //Llenar tabla cotizaciones
            //1.Recuperar los arrays
            $arrayProducto_id = $request->get('arrayidproducto');
            $arrayCantidad = $request->get('arraycantidad');

            $arrayCostoMateriales = $request->get('arraycostomateriales');
            $arrayCostoManoObra = $request->get('arraycostomanoobra');

            //$arrayPrecioCotizacion = $request->get('arraypreciocotizacion', []);
            //$arrayDescuentoPorcentaje = $request->get('arraydescuentoporcentaje', []);
            //$arrayDescuentoMonto = $request->get('arraydescuentomonto', []);
            //$arrayTotalCotizacion = $request->get('arraytotalcotizacion', []);


            //2.Realizar el llenado
            $siseArray = count($arrayProducto_id);
            $cont = 0;

            while ($cont < $siseArray) {
                $producto = Producto::find($arrayProducto_id[$cont]);

                //Verificar si el producto existe
                if (!$producto) {
                    return back()->with('error', 'Producto no encontrado');
                }

                //$costoManoObra = $producto->costo_mano_obra; // Obtener costo_mano_obra desde la tabla productos
                //$costoMateriales = $arrayCostoMateriales[$cont] ?? 0.0; // Tomar de la solicitud
                //$cantidad = $arrayCantidad[$cont];


                $precioCotizacion = $request->get('arraypreciocotizacion')[$cont] ?? 0.0; // Obtiene el precio de la cotización
                //$descuentoPorcentaje = $request->get('arraydescuentoporcentaje')[$cont] ?? 0.0; // Obtiene el descuento porcentual
                //$descuentoMonto = $request->get('arraydescuentomonto')[$cont] ?? 0.0; // Obtiene el descuento en monto

                //$cantidad = $arrayCantidad[$cont];
                //$totalCotizacion = ($precioCotizacion * $cantidad) - $descuentoMonto;

                // Calcular el total de cotización si no se ha proporcionado
                //$totalCotizacion = $arrayTotalCotizacion[$cont] ?? (($precioCotizacion * $cantidad) - $descuentoMonto);
                //$totalCotizacion = ($precioCotizacion * $cantidad) - $descuentoMonto;

                $cotizacion->productos()->syncWithoutDetaching([

                    $arrayProducto_id[$cont] => [
                        'cantidad' => $arrayCantidad[$cont],
                        //'costo_mano_obra' => $arrayCostoManoObra[$cont],
                        //'costo_materiales' => $arrayCostoMateriales[$cont],
                        // Usar el valor obtenido
                        'costo_materiales' => $arrayCostoMateriales[$cont],
                        //'costo_mano_obra' => $costoManoObra[$cont] ?? 0.0,
                        //'total_cotizacion' => 0.0,
                        'precio_cotizacion' => $precioCotizacion,
                        //'descuento_porcentaje' => $descuentoPorcentaje,
                        //'descuento_monto' => $descuentoMonto,
                        //'total_cotizacion' => $totalCotizacion,
                    ]
                ]);

                //dd($cotizacion->productos()->get());
                $cont++;
            }
            DB::commit(); // Confirmar la transacción si todo fue bien
            Log::info('Transacción confirmada');
        } catch (Exception $e) {
            Log::info('Punto de control');
            DB::rollback(); // Revertir la transacción en caso de error
            Log::info('Punto de control');
            Log::error('Error al guardar cotización: ' . $e->getMessage());
            return back()->with('error', 'Error al guardar la cotización' . $e->getMessage());
        }
        return redirect()->route('cotizaciones.index')->with('success', 'cotizacion exitosa');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view('cotizaciones.show',compact('cotizacion'));
        // Cargar la cotización junto con la relación 'cliente.persona'
        $cotizacion = Cotizacione::with('cliente.persona')->find($id);

        // Verificar si la cotización existe
        if (!$cotizacion) {
            return redirect()->route('cotizaciones.index')->with('error', 'Cotización no encontrada.');
        }

        // Pasar la cotización a la vista
        return view('cotizaciones.show', compact('cotizacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cotizacione $cotizacione)
    {
        $clientes = Cliente::all();
        $productos = Producto::all();

        return view('cotizaciones.edit', compact('cotizacione', 'clientes', 'productos'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCotizacionRequest $request, Cotizacione $cotizacione)
    {
        try {
            DB::beginTransaction();

            // Actualizar datos generales de la cotización
            $cotizacione->update([
                'cliente_id' => $request->cliente_id,
                'impuestos' => $request->impuestos,
                'costo_mano_obra' => $request->costo_mano_obra,
                'fecha_hora' => $request->fecha_hora,
                'total' => $request->total,
            ]);

            // Actualizar productos asociados
            $productosData = [];
            if ($request->has('cantidad')) {
                foreach ($request->cantidad as $productoId => $cantidad) {
                    $productosData[$productoId] = [
                        'cantidad' => $cantidad,
                        'costo_materiales' => $request->input("costo_materiales.$productoId", 0),
                        'precio_cotizacion' => $request->input("precio_cotizacion.$productoId", 0),
                        'descuento_porcentaje' => $request->input("descuento_porcentaje.$productoId", 0),
                        'descuento_monto' => $request->input("descuento_monto.$productoId", 0),
                    ];
                }
            }

            if (!empty($productosData)) {
                $cotizacione->productos()->sync($productosData);
            }

            DB::commit();

            return redirect()->route('cotizaciones.index')->with('success', 'Cotización actualizada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Error al actualizar la cotización: ' . $e->getMessage()]);
        }
    }

    /**
     * Función para calcular el total de la cotización.
     */
    private function calcularTotal($cantidad, $costo_materiales, $costo_mano_obra, $impuestos)
    {
        $subtotal = ($cantidad * ($costo_materiales + $costo_mano_obra));
        $total = $subtotal * (1 + ($impuestos / 100)); // Calcular el total con impuestos
        return $total;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cotizacion = Cotizacione::find($id);
        $cotizacion->delete();
        return redirect()->route('cotizaciones.index')->with('success', 'Cotización eliminada');
    }
}
