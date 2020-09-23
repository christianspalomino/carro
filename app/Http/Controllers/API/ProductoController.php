<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Producto;
use App\Image;
use Illuminate\Support\Facades\File;//archivos a nivel servidor
class ProductoController extends Controller
{
    public function index()
    {
        return Producto::all();
    }

    public function show($slug)//cambiar la palabra id por slug
    {
        //si ejecutamos esto y me trae el 1er registro 
        if (Producto::where('slug',$slug)->first()){
        //buscar por el campo slug y eso va ser = a lo q reciba por la url y busca el 1er registro
        return 'Slug existe';//return existe
        }
        else{
            return 'Slug Disponible';
        }
    }

    public function eliminarimagen($id)//eliminar imagen
    {
          // return "Se va eliminar el registro".$id;
        $image = Image::find($id);
        $archivo = substr($image->url,1); //substr1,elimina el (1 er/ slash) de la url con la q esta guardada la imagen

        $eliminar = File::delete($archivo);

        $image->delete();

        return "eliminado id:".$id. ' '.$eliminar;
    }
}
