@extends('layouts.app')

@section('content')
<script>  
    $(document).ready(function() {
        productos = @json($prod);
    });

function cli() {  
    var ac = document.getElementById("acc");  
    var cl = document.getElementById("cli_id");  
    if (ac.value === "Compra") {  
        cl.disabled = true; // Desactivar el campo "cli"
    } else {  
        cl.disabled = false; // Activar el campo "cli"  
    }
    document.getElementById("tablaProductos").innerHTML="";
    $("#codigo-p").val("");
    total();
}

function buscarProducto() {
            const codigo = $("#codigo-p").val().trim();
            const producto = productos.find(p => p.code === codigo);

            if (producto) {
                agregarProductoATabla(producto);
            } else {
                alert("Producto no encontrado");
            }
            $("#codigo-p").val("");
        }

function agregarProductoATabla(producto) {
            const fila = `<tr>
                            <td id="a-id-${producto.id}" class="d-none">${producto.id}</td>
                            <td id="a-ch-${producto.id}" class="d-none">${producto.costo}</td>
                            <td id="a-sh-${producto.id}" class="d-none">${producto.stock}</td>
                            <td>${producto.code}</td>
                            <td>${producto.nombre}</td>
                            <td id="a-pr-${producto.id}" contenteditable="true" oninput="subt(${producto.id});">${producto.venta}</td>  
                            <td id="a-ca-${producto.id}" contenteditable="true" oninput="subt(${producto.id});">${producto.stock}</td>  
                            <td id="su-${producto.id}" >${producto.total}</td>  
                            <td><button class="btn btn-danger btn-sm" onclick="eliminarFila(this)"><i class="bi bi-trash"></i></button></td>
                        </tr>`;
            $("#tablaProductos").append(fila);
            total();
        }

function subt(id) {  
    const precioElem = document.getElementById(`a-pr-${id}`);  
    const cantidadElem = document.getElementById(`a-ca-${id}`);  
    const subtotalElem = document.getElementById(`su-${id}`);  

    const precio = parseFloat(precioElem.innerText) || 0; // Convertir a número  
    const cantidad = parseFloat(cantidadElem.innerText) || 0; 

    const subtotal = precio * cantidad; // Calcular subtotal  
    subtotalElem.innerText = subtotal.toFixed(2); // Mostrar subtotal en el formato deseado (2 decimales)  

    total(); // Llamar a función total si necesitas actualizar el total general  
}

function total() {  
    let totalGeneral = 0;  
 
    $("#tablaProductos tr").each(function() {  
        const subtotalElem = $(this).find("td[id^='su-']"); 
        const subtotal = parseFloat(subtotalElem.text()) || 0; 
        totalGeneral += subtotal; // Sumar al total general  
    });  

    // Muestra el total general en un lugar adecuado  
    // Asegúrate de tener un elemento para mostrar el total, por ejemplo, una celda en la tabla o un párrafo  
    $("#totalGeneral").text(totalGeneral.toFixed(2)); // Actualiza el total  
} 

function eliminarFila(btn) {
            $(btn).closest("tr").remove();
            total();
        }

function enviarDatos() {
            const fecha = $("#fecha").val().trim();
            const acc = $("#acc").val().trim();
            const idCliente = $("#cli_id").val().trim();
            const obs = $("#obs").val().trim();

            let productosEnTabla = [];
            $("#tablaProductos tr").each(function() {
                let celdas = $(this).find("td");
                if (celdas.length > 0) {
                    productosEnTabla.push({
                        id: parseInt(celdas.eq(0).text().trim()),
                        costo: parseFloat(celdas.eq(1).text().trim()),
                        sth: parseInt(celdas.eq(2).text().trim()),
                        precio: parseFloat(celdas.eq(5).text().trim()),
                        q: parseInt(celdas.eq(6).text().trim())
                    });
                }
            });

            let datos = {
                "_token": "{{ csrf_token() }}",
                "fecha": fecha,
                "acc": acc,
                "idCliente": idCliente,
                "obs": obs,
                "productos": productosEnTabla
            };

            $.ajax({
                url: "{{route('addmv')}}", 
                type: "POST", 
                contentType: "application/json",
                data: JSON.stringify(datos),
                cache: false,
                success: function(response){
                location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) { 
                location.reload();
                }
            });
        }
</script>  
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Movimiento') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="row">
                    <div class="col-4">
                        <label for="fecha">Fecha</label>
                        <input class="form-control" type="date" id='fecha' name='fecha' value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="col-4">
                        <label for="acc">Movimiento</label>
                        <select name="acc" id='acc' class="form-select" onchange="cli()">
                            <option value="Venta">Venta</option>
                            <option value="Compra">Compra</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="cli_id">Cliente</label>
                        <select name="cli_id" id='cli_id' class="form-select">
                            @foreach ($cli as $c)
                            <option value="{{$c->id}}">{{$c->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>
                    <div class="row my-2">
                    <div class="col-9">
                        <label for="obs">Observaciones</label>
                        <input type="text" id="obs" name="obs" max="250" class="form-control">
                    </div>
                    <div class="col-3 align-middle align-self-end">
                        <button class="btn btn-sm btn-success col-12" onclick="enviarDatos()">Crear Movimiento</button>
                    </div>
                    </div>
                    <div class="row my-2">                   
                    <div class="col-10">
                        <label for="codigo-p">Buscar y Agregar Producto</label>
                        <input type="text" id="codigo-p" class="form-control" placeholder="Ingrese código del producto">
                    </div>
                    <div class="col-2 align-middle align-self-end">
                        <button  class="btn btn-sm btn-success col-12" onclick="buscarProducto()">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                    </div>
                    </div>
                    <table class="table table-striped">
            <thead>
                <tr>
                    <th class="d-none"></th>
                    <th class="d-none"></th>
                    <th class="d-none"></th>
                    <th>Código</th>
                    <th>Detalle</th>
                    <th>$</th>
                    <th>Cantidad</th>
                    <th>Sub.</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody id="tablaProductos">
                <!-- Productos agregados aparecerán aquí -->
            </tbody>
            <tfoot>
                <tr>
                <th scope="row">Total</th>
                <td id="totalGeneral"></td>
                </tr>
            </tfoot>
        </table>
                </div>
                <div class="card-footer">
                    Artícuos en Stock Crítico
                <table class="table">
                    <tr>
                        <th>Art</th>
                        <th>Stock</th>
                    </tr>
                    @foreach ($al as $a)
                    <tr>
                        <td>{{$a->nombre}}</td>
                        <td>{{$a->stock}}</td>
                    </tr>
                    @endforeach
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
