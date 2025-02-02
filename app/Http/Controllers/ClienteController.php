<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes=cliente::all();
        return view('clientes',['clientes'=>$clientes]);
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
        $ingreso = new cliente();
        $ingreso->nombre = $request->nombre;
        $ingreso->domicilio = $request->domicilio;
        $ingreso->cuit = $request->cuit;
        $ingreso->email = $request->email;
        $ingreso->save();
        return redirect()->route('clientes')->with('alert',$request->nombre.' Cargado')->with('color','success');

    }

    /**
     * Display the specified resource.
     */
    public function show(cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $edit=cliente::find($request->cliente_id);
        $edit->nombre = $request->nombre;
        $edit->domicilio = $request->domicilio;
        $edit->cuit = $request->cuit;
        $edit->email = $request->email;
        $edit->save();
        return redirect()->route('clientes')->with('alert',$request->nombre.' Editado')->with('color','success');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $del=cliente::find($request->cliente_id);
        $del->delete();
        return redirect()->route('clientes')->with('alert',$del->nombre.' Eliminado')->with('color','success');
    }
}
