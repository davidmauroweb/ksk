<?php

namespace App\Http\Controllers;

use App\Models\{User,cliente};
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
        $clientes=cliente::all()->sortBy('nombre');
        return view('home',['clientes'=>$clientes]);
 
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
