@extends('layouts.app')

@section('content')
<script>
    function total(){
        var elTotal = document.getElementById('total');
        var allSubTotals = document.querySelectorAll('.sub');
        var total = 0;
    allSubTotals.forEach(function(item) {
    //suma si tiene valor valido el subtotal
    if (item.value)  total += parseInt(item.value);
})
var tot = document.getElementById("elTotal");
tot.value = total;
}
    function subt(cantidad, precio, sub) {

/* Parametros:
cantidad - entero con la cantidad
precio - entero con el precio
sub - nombre del elemento del formulario donde ira el subtotal
tot - el elemento donde va el total de todo lo cargado
*/
// Calculo del subtotal
var subtotal = (precio && cantidad) ? precio * cantidad : 0;// precio * cantidad || 0;
sub.value = subtotal;

this.total();
}

function act(it){
    //en base al parametro 'it' traigo los valores de los id de los campos, el select para saber si se activa o no la cantidad y el precio del rengón.
    var select = document.getElementById("pro_id"+it);  
    var cant = document.getElementById("cant_"+it);
    var precio = document.getElementById("precio_"+it);
    var subt = document.getElementById("subtotal"+it);
 if (select.value===""){
    cant.disabled = true;
    precio.disabled = true;
    cant.value = "";
    precio.value = "";
    subt.value = "";
    //recalculo el total y deja el subtotal en cero
this.total();

 }else{
    cant.disabled = false;
    precio.disabled = false;
 }
}
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{$acc->fecha}}:{{$acc->acc}} @if ($acc->acc == "Venta") - {{$cli->nombre}} @endif
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-sm">

                    </table>
                </div>
                <div class="card-footer">
                <form id="movimientos" class="form" method="post" action="{{route('addmv')}}">
                @csrf
        Movimientos
        <table id="TablaPro" class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php for ($x = 0; $x < 10; $x++){
                    echo '
                <tr>
                    <td>
                    <select class="selectpicker form-control" id="pro_id'.$x.'" name="pro_id'.$x.'" onchange="act('.$x.')">
                    <option value="">Seleccione Producto</option>';@endphp
                            @foreach ($arts as $a)
                            <option value="{{$a->id}}-{{$a->costo}}-{{$a->stock}}">{{$a->id}}-{{$a->nombre}}</option>
                            @endforeach
                            @php echo'
                    </select>
                    </td>
                    <td><input disabled class="form-control" type="number" id="cant_'.$x.'" name="cant_'.$x.'" oninput="subt(cant_'.$x.'.value,precio_'.$x.'.value,subtotal'.$x.',elTotal);"></td>
                    <td><input disabled class="form-control" type="number" id="precio_'.$x.'" name="precio_'.$x.'" oninput="subt(cant_'.$x.'.value,precio_'.$x.'.value,subtotal'.$x.',elTotal);"></td>
                    <td><input class="form-control sub" type="number" name="subtotal'.$x.'" id="subtotal'.$x.'" readonly></td>
                </tr>';
            }@endphp
            </tbody>
        </table><input type="number" id="elTotal" name="elTotal" class="form-control" readonly>
                <div class="form-group ">
                <input type="submit" value="Guardar" class="btn btn-sm btn-success my-2">
                </div>
</form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
