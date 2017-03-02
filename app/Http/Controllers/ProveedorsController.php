<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Requests;

use App\Proveedor;
use App\Tipoiva;
use DB;


use Validator;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class ProveedorsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $proveedors = Proveedor::paginate(15);
        $title = "Proveedores";
        return view('proveedors.index', ['proveedors' => $proveedors, 'title' => $title ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Agregar nuevo Proveedor";
        return view('proveedors.create', ['title' => $title]);
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

        // echo $request->tipoiva;
        // die;


        $validator = Validator::make($request->all(), [
                    'proveedor' => 'required|unique:proveedors|max:75',
                    'tipoivas_id' => 'required|exists:tipoivas,id',

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


        $tipoiva_id = DB::table('tipoivas')->where('tipoiva', $request->tipoiva)->value('id');

        $proveedor = new Proveedor;
        $proveedor->proveedor = $request->proveedor;
        $proveedor->domicilio_fiscal = $request->domicilio_fiscal;
        $proveedor->tipoivas_id = $tipoiva_id;
        $proveedor->cuit =  $request->cuit;
        $proveedor->telefono =  $request->telefono;
        $proveedor->save();
        return redirect('/proveedors');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      $proveedor = Proveedor::find($id);
      $title = "Proveedor";
      return view('proveedors.show', ['proveedor' => $proveedor,'title' => $title]);
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
        $proveedor = Proveedor::find($id);
        $tipoiva = Tipoiva::where('id', $proveedor->tipoivas_id)->first();

        $title = "Editar Proveedor";
        return view('proveedors.edit', ['proveedor' => $proveedor, 'tipoiva' => $tipoiva, 'title' => $title]);
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

              // 'proveedor' => 'required|unique:proveedors|max:75',

                $validator = Validator::make($request->all(), [

                            'tipoivas_id' => 'required|exists:tipoivas,id',

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

                $tipoiva = Tipoiva::where('tipoiva', $request->tipoiva)->first();

                $proveedor = Proveedor::find($id);
                $proveedor->proveedor = $request->proveedor;
                $proveedor->domicilio_fiscal = $request->domicilio_fiscal;
                $proveedor->tipoivas_id = $tipoiva->id;
                $proveedor->cuit =  $request->cuit;
                $proveedor->telefono =  $request->telefono;
                $proveedor->save();
                return redirect('/proveedors');


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
        $proveedor = Proveedor::find($id);
        $proveedor->delete();

        return redirect('/proveedors');
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

        $proveedor = Proveedor::where('proveedor', 'like', '%'. $request->buscar . '%')->paginate(15);
        $title = "Proveedor: buscando " . $request->buscar;
        return view('proveedors.index', ['proveedor' => $proveedor, 'title' => $title ]);

    }



    public function search(Request $request){
         $term = $request->term;

        //  echo $term;
        //  die;

         $datos = Proveedor::where('proveedor', 'like', '%'. $request->term . '%')->get();
         $adevol = array();
         if (count($datos) > 0) {
             foreach ($datos as $dato)
                 {
                     $adevol[] = array(
                         'id' => $dato->id,
                         'value' => $dato->proveedor,
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
