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
$app->get('/clientes', ClientesController::class . ':index');
$app->post('/clientes', ClientesController::class . ':agregar_cliente');
$app->post('/clientesEliminar', ClientesController::class . ':eliminar_cliente');
$app->post('/EditarCliente', ClientesController::class . ':editar_cliente');
$app->post('/PaginaEditarClientes', ClientesController::class . ':indexEditar');
$app->get('/proveedores', ProveedoresController::class . ':index');
$app->post('/proveedores', ProveedoresController::class . ':agregar_proveedor');
$app->get('/credito', CreditoController::class . ':index');
$app->get('/inventario', InventarioController::class . ':index');
$app->get('/facturas', FacturasController::class . ':index');
$app->get('/index', IndexController::class . ':index');
$app->get('/cobranza', CobranzaController::class . ':index');
$app->run();
?>