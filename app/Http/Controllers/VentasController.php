<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Requests;
use App\Articulo;
use App\Stock;
use DB;
use App\Venta;
use App\Ventasdetalle;
use App\Cliente;
use App\Deposito;
use App\Condicionesventa;
use Carbon\Carbon;
use App\Cuota;
use App\Tiposdocumento;

use Validator;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class VentasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ventas = Venta::paginate(15);
        $title = "Ventas";
        return view('ventas.index', ['ventas' => $ventas, 'title' => $title ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Ventas";
        return view('ventas.create', ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //


        $validator = Validator::make($request->all(), [
                    'cliente' => 'required|exists:clientes,cliente',
                    'deposito' => 'required|exists:depositos,deposito',
                    'condicionesventa' => 'required|exists:condicionesventas,condicionesventa',

        ]);


        if ($validator->fails()) {
          foreach($validator->messages()->getMessages() as $field_name => $messages) {
            foreach($messages AS $message) {
                $errors[] = $message;
            }
          }
          return redirect()->back()->with('errors', $errors)->withInput();
          die;
        }

        $clientes_id = DB::table('clientes')->where('cliente', $request->cliente)->value('id');
        $depositos_id = DB::table('depositos')->where('deposito', $request->deposito)->value('id');
        $condicionesventas_id = DB::table('condicionesventas')->where('condicionesventa', $request->condicionesventa)->value('id');

        $venta = new Venta;
        $venta->clientes_id = $clientes_id;
        $venta->depositos_id = $depositos_id;
        $venta->condicionesventas_id = $condicionesventas_id;
        $venta->tiposdocumentos_id = 1;
        $venta->numero_comprobante = 1;
        $venta->save();
        return redirect('/ventas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $articuloscategoria = Articuloscategoria::find($id);
      $title = "Articulos Categorias";
      return view('articuloscategorias.show', ['articuloscategoria' => $articuloscategoria,'title' => $title]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $venta = Venta::find($id);
        $cliente = Cliente::find($venta->clientes_id);
        $deposito = Deposito::find($venta->depositos_id);
        $condicionesventa = Condicionesventa::find($venta->condicionesventas_id);

        $title = "Editar venta";
        return view('ventas.edit', [ 'venta' => $venta,
                                    'cliente' => $cliente,
                                    'deposito' => $deposito,
                                    'condicionesventa' => $condicionesventa,
                                    'title' => $title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {



        $validator = Validator::make($request->all(), [
                    'cliente' => 'required|exists:clientes,cliente',
                    'deposito' => 'required|exists:depositos,deposito',
                    'condicionesventa' => 'required|exists:condicionesventas,condicionesventa',

        ]);


        if ($validator->fails()) {
          foreach($validator->messages()->getMessages() as $field_name => $messages) {
            foreach($messages AS $message) {
                $errors[] = $message;
            }
          }
          return redirect()->back()->with('errors', $errors)->withInput();
          die;
        }

        $clientes_id = DB::table('clientes')->where('cliente', $request->cliente)->value('id');
        $depositos_id = DB::table('depositos')->where('deposito', $request->deposito)->value('id');
        $condicionesventas_id = DB::table('condicionesventas')->where('condicionesventa', $request->condicionesventa)->value('id');

        $venta = Venta::find($request->ventas_id);
        $venta->clientes_id = $clientes_id;
        $venta->depositos_id = $depositos_id;
        $venta->condicionesventas_id = $condicionesventas_id;
        $venta->tiposdocumentos_id = 1;
        $venta->numero_comprobante = 1;
        $venta->save();
        return redirect('/ventas');




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $articuloscategorias = Articuloscategoria::find($id);
        $articuloscategorias->delete();

        return redirect('/articuloscategorias');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function finder(Request $request)
    {
        //

        $articuloscategorias = Articuloscategoria::where('articuloscategoria', 'like', '%'. $request->buscar . '%')->paginate(15);
        $title = "articuloscategoria: buscando " . $request->buscar;
        return view('articuloscategorias.index', ['articuloscategorias' => $articuloscategorias, 'title' => $title ]);

    }



    public function search(Request $request){
         $term = $request->term;

        //  echo $term;
        //  die;

         $datos = Articuloscategoria::where('articuloscategoria', 'like', '%'. $request->term . '%')->get();
         $adevol = array();
         if (count($datos) > 0) {
             foreach ($datos as $dato)
                 {
                     $adevol[] = array(
                         'id' => $dato->id,
                         'value' => $dato->articuloscategoria,
                     );
             }
         } else {
                     $adevol[] = array(
                         'id' => 0,
                         'value' => 'no hay coincidencias para ' .  $term
                     );
         }
          return json_encode($adevol);
     }


     public function close($id)
     {

         $venta = Venta::find($id);

         $ventasdetalles = Ventasdetalle::where('ventas_id',$id)->get();

         $cantidadcuotas = $venta->condicionesventas->cuotas;

         $precio_total = 0;

         $datenow = Carbon::now();


         if (count($ventasdetalles) > 0 )
         {
             foreach ($ventasdetalles as $ventasdetalle)
             {

                $stock = Stock::where('depositos_id',$venta->depositos_id)->
                            where('articulos_id',$ventasdetalle->articulos_id)->
                            first();

                if ($stock) {
                  $stock->stock = $stock->stock - $ventasdetalle->cantidad;
                  $stock->save();
                } else {
                  $stock = new Stock;
                  $stock->depositos_id = $venta->depositos_id;
                  $stock->articulos_id = $ventasdetalle->articulos_id;
                  $stock->stock = -$ventasdetalle->cantidad;
                  $stock->stock_minimo = 0;
                  $stock->stock_maximo = 0;
                  $stock->save();

                }

                $precio_total += $ventasdetalle->precio_total;
             }

           $tiposdocumento = Tiposdocumento::find(1);
           $numero_comprobante_factura = $tiposdocumento->numero;
           $tiposdocumento->numero = $tiposdocumento->numero +1;
           $tiposdocumento->save();

           $tiposdocumento = Tiposdocumento::find(2);
           $numero_comprobante_recibo = $tiposdocumento->numero;
           $tiposdocumento->numero = $tiposdocumento->numero +1;
           $tiposdocumento->save();

           // actualizo el registro de venta
           $venta->numero_comprobante = $numero_comprobante_factura;
           $venta->subtotal = $precio_total;
           $venta->total = $precio_total;
           $venta->estado = 'cerrada';
           $venta->save();
           $ventas_id = $venta->id;


           // verifico entrega y calculo valor cuota
           $valorcuotas = 0;

           if ($venta->entrega == 0 ) {
               $entrega = $precio_total;
               $entrega = $precio_total * $condicionesventa->porcentaje_entrega / 100;
           } else {
               $entrega = $venta->entrega;
           }

           if ($precio_total > 0 and $venta->condicionesventas->cuotas > 0) {
               $resto = $precio_total - $entrega;
               $resto = $resto + ( $resto * $venta->condicionesventas->interes / 100);
               $valorcuotas = ceil($resto / $venta->condicionesventas->cuotas);
           }



             if ($cantidadcuotas > 0)
              {
                 for ($i = 1; $i <= $cantidadcuotas; $i++)
                 {
                   $cuota = new Cuota;
                   $datenow = $datenow->addMonth();
                   $cuota->ventas_id = $ventas_id;
                   $cuota->fecha_pago = $datenow;
                   $cuota->cuota_numero = $i;
                   $cuota->cuota_importe = $valorcuotas;
                   $cuota->cuota_pagado = 0;
                   $cuota->cuota_saldo = $valorcuotas;
                   $cuota->save();

                 }
               }



           }

         $ventas = Venta::paginate(15);
         $title = "Ventas";
         return view('ventas.index', ['ventas' => $ventas, 'title' => $title ]);



       }
}
