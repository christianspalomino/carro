<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->decimal('precio');
            $table->text('descripcion');
            $table->string('nombre');
            $table->string('slug');
            $table->bigInteger('stock_disponible')->unsigned()->default(0);
            //unsigned campo entero sin signos
            $table->unsignedbigInteger('categoria_id');

            //relacion 
            $table->foreign('categoria_id')->references('id')->on('categorias');

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
        Schema::dropIfExists('productos');
    }
}
