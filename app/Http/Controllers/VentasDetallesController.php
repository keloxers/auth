<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Requests;
use App\Venta;
use App\Ventasdetalle;
use App\Deposito;
use App\Articulo;
use App\Condicionesventa;
use DB;

use Validator;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class VentasdetallesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $venta = Venta::find($id);
        $condicionesventa = Condicionesventa::find($venta->condicionesventas_id);
        $ventasdetalles = Ventasdetalle::where('ventas_id',$id)->paginate(15);
        $title = "Ventas Detalles";
        return view('ventasdetalles.index', ['ventasdetalles' => $ventasdetalles,
                                'venta' => $venta,
                                'condicionesventa' => $condicionesventa,
                                'title' => $title ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //

        $venta = Venta::find($id);
        $title = "Ventas Detalles";
        return view('ventasdetalles.create', ['venta' => $venta, 'title' => $title]);
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
                    'cantidad' => 'required|numeric',
                    'articulo' => 'required|exists:articulos,articulo',
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
        $cantidad = $request->cantidad;
        $articulo = DB::table('articulos')->where('articulo', $request->articulo)->first();
        $articulos_id = $articulo->id;
        $descripcion = $articulo->articulo;
        $precio_unitario = $articulo->precio_publico;
        $precio_total = $precio_unitario * $cantidad;

        $ventasdetalle = new ventasdetalle;
        $ventasdetalle->ventas_id = $request->ventas_id;
        $ventasdetalle->articulos_id = $articulos_id;
        $ventasdetalle->cantidad = $request->cantidad;
        $ventasdetalle->descripcion = $descripcion;
        $ventasdetalle->precio_unitario = $precio_unitario;
        $ventasdetalle->precio_total = $precio_total;
        $ventasdetalle->save();
        return redirect('/ventasdetalles/' . $request->ventas_id);
    }


/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function calcular(Request $request)
{
    //


    $validator = Validator::make($request->all(), [
                'entrega' => 'required|numeric',
                'ventas_id' => 'required|exists:ventas,id',
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

    $ventasdetalle = Venta::find($request->ventas_id);
    $ventasdetalle->entrega = $request->entrega;
    $ventasdetalle->save();
    return redirect('/ventasdetalles/' . $request->ventas_id);
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      $ventasdetalle = ventasdetalle::find($id);
      $venta = venta::find($ventasdetalle->ventas_id);
      $deposito = Deposito::find($ventasdetalle->depositos_id);
      $articulo = Articulo::find($ventasdetalle->articulos_id);

      $title = "ventas detalle";
      return view('ventasdetalles.show', ['ventasdetalle' => $ventasdetalle,
                                            'venta' => $venta,
                                            'deposito' => $deposito,
                                            'articulo' => $articulo,
                                            'title' => $title]);



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ventasdetalle = ventasdetalle::find($id);
        $venta = venta::find($ventasdetalle->ventas_id);
        $deposito = Deposito::find($ventasdetalle->depositos_id);
        $articulo = Articulo::find($ventasdetalle->articulos_id);

        $title = "Editar ventas detalle";
        return view('ventasdetalles.edit', ['ventasdetalle' => $ventasdetalle,
                                              'venta' => $venta,
                                              'deposito' => $deposito,
                                              'articulo' => $articulo,
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
                      'deposito' => 'required|exists:depositos,deposito',
                      'articulo' => 'required|exists:articulos,articulo',

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

          $depositos_id = DB::table('depositos')->where('deposito', $request->deposito)->value('id');
          $articulos_id = DB::table('articulos')->where('articulo', $request->articulo)->value('id');

          $ventasdetalle = ventasdetalle::find($id);
          // $ventasdetalle->ventas_id = $request->ventas_id;
          $ventasdetalle->depositos_id = $depositos_id;
          $ventasdetalle->articulos_id = $articulos_id;
          $ventasdetalle->cantidad = $request->cantidad;
          $ventasdetalle->precio_costo = $request->precio_costo;
          $ventasdetalle->save();
          return redirect('/ventasdetalles/' . $request->ventas_id);






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
        $ventasdetalle = ventasdetalle::find($id);
        $ventas_id = $ventasdetalle->ventas_id;
        $ventasdetalle->delete();

        return redirect('/ventasdetalles/' . $ventas_id);
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



}
