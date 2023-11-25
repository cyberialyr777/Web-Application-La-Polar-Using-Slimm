<?php 
namespace App\Controllers;

use App\Models\Proveedores;
use App\Models\Municipios;
use App\Models\Colonias;
use App\Models\Estados;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class ProveedoresController {
    public function index(Request $request, Response $response, array $args)
    {
        $view = Twig::fromRequest($request);
        $reg = Proveedores::get();
        $municipios = Municipios::get();
        $colonias = Colonias::get();
        $estados = Estados::get();
        $params = ['proveedores' => $reg, 'municipios' => $municipios, 'colonias' => $colonias, 'estados' => $estados];
        return $view->render($response, "proveedores.html", $params);
    }
}
