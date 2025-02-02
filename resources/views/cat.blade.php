@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Gestión de Categorías
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-sm">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th></th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cats as $i)
                            <tr>
                            <th>{{$i->id}}</th>
                            <td>{{$i->nombre}}</td>
                            <td>{{$i->total}}</td>
                            <td></td>
                            <td>
                                <form action="{{route('dcat')}}">
                                    @csrf
                                    <input type="hidden" name="cat_id" value="{{$i->id}}">
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                <form method="POST" action="{{ route('ncat') }}">
                @csrf
                    
                    <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="name" class="col-form-label">Nueva Categoría</label>
                    </div>
                    <div class="col-auto">
                        <input id="name" type="text" class="form-control" name="nombre" value="" required autocomplete="name" autofocus>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="col-form-btn btn btn-primary btn-sm">Agregar</button>
                    </div>
                    </div>  
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
