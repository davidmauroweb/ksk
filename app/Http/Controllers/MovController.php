<?php

namespace App\Http\Controllers;

use App\Models\{mov,art,acc};
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MovController extends Controller
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
    /*
    return redirect()->route('home')->with('alert',$msj)->with('color',$color);
    */
    $fecha = $request->input('fecha');
    $acc = $request->input('acc');
    $idCliente = $request->input('idCliente');
    $obs = $request->input('obs');
    $ps =  $request->input('productos');
    // Genero el movimiento Venta o Compra en acc
    $nuevo = new acc();
    $nuevo->fecha = $fecha;
    $nuevo->acc = $acc;
    $nuevo->obs = $obs;
if ($acc == "Venta"){
        $nuevo->cli_id = $idCliente;
    }else{
        $nuevo->cli_id = 0;
    }
$nuevo->save();
// Registro los movimientos de cada producto en mov
var_dump($ps);
if ($acc == "Venta"){

    foreach($ps as $m){
        $newmov = new mov;
        $newmov->art_id = $m["id"];
        $newmov->cantidad = $m["q"];
        $newmov->venta = $m["precio"];
        $newmov->costo = $m["costo"];
        $newmov->acc_id = $nuevo->id;
        $newmov->save();
        $uart=art::find($m["id"]);
        $uart->stock = $m["sth"]-$m["q"];
        $uart->venta = $m["precio"];
        $uart->save();
    }
        $msj="Compra Registrada";
        $color="success";
        
}else{
    foreach($ps as $m){
    $ncosto = (($m["sth"]*$m["costo"])+($m["q"]*$m["precio"]))/($m["sth"]+$m["q"]);
    $newmov = new mov;
    $newmov->art_id = $m["id"];
    $newmov->cantidad = $m["q"];
    $newmov->costo = $m["precio"];
    $newmov->acc_id = $nuevo->id;
    $newmov->save();
    $uart=art::find($m["id"]);
    $uart->stock = $m["sth"]+$m["q"];
    $uart->costo = $ncosto;
    $uart->save();

    $msj="Compra Registrada";
    $color="success";

    }
}
return response()->json(['msj' => $msj, 'color' => $color]);

}
    /**
     * Display the specified resource.
     */
    public function show(acc $acc)
    {
        $cli = DB::table('clientes')->select('nombre')->where('id','=',$acc->cli_id)->first();
        $movs = DB::table('movs')
        ->select('art.nombre','movs.cantidad','movs.costo','movs.venta')
        ->join('art','movs.art_id','art.id')
        ->where('movs.acc_id','=',$acc->id)
        ->get();
        return view('movs',['acc'=>$acc,'cli'=>$cli,'movs'=>$movs]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(mov $mov)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, mov $mov)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mov $mov)
    {
        //
    }
}