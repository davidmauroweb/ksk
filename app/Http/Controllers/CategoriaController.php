<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoriaController extends Controller
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
        $cats=DB::table('categorias')
        ->leftJoin('art', 'categorias.id', '=', 'art.cat_id')
        ->select('categorias.id','categorias.nombre','art.cat_id AS total','art.cat_id')
        ->groupBy('art.cat_id')
        ->orderBy('categorias.nombre')
        ->get();
        return view('cat',['cats'=>$cats]);
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
        $Ingreso = new categoria();
        $Ingreso->nombre = $request->nombre;
        $Ingreso->save();
        return redirect()->route('cat')->withSuccess('Categoria Cargada');
    }

    /**
     * Display the specified resource.
     */
    public function show(categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, categoria $categoria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }
}
