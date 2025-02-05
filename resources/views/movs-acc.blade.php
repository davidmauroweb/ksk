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
            
            
            var newtr = '<tr class="item" data-id="'+sel+'"><td class="iProduct" ><input type="hidden" id="acc_id" name="acc_id[]" value="{{$acc->id}}"/><input type="hidden" id="art_id" name="art_id[]" value="' + datos[0] + '"/>' + sptext[1] + '</td><td>' + datos[2] + '</td><td><input type="number" class="form-control" id="cantidad" name="cantidad[]" value="' + datos[1] + '" required /></td><td><input type="number" class="form-control" id="costo" name="costo[]" value="' + datos[1] + '" required /></td><td>Parcial</td><td><button type="submit" class="btn btn-danger btn-sm remove-item"><i class="bi bi-trash-fill"></i></button></td></tr>';
            
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
// ARMAR JSON
        document.getElementById('movimientos').addEventListener('submit', function(event) {  
            event.preventDefault(); // Evitar que el formulario se envíe normalmente  

            const formData = new FormData(this);  
    // Añade los datos de la tabla dinámicamente  
    $('#ProSelected tr.item').each(function() {  
        const acc_ids = document.querySelectorAll('input[name="acc_id[]"]');
        const art_ids = document.querySelectorAll('input[name="art_id[]"]');
        const cantidads = document.querySelectorAll('input[name="cantidad[]"]'); 
        const costos = document.querySelectorAll('input[name="costo[]"]');
        
        formData.append('productos', JSON.stringify({ acc_id, art_id, cantidad, costo }));  
    });  

  // Crear el JSON de productos
  let productosArray = [];
  
  for (let i = 0; i < acc_ids.length; i++) {
    productosArray.push({
      acc_id: parseInt(acc_ids[i].value),
      art_id: parseInt(art_ids[i].value),
      cantidad: parseInt(cantidades[i].value),
      costo: parseFloat(costos[i].value)
    });  
  }

    const data = {
    productos: productosArray
  };

            // Ahora puedes enviar jsonData como JSON al servidor  
            fetch('{{route("addmv")}}', {  
               method: 'POST',  
                headers: {  
                    'Content-Type': 'application/json',  
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Importante para proteger contra CSRF  
                },  
                body: JSON.stringify(jsonData)  
            }).then(response => response.json())  
              .then(data => {  
                  console.log(data); // Maneja la respuesta del servidor  
              }).catch(error => {  
                  console.error('Error:', error);  
              });  
        });  

    }
</script>

                <div class="card-footer">
                <form id="movimientos" class="form">
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
                <input type="submit" value="Guardar" class="btn btn-sm btn-success my-2">
                </div>
</form>
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
