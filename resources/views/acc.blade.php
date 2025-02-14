@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Lista de {{$t}}s
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
                            <th></th>
                            <th>Fecha</th>
                            <th>Items</th>
                             @if($t == "Venta")
                            <th>Cliente</th>
                            @endif
                            <th>Observaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accs as $i)
                            <tr>
                            <th><a href="{{route('lsmovs',$i->id)}}">{{$i->id}}</a></th>

                            <td>@if($i->totmovs==0)
                                <form action="{{route('accdel')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="acc_id" value="{{$i->id}}">
                                    <input type="hidden" name="t" value="{{$t}}">
                                    <button type="submit" class="btn btn-danger btn-sm" disable><i class="bi bi-trash-fill"></i></button>
                                </form>
                                @endif
                            </td>
                            <td>{{$i->fecha}}</td>
                            <td>{{$i->totmovs}}</td>
                            @if($t == "Venta")
                            <td>{{$i->nombre}}</td>
                            @endif
                            <td>{{$i->obs}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                <div class="mx-3"><ul class="pagination">{{ $accs->appends(['acc' => $t])->links() }}</ul></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
