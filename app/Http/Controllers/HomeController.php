<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cli=DB::table('clientes')->select('id','nombre')->orderBy('nombre')->get();
        $al=DB::table('art')->select('nombre','stock')->whereRaw('stock < repo')->get();
        $arts=DB::table('art')->select('id','code','nombre','costo','stock','venta')->get();
        if ($arts == "[]")
        {
                $prod [] = [
                    'id'=> "0",
                    'nombre'=> "n/a",
                    'code' => "n/a",
                    'stock' => "n/a",
                    'costo' => "n/a",
                    'venta' => "n/a",
                    'total' => "n/a"
                ];
        }else{
            foreach ($arts as $a){
                $prod [] = [
                    'id'=> $a->id,
                    'nombre'=> $a->nombre,
                    'code' => $a->code,
                    'stock' => $a->stock,
                    'costo' => $a->costo,
                    'venta' => $a->venta,
                    'total' => $a->stock*$a->venta
                ];
            }
        }
        return view('home',['cli'=>$cli, 'al'=>$al],compact('prod'));
    }

    public function pw(Request $request)
    {
        $pw=User::find($request->user_id);
        if (Hash::check($request->o_pw, $request->user()->password)){
            if($request->n_pw == $request->c_pw){
                $n_pw_h=Hash::make($request->n_pw);
                $pw->password = $n_pw_h;
                $pw->save();
                $msj="La clave se actualizó";
                $type="success";
            }else{
                $msj = "Las nuevas claves no coinciden";
                $type = "warning";
            }
        }else{
            $msj = "La clave original no coincide";
            $type = "danger";
        }
        return redirect()->route('home')->with('alert',$msj)->with('color',$type);
    }
}
