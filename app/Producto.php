<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //un producto pertenece a una categoria
    public function categoria(){
    	return $this->belongsTo(Categoria::class);
    }

     // un producto puede tener muchas imagenes
    	//relacion polimorfica de uno a muchos
    		//pasamos el campo 'imageable' para q no dea error
    public function images(){
    	return $this->morphMany('App\Image', 'imageable');
    }


    public function Pedidos(){
        return $this->hasMany(Pedido::class, 'pedido_id');
    }

}
