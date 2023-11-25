<?php 
namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class IndexController {
    function index (Request $request, Response $response, array $args){
        $view = Twig::fromRequest($request);
        $params = ['titulo'=>''];
        return $view->render($response, "index.html", $params);
}
}