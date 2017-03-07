<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Requests;
use App\Cliente;
use App\Barrio;

use Validator;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::orderby('cliente')->paginate(15);
        $title = "Clientes";
        return view('clientes.index', ['clientes' => $clientes, 'title' => $title ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Agregar nuevo Cliente";
        return view('clientes.create', ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
                    'cliente' => 'required|unique:clientes|max:75',

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

        $barrio = Barrio::where('barrio', $request->barrio)->first();

        $cliente = new Cliente;
        $cliente->cliente = $request->cliente;
        $cliente->barrios_id = $barrio->id;
        $cliente->save();
        return redirect('/clientes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $Cliente = Cliente::find($id);
      $title = "Clientes";
      return view('Clientes.show', ['Cliente' => $Cliente,'title' => $title]);

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
        $Cliente = Cliente::find($id);
        $ciudad = Ciudad::find($Cliente->ciudads_id);

        $title = "Editar Cliente";
        return view('Clientes.edit', [
            'Cliente' => $Cliente,
            'ciudad' => $ciudad,
            'title' => $title
          ]);

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
                  'Cliente' => 'required|unique:Clientes,id,'. $request->id . '|max:75',
                  'ciudad' => 'required|exists:ciudads,ciudad'

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


        $ciudad = Ciudad::where('ciudad', $request->ciudad)->first();


        //
        $Cliente = Cliente::find($id);
        $Cliente->Cliente = $request->Cliente;
        $Cliente->ciudads_id = $ciudad->id;
        $Cliente->save();
        return redirect('/Clientes');
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
        $Clientes = Cliente::find($id);
        $Clientes->delete();

        return redirect('/Clientes');
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

        $Clientes = Cliente::where('Cliente', 'like', '%'. $request->buscar . '%')->orderby('Cliente')->paginate(15);
        $title = "Cliente: buscando " . $request->buscar;
        return view('Clientes.index', ['Clientes' => $Clientes, 'title' => $title ]);


    }


    public function search(Request $request){
         $term = $request->term;
         $datos = Cliente::where('Cliente', 'like', '%'. $request->term . '%')->get();
         $adevol = array();
         if (count($datos) > 0) {
             foreach ($datos as $dato)
                 {
                     $adevol[] = array(
                         'id' => $dato->id,
                         'value' => $dato->Cliente,
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
