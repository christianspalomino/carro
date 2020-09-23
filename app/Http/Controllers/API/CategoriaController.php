<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Categoria;
class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //crear categoria
        /*$cat = new Category();
        $cat->nombre='Mujer';
        $cat->slug='mujer';
        $cat->descripcion='Ropa para mujer';
        $cat->save();
        return $cat;
        */
        return Categoria::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)//cambiar la palabra id por slug
    {
        //si ejecutamos esto y me trae el 1er registro 
        if (Categoria::where('slug',$slug)->first()){
        //buscar por el campo slug y eso va ser = a lo q reciba por la url y busca el 1er registro
        return 'Slug existe';//return existe
        }
        else{
            return 'Slug Disponible';
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
