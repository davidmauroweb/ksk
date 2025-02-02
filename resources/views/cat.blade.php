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
                            <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit{{$i->id}}"><i class="bi bi-pencil-square"></i></button>
                                        <!-- ModalEdit -->
                                        <div class="modal fade" id="edit{{$i->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <form method="POST" action="{{ route('ecat') }}">
                                                @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Editar Categoría</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <input type="hidden" name="cat_id" value="{{$i->id}}">
                                                    <div class="row mb-3">
                                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>
                                                    <div class="col-md-6">
                                                        <input id="name" type="text" class="form-control" name="nombre" value="{{$i->nombre}}" required autocomplete="name" autofocus>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success btn-sm">Editar</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ModalEdit -->

                            </td>
                            <td>
                                <form action="{{route('dcat')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="cat_id" value="{{$i->id}}">
                                    <button type="submit" class="btn btn-danger btn-sm" @if ($i->total == 0) disabled @endif><i class="bi bi-trash-fill"></i></button>
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
