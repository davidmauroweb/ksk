@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Gestión de Clientes
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
                            <th>Domicilio</th>
                            <th>CUIT</th>
                            <th>Mail</th>
                            <th></th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $i)
                            <tr>
                            <th>{{$i->id}}</th>
                            <td>{{$i->nombre}}</td>
                            <td>{{$i->domicilio}}</td>
                            <td>{{$i->cuit}}</td>
                            <td>{{$i->mail}}</td>
                            <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit{{$i->id}}"><i class="bi bi-pencil-square"></i></button>
                                        <!-- ModalEdit -->
                                        <div class="modal fade" id="edit{{$i->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <form method="POST" action="{{ route('eclientes') }}">
                                                @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <input type="hidden" name="cliente_id" value="{{$i->id}}">
                                                    <div class="row mb-3">
                                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>
                                                    <div class="col-md-6">
                                                        <input id="name" type="text" class="form-control" name="nombre" value="{{$i->nombre}}" required autofocus>
                                                    </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Domicilio') }}</label>
                                                    <div class="col-md-6">
                                                        <input id="name" type="text" class="form-control" name="domicilio" value="{{$i->domicilio}}" autofocus>
                                                    </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('CUIT') }}</label>
                                                    <div class="col-md-6">
                                                        <input id="name" type="text" class="form-control" name="cuit" value="{{$i->cuit}}" autofocus placeholder="00-00000000-0">
                                                    </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Mail') }}</label>
                                                    <div class="col-md-6">
                                                        <input id="name" type="text" class="form-control" name="email" value="{{$i->email}}" autofocus>
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
                                <form action="{{route('dclientes')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="cliente_id" value="{{$i->id}}">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Desea deshacer el parte de {{$i->nombre}}?')" @if($i->id==1) disabled @endif><i class="bi bi-trash-fill"></i></button>
                                </form>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#nuevo">Nuevo</button>
                                        <!-- ModalNuevo -->
                                        <div class="modal fade" id="nuevo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <form method="POST" action="{{ route('nclientes') }}">
                                                @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Nuevo Cliente</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="row mb-3">
                                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>
                                                    <div class="col-md-6">
                                                        <input id="name" type="text" class="form-control" name="nombre" value="" required autocomplete="name" autofocus>
                                                    </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Domicilio') }}</label>
                                                    <div class="col-md-6">
                                                        <input id="name" type="text" class="form-control" name="domicilio" value="" autocomplete="name" autofocus>
                                                    </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('CUIT') }}</label>
                                                    <div class="col-md-6">
                                                        <input id="name" type="text" class="form-control" name="cuit" value="" autocomplete="name" autofocus placeholder="00-00000000-0">
                                                    </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Mail') }}</label>
                                                    <div class="col-md-6">
                                                        <input id="name" type="text" class="form-control" name="email" value="" autocomplete="name" autofocus>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success btn-sm">Agregar</button>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ModalNuevo -->                </div>
            </div>
        </div>
    </div>
</div>
@endsection
