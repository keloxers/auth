<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Requests;
use App\pedidostiposbonificacion;


use Validator;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class pedidostiposbonificacionsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pedidostiposbonificacions = Pedidostiposbonificacion::paginate(15);
        $title = "pedidostiposbonificacions";
        return view('pedidostiposbonificacions.index', ['pedidostiposbonificacions' => $pedidostiposbonificacions, 'title' => $title ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Agregar nuevo Tipo de Bonificación de Pedidos";
        return view('pedidostiposbonificacions.create', ['title' => $title]);
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
                    'pedidostiposbonificacion' => 'required|unique:pedidostiposbonificacions|max:75',

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


        $pedidostiposbonificacions = new pedidostiposbonificacion;
        $pedidostiposbonificacions->pedidostiposbonificacion = $request->pedidostiposbonificacion;
        $pedidostiposbonificacions->save();
        return redirect('/pedidostiposbonificacions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $pedidostiposbonificacion = pedidostiposbonificacion::find($id);
      $title = "pedidostiposbonificacions";
      return view('pedidostiposbonificacions.show', ['pedidostiposbonificacion' => $pedidostiposbonificacion,'title' => $title]);
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
        $pedidostiposbonificacion = pedidostiposbonificacion::find($id);
        $title = "Editar pedidostiposbonificacion";
        return view('pedidostiposbonificacions.edit', ['pedidostiposbonificacion' => $pedidostiposbonificacion,'title' => $title]);


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
                    'pedidostiposbonificacion' => 'required|unique:pedidostiposbonificacions,id,'. $request->id . '|max:75',


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


        $pedidostiposbonificacions = pedidostiposbonificacion::find($id);
        $pedidostiposbonificacions->pedidostiposbonificacion = $request->pedidostiposbonificacion;
        $pedidostiposbonificacions->save();
        return redirect('/pedidostiposbonificacions');
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
        $pedidostiposbonificacions = pedidostiposbonificacion::find($id);
        $pedidostiposbonificacions->delete();

        return redirect('/pedidostiposbonificacions');
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

        $pedidostiposbonificacions = pedidostiposbonificacion::where('pedidostiposbonificacion', 'like', '%'. $request->buscar . '%')->paginate(15);
        $title = "pedidostiposbonificacion: buscando " . $request->buscar;
        return view('pedidostiposbonificacions.index', ['pedidostiposbonificacions' => $pedidostiposbonificacions, 'title' => $title ]);

    }



    public function search(Request $request){
         $term = $request->term;

        //  echo $term;
        //  die;

         $datos = pedidostiposbonificacion::where('pedidostiposbonificacion', 'like', '%'. $request->term . '%')->get();
         $adevol = array();
         if (count($datos) > 0) {
             foreach ($datos as $dato)
                 {
                     $adevol[] = array(
                         'id' => $dato->id,
                         'value' => $dato->pedidostiposbonificacion,
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
