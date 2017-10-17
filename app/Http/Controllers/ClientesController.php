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
        $cliente->direccion = $request->direccion;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->observaciones = $request->observaciones;
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
      $cliente = Cliente::find($id);
      $title = "Cliente";
      return view('clientes.show', ['cliente' => $cliente,'title' => $title]);

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
        $cliente = Cliente::find($id);
        $barrio = Barrio::find($cliente->barrios_id);

        $title = "Editar Cliente";
        return view('clientes.edit', [
            'cliente' => $cliente,
            'barrio' => $barrio,
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

      echo $id;
      die;
      

      $validator = Validator::make($request->all(), [
                  'cliente' => 'required|unique:Clientes,id,'. $request->id . '|max:75',
                  'barrio' => 'required|exists:barrios,barrio'

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


        //
        $cliente = Cliente::find($id);
        $cliente->cliente = $request->cliente;
        $cliente->barrios_id = $barrio->id;
        $cliente->direccion = $request->direccion;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->observaciones = $request->observaciones;
        $cliente->save();
        return redirect('/clientes');
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
        $clientes = Cliente::find($id);
        $clientes->delete();

        return redirect('/clientes');
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

        $clientes = Cliente::where('cliente', 'like', '%'. $request->buscar . '%')->orderby('cliente')->paginate(15);
        $title = "Cliente: buscando " . $request->buscar;
        return view('clientes.index', ['clientes' => $clientes, 'title' => $title ]);


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
                         'value' => $dato->cliente,
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
