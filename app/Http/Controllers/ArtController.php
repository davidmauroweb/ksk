<?php

namespace App\Http\Controllers;

use App\Models\{art,marca,categoria};
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ArtController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $arts=DB::table('art')
        ->join('categorias', 'art.cat_id', '=', 'categorias.id')
        ->join('marcas','art.marca_id','=','marcas.id')
        ->select('art.id','art.nombre','categorias.nombre as cat_n','categorias.id as cat_id','marcas.nombre as marca_n','marcas.id as marca_id','art.stock','art.precio','art.repo')
        ->orderBy('art.nombre')
        ->get();
        $marcas=marca::all()->sortBy('nombre');
        $cats=categoria::all()->sortBy('nombre');
        return view('art',['arts'=>$arts, 'marcas'=>$marcas, 'cats'=>$cats]);
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
        $Ingreso = new art();
        $Ingreso->nombre = $request->nombre;
        $Ingreso->cat_id = $request->cat_id;
        $Ingreso->marca_id = $request->marca_id;
        $Ingreso->repo = $request->repo;
        $Ingreso->save();
        return redirect()->route('art')->with('alert',$request->nombre.' Agregado')->with('color','success');
    }

    /**
     * Display the specified resource.
     */
    public function show(art $art)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(art $art)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, art $art)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(art $art)
    {
        //
    }
}
