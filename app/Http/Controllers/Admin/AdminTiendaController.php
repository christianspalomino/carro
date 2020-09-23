<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


//Librerias
use Session;
use Redirect;
// use Swap;


use App\Producto;
use App\Categoria;
use App\Carrito;

use App\Pedido;
use App\Http\Requests\PedidoRequest;

class AdminTiendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nombre=$request->get('nombre');
        // dd($nombre);
        $productos = Producto::with('images', 'categoria')->where('nombre','like',"%$nombre%")->orderBy('id', 'desc')->paginate(20);
     
       // dd($nombre, $productos);
     return view('tienda.index', compact('productos'));
    }

  
    public function show($slug)
    {
        $producto = Producto::with('images', 'categoria')->where('slug', $slug)->firstOrFail();

        $categorias = Categoria::orderBy('nombre')->get();
        //dd($producto,$categorias);
        return view('tienda.show',compact('producto', 'categorias'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   // public function categorias($slug)
   //  {
   //     $categorias = Producto::with('productos')->where('nombre','like',"%$nombre%")->orderBy('nombre')->paginate(20);
     
   //     // dd($nombre, $productos);
   //   return view('tienda.index', compact('categorias'));
   //  }

    public function carro()
    {
        
        if(!Session::has('cart'))
            return view('tienda.carrodecompras', ['productos' => null]);
        
        $oldCart = Session::get('cart');
        $cart = new Carrito($oldCart);
        return view('tienda.carrodecompras', [
            'carro' => $cart,
            'productos' => $cart->items,
            'totalPrecio' => $cart->totalPrecio 
            ]);
    }
    public function anadiralcarro(Request $request, $id)
    {
        $producto = Producto::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Carrito($oldCart);
        $cart->add($producto, $producto->id);
        
        $request->session()->put('cart', $cart);

        return Redirect::back()->with('datos', $producto->nombre.' añadido al carro de compras!');
        
    }

    public function postanadiralcarro(Request $request)
    {
        if($request->cantidad < 1)
        {
            $notificacion = array(
                'message' => 'La cantidad de productos debe ser mayor a 0', 
                'alert-type' => 'info'
            );
        
            return Redirect::back()->with($notificacion);
        }
        $producto = Product::find($request->id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Carrito($oldCart);
        $cart->addmany($producto, $request->cantidad, $producto->id);
        
        $request->session()->put('cart', $cart);

        $notificacion = array(
            'message' => $producto->nombre.' añadido al carro de compras', 
            'alert-type' => 'success'
        );
        
        return Redirect::back()->with($notificacion);
    }

    public function removerunitemcarro($id)
    {
        $producto = Producto::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Carrito($oldCart);
        $cart->removeaitem($id);

        Session::put('cart', $cart);

        // $notificacion = array(
        //     'message' => $producto->titulo.' ha sido reducido en 1', 
        //     'alert-type' => 'warning'
        // );

        return Redirect::back()->with('datos', $producto->nombre.' ha sido reducido en 1');
    }

    public function removeritemcarro($id)
    {
        $producto = Producto::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Carrito($oldCart);
        $cart->removeallitem($id);

        if(count($cart->items) > 0)
        {
            Session::put('cart', $cart);
        }
        else
        {
            Session::forget('cart');
        }

        Session::put('cart', $cart);

        // $notificacion = array(
        //     'message' => $producto->titulo.' ha sido eliminado', 
        //     'alert-type' => 'error'
        // );

        return Redirect::back()->with('datos', $producto->nombre.' eliminado del carro de compras!');
    }

    public function comprar()
    {
        if(!Session::has('cart'))
            return view('tienda.carrodecompras');

        $oldCart = Session::get('cart');
        
        if(count($oldCart->items) === 0)
            return Redirect::route('tienda.carro');
        
        $cart = new Carrito($oldCart);
        $total = $cart->totalPrecio;

        // // $rate = Swap::latest('USD/CLP');
        // $totalusd = (number_format(($cart->totalPrecio / $rate->getValue()),2) * 100); 
        // $cart->save();
       
        return view('tienda.comprar', [
            'productos' => $cart->items,
            'total' => $total,
          
            // 'totalusd' => $totalusd
        ]);
    }

    public function postcomprar(PedidoRequest $request)
    {
        if(!Session::has('cart'))
            return Redirect::route('tienda.carro');

        $oldCart = Session::get('cart');
        $cart = new Carrito($oldCart);

        try
        {   
            $pedido = Pedido::crear($cart, $request);
        }
        catch(Exception $e)
        {
            return Redirect::route('tienda.comprar')->with('datos', 'error');
        }

        Session::forget('cart');
        
        // return Redirect::route('tienda.index', compact('pedido'))->with('datos', 'Su compra ha sido realizada, el id de la compra es #' . $pedido->id);

        return Redirect::route('tienda.index')->with('datos', 'Su compra ha sido realizada, el id de la compra es #' . $pedido->id);
        // $pedido=new Pedido();
        // $pedido->carro = $request->carro;

        // $pedido->nombres =  $request->nombres;
        // $pedido->apellidos =  $request->apellidos;
        // $pedido->email =  $request->email;
        // $pedido->direccion =  $request->direccion;
        // $pedido-> telefono =  $request->telefono;
        // $pedido->comentario =  $request->comentario;
        // $pedido->save();
        // return Redirect::route('tienda.index')->with('datos', 'Su compra ha sido realizada, el id de la compra es #' . $pedido->id);
    }
}
