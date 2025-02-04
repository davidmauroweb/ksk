@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Movimiento') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="form-inline" action="{{route('nacc')}}" method='post'>
                        @csrf
                        <div class="row">
                    <div class="col-4">
                        <label for="fecha">Fecha</label>
                        <input class="form-control" type="date" id='fecha' name='fecha' value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="col-4">
                        <label for="acc">Movimiento</label>
                        <select name="acc" id='acc' class="form-select">
                            <option value="Venta">Venta</option>
                            <option value="Compra">Compra</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="cli">Cliente</label>
                        <select name="cli_id" id='cli' class="form-select">
                            @foreach ($cli as $c)
                            <option value="{{$c->id}}">{{$c->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>
                    <div class="row my-2">
                    <div class="col-9">
                        <label for="obs">Observaciones</label>
                        <input type="text" id="obs" name="obs" max="250" class="form-control">
                    </div>
                    <div class="col-3 align-middle align-self-end">
                        <button class="btn btn-sm btn-success col-12">Nuevo Movimiento</button>
                    </div>
                    </div>
                    </form>
                </div>
                <div class="card-footer">
                    Artícuos en Stock Crítico
                <table class="table">
                    <tr>
                        <th>Art</th>
                        <th>Stock</th>
                    </tr>
                    @foreach ($al as $a)
                    <tr>
                        <td>{{$a->nombre}}</td>
                        <td>{{$a->stock}}</td>
                    </tr>
                    @endforeach
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
