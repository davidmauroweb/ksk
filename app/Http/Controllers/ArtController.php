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
    public function index(Request $r)
    {
        if(isset($r->b)){
            if($r->b == "c"){
                $arts=DB::table('art')
                ->join('categorias', 'art.cat_id', '=', 'categorias.id')
                ->join('marcas','art.marca_id','=','marcas.id')
                ->where('art.cat_id','=',$r->i)
                ->select('art.id','art.nombre','categorias.nombre as cat_n','categorias.id as cat_id','marcas.nombre as marca_n','marcas.id as marca_id','art.stock','art.costo','art.venta','art.repo')
                ->orderBy('art.nombre')
                ->get();
            }else{
                $arts=DB::table('art')
                ->join('categorias', 'art.cat_id', '=', 'categorias.id')
                ->join('marcas','art.marca_id','=','marcas.id')
                ->where('art.marca_id','=',$r->i)
                ->select('art.id','art.nombre','categorias.nombre as cat_n','categorias.id as cat_id','marcas.nombre as marca_n','marcas.id as marca_id','art.stock','art.costo','art.venta','art.repo')
                ->orderBy('art.nombre')
                ->get();
            }
        }else{
            $arts=DB::table('art')
            ->join('categorias', 'art.cat_id', '=', 'categorias.id')
            ->join('marcas','art.marca_id','=','marcas.id')
            ->select('art.id','art.nombre','categorias.nombre as cat_n','categorias.id as cat_id','marcas.nombre as marca_n','marcas.id as marca_id','art.stock','art.costo','art.venta','art.repo')
            ->orderBy('art.nombre')
            ->get();
        }
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
        $Ingreso->stock = 0;
        $Ingreso->repo = $request->repo;
        $Ingreso->save();
        return redirect()->route('arts')->with('alert',$request->nombre.' Agregado')->with('color','success');
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
    public function edit(Request $request)
    {
        $edit=art::find($request->art_id);
        $edit->nombre = $request->nombre;
        $edit->cat_id = $request->cat_id;
        $edit->marca_id = $request->marca_id;
        $edit->precio = $request->precio;

        $edit->save();
        return redirect()->route('arts')->with('alert', $request->nombre.' Editado')->with('color','success');
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
