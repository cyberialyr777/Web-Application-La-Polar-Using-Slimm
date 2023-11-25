<?php 
namespace App\Controllers;
use App\Models\Cobros;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class CobranzaController {
    function index (Request $request, Response $response, array $args){
        $view = Twig::fromRequest($request);
        $reg = Cobros::get();
        $params = ['cobros' => $reg];
        return $view->render($response, "cobranza.html", $params);
}
}