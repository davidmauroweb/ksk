@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$titulo}}
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
                            <th>Fecha</th>
                            <th>Items</th>
                            <th>Observaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($accs as $i)
                            <tr>
                            <th><a href="{{route('lsmovs',$i->id)}}">{{$i->id}}</a></th>
                            <td>{{$i->fecha}}</td>
                            <td>{{$i->totmovs}}</td>
                            <td>{{$i->obs}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                <div class="mx-3"><ul class="pagination">{{ $accs->appends(['acc' => $pg])->links() }}</ul></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
