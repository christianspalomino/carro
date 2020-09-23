<?php

use Illuminate\Database\Seeder;
use App\Categoria;
class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create([
        	'nombre' =>	'Categoria 1',
        	'slug'   => 'categoria-1'
        ]);

        Categoria::create([
        	'nombre' =>	'Categoria 2',
        	'slug'   => 'categoria-2'
        ]);
    }
}
