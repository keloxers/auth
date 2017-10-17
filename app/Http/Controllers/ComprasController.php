<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Requests;
use App\Compra;
use App\Articulo;
use App\Comprasdetalle;
use App\Stock;
use DB;

use Validator;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class ComprasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $compras = Compra::paginate(15);
        $title = "Compras";
        return view('compras.index', ['compras' => $compras, 'title' => $title ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Compras";
        return view('compras.create', ['title' => $title]);
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
                    'proveedor' => 'required|exists:proveedors,proveedor',

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

        $proveedors_id = DB::table('proveedors')->where('proveedor', $request->proveedor)->value('id');

        $compra = new Compra;
        $compra->proveedors_id = $proveedors_id;
        $compra->saldo_total = 0;
        $compra->importe_total = 0;
        $compra->estado = 'abierta';
        $compra->save();
        return redirect('/compras');
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
        $articuloscategoria = Articuloscategoria::find($id);
        $title = "Editar articuloscategoria";
        return view('articuloscategorias.edit', ['articuloscategoria' => $articuloscategoria,'title' => $title]);


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
        //
        $articuloscategorias = Articuloscategoria::find($id);
        $articuloscategorias->articuloscategoria = $request->articuloscategoria;
        $articuloscategorias->save();
        return redirect('/articuloscategorias');
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


         $compra = Compra::find($id);
         $comprasdetalles = Comprasdetalle::where('compras_id',$compra->id)->get();

         $precio_costo = 0;

         if (count($comprasdetalles) > 0)
          {
             foreach ($comprasdetalles as $comprasdetalle)
             {
                $articulo = Articulo::find($comprasdetalle->articulos_id);
                $articulo->precio_costo = $comprasdetalle->precio_costo;
                $articulo->save();

                /* aca actualiza el stock buscando por deposito y articulo :) */

                $stock = Stock::where('depositos_id',$comprasdetalle->depositos_id)->
                            where('articulos_id',$comprasdetalle->articulos_id)->
                            first();

                if ($stock) {
                  $stock->stock = $stock->stock + $comprasdetalle->cantidad;
                  $stock->save();
                } else {
                  $stock = new Stock;
                  $stock->depositos_id = $comprasdetalle->depositos_id;
                  $stock->articulos_id = $comprasdetalle->articulos_id;
                  $stock->stock = $comprasdetalle->cantidad;
                  $stock->stock_minimo = 0;
                  $stock->stock_maximo = 0;
                  $stock->save();

                }

                $precio_costo += $comprasdetalle->precio_costo;
             }
           }

         $compra->saldo_total = $precio_costo;
         $compra->importe_total = $precio_costo;
         $compra->estado = 'cerrada';
         $compra->save();

         $compras = Compra::paginate(15);
         $title = "Compras";
         return view('compras.index', ['compras' => $compras, 'title' => $title ]);



     }


}
