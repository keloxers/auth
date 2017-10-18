<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Requests;
use App\Articuloscategoria;
use App\Articulo;
use App\Deposito;


use Validator;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class ArticulosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $articulos = Articulo::paginate(15);
        $title = "Articulos";
        return view('articulos.index', ['articulos' => $articulos, 'title' => $title ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Agregar nuevo Articulos";
        return view('articulos.create', ['title' => $title]);
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
                    'articulo' => 'required|unique:articulos|max:75',
                    'articuloscategoria' => 'required|exists:articuloscategorias,articuloscategoria',

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

        $articuloscategoria = Articuloscategoria::where('articuloscategoria', $request->articuloscategoria)->first();

        $articulo = new Articulo;
        $articulo->articulo = $request->articulo;
        $articulo->descripcion = $request->descripcion;
        $articulo->articuloscategorias_id = $articuloscategoria->id;
        $articulo->precio_costo =  $request->precio_costo;
        $articulo->utilidad =  $request->utilidad;
        $articulo->iva =  $request->iva;
        $articulo->precio_publico =  $request->precio_publico;

        $articulo->save();
        return redirect('/articulos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $articulo = Articulo::find($id);
      $title = "Articulo";
      return view('articulos.show', ['articulo' => $articulo,'title' => $title]);
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
        $articulo = Articulo::find($id);
        $articuloscategoria = Articuloscategoria::where('id', $articulo->articuloscategorias_id)->first();



        $title = "Editar articulo";
        return view('articulos.edit', ['articulo' => $articulo, 'articuloscategoria' => $articuloscategoria, 'title' => $title]);
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
        $articulo = Articulo::find($id);
        $articulo->articulo = $request->articulo;
        $articulo->descripcion = $request->descripcion;
        // $articulo->articuloscategorias_id = $request->articuloscategorias_id;
        $articulo->precio_costo =  $request->precio_costo;
        $articulo->utilidad =  $request->utilidad;
        $articulo->iva =  $request->iva;
        $articulo->precio_publico =  $request->precio_publico;
        $articulo->save();
        return redirect('/articulos');
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
        $articulo = Articulo::find($id);
        $articulo->delete();

        return redirect('/articulos');
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

        $articulos = Articulo::where('articulo', 'like', '%'. $request->buscar . '%')->paginate(15);
        $title = "Articulo: buscando " . $request->buscar;
        return view('articulos.index', ['articulos' => $articulos, 'title' => $title ]);

    }



    public function search(Request $request){
         $term = $request->term;

        //  echo $term;
        //  die;

         $datos = Articulo::where('articulo', 'like', '%'. $request->term . '%')->get();
         $adevol = array();
         if (count($datos) > 0) {
             foreach ($datos as $dato)
                 {
                     $adevol[] = array(
                         'id' => $dato->id,
                         'value' => $dato->articulo,
                         'publico' => $dato->precio_publico,
                     );
             }
         } else {
                     $adevol[] = array(
                         'id' => 0,
                         'value' => 'no hay coincidencias para ' .  $term,
                         'publico' => 0,
                     );
         }
          return json_encode($adevol);
     }

}
