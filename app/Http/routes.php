<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::bind('empresa', function($empresa){
    return App\Empresas::find($empresa);
});

Route::bind('trabajadores', function($trabajadores){
    return App\Trabajadores::find($trabajadores);
});

Route::bind('clientes', function($clientes){
    return App\Clientes_id::find($clientes);
});

Route::bind('productos', function($productos){
    return App\Producto::find($productos);
});

Route::bind('ventas', function($ventas){
    return App\Ventas::find($ventas);
});

Route::bind('compras_gastos', function($compras_gastos){
    return App\Compras_gastos::find($compras_gastos);
});

Route::bind('pagos', function($pagos){
    return App\Pagos::find($pagos);
});


Route::bind('cobros', function($cobros){
    return App\Cobros::find($cobros);
});

Route::bind('cuentas_por_pagar', function($cpp){
    return App\Cuentas_por_pagar::find($cpp);
});

Route::bind('inventario', function($inventario){
    return App\Inventario::find($inventario);
});

Route::bind('categoria', function($categoria){
    return App\Categoria::find($categoria);
});

Route::bind('terceros', function($terceros){
    return App\Terceros::find($terceros);
});

Route::bind('proveedor', function($proveedor){
    return App\Proveedor::find($proveedor);
});

Route::bind('ingreso_producto', function($ingreso_producto){
    return App\Ingreso_producto::find($ingreso_producto);
});

Route::bind('comprobante', function($comprobante){
    return App\Comprobante::find($comprobante);
});
Route::auth();

Route::get('/', 'HomeController@index');
Route::resource('empresa', 'ControllerEmpresa');
Route::get('empresa-show/{id}', 'HomeController@show');
Route::resource('trabajadores', 'ControllerTrabajadores');
Route::resource('clientes', 'ControllerClientes');
// Productos
Route::resource('productos', 'ControllerProducto');
// Rutas post para activar y desactivar checkbox
Route::post('productos/complete_ganancia','ControllerProducto@postCompleteGanancia');
Route::post('productos/complete_descuento','ControllerProducto@postCompleteDescuento');
Route::post('productos/complete_promocion','ControllerProducto@postCompletePromocion');

Route::resource('ventas', 'ControllerVentas');
Route::resource('compras_gastos', 'ControllerComprasGastos');
Route::resource('pagos', 'ControllerPagos');
Route::resource('cobros', 'ControllerCobros');
Route::resource('cuentas_pagar', 'ControllerCuentasPagar');
Route::get('cobros-show', 'ControllerCobros@cobros_show');
Route::get('cobros-pago/{id}', 'ControllerCobros@cobros_pago');
Route::get('informe-estado','HomeController@informe_estado');
Route::get('ventas_rango','ControllerVentas@show_rango_venta');
Route::get('show_resultado', 'HomeController@show_estado_resultado');
Route::get('recaudo_cartera', 'HomeController@recaudo_cartera');
Route::get('limite_agotar', 'HomeController@limite_agotar');
Route::get('presupuesto_gastos', 'HomeController@presupuesto_gastos');
Route::resource('inventario', 'InventarioController');
Route::resource('categoria', 'CategoriaController');
Route::resource('terceros', 'TercerosController');
Route::resource('proveedor', 'ProveedorController');
Route::resource('ingreso_producto', 'IngresoProductoController');
Route::resource('comprobante', 'ComprobanteController');
// FILTROS

Route::get('filtro_categoria', [
     'as'   => 'buscar-categoria',
     'uses' => 'CategoriaController@filtro_categoria'
]);

Route::get('filtro_inventario', [
     'as'   => 'buscar-inventario',
     'uses' => 'InventarioController@filtro_inventario'
]);

Route::get('filtro_producto', [
     'as'   => 'buscar-producto',
     'uses' => 'ControllerProducto@filtro_producto'
]);

Route::get('filtro_ingreso_producto', [
     'as'   => 'buscar-ingreso_producto',
     'uses' => 'IngresoProductoController@filtro_ingreso_producto'
]);

Route::get('filtro_clientes', [
     'as'   => 'buscar-clientes',
     'uses' => 'ControllerClientes@filtro_clientes'
]);

Route::get('filtro_trabajadores', [
     'as'   => 'buscar-trabajadores',
     'uses' => 'ControllerTrabajadores@filtro_trabajadores'
]);

Route::get('filtro_terceros', [
     'as'   => 'buscar-terceros',
     'uses' => 'TercerosController@filtro_terceros'
]);

Route::get('filtro_proveedor', [
     'as'   => 'buscar-proveedor',
     'uses' => 'ProveedorController@filtro_proveedor'
]);
// RANGOS DE BUSQUEDA

Route::get('cuadre_caja', [
     'as'   => 'rango-caja',
     'uses' => 'ComprobanteController@cuadre_caja'
]);

Route::get('venta_rango_fecha', [
     'as'   => 'rango-venta',
     'uses' => 'ControllerVentas@rango_venta'
]);

Route::get('estado_resultado', [
     'as'   => 'rango-estado-resultado',
     'uses' => 'HomeController@rango_estado_resultado'
]);
// RELACIONES

Route::get('relacion_c_p/{id}', [
     'as'   => 'categoria-producto/{id}',
     'uses' => 'CategoriaController@relacion_c_p'
]);


//FACTYRAS 

Route::get('factura_venta/{id}', [
     'as'   => 'factura-venta/{id}',
     'uses' => 'ControllerVentas@factura_venta'
]);