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
    public function agregar_proveedor (Request $request, Response $response, array $args)
    {
        $view = Twig::fromRequest($request);
        $data = $request->getParsedBody();
        $nuevoCliente = new Proveedores();
        $nuevoCliente->NOMBRE = $data['nombre'];
        $nuevoCliente->TELEFONO = $data['telefono'];
        $nuevoCliente->C_P_ = $data['cp'];
        $nuevoCliente->ID_MUNICIPIO = $data['id_municipio'];
        $nuevoCliente->ID_COLONIA = $data['id_colonia'];
        $nuevoCliente->ID_ESTADO = $data['id_estado'];
        $nuevoCliente->CORREO = $data['correo'];
        $nuevoCliente->CALLE = $data['calle'];
        $nuevoCliente->NUMERO = $data['numero'];
        $nuevoCliente->REPRESENTANTE_NOMBRE = $data['representante_nombre'];
        $nuevoCliente->REPRESENTANTE_APELLIDO_PATERNO = $data['representante_apellido_paterno'];
        $nuevoCliente->FECHA_CREACION = date('Y-m-d H:i:s');
        $nuevoCliente->FECHA_ACTUALIZACION = date('Y-m-d H:i:s');
        $nuevoCliente->save();
        header('location: proveedores');
    }
    public function eliminar_proveedor (Request $request, Response $response, array $args)
    {
        $data = $request->getParsedBody();
        $id = $data['id'];
        $delete = Proveedores::find($id);
        $delete->delete();
        header('location: proveedores');
    }
    public function indexEditarProveedores(Request $request, Response $response, array $args)
    {
        $view = Twig::fromRequest($request);
        $municipios = Municipios::get();
        $colonias = Colonias::get();
        $estados = Estados::get();
        $data = $request->getParsedBody();
        $id = $data['id'];
        $query = Proveedores::where('ID_PROVEEDOR',$id)->get();
        $params = ['proveedores' => $query, 'municipios' => $municipios, 'colonias' => $colonias, 'estados' => $estados];
        return $view->render($response, "editar_proveedores.html", $params);
    }
    public function editar_proveedor (Request $request, Response $response, array $args)
    {
        $data = $request->getParsedBody();
        $id = $data['id'];
        $nuevoCliente = Proveedores::find($id);
        $nuevoCliente->NOMBRE = $data['nombre'];
        $nuevoCliente->TELEFONO = $data['telefono'];
        $nuevoCliente->C_P_ = $data['cp'];
        $nuevoCliente->CALLE = $data['calle'];
        $nuevoCliente->NUMERO = $data['numero'];
        $nuevoCliente->ID_MUNICIPIO = $data['id_municipio'];
        $nuevoCliente->ID_COLONIA = $data['id_colonia'];
        $nuevoCliente->ID_ESTADO = $data['id_estado'];
        $nuevoCliente->CORREO = $data['correo'];
        $nuevoCliente->REPRESENTANTE_NOMBRE = $data['representante_nombre'];
        $nuevoCliente->REPRESENTANTE_APELLIDO_PATERNO = $data['representante_apellido_paterno'];
        $nuevoCliente->FECHA_ACTUALIZACION = date('Y-m-d H:i:s');
        $nuevoCliente->save();
        header('location: proveedores');
    }
}