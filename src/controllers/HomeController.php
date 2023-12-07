<?php 
namespace App\Controllers;

use App\Models\Facturas;
use App\Models\Deudas;
use App\Models\Proveedores;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class HomeController {
    function index (Request $request, Response $response, array $args){
    $view = Twig::fromRequest($request);

    $reg = Facturas::orderBy('fecha_creacion', 'desc')->take(6)->get();

    $creditos = Deudas::orderBy('fecha_creacion', 'desc')->take(2)->get();

    $proveedores = Proveedores::get();

    $params = ['facturas' => $reg, 'creditos' => $creditos, 'proveedores' => $proveedores];

    return $view->render($response, "home.html", $params);
}
}