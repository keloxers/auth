<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Requests;
use App\Motivosajustesstock;


use Validator;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class MotivosajustesstocksController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $motivosajustesstocks = Motivosajustesstock::paginate(15);
        $title = "Motivos Ajustes Stocks";
        return view('motivosajustesstocks.index', ['motivosajustesstocks' => $motivosajustesstocks, 'title' => $title ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Agregar nuevo Motivos Ajustes Stocks";
        return view('motivosajustesstocks.create', ['title' => $title]);
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
                    'motivosajustesstock' => 'required|unique:motivosajustesstocks|max:75',

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


        $motivosajustesstocks = new Motivosajustesstock;
        $motivosajustesstocks->motivosajustesstock = $request->motivosajustesstock;
        $motivosajustesstocks->operacion = $request->operacion;
        $motivosajustesstocks->save();
        return redirect('/motivosajustesstocks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $motivosajustesstock = Motivosajustesstock::find($id);
      $title = "Motivos Ajustes Stocks";
      return view('motivosajustesstocks.show', ['motivosajustesstock' => $motivosajustesstock,'title' => $title]);
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
        $motivosajustesstock = Motivosajustesstock::find($id);
        $title = "Editar Motivos Ajustes Stocks";
        return view('motivosajustesstocks.edit', ['motivosajustesstock' => $motivosajustesstock,'title' => $title]);


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
                    'motivosajustesstock' => 'required|unique:motivosajustesstocks,id,'. $request->id . '|max:75',


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


        $motivosajustesstocks = Motivosajustesstock::find($id);
        $motivosajustesstocks->motivosajustesstock = $request->motivosajustesstock;
        $motivosajustesstocks->operacion = $request->operacion;
        $motivosajustesstocks->save();
        return redirect('/motivosajustesstocks');
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
        $motivosajustesstocks = Motivosajustesstock::find($id);
        $motivosajustesstocks->delete();

        return redirect('/motivosajustesstocks');
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

        $motivosajustesstocks = Motivosajustesstock::where('motivosajustesstock', 'like', '%'. $request->buscar . '%')->paginate(15);
        $title = "Motivos Ajustes Stocks: buscando " . $request->buscar;
        return view('motivosajustesstocks.index', ['motivosajustesstocks' => $motivosajustesstocks, 'title' => $title ]);

    }



    public function search(Request $request){
         $term = $request->term;

        //  echo $term;
        //  die;

         $datos = Motivosajustesstock::where('motivosajustesstock', 'like', '%'. $request->term . '%')->get();
         $adevol = array();
         if (count($datos) > 0) {
             foreach ($datos as $dato)
                 {
                     $adevol[] = array(
                         'id' => $dato->id,
                         'value' => $dato->motivosajustesstock,
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
