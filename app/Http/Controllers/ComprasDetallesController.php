<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Requests;
use App\Compra;
use App\Comprasdetalle;
use DB;

use Validator;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class ComprasdetallesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $compra = Compra::find($id);
        $comprasdetalles = Comprasdetalle::paginate(15);
        $title = "Compras Detalles";
        return view('comprasdetalles.index', ['comprasdetalles' => $comprasdetalles, 'compra' => $compra, 'title' => $title ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $compra = Compra::find($id);

        $title = "Compras Detalles";
        return view('comprasdetalles.create', ['compra' => $compra, 'title' => $title]);
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

        $comprasdetalle = new Comprasdetalle;
        $comprasdetalle->compras_id = $request->compras_id;
        $comprasdetalle->depositos_id = $depositos_id;
        $comprasdetalle->articulos_id = $articulos_id;
        $comprasdetalle->cantidad = $request->cantidad;
        $comprasdetalle->precio_costo = $request->precio_costo;
        $comprasdetalle->save();
        return redirect('/comprasdetalles/' . $request->compras_id);
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



}
