<?php

namespace App\Http\Controllers;

use App\Models\acc;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AccController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $nuevo = new acc();
        $nuevo->fecha = $request->fecha;
        $nuevo->acc = $request->acc;
        $nuevo->obs = $request->obs;
        if ($request->acc == "Venta" OR $request->acc=="Devolución a Proveedores"){
            $nuevo->resta = 1;
        }else{
            $nuevo->resta = 0;
        }
        if ($request->acc == "Venta"){
            $nuevo->cli_id = $request->cli_id;
        }
        $nuevo->save();
        return redirect()->route('accshow',$nuevo->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(acc $acc)
    {
        $movs=DB::table('movs')
            ->join('art','movs.art_id','art.id')
            ->where('movs.acc_id','=',$acc->id)
            ->orderBy('movs.id')
            ->get();
        $cli=DB::table('clientes')->select('nombre','id')->where('id','=',$acc->cli_id)->first();
        return view('movs-acc',['movs'=>$movs,'acc'=>$acc,'cli'=>$cli]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(acc $acc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, acc $acc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(acc $acc)
    {
        //
    }
}
