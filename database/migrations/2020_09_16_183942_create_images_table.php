<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('url');

            //morphs->tabla centralizada, es para guardar todas las imagenes
            //esta tabla se podra usar con varios modelos
            //ademas guardará el id del registro del modelo para saber a q modelo pertence x ejemplo(producto,imagen) 

            $table->morphs('imageable');//las imagenes se relacionan con el producto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
