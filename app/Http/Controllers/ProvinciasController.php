<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Http\Requests;
use App\Provincia;

use Validator;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class ProvinciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $provincias = Provincia::paginate(15);
        $title = "Provincia";
        return view('provincias.index', ['provincias' => $provincias, 'title' => $title ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Agregar nueva provincia";
        return view('provincias.create', ['title' => $title]);
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
                    'provincia' => 'required|unique:provincias|max:75',

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


        $provincias = new Provincia;
        $provincias->provincia = $request->provincia;
        $provincias->save();
        return redirect('/provincias');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $provincia = Provincia::find($id);
      $title = "Provincias";
      return view('provincias.show', ['provincia' => $provincia,'title' => $title]);
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
        $provincia = Provincia::find($id);
        $title = "Editar provincia";
        return view('provincias.edit', ['provincia' => $provincia,'title' => $title]);


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
        $provincias = Provincia::find($id);
        $provincias->provincia = $request->provincia;
        $provincias->save();

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
        $provincias = Provincia::find($id);
        $provincias->delete();

        return redirect('/provincias');
    }
}
