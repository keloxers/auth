<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Requests;
use App\chofer;


use Validator;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class ChofersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $chofers = Chofer::paginate(15);
        $title = "chofer";
        return view('chofers.index', ['chofers' => $chofers, 'title' => $title ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Agregar nueva chofer";
        return view('chofers.create', ['title' => $title]);
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
                    'chofer' => 'required|unique:chofers|max:75',
                    'dni' => 'max:8',

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

        if(is_null($request->estado)) {
            $request->estado=0;
        }

        $chofers = new Chofer;
        $chofers->chofer = $request->chofer;
        $chofers->dni = $request->dni;
        $chofers->estado = $request->estado;
        $chofers->save();
        return redirect('/chofers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $chofer = Chofer::find($id);
      $title = "chofers";
      return view('chofers.show', ['chofer' => $chofer,'title' => $title]);
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
        $chofer = Chofer::find($id);
        $title = "Editar chofer";
        return view('chofers.edit', ['chofer' => $chofer,'title' => $title]);


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
        $chofers = Chofer::find($id);
        $chofers->chofer = $request->chofer;
        $chofers->dni = $request->dni;
        $chofers->estado = $request->estado;
        $chofers->save();
        return redirect('/chofers');
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
        $chofers = Chofer::find($id);
        $chofers->delete();

        return redirect('/chofers');
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

        $chofers = Chofer::where('chofer', 'like', '%'. $request->buscar . '%')->paginate(15);
        $title = "chofer: buscando " . $request->buscar;
        return view('chofers.index', ['chofers' => $chofers, 'title' => $title ]);

    }



    public function search(Request $request){
         $term = $request->term;

        //  echo $term;
        //  die;

         $datos = Chofer::where('chofer', 'like', '%'. $request->term . '%')->get();
         $adevol = array();
         if (count($datos) > 0) {
             foreach ($datos as $dato)
                 {
                     $adevol[] = array(
                         'id' => $dato->id,
                         'value' => $dato->chofer,
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
