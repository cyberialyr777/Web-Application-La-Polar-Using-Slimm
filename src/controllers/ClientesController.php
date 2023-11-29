<?php

namespace App\Controllers;

use App\Models\Clientes;
use App\Models\Municipios;
use App\Models\Colonias;
use App\Models\Estados;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class ClientesController
{
    public function index(Request $request, Response $response, array $args)
    {
        $view = Twig::fromRequest($request);
        $reg = Clientes::get();
        $municipios = Municipios::get();
        $colonias = Colonias::get();
        $estados = Estados::get();
        $params = ['clientes' => $reg, 'municipios' => $municipios, 'colonias' => $colonias, 'estados' => $estados];
        return $view->render($response, "clientes.html", $params);
    }
    public function agregar_cliente (Request $request, Response $response, array $args)
    {
        $view = Twig::fromRequest($request);
        $data = $request->getParsedBody();
        $nuevoCliente = new Clientes();
        $nuevoCliente->NOMBRE = $data['nombre'];
        $nuevoCliente->TELEFONO = $data['telefono'];
        $nuevoCliente->C_P_ = $data['cp'];
        $nuevoCliente->ID_MUNICIPIO = $data['id_municipio'];
        $nuevoCliente->ID_COLONIA = $data['id_colonia'];
        $nuevoCliente->ID_ESTADO = $data['id_estado'];
        $nuevoCliente->CORREO = $data['correo'];
        $nuevoCliente->REPRESENTANTE_NOMBRE = $data['representante_nombre'];
        $nuevoCliente->REPRESENTANTE_APELLIDO_PATERNO = $data['representante_apellido_paterno'];
        $nuevoCliente->FECHA_CREACION = date('Y-m-d H:i:s');
        $nuevoCliente->FECHA_ACTUALIZACION = date('Y-m-d H:i:s');
        $nuevoCliente->save();
        header('location: clientes');
    }
    public function eliminar_cliente (Request $request, Response $response, array $args)
    {
        $data = $request->getParsedBody();
        $id = $data['id'];
        $delete = Clientes::find($id);
        $delete->delete();
        header('location: clientes');
    }
    public function indexEditar(Request $request, Response $response, array $args)
    {
        $view = Twig::fromRequest($request);
        $municipios = Municipios::get();
        $colonias = Colonias::get();
        $estados = Estados::get();
        $data = $request->getParsedBody();
        $id = $data['id'];
        $query = Clientes::where('ID_CLIENTE',$id)->get();
        $params = ['clientes' => $query, 'municipios' => $municipios, 'colonias' => $colonias, 'estados' => $estados];
        return $view->render($response, "editar_clientes.html", $params);
    }
    public function editar_cliente (Request $request, Response $response, array $args)
    {
        $data = $request->getParsedBody();
        $id = $data['id'];
        $nuevoCliente = Clientes::find($id);
        $nuevoCliente->NOMBRE = $data['nombre'];
        $nuevoCliente->TELEFONO = $data['telefono'];
        $nuevoCliente->C_P_ = $data['cp'];
        $nuevoCliente->ID_MUNICIPIO = $data['id_municipio'];
        $nuevoCliente->ID_COLONIA = $data['id_colonia'];
        $nuevoCliente->ID_ESTADO = $data['id_estado'];
        $nuevoCliente->CORREO = $data['correo'];
        $nuevoCliente->REPRESENTANTE_NOMBRE = $data['representante_nombre'];
        $nuevoCliente->REPRESENTANTE_APELLIDO_PATERNO = $data['representante_apellido_paterno'];
        $nuevoCliente->FECHA_ACTUALIZACION = date('Y-m-d H:i:s');
        $nuevoCliente->save();
        header('location: clientes');
    }
}
?>