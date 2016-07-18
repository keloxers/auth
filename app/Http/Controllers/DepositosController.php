<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Requests;
use App\Deposito;


use Validator;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class depositosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $depositos = Deposito::paginate(15);
        $title = "Depositos";
        return view('depositos.index', ['depositos' => $depositos, 'title' => $title ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Agregar nuevo deposito";
        return view('depositos.create', ['title' => $title]);
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
                    'deposito' => 'required|unique:depositos|max:75',
                    'numero' => 'required|max:75',
                    'capacidadkg' => 'numeric',

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


        $depositos = new Deposito;
        $depositos->deposito = $request->deposito;
        $depositos->numero = $request->numero;
        $depositos->capacidadkg = $request->capacidadkg;
        $depositos->save();
        return redirect('/depositos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $deposito = Deposito::find($id);
      $title = "Depositos";
      return view('depositos.show', ['deposito' => $deposito,'title' => $title]);
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
        $deposito = Deposito::find($id);
        $title = "Editar Deposito";
        return view('depositos.edit', ['deposito' => $deposito,'title' => $title]);


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
        $depositos = Deposito::find($id);
        $depositos->deposito = $request->deposito;
        $depositos->numero = $request->numero;
        $depositos->capacidadkg = $request->capacidadkg;
        
        $depositos->save();
        return redirect('/depositos');
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
        $depositos = Deposito::find($id);
        $depositos->delete();

        return redirect('/depositos');
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

        $depositos = Deposito::where('deposito', 'like', '%'. $request->buscar . '%')->paginate(15);
        $title = "Deposito: buscando " . $request->buscar;
        return view('depositos.index', ['depositos' => $depositos, 'title' => $title ]);

    }



    public function search(Request $request){
         $term = $request->term;

        //  echo $term;
        //  die;

         $datos = Deposito::where('deposito', 'like', '%'. $request->term . '%')->get();
         $adevol = array();
         if (count($datos) > 0) {
             foreach ($datos as $dato)
                 {
                     $adevol[] = array(
                         'id' => $dato->id,
                         'value' => $dato->deposito,
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
