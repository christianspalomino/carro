<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
	protected $fillable = ['nombre', 'slug'];
    //una categoria puede tener muchos productos
    public function productos(){
    	return $this->hasMany(Producto::class, 'producto_id');
    }
}
