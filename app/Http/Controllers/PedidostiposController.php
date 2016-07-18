<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Requests;
use App\Pedidostipo;


use Validator;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class PedidostiposController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pedidostipos = Pedidostipo::orderby('pedidostipo')->paginate(15);
        $title = "Todos los Pedidos Tipos";
        return view('pedidostipos.index', ['pedidostipos' => $pedidostipos, 'title' => $title ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Agregar nueva pedidostipo";
        return view('pedidostipos.create', ['title' => $title]);
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
                    'pedidostipo' => 'required|unique:pedidostipos|max:75',

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


        $pedidostipos = new Pedidostipo;
        $pedidostipos->pedidostipo = $request->pedidostipo;
        $pedidostipos->save();
        return redirect('/pedidostipos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $pedidostipo = Pedidostipo::find($id);
      $title = "pedidostipos";
      return view('pedidostipos.show', ['pedidostipo' => $pedidostipo,'title' => $title]);
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
        $pedidostipo = Pedidostipo::find($id);
        $title = "Editar pedidostipo";
        return view('pedidostipos.edit', ['pedidostipo' => $pedidostipo,'title' => $title]);


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
        $pedidostipos = Pedidostipo::find($id);
        $pedidostipos->pedidostipo = $request->pedidostipo;
        $pedidostipos->save();
        return redirect('/pedidostipos');
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
        $pedidostipos = Pedidostipo::find($id);
        $pedidostipos->delete();

        return redirect('/pedidostipos');
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

        $pedidostipos = Pedidostipo::where('pedidostipo', 'like', '%'. $request->buscar . '%')->paginate(15);
        $title = "pedidostipo: buscando " . $request->buscar;
        return view('pedidostipos.index', ['pedidostipos' => $pedidostipos, 'title' => $title ]);

    }



    public function search(Request $request){
         $term = $request->term;

        //  echo $term;
        //  die;

         $datos = Pedidostipo::where('pedidostipo', 'like', '%'. $request->term . '%')->get();
         $adevol = array();
         if (count($datos) > 0) {
             foreach ($datos as $dato)
                 {
                     $adevol[] = array(
                         'id' => $dato->id,
                         'value' => $dato->pedidostipo,
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
