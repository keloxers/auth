<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Requests;
use App\Condicionesventa;


use Validator;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class CondicionesventasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $condicionesventas = Condicionesventa::paginate(15);
        $title = "Condiciones Ventas";
        return view('condicionesventas.index', ['condicionesventas' => $condicionesventas, 'title' => $title ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Agregar nueva Condicion Venta";
        return view('condicionesventas.create', ['title' => $title]);
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
                    'condicionesventa' => 'required|unique:condicionesventas|max:75',

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


        $condicionesventas = new Condicionesventa;
        $condicionesventas->condicionesventa = $request->condicionesventa;
        $condicionesventas->porcentaje_entrega = $request->porcentaje_entrega;
        $condicionesventas->cuotas = $request->cuotas;
        $condicionesventas->interes = $request->interes;
        $condicionesventas->save();
        return redirect('/condicionesventas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $condicionesventa = Condicionesventa::find($id);
      $title = "Condiciones Ventas";
      return view('condicionesventas.show', ['condicionesventa' => $condicionesventa,'title' => $title]);
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
        $condicionesventa = Condicionesventa::find($id);
        $title = "Editar condición Venta";
        return view('condicionesventas.edit', ['condicionesventa' => $condicionesventa,'title' => $title]);


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
                    'condicionesventa' => 'required|unique:condicionesventas,id,'. $request->id . '|max:75',


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


        $condicionesventas = Condicionesventa::find($id);
        $condicionesventas->condicionesventa = $request->condicionesventa;
        $condicionesventas->porcentaje_entrega = $request->porcentaje_entrega;
        $condicionesventas->cuotas = $request->cuotas;
        $condicionesventas->interes = $request->interes;        
        $condicionesventas->save();
        return redirect('/condicionesventas');
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
        $condicionesventas = Condicionesventa::find($id);
        $condicionesventas->delete();

        return redirect('/condicionesventas');
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

        $condicionesventas = Condicionesventa::where('condicionesventa', 'like', '%'. $request->buscar . '%')->paginate(15);
        $title = "Condición Venta: buscando " . $request->buscar;
        return view('condicionesventas.index', ['condicionesventas' => $condicionesventas, 'title' => $title ]);

    }



    public function search(Request $request){
         $term = $request->term;

        //  echo $term;
        //  die;

         $datos = Condicionesventa::where('condicionesventa', 'like', '%'. $request->term . '%')->get();
         $adevol = array();
         if (count($datos) > 0) {
             foreach ($datos as $dato)
                 {
                     $adevol[] = array(
                         'id' => $dato->id,
                         'value' => $dato->condicionesventa,
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
