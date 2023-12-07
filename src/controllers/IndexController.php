<?php

namespace App\Controllers;

use App\Models\Usuarios;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class IndexController
{
    function index(Request $request, Response $response, array $args)
    {
        $view = Twig::fromRequest($request);
        $reg = Usuarios::get();
        $params = ['usuarios' => $reg];
        return $view->render($response, "index.html", $params);
    }
    function inicio_sesion(Request $request, Response $response, array $args)
    {
        $view = Twig::fromRequest($request);
        $data = $request->getParsedBody();
        $correo = $data["correo"];
        $contrasena = $data["contrasena"];
        $query = Usuarios::where("CORREO", $correo)->where("CONTRASENA", $contrasena)->get();
        if (count($query) === 1) {
            $_SESSION['NOMBRE'] = [
                'id' => $query[0]['ID'],
                'nombre' => $query[0]['NOMBRE'],
                'correo' => $query[0]['CORREO']
            ];
            return $view->render($response, "home.html");
        } else {
            return $view->render($response, "index.html");
        }
    }
    function cerrarSesion(Request $request, Response $response, array $args)
    {
        session_destroy();
        return $response->withHeader('location','http://localhost/proyecto_slim/index')->withStatus(302);
    }
}
