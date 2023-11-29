<?php

namespace App\Controllers;

use App\Models\Cobros;
use App\Models\Clientes;
use Carbon\Carbon;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class CobranzaController
{
    function index(Request $request, Response $response, array $args)
    {
        $view = Twig::fromRequest($request);
        $reg = Cobros::get();
        $clientes = Clientes::get();
        $params = ['cobros' => $reg, 'clientes' => $clientes];
        return $view->render($response, "cobranza.html", $params);
    }
    public function agregar_cobro(Request $request, Response $response, array $args)
    {
        $data = $request->getParsedBody();
        $nuevoCliente = new Cobros();
        $nuevoCliente->NUMERO_DE_FACTURA = $data['numero_de_factura'];
        $nuevoCliente->ID_CLIENTE = $data['id_cliente'];
        $nuevoCliente->MONTO = $data['monto'];
        $fechaLimite = Carbon::createFromFormat('d/m/Y', $data['fecha_limite'])->format('Y-m-d');
        $nuevoCliente->FECHA_LIMITE = $fechaLimite;
        $nuevoCliente->SERVICIO = $data['servicio'];
        $nuevoCliente->FECHA_CREACION = date('Y-m-d H:i:s');
        $nuevoCliente->FECHA_ACTUALIZACION = date('Y-m-d H:i:s');
        $nuevoCliente->save();
        header('location: cobranza');
    }
    public function eliminar_cobro(Request $request, Response $response, array $args)
    {
        $data = $request->getParsedBody();
        $id = $data['id'];
        $delete = Cobros::find($id);
        $delete->delete();
        header('location: cobranza');
    }
    public function indexEditarCobros(Request $request, Response $response, array $args)
    {
        $view = Twig::fromRequest($request);
        $clientes = Clientes::get();
        $data = $request->getParsedBody();
        $id = $data['numero_de_factura'];
        $query = Cobros::where('NUMERO_DE_FACTURA', $id)->get();
        $params = ['cobros' => $query, 'clientes' => $clientes];
        return $view->render($response, "editar_cobros.html", $params);
    }
    public function editar_cobros(Request $request, Response $response, array $args)
    {
        $data = $request->getParsedBody();
        $id = $data['numero_de_factura'];
        $nuevoCliente = Cobros::find($id);
        // $nuevoCliente->NUMERO_DE_FACTURA = $data['numero_de_factura'];
        $nuevoCliente->ID_CLIENTE = $data['id_cliente'];
        $nuevoCliente->MONTO = $data['monto'];
        $fechaLimite = $data['fecha_limite'];
        $fechaLimite = Carbon::createFromFormat('Y-m-d', $fechaLimite);
        if ($fechaLimite) {
            $nuevoCliente->FECHA_LIMITE = $fechaLimite->format('Y-m-d');
        } else {
            $nuevoCliente->FECHA_LIMITE = $data['fecha_limite'];
        }
        // $fechaLimite = Carbon::createFromFormat('d-m-Y', $fechaLimite);
        // if ($fechaLimite->format('d-m-Y')) {
        //     $fechaLimite = Carbon::createFromFormat('d/m/Y', $data['fecha_limite'])->format('Y-m-d');
        //     $nuevoCliente->FECHA_LIMITE = $fechaLimite;
        // }else {
        //     $nuevoCliente->FECHA_LIMITE = $fechaLimite;
        // }
        // $fechaLimite = Carbon::createFromFormat('d/m/Y', $data['fecha_limite'])->format('Y-m-d');
        // $nuevoCliente->FECHA_LIMITE = $fechaLimite;
        $nuevoCliente->SERVICIO = $data['servicio'];
        $nuevoCliente->FECHA_ACTUALIZACION = date('Y-m-d H:i:s');
        $nuevoCliente->save();
        header('location: cobranza');
    }
}
