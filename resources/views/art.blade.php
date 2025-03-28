@extends('layouts.app')

@section('content')
<div class="container">  
    <div class="row justify-content-center">  
        <div class="col-md-12 col-12">  
            <div class="card">  
                <div class="card-header text-center">Gestión de Artículos</div>  
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
                                    <th>#</th>  
                                    <th>Código</th>  
                                    <th>Nombre</th>  
                                    <th>Categoría</th>  
                                    <th>Marca</th>  
                                    <th>Stock</th>  
                                    <th>Costo</th>  
                                    <th>Venta</th>  
                                    <th>Repoc</th>  
                                    <th colspan="2" class="text-center">Acciones</th>  
                                </tr>  
                            </thead>  
                            <tbody>  
                                @foreach ($arts as $i)  
                                    <tr>  
                                        <th>{{$i->id}}</th>  
                                        <td>{{$i->code}}</td>  
                                        <td>{{$i->nombre}}</td>  
                                        <td>{{$i->cat_n}}</td>  
                                        <td>{{$i->marca_n}}</td>  
                                        <td>{{$i->stock}}</td>  
                                        <td>{{$i->costo}}</td>  
                                        <td>{{$i->venta}}</td>  
                                        <td>{{$i->repo}}</td>  
                                        <td class="text-center">  
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit{{$i->id}}">  
                                                <i class="bi bi-pencil-square"></i>  
                                            </button>  
                                            <!-- Modal Edit -->  
                                            <div class="modal fade" id="edit{{$i->id}}" tabindex="-1" aria-labelledby="editModalLabel{{$i->id}}" aria-hidden="true">  
                                                <div class="modal-dialog modal-lg">  
                                                    <div class="modal-content">  
                                                        <form method="POST" action="{{ route('earts') }}">  
                                                            @csrf  
                                                            <div class="modal-header">  
                                                                <h5 class="modal-title" id="editModalLabel{{$i->id}}">Editar Artículo</h5>  
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  
                                                            </div>  
                                                            <div class="modal-body">  
                                                                <input type="hidden" name="art_id" value="{{$i->id}}">  
                                                                <div class="mb-3 row">  
                                                                    <label for="name{{$i->id}}" class="col-sm-4 col-form-label text-md-end">Nombre</label>  
                                                                    <div class="col-sm-8">  
                                                                        <input id="name{{$i->id}}" type="text" class="form-control" name="nombre" value="{{$i->nombre}}" required>  
                                                                    </div>  
                                                                </div>  
                                                                <div class="mb-3 row">  
                                                                    <label for="code{{$i->id}}" class="col-sm-4 col-form-label text-md-end">Código</label>  
                                                                    <div class="col-sm-8">  
                                                                        <input id="code{{$i->id}}" type="text" class="form-control" name="code" value="{{$i->code}}" required>  
                                                                    </div>  
                                                                </div>  
                                                                <div class="mb-3 row">  
                                                                    <label for="cat_id{{$i->id}}" class="col-sm-4 col-form-label text-md-end">Categoría</label>  
                                                                    <div class="col-sm-8">  
                                                                        <select class="form-select" name="cat_id">  
                                                                            @foreach ($cats as $c)  
                                                                                <option value="{{$c->id}}" @if($i->cat_id == $c->id) selected @endif>{{$c->nombre}}</option>  
                                                                            @endforeach  
                                                                        </select>  
                                                                    </div>  
                                                                </div>  
                                                                <div class="mb-3 row">  
                                                                    <label for="marca_id{{$i->id}}" class="col-sm-4 col-form-label text-md-end">Marca</label>  
                                                                    <div class="col-sm-8">  
                                                                        <select class="form-select" name="marca_id">  
                                                                            @foreach ($marcas as $m)  
                                                                                <option value="{{$m->id}}" @if($i->marca_id == $m->id) selected @endif>{{$m->nombre}}</option>  
                                                                            @endforeach  
                                                                        </select>  
                                                                    </div>  
                                                                </div>  
                                                                <div class="mb-3 row">  
                                                                    <label for="costo{{$i->id}}" class="col-sm-4 col-form-label text-md-end">Costo</label>  
                                                                    <div class="col-sm-8">  
                                                                        <input id="costo{{$i->id}}" type="text" class="form-control" name="costo" value="{{$i->costo}}" pattern="^\d*(\.\d{0,2})?$">  
                                                                    </div>  
                                                                </div>  
                                                                <div class="mb-3 row">  
                                                                    <label for="venta{{$i->id}}" class="col-sm-4 col-form-label text-md-end">Venta</label>  
                                                                    <div class="col-sm-8">  
                                                                        <input id="venta{{$i->id}}" type="text" class="form-control" name="venta" value="{{$i->venta}}" pattern="^\d*(\.\d{0,2})?$">  
                                                                    </div>  
                                                                </div>  
                                                                <div class="mb-3 row">  
                                                                    <label for="repo{{$i->id}}" class="col-sm-4 col-form-label text-md-end">Reposición</label>  
                                                                    <div class="col-sm-8">  
                                                                        <input id="repo{{$i->id}}" type="text" class="form-control" name="repo" value="{{$i->repo}}" required>  
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
                                            <!-- Modal Edit -->  
                                        </td>  
                                        <td class="text-center">  
                                            <form action="{{route('darts')}}" method="post">  
                                                @csrf  
                                                <input type="hidden" name="cat_id" value="{{$i->id}}">  
                                                <button type="submit" class="btn btn-danger btn-sm" @if($i->stock != 0) disabled @endif>  
                                                    <i class="bi bi-trash-fill"></i>  
                                                </button>  
                                            </form>  
                                        </td>  
                                    </tr>  
                                @endforeach  
                            </tbody>  
                        </table>  
                    </div>  
                </div>  
                <div class="card-footer text-end">  
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#nuevoArt" @if($cats=="" || $marcas=="") disabled>Debes crear Marcas y Categorías</button> @else >Nuevo</button> @endif  
                    <!-- Modal Nuevo -->  
                    <div class="modal fade" id="nuevoArt" tabindex="-1" aria-labelledby="nuevoModalLabel" aria-hidden="true">  
                        <div class="modal-dialog modal-lg">  
                            <div class="modal-content">  
                                <form method="POST" action="{{ route('narts') }}">  
                                    @csrf  
                                    <div class="modal-header">  
                                        <h5 class="modal-title" id="nuevoModalLabel">Nuevo Artículo</h5>  
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  
                                    </div>  
                                    <div class="modal-body">  
                                        <div class="mb-3 row">  
                                            <label for="nuevo_nombre" class="col-sm-4 col-form-label text-md-end">Nombre</label>  
                                            <div class="col-sm-8">  
                                                <input id="nuevo_nombre" type="text" class="form-control" name="nombre" required>  
                                            </div>  
                                        </div>  
                                        <div class="mb-3 row">  
                                            <label for="nuevo_codigo" class="col-sm-4 col-form-label text-md-end">Código</label>  
                                            <div class="col-sm-8">  
                                                <input id="nuevo_codigo" type="text" class="form-control" name="code" required>  
                                            </div>  
                                        </div>  
                                        <div class="mb-3 row">  
                                            <label for="nueva_cat_id" class="col-sm-4 col-form-label text-md-end">Categoría</label>  
                                            <div class="col-sm-8">  
                                                <select class="form-select" name="cat_id">  
                                                    @foreach ($cats as $c)  
                                                        <option value="{{$c->id}}">{{$c->nombre}}</option>  
                                                    @endforeach  
                                                </select>  
                                            </div>  
                                        </div>  
                                        <div class="mb-3 row">  
                                            <label for="nueva_marca_id" class="col-sm-4 col-form-label text-md-end">Marca</label>  
                                            <div class="col-sm-8">  
                                                <select class="form-select" name="marca_id">  
                                                    @foreach ($marcas as $m)  
                                                        <option value="{{$m->id}}">{{$m->nombre}}</option>  
                                                    @endforeach  
                                                </select>  
                                            </div>  
                                        </div>  
                                        <div class="mb-3 row">  
                                            <label for="nuevo_repo" class="col-sm-4 col-form-label text-md-end">Reposición</label>  
                                            <div class="col-sm-8">  
                                                <input id="nuevo_repo" type="text" class="form-control" name="repo" required>  
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
                    <!-- Modal Nuevo -->  
                </div>  
            </div>  
        </div>  
    </div>  
</div> 
@endsection
