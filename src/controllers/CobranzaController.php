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
public function agregar_cobro (Request $request, Response $response, array $args)
    {
        $view = Twig::fromRequest($request);
        $data = $request->getParsedBody();
        $nuevoCliente = new Cobros();
        $nuevoCliente->NUMERO_DE_FACTURA = $data['numero_de_factura'];
        $nuevoCliente->ID_CLIENTE = $data['id_cliente'];
        $nuevoCliente->MONTO = $data['monto'];
        $nuevoCliente->FECHA_LIMITE = $data['fecha_limite'];
        $nuevoCliente->SERVICIO = $data['servicio'];
        $nuevoCliente->FECHA_CREACION = date('Y-m-d H:i:s');
        $nuevoCliente->FECHA_ACTUALIZACION = date('Y-m-d H:i:s');
        $nuevoCliente->save();
        header('location: cobros');
    }
}