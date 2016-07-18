<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Requests;
use App\Articuloscategoria;


use Validator;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class ArticuloscategoriasController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $articuloscategorias = Articuloscategoria::paginate(15);
        $title = "articuloscategorias";
        return view('articuloscategorias.index', ['articuloscategorias' => $articuloscategorias, 'title' => $title ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Agregar nueva articuloscategoria";
        return view('articuloscategorias.create', ['title' => $title]);
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
                    'articuloscategoria' => 'required|unique:articuloscategorias|max:75',

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


        $articuloscategorias = new Articuloscategoria;
        $articuloscategorias->articuloscategoria = $request->articuloscategoria;
        $articuloscategorias->save();
        return redirect('/articuloscategorias');
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
      $title = "articuloscategorias";
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
