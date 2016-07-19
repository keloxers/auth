<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Requests;
use App\devolucionesmotivo;


use Validator;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class DevolucionesmotivosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $devolucionesmotivos = Devolucionesmotivo::paginate(15);
        $title = "devolucionesmotivos";
        return view('devolucionesmotivos.index', ['devolucionesmotivos' => $devolucionesmotivos, 'title' => $title ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Agregar nueva devolucionesmotivo";
        return view('devolucionesmotivos.create', ['title' => $title]);
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
                    'devolucionesmotivo' => 'required|unique:devolucionesmotivos|max:75',

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


        $devolucionesmotivos = new Devolucionesmotivo;
        $devolucionesmotivos->devolucionesmotivo = $request->devolucionesmotivo;
        $devolucionesmotivos->save();
        return redirect('/devolucionesmotivos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $devolucionesmotivo = Devolucionesmotivo::find($id);
      $title = "devolucionesmotivos";
      return view('devolucionesmotivos.show', ['devolucionesmotivo' => $devolucionesmotivo,'title' => $title]);
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
        $devolucionesmotivo = Devolucionesmotivo::find($id);
        $title = "Editar devolucionesmotivo";
        return view('devolucionesmotivos.edit', ['devolucionesmotivo' => $devolucionesmotivo,'title' => $title]);


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
                    'devolucionesmotivo' => 'required|unique:devolucionesmotivos,id,'. $request->id . '|max:75',


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


        $devolucionesmotivos = Devolucionesmotivo::find($id);
        $devolucionesmotivos->devolucionesmotivo = $request->devolucionesmotivo;
        $devolucionesmotivos->save();
        return redirect('/devolucionesmotivos');
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
        $devolucionesmotivos = Devolucionesmotivo::find($id);
        $devolucionesmotivos->delete();

        return redirect('/devolucionesmotivos');
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

        $devolucionesmotivos = Devolucionesmotivo::where('devolucionesmotivo', 'like', '%'. $request->buscar . '%')->paginate(15);
        $title = "devolucionesmotivo: buscando " . $request->buscar;
        return view('devolucionesmotivos.index', ['devolucionesmotivos' => $devolucionesmotivos, 'title' => $title ]);

    }



    public function search(Request $request){
         $term = $request->term;

        //  echo $term;
        //  die;

         $datos = Devolucionesmotivo::where('devolucionesmotivo', 'like', '%'. $request->term . '%')->get();
         $adevol = array();
         if (count($datos) > 0) {
             foreach ($datos as $dato)
                 {
                     $adevol[] = array(
                         'id' => $dato->id,
                         'value' => $dato->devolucionesmotivo,
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
