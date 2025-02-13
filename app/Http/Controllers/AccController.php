<?php

namespace App\Http\Controllers;

use App\Models\acc;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AccController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index($acc)
    {
        $accs=DB::table('accs')
        ->select('accs.id','accs.fecha','accs.obs','clientes.nombre',DB::raw('count(movs.id) as totmovs'))
        ->leftJoin('clientes','clientes.id','accs.cli_id')
        ->leftJoin('movs','movs.acc_id','accs.id')
        ->where('accs.acc','=',$acc)
        ->groupBy('accs.id')
        ->orderByDesc('accs.id')
        ->paginate(30);
        return view('acc',['accs'=>$accs,'t'=>$acc]);
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
        $cli=DB::table('clientes')->select('nombre','id')->where('id','=',$acc->cli_id)->first();
        $arts=DB::table('art')->select('id','nombre','costo','stock','venta')->orderBy('nombre')->get();
        return view('movs-acc',['acc'=>$acc,'cli'=>$cli,'arts'=>$arts]);
    }

    public function xfch($d,$h)
    {

    }
    public function xcli($cli_id)
    {
        $accs=DB::table('accs')
        ->select('accs.id','accs.fecha','accs.obs',DB::raw('count(movs.id) as totmovs'))
        ->leftJoin('movs','movs.acc_id','accs.id')
        ->where('accs.cli_id','=',$cli_id)
        ->groupBy('accs.id')
        ->orderByDesc('accs.id')
        ->paginate(30);
        $cli=DB::table('clientes')->select('nombre')->where('id','=',$cli_id)->first();
        $msj = "Lista de operaciones con ".$cli->nombre;
        return view('accxcli',['accs'=>$accs,'titulo'=>$msj,'pg'=>$cli_id]);
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
