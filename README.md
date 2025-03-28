# ksk
php artisan migrate:fresh --seed
Mail : admin@admin.com.ar
Clave: 12345678

No permite cargar articulos sin haber cargado Marcas y Categorías

La plataforma está pensada para el uso de pistola lectora de codigo de barra para agilizar el uso.

En el formulario de carga de movimientos se selecciona el tipo de movimiento: *Compra* o *Venta*

En todos los casos al escanear el código se muestra la cantidad total disponible del producto y el útlimo precio de venta (independientemente si el movimiento es de venta o compra)

### Compra
* Aumenta la cantidad en stock del producto
* Calcula el precio promedio ponderado entre el costo histórico y el nuevo costo.

### Venta
* Reduce la cantidad disponible del producto
* Registra el nuevo precio de venta y el precio del costo al momento del movimiento
* Guarda el último precio de venta que será mostrado en cada escaneo del producto.

### Productos
Para cargar productos en necesario tener cargadas las marcas y las categorías, cada producto se vincula a dichos ítems.
Las cantidades y precios se actualizan automáticamente con el registro de cada movimiento.
También pueden realizarse ajustes en existencias y/o precios desde el apartado de productos.

### Listados
Tanto de *ventas* como de *compras*, se listan dichos movimientos con la opción de desglose de los mismos para analizar cuales fueron los productos afectados con sus totales de las compras, y en el caso de las ventas, no solo los montos totales sinó también el margen histórico de dicha operación.
En el listado de *marcas* y *categorías* las cantidades corresponde al total de unidades de cada producto perteneciente a cada item, según el criterio de agrupación, es decir, la cantidad de unidades de cada marca son la sumatoria independientemente de la categoría, y el mismo caso para el listado de categoría es independiente de la marca a la que pertenezca cada prodcto.

### Clace
La clave asignada por defecto puede cambiarse en el apartado clave, colocando la clave anterior y verificando la nueva, solo para escenarios de producción, en caso de prueba esta opción queda desactivada.