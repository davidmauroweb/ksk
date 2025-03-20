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
        var acc = document.getElementById("jsa");
        var art = select.value.split("xyz");
    if (select.value===""){
        cant.disabled = true;
        precio.disabled = true;
        cant.value = "";
        precio.value = "";
        subt.value = "";
    }else{
        cant.disabled = false;
        precio.disabled = false;
        if (acc.value==="Venta"){
            precio.value = art[3];
            cant.value = art[2];
            subt.value = art[2]*art[3];
        }
    }
        this.total();
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
                    <div class="row align-items-center"><div class="col-7"></div><div class="col-1  text-end">Total:</div><div class="col-4"> <input type="number" id="elTotal" name="elTotal" class="form-control" readonly></div></div>
                    </table>
                </div>
                <div class="card-footer">
                <form id="movimientos" class="form" method="post" action="{{route('addmv')}}">
                    <input type="hidden" id="acc" name="acc" value="{{$acc->id}}">
                    <input type="hidden" id="jsa" name="jsa" value="{{$acc->acc}}">
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
                            <option value="{{$a->id}}xyz{{$a->costo}}xyz{{$a->stock}}xyz{{$a->venta}}">{{$a->code}}-{{$a->nombre}}</option>
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
        </table>
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
