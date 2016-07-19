<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Requests;
use App\Proveedorescategoria;


use Validator;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class ProveedorescategoriasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $proveedorescategorias = Proveedorescategoria::paginate(15);
        $title = "Proveedores Categorias";
        return view('proveedorescategorias.index', ['proveedorescategorias' => $proveedorescategorias, 'title' => $title ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Agregar nuevo Proveedor Categoria";
        return view('proveedorescategorias.create', ['title' => $title]);
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
                    'proveedorescategoria' => 'required|unique:proveedorescategorias|max:75',

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


        $proveedorescategorias = new Proveedorescategoria;
        $proveedorescategorias->proveedorescategoria = $request->proveedorescategoria;
        $proveedorescategorias->save();
        return redirect('/proveedorescategorias');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $proveedorescategoria = Proveedorescategoria::find($id);
      $title = "Proveedor Categoria";
      return view('proveedorescategorias.show', ['proveedorescategoria' => $proveedorescategoria,'title' => $title]);
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
        $proveedorescategoria = Proveedorescategoria::find($id);
        $title = "Editar Proveedor Categoria";
        return view('proveedorescategorias.edit', ['proveedorescategoria' => $proveedorescategoria,'title' => $title]);


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
                    'proveedorescategoria' => 'required|unique:proveedorescategorias,id,'. $request->id . '|max:75',


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


        $proveedorescategorias = Proveedorescategoria::find($id);
        $proveedorescategorias->proveedorescategoria = $request->proveedorescategoria;
        $proveedorescategorias->save();
        return redirect('/proveedorescategorias');
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
        $proveedorescategorias = Proveedorescategoria::find($id);
        $proveedorescategorias->delete();

        return redirect('/proveedorescategorias');
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

        $proveedorescategorias = Proveedorescategoria::where('proveedorescategoria', 'like', '%'. $request->buscar . '%')->paginate(15);
        $title = "proveedorescategoria: buscando " . $request->buscar;
        return view('proveedorescategorias.index', ['proveedorescategorias' => $proveedorescategorias, 'title' => $title ]);

    }



    public function search(Request $request){
         $term = $request->term;

        //  echo $term;
        //  die;

         $datos = Proveedorescategoria::where('proveedorescategoria', 'like', '%'. $request->term . '%')->get();
         $adevol = array();
         if (count($datos) > 0) {
             foreach ($datos as $dato)
                 {
                     $adevol[] = array(
                         'id' => $dato->id,
                         'value' => $dato->proveedorescategoria,
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
