<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Storage;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::with('categorias')->latest()->get();
        //return view('producto.index',compact('productos'));
        //$productos = Producto::with(['categorias'])->get();
        //dd($productos);
        return view('producto.index',compact('productos'));
        //$productos = Producto::with(['categorias'])->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        
        //dd($categorias);
        return view('producto.create', compact('categorias'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductoRequest $request)
    {
        //dd($request);
        //dd($request->all());
        try {
            DB::beginTransaction();
            //Tabla producto
            $producto = new Producto();
            if ($request->hasFile('img_path')) {
                $name = $producto->handleUploadImage($request->file('img_path'));
            } else {
                $name = null;
            }

            $producto->fill([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio_unitario' => $request->precio_unitario,
                'talla' => $request->talla,
                'color' => $request->color,
                'genero' => $request->genero,
                'costo_mano_obra' => $request->costo_mano_obra,
                'img_path' => $name
            ]);

            $producto->save();
            //dd($producto);
            //Tabla categoría producto
            $categorias = $request->get('categorias');
            //dd($categorias);
            $producto->categorias()->attach($categorias);


            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }

        return redirect()->route('productos.index')->with('success', 'Producto registrado');
    
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        
        //dd($categorias);
        return view('producto.edit',compact('producto','categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        //dd('Hola');
        try{
            DB::beginTransaction();

            if ($request->hasFile('img_path')) {
                $name = $producto->handleUploadImage($request->file('img_path'));

                //Eliminar si existiese una imagen
                if(Storage::disk('public')->exists('productos/'.$producto->img_path)){
                    Storage::disk('public')->delete('productos/'.$producto->img_path);
                }
            } else {
                $name = $producto->img_path;
            }

            $producto->fill([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio_unitario' => $request->precio_unitario,
                'talla' => $request->talla,
                'color' => $request->color,
                'genero' => $request->genero,
                'costo_mano_obra' => $request->costo_mano_obra,
                'img_path' => $name
            ]);

            $producto->save();
            //dd($producto);
            //Tabla categoría producto
            $categorias = $request->get('categorias');
            //dd($categorias);
            $producto->categorias()->attach($categorias);

            DB::commit();
        }catch(Exception $e){
            DB::rollBack();
        }
        return redirect()->route('productos.index')->with('success','Producto editado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto= Producto::find($id);
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto elimindado');
    }
}
