@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="form-inline" action="{{route('nvta')}}" method='post'>
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
                            <option value="Devolución a Proveedores">Devolución a Proveedores</option>
                            <option value="Devolución de Clientes">Devolución de Clientes</option>
                        </select>
                    </div>
                    <div class="col-4 align-middle align-self-end">
                        <button class="btn btn-sm btn-success col-12">Nuevo Movimiento</button>
                    </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
