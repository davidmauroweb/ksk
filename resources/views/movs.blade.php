@extends('layouts.app')

@section('content')
<div class="container">  
    <div class="row justify-content-center">  
        <div class="col-md-12 col-12">  
            <div class="card">  
                <div class="card-header text-center">{{$acc->acc}} :: {{$acc->fecha}} @if($acc->acc == "Venta") {{$cli->nombre}} @endif<br>{{$acc->obs}}
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive"> 
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Artículo</th>
                                <th>Cantidad</th>
                                <th>Cs.</th>
                                <th>Cs. T.</th>
                            @if($acc->acc == "Venta")
                                <th>Vta.</th>
                                <th>Vta. Tot.</th>
                                <th>Dif</th>
                            @endif
                            </tr>
                        </thead>
                        @php
                            $ctt = 0;
                            $vtt = 0;
                            $dit = 0;
                        @endphp
                        <tbody>
                            @foreach ($movs as $i)
                            @php
                            $ct = $i->costo * $i->cantidad;
                            $vt = $i->venta * $i->cantidad;
                            $di = $vt - $ct;
                            $ctt += $ct;
                            $vtt += $vt;
                            $dit += $di;
                            @endphp
                            <tr>
                                <th>{{$i->nombre}}</th>
                                <td>{{$i->cantidad}}</td>
                                <td>{{$i->costo}}</td>
                                <td>{{$ct}}</td>
                            @if($acc->acc == "Venta")
                                <td>{{$i->venta}}</td>
                                <td>{{$vt}}</td>
                                <th>{{$di}}</th>
                            @endif
                            </tr>
                            @endforeach
                            <tr class="table-secondary">
                                <th>Totales</th>
                                <td></td>
                                <td></td>
                                <th>{{$ctt}}</th>
                            @if($acc->acc == "Venta")
                                <td></td>
                                <th>{{$vtt}}</th>
                                <th>{{$dit}}</th>
                            @endif
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
