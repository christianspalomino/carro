<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
class AutocompleteController extends Controller
{
    public function autocomplete(Request $request) 
    {
    	$palabraabuscar = $request->get('palabraabuscar');
    	$Productos = Product::where('nombre', 'like', '%'.$palabraabuscar. '%')
    	->orderBy('nombre')
    	->get();

    	$resultados=[];

    	foreach ($Productos as $prod) {
    		//poner en negrita la letra q se busca
    		//stristr busca detras de la palabra ejemplo para buscar producto solo muestra de oduc en adelante
    		$encontrartexto = stristr($prod->nombre, $palabraabuscar);
    		$prod->encontrar = $encontrartexto;

    		// substr recorta la informacion 
    		//strlen cuenta los caracteres de la palabraabuscar y de str en adelante lo substr
    		$recortar_palabra = substr($encontrartexto, 0, strlen($palabraabuscar));

    		$prod->substr = $recortar_palabra;
    		// en el campo name_negrita ejecutar la funcion str_ireplace y q busque en  ,dentro del campo nombre dentro  de palabraabuscar y lo va reemplaxar por lo q tengo en <b>$recortar_palabra</br>
    		$prod->name_negrita = str_ireplace($palabraabuscar, "<b>$recortar_palabra</br>", $prod->nombre);
    		$resultados[] = $prod;
    	}
    	
    	return $resultados;
    }
}
