<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categoria;

class AdminCategoriaController extends Controller
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
    public function index(Request $request)//busqeda pasamos elreques
    {
        $nombre=$request->get('nombre');
        // dd($nombre);
        $categorias = Categoria::where('nombre','like',"%$nombre%")->orderBy('id', 'desc')->paginate(10);
        return view('admin.categoria.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $request->validate([
            'nombre' => 'required|max:50|unique:categorias,nombre',
            'slug' => 'required|max:50|unique:categorias,slug',

        ]);
        Categoria::create($request->all());
        return redirect()->route('admin.categoria.index')
        ->with('datos', 'Registro creado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
         //busca por el campo slug 
        $cat = Categoria::where('slug',$slug)->firstOrfail();//firsorfail busca el primero y si no coincide byscara pag no encontrada
        $editar= 'si';
        return view('admin.categoria.show', compact('cat', 'editar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        //busca por el campo slug 
        $cat = Categoria::where('slug',$slug)->firstOrfail();//firsorfail busca el primero y si no coincide byscara pag no encontrada
        $editar= 'si';
        return view('admin.categoria.edit', compact('cat', 'editar'));
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
       $cat = Categoria::findOrFail($id);
      
        $request->validate([
            'nombre' => 'required|max:50|unique:categorias,nombre,'.$cat->id,
            'slug' => 'required|max:50|unique:categorias,slug,'.$cat->id,

        ]);
        $cat->fill($request->all())->save();
   
        return redirect()->route('admin.categoria.index')
        ->with('datos', 'Registro actualizado correctamente!');
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
        $cat = Categoria::findOrFail($id);
        $cat->delete();
        return redirect()->route('admin.categoria.index')
        ->with('datos', 'Registro eliminado correctamente!');

    }
}
