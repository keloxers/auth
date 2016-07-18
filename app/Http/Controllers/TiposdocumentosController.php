<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Requests;
use App\Tiposdocumento;


use Validator;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class TiposdocumentosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tiposdocumentos = Tiposdocumento::paginate(15);
        $title = "Tipos de Documentos Fiscales";
        return view('tiposdocumentos.index', ['tiposdocumentos' => $tiposdocumentos, 'title' => $title ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Agregar nuevo Tipo de Documento";
        return view('tiposdocumentos.create', ['title' => $title]);
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
                    'tiposdocumento' => 'required|unique:tiposdocumentos|max:75',

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


        $tiposdocumentos = new Tiposdocumento;
        $tiposdocumentos->tiposdocumento = $request->tiposdocumento;
        $tiposdocumentos->save();
        return redirect('/tiposdocumentos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $tiposdocumento = Tiposdocumento::find($id);
      $title = "tiposdocumentos";
      return view('tiposdocumentos.show', ['tiposdocumento' => $tiposdocumento,'title' => $title]);
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
        $tiposdocumento = tiposdocumento::find($id);
        $title = "Editar Tipo de Documentos";
        return view('tiposdocumentos.edit', ['tiposdocumento' => $tiposdocumento,'title' => $title]);


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
        $tiposdocumentos = tiposdocumento::find($id);
        $tiposdocumentos->tiposdocumento = $request->tiposdocumento;
        $tiposdocumentos->save();
        return redirect('/tiposdocumentos');
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
        $tiposdocumentos = tiposdocumento::find($id);
        $tiposdocumentos->delete();

        return redirect('/tiposdocumentos');
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

        $tiposdocumentos = tiposdocumento::where('tiposdocumento', 'like', '%'. $request->buscar . '%')->paginate(15);
        $title = "tiposdocumento: buscando " . $request->buscar;
        return view('tiposdocumentos.index', ['tiposdocumentos' => $tiposdocumentos, 'title' => $title ]);

    }



    public function search(Request $request){
         $term = $request->term;

        //  echo $term;
        //  die;

         $datos = tiposdocumento::where('tiposdocumento', 'like', '%'. $request->term . '%')->get();
         $adevol = array();
         if (count($datos) > 0) {
             foreach ($datos as $dato)
                 {
                     $adevol[] = array(
                         'id' => $dato->id,
                         'value' => $dato->tiposdocumento,
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
