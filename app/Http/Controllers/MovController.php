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
        /*/tomo valores desde movs-acc.blade.php
        //{0}id|{1}costo|{2}stock|{3}venta|{4}cant|{5}precio
    $movs = $request->pro_id0."xyz".$request->cant_0."xyz".$request->precio_0."//";
    $movs .= $request->pro_id1."xyz".$request->cant_1."xyz".$request->precio_1."//";
    $movs .= $request->pro_id2."xyz".$request->cant_2."xyz".$request->precio_2."//";
    $movs .= $request->pro_id3."xyz".$request->cant_3."xyz".$request->precio_3."//";
    $movs .= $request->pro_id4."xyz".$request->cant_4."xyz".$request->precio_4."//";
    $movs .= $request->pro_id5."xyz".$request->cant_5."xyz".$request->precio_5."//";
    $movs .= $request->pro_id6."xyz".$request->cant_6."xyz".$request->precio_6."//";
    $movs .= $request->pro_id7."xyz".$request->cant_7."xyz".$request->precio_7."//";
    $movs .= $request->pro_id8."xyz".$request->cant_8."xyz".$request->precio_8."//";
    $movs .= $request->pro_id9."xyz".$request->cant_9."xyz".$request->precio_9;
    $mv=explode("//",$movs,);
    $acc = DB::table('accs')->where('id','=',$request->acc)->first();
    if ($acc->acc == "Compra"){
        foreach($mv as $m){
            $campo=explode("xyz",$m);
            if($campo[0]!=""){
                $nstock=$campo[2]+$campo[4];
                $nmov = new mov();
                $nmov->art_id = $campo[0];
                $nmov->cantidad = $campo[4];
                $nmov->costo = $campo[5];
                $nmov->acc_id = $acc->id;
                $nmov->save();
                $nstock=$campo[2]+$campo[4];
                $uart=art::find($campo[0]);
                $uart->stock=$nstock;
                $ncosto = (($campo[1]*$campo[2])+($campo[4]*$campo[5]))/$nstock;
                $uart->costo=$ncosto;
                $uart->save();
                }
            }
            $msj="Compra Registrada";
            $color="success";
    }else{
        foreach($mv as $m){
            $campo=explode("xyz",$m);
            if($campo[0]!=""){
                $nmov = new mov();
                $nmov->art_id = $campo[0];
                $nmov->cantidad = $campo[4];
                $nmov->costo = $campo[1];
                $nmov->venta = $campo[5];
                $nmov->acc_id = $acc->id;
                $nmov->save();
                $nstock=$campo[2]-$campo[4];
                $uart=art::find($campo[0]);
                $uart->stock=$nstock;
                $uart->venta=$campo[5];
                $uart->save();
            }
        }
        $msj="Venta Registrada";
        $color="success";
    }
    return redirect()->route('home')->with('alert',$msj)->with('color',$color);
    fecha":"2025-03-22","acc":"Venta","idCliente":"1","obs":"","productos"
*/
echo $request->input('fecha');
echo $request->input('acc');
echo $request->input('idCliente');
echo $request->input('obs');
$ps =  $request->input('productos');
echo "---";
foreach ($ps as $m)
{
    echo $m['id'];
}
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