<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    
	//q los datos se guarde de manera masiva
    protected $fillable = [
        'url',
    ];

    //si busco el id de la tabla image, a cual modelo pertenece
    // ya sea (producto, catgoria o user)
    	//morphTo transformate
    public function imageable(){
    	return $this->morphTo();
    }
}
