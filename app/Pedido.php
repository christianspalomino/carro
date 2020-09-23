<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;
// use Swap;
class Pedido extends Model
{
    //

    protected $fillable = [
        'user_id',
        'carro',
        'nombres',
        'apellidos',
        'email',
        'direccion',
        'telefono',
        'comentario',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function producto(){
        return $this->belongsTo(Producto::class);
    }

     public function carro()
    {
        return $this->belongsTo('App\Pedido');
    }

    //Crea un pedido
    public static function crear($cart, $request)
    {
        $user = Auth::user();
        // $rate = Swap::latest('per US$');
        // $totalusd = (number_format(($cart->totalPrecio / $rate->getValue()),2) * 100);
        
        // $charge = $user->charge($totalusd,[
        //                 "description" => "Pago usuario ".Auth::user()->nombre. " ID #".Auth::user()->id,
        //             ]);

        $pedido = Pedido::create([
                        'user_id' => Auth::user()->id,
                        'carro' => serialize($cart),
                        'nombres' => $request->input('nombres'),
                        'apellidos' => $request->input('apellidos'),
                        'email' => $request->input('email'),
                        'direccion' => $request->input('direccion'),
                        'telefono' => $request->input('telefono'),
                        'comentario' => $request->input('comentario'),
                     ]);
        // Auth::user()->pedidos()->save($pedido);
        


        return $pedido;
    }
}
