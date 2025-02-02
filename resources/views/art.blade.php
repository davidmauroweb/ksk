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
                            <th>Categoria</th>
                            <th>Marca</th>
                            <th>Stock</th>
                            <th>Precio</th>
                            <th>Repoc</th>
                            <th></th>
                            <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($arts as $i)
                            <tr>
                            <th>{{$i->id}}</th>
                            <td>{{$i->nombre}}</td>
                            <td>{{$i->cat_n}}</td>
                            <td>{{$i->marca_n}}</td>
                            <td>{{$i->stock}}</td>
                            <td>{{$i->precio}}</td>
                            <td>{{$i->repo}}</td>
                            <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit{{$i->id}}"><i class="bi bi-pencil-square"></i></button>
                                        <!-- ModalEdit -->
                                        <div class="modal fade" id="edit{{$i->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <form method="POST" action="{{ route('earts') }}">
                                                @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Editar Artículo</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <input type="hidden" name="art_id" value="{{$i->id}}">
                                                    <div class="row mb-3">
                                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>
                                                    <div class="col-md-6">
                                                        <input id="name" type="text" class="form-control" name="nombre" value="{{$i->nombre}}" required autocomplete="name" autofocus>
                                                    </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Categoría') }}</label>
                                                    <div class="col-md-6">
                                                    <select class="form-select" aria-label="Default select example" name="cat_id">
                                                        @foreach ($cats as $c)
                                                        <option value="{{$c->id}}" @if($i->cat_id == $c->id) selected @endif>{{$c->nombre}}</option>
                                                        @endforeach
                                                    </select>
                                                    </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Marca') }}</label>
                                                    <div class="col-md-6">
                                                    <select class="form-select" aria-label="Default select example" name="cat_id">
                                                        @foreach ($marcas as $m)
                                                        <option value="{{$m->id}}" @if($i->marca_id == $m->id) selected @endif>{{$m->nombre}}</option>
                                                        @endforeach
                                                    </select>
                                                    </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Precio') }}</label>
                                                    <div class="col-md-6">
                                                        <input id="name" type="text" class="form-control" name="precio" value="{{$i->precio}}" required autocomplete="name" autofocus>
                                                    </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Repocición') }}</label>
                                                    <div class="col-md-6">
                                                        <input id="name" type="text" class="form-control" name="repo" value="{{$i->repo}}" required autocomplete="name" autofocus>
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
                                <form action="{{route('dart')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="cat_id" value="{{$i->id}}">
                                    <button type="submit" class="btn btn-danger btn-sm" disable><i class="bi bi-trash-fill"></i></button>
                                </form>
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#nuevoArt" @if($cats=="[]" OR $marcas=="[]") disabled> Deben existir Marcas y Categorías</button> @else >Nuevo</button> @endif
                                        <!-- ModalNuevo -->
                                        <div class="modal fade" id="nuevoArt" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <form method="POST" action="{{ route('narts') }}">
                                                @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Nuevo Artículo</h5>
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
                                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Categoría') }}</label>
                                                    <div class="col-md-6">
                                                    <select class="form-select" aria-label="Default select example" name="cat_id">
                                                        @foreach ($cats as $c)
                                                        <option value="{{$c->id}}">{{$c->nombre}}</option>
                                                        @endforeach
                                                    </select>
                                                    </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Marca') }}</label>
                                                    <div class="col-md-6">
                                                    <select class="form-select" aria-label="Default select example" name="cat_id">
                                                        @foreach ($marcas as $m)
                                                        <option value="{{$m->id}}">{{$m->nombre}}</option>
                                                        @endforeach
                                                    </select>
                                                    </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Repocición') }}</label>
                                                    <div class="col-md-6">
                                                        <input id="name" type="text" class="form-control" name="repo" value="" required autocomplete="name" autofocus>
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
                                        <!-- ModalNuevo -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
