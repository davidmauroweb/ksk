@extends('layouts.app')

@section('content')
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

<script type="text/javascript">
  // Refresca Producto: Refresco la Lista de Productos dentro de la Tabla
  // Si es vacia deshabilito el boton guardar para obligar a seleccionar al menos un producto al usuario
  // Sino habilito el boton Guardar para que pueda Guardar
    function RefrescaProducto(){
        var ip = [];
        var i = 0;
        $('#guardar').attr('disabled','disabled'); //Deshabilito el Boton Guardar
        $('.iProduct').each(function(index, element) {
            i++;
            ip.push({ id_pro : $(this).val() });
        });
        // Si la lista de Productos no es vacia Habilito el Boton Guardar
        if (i > 0) {
            $('#guardar').removeAttr('disabled','disabled');
        }
        var ipt=JSON.stringify(ip); //Convierto la Lista de Productos a un JSON para procesarlo en tu controlador
        $('#ListaPro').val(encodeURIComponent(ipt));
    }
       function agregarProducto() {

            var sel = $('#pro_id').find(':selected').val(); //Capturo el Value del Producto
            var text = $('#pro_id').find(':selected').text();//Capturo el Nombre del Producto- Texto dentro del Select
           
            if(sel !=""){
            
            var sptext = text.split("-");
            const datos = sel.split("-");
            
            
            var newtr = '<tr class="item"  data-id="'+sel+'">';
            newtr = newtr + '<td class="iProduct" ><input type="hidden" id="art_id" name="art_id" value="' + datos[0] + '" required />' + sptext[1] + '</td>';
            newtr = newtr + '<td>' + datos[2] + '</td>';
            newtr = newtr + '<td><input  class="form-control" id="cantidad" name="cantidad" value="' + datos[1] + '" required /></td>';
            newtr = newtr + '<td><input  class="form-control" id="costo" name="costo" value="' + datos[1] + '" required /></td>';
            newtr = newtr + '<td>Parcial</td>';
            newtr = newtr + '<td><button type="submit" class="btn btn-danger btn-sm remove-item"><i class="bi bi-trash-fill"></i></button></td></tr>';
            
            $('#ProSelected').append(newtr); //Agrego el Producto al tbody de la Tabla con el id=ProSelected
            
            RefrescaProducto();//Refresco Productos
                
            $('.remove-item').off().click(function(e) {
                $(this).parent('td').parent('tr').remove(); //En accion elimino el Producto de la Tabla
                if ($('#ProSelected tr.item').length == 0)
                    $('#ProSelected .no-item').slideDown(300); 
                RefrescaProducto();
            });        
           $('.iProduct').off().change(function(e) {
                RefrescaProducto();
           });
        }
    }
</script>

                <div class="card-footer">
                <form class="form" method="POST" action="{{route('addmv')}}">
                @csrf
        Movimientos
        <table id="TablaPro" class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Stock</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody id="ProSelected"><!--Ingreso un id al tbody-->
                <tr>
             
                </tr>
            </tbody>
        </table>
<!--Agregue un boton en caso de desear enviar los productos para ser procesados-->
                <div class="form-group ">
                    <button type="submit" class="btn btn-sm btn-success my-2">Guardar</button>
                </div>
</form>

        <!-- Modal -->
        <div class="card">

                    <div class="card-header">
                        <div class="modal-title">Agregar producto a la lista</div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                                <label for="pro_id" class="form-label">Producto</label>
                                <select class="selectpicker form-control" id="pro_id" name="pro_id" data-width='100%' >
                                <option value="">Seleccione Producto</option>
                                        @foreach ($arts as $a)
                                        <option value="{{$a->id}}-{{$a->costo}}-{{$a->stock}}">{{$a->id}}-{{$a->nombre}}</option>
                                        @endforeach
                                </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <!--Uso la funcion onclick para llamar a la funcion en javascript-->
                        <button type="button" onclick="agregarProducto()" class="btn btn-success btn-sm">+</button>
                    </div>

        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
