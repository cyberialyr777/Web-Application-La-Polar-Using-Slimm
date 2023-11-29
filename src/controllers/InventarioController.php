<?php

namespace App\Controllers;

use App\Models\Inventario;
use App\Models\Marcas;
use App\Models\Modelos;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;


class InventarioController
{
    public function index(Request $request, Response $response, array $args)
    {
        $view = Twig::fromRequest($request);
        $reg = Inventario::get();
        $marcas = Marcas::get();
        $modelos = Modelos::get();
        $params = ['inventario' => $reg, 'marcas' => $marcas, 'modelos' => $modelos];
        return $view->render($response, "inventario.html", $params);
    }
    public function agregar_refaccion(Request $request, Response $response, array $args)
    {
        $view = Twig::fromRequest($request);
        $data = $request->getParsedBody();
        $nuevoCliente = new Inventario();
        $nuevoCliente->ID_REFACCION = $data['id_refaccion'];
        $nuevoCliente->CANTIDAD = $data['cantidad'];
        $nuevoCliente->ID_MARCA = $data['id_marca'];
        $nuevoCliente->ID_MODELO = $data['id_modelo'];
        $nuevoCliente->REFACCION = $data['refaccion'];
        $nuevoCliente->FECHA_ENTRADA = date('Y-m-d H:i:s');
        $nuevoCliente->FECHA_SALIDA = date('Y-m-d H:i:s');
        $nuevoCliente->save();
        header('location: inventario');
    }
    public function eliminar_refaccion(Request $request, Response $response, array $args)
    {
        $data = $request->getParsedBody();
        $id = $data['id'];
        $delete = Inventario::find($id);
        $delete->delete();
        header('location: inventario');
    }
    public function indexEditarInventario(Request $request, Response $response, array $args)
    {
        $view = Twig::fromRequest($request);
        $marcas = Marcas::get();
        $modelos = Modelos::get();
        $data = $request->getParsedBody();
        $id = $data['id'];
        $query = Inventario::where('ID_REFACCION', $id)->get();
        $params = ['inventario' => $query, 'marcas' => $marcas, 'modelos' => $modelos];
        return $view->render($response, "editar_inventario.html", $params);
    }
    public function editar_inventario(Request $request, Response $response, array $args)
    {
        $data = $request->getParsedBody();
        $id = $data['id'];
        $nuevoCliente = Inventario::find($id);
        $nuevoCliente->CANTIDAD = $data['cantidad'];
        $nuevoCliente->ID_MARCA = $data['id_marca'];
        $nuevoCliente->ID_MODELO = $data['id_modelo'];
        $nuevoCliente->REFACCION = $data['refaccion'];
        $nuevoCliente->FECHA_ENTRADA = date('Y-m-d H:i:s');
        $nuevoCliente->FECHA_SALIDA = date('Y-m-d H:i:s');
        $nuevoCliente->save();
        header('location: inventario');
    }
}
