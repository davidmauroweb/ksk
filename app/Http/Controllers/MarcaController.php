<?php

namespace App\Http\Controllers;

use App\Models\{marca,art};
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marcas=DB::table('marcas')
        ->leftJoin('art', 'marcas.id', '=', 'art.marca_id')
        ->select('marcas.id','marcas.nombre',DB::raw('count(art.id) as total'),'art.marca_id')
        ->groupBy('marcas.id')
        ->orderBy('marcas.nombre')
        ->get();
        return view('marcas',['marcas'=>$marcas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $Ingreso = new marca();
        $Ingreso->nombre = $request->nombre;
        $Ingreso->save();
        return redirect()->route('marcas')->with('alert',$request->nombre.' Cargada')->with('color','success');
    }

    /**
     * Display the specified resource.
     */
    public function show(marca $marca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $edit=marca::find($request->marca_id);
        $edit->nombre = $request->nombre;
        $edit->save();
        return redirect()->route('marcas')->with('alert','Marca Editada')->with('color','success');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, marca $marca)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $del=marca::find($request->marca_id);
        $del->delete();
        return redirect()->route('marcas')->with('alert',$del->nombre.' Eliminada')->with('color','danger');
    }
}
