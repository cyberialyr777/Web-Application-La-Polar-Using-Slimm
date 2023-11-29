<?php
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use App\Controllers\HomeController;
use App\Controllers\ClientesController;
use App\Controllers\ProveedoresController;
use App\Controllers\CreditoController;
use App\Controllers\InventarioController;
use App\Controllers\FacturasController;
use App\Controllers\IndexController;
use App\Controllers\CobranzaController;

require __DIR__ . '/vendor/autoload.php';
$app = AppFactory::create();
$twig = Twig::create('Templates',['cache'=>false]);
$app->add(TwigMiddleware::create($app,$twig));

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule -> addConnection([
    'driver' => 'mysql',
    'host' => '127.0.0.1',
    'database' => 'lapolarr',
    'username' => 'root',
    'password' => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);
$capsule -> bootEloquent();
$capsule -> setAsGlobal();

$app->setBasePath('/proyecto_slim');
$app->get('/home', HomeController::class . ':index');
//rutas clientes
$app->get('/clientes', ClientesController::class . ':index');
$app->post('/clientes', ClientesController::class . ':agregar_cliente');
$app->post('/clientesEliminar', ClientesController::class . ':eliminar_cliente');
$app->post('/EditarCliente', ClientesController::class . ':editar_cliente');
$app->post('/PaginaEditarClientes', ClientesController::class . ':indexEditar');
//rutas proveedor
$app->get('/proveedores', ProveedoresController::class . ':index');
$app->post('/proveedores', ProveedoresController::class . ':agregar_proveedor');
$app->post('/EditarProveedor', ProveedoresController::class . ':editar_proveedor');
$app->post('/PaginaEditarProveedores', ProveedoresController::class . ':indexEditarProveedores');
$app->post('/proveedoresEliminar', ProveedoresController::class . ':eliminar_proveedor');
//rutas inventario
$app->get('/inventario', InventarioController::class . ':index');
$app->post('/inventario', InventarioController::class . ':agregar_refaccion');
$app->post('/inventarioEliminar', InventarioController::class . ':eliminar_refaccion');
$app->post('/EditarInventario', InventarioController::class . ':editar_inventario');
$app->post('/PaginaEditarInventario', InventarioController::class . ':indexEditarInventario');
//rutas crédito
$app->get('/credito', CreditoController::class . ':index');
$app->post('/credito', CreditoController::class . ':agregar_deuda');
$app->post('/deudasEliminar', CreditoController::class . ':eliminar_deuda');
$app->post('/EditarDeudas', CreditoController::class . ':editar_deudas');
$app->post('/PaginaEditarDeudas', CreditoController::class . ':indexEditarDeudas');
//rutas factura
$app->get('/facturas', FacturasController::class . ':index');
//rutas inicio de sesión
$app->get('/index', IndexController::class . ':index');
// rutas cobros
$app->get('/cobranza', CobranzaController::class . ':index');
$app->post('/cobranza', CobranzaController::class . ':agregar_cobro');
$app->post('/cobrosEliminar', CobranzaController::class . ':eliminar_cobro');
$app->post('/EditarCobros', CobranzaController::class . ':editar_cobros');
$app->post('/PaginaEditarCobros', CobranzaController::class . ':indexEditarCobros');
$app->run();
?>