<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Producto;
use App\Categoria;
use Illuminate\Support\Facades\File;//archivos a nivel servidor
class AdminProductoController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nombre=$request->get('nombre');
        // dd($nombre);
        $productos = Producto::with('images', 'categoria')->where('nombre','like',"%$nombre%")->orderBy('nombre')
        ->paginate(10);
       // dd($nombre, $productos);
         return view('admin.producto.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $categorias = Categoria::orderBy('nombre')->get();
        return view('admin.producto.create',compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validacion
        $request->validate([
            'nombre' => 'required|unique:productos,nombre',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'descripcion' => 'required',

        ]);

        $urlimagenes = [];//creacion de variable

        //si en el request del campo imagen viene un archivo
        if($request->hasFile('imagenes')){
            $imagenes = $request->File('imagenes');//obtenemos los archivos enviados
            // dd($imagenes);
                //reccorrer
                foreach($imagenes as $imagen){
                    $nombre = time().'_'.$imagen->getClientOriginalName();//variable nombre modifica el nombre original de la imag
                    $ruta=public_path().'/imagenes';//busca la ruta para almacenar
                    $imagen->move($ruta,$nombre);//guardar en la carpeta imagenes
                    //pasar 
                    $urlimagenes[]['url'] = '/imagenes/'.$nombre;//ademos de guardar el nuevo nombre quiero guardar '/imagenes'

                }
                // return $urlimagenes;
        }

        $prod = new Producto;

        $prod->nombre=                  $request->nombre;
        $prod->slug=                    $request->slug;
        $prod->categoria_id=            $request->categoria_id;
        $prod->precio=                  $request->precio;
        $prod->descripcion=             $request->descripcion;
        $prod->stock_disponible=        $request->stock_disponible;
        $prod->Save();


        $prod->images()->createMany($urlimagenes);//createMany

        // return $prod->images;
        return redirect()->route('admin.producto.index')
        ->with('datos', 'Registro creado correctamente!');
        // return $prod;
        // return $request->all();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $producto = Producto::with('images', 'categoria')->where('slug', $slug)->firstOrFail();

        $categorias = Categoria::orderBy('nombre')->get();
        //dd($producto,$categorias);
        return view('admin.producto.show',compact('producto', 'categorias'));

    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $producto = Producto::with('images', 'categoria')->where('slug', $slug)->firstOrFail();

        $categorias = Categoria::orderBy('nombre')->get();

        return view('admin.producto.edit',compact('producto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validacion
        $request->validate([
            'nombre' => 'required|unique:productos,nombre,'.$id,
            // 'slug' => 'required|unique:productos,slug,'.$id,
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',

        ]);

        $urlimagenes = [];//creacion de variable

        //si en el request del campo imagen viene un archivo
        if($request->hasFile('imagenes')){
            $imagenes = $request->File('imagenes');//obtenemos los archivos enviados
            // dd($imagenes);
                //reccorrer
                foreach($imagenes as $imagen){
                    $nombre = time().'_'.$imagen->getClientOriginalName();//variable nombre modifica el nombre original de la imag
                    $ruta=public_path().'/imagenes';//busca la ruta para almacenar
                    $imagen->move($ruta,$nombre);//guardar en la carpeta imagenes
                    //pasar 
                    $urlimagenes[]['url'] = '/imagenes/'.$nombre;//ademos de guardar el nuevo nombre quiero guardar '/imagenes'

                }
                // return $urlimagenes;
        }

        $prod = Producto::findOrFail($id);

        $prod->nombre=                  $request->nombre;
        $prod->slug=                    $request->slug;
        $prod->categoria_id=            $request->categoria_id;
        $prod->precio=                  $request->precio;
        $prod->descripcion=             $request->descripcion;
        $prod->stock_disponible=        $request->stock_disponible;
    
        $prod->Save();


        $prod->images()->createMany($urlimagenes);//createMany

        // return $prod->images;
        //slug mostar o redireccionar
        return redirect()->route('admin.producto.edit', $prod->slug)
        ->with('datos', 'Registro Actualizado correctamente!');
        // return $prod;
        // return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //buscamos el id
        // with('images') lamamos a las imagenes relacionadas al producto
        $prod = Producto::with('images')->findOrFail($id);
        

        foreach ($prod->images as $image) { //recorro
            
            $archivo = substr($image->url,1); //substr,1 elimina el / slash

            //eliminar el archivo
            File::delete($archivo);

            $image->delete();
        }
        // return $prod;
        //eliminar el registro completo
        $prod->delete();
        return redirect()->route('admin.producto.index')
        ->with('datos', 'Registro eliminado correctamente!');
        
    }

   
}
