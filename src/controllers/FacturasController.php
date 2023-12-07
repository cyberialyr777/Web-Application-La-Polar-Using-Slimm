<?php

namespace App\Controllers;

use App\Models\Facturas;
use App\Models\Clientes;
use Psr\Http\Message\UploadedFileInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Database\Eloquent\Builder;
use Slim\Psr7\UploadedFile;
use Slim\Views\Twig;


class FacturasController
{
    function index(Request $request, Response $response, array $args)
    {
        $view = Twig::fromRequest($request);
        $reg = Facturas::get();
        $clientes = Clientes::get();
        $params = ['facturas' => $reg, 'clientes' => $clientes];
        return $view->render($response, "facturas.html", $params);
    }
    public function agregar_factura(Request $request, Response $response, array $args)
    {
        $directory = './archivos_facturas';
        $uploadedFile = $request->getUploadedFiles()['archivo'];

        if ($uploadedFile instanceof UploadedFileInterface) {
            $fileName = $uploadedFile->getClientFilename();
            $uploadedFile->moveTo($directory . '/' . $fileName);
        }
        $data = $request->getParsedBody();
        $nuevoCliente = new Facturas();
        $nuevoCliente->NUMERO_DE_FACTURA = $data['numero_de_factura'];
        $nuevoCliente->ID_CLIENTE = $data['id_cliente'];
        $nuevoCliente->ARCHIVO = $fileName;
        $nuevoCliente->FECHA_CREACION = date('Y-m-d H:i:s');
        $nuevoCliente->FECHA_ACTUALIZACION = date('Y-m-d H:i:s');
        $nuevoCliente->save();
        header('location: facturas');
    }
    public function eliminar_factura (Request $request, Response $response, array $args)
    {
        $data = $request->getParsedBody();
        $id = $data['numero_de_factura'];
        $delete = Facturas::find($id);
        $delete->delete();
        header('location: facturas');
    }
    public function indexEditarFacturas(Request $request, Response $response, array $args)
    {
        $view = Twig::fromRequest($request);
        $clientes = Clientes::get();;
        $data = $request->getParsedBody();
        $id = $data['numero_de_factura'];
        $query = Facturas::where('NUMERO_DE_FACTURA',$id)->get();
        $params = ['facturas' => $query, 'clientes' => $clientes];
        return $view->render($response, "editar_facturas.html", $params);
    }
    public function editar_facturas (Request $request, Response $response, array $args)
    {
        $data = $request ->getParsedBody();
        $id = $data['btn_editar'];
        $nuevoCliente = Facturas::find($id);
        $nuevoCliente->ID_CLIENTE = $data['id_cliente'];
        $nuevoCliente->FECHA_ACTUALIZACION = date('Y-m-d H:i:s');
        $nuevoCliente->save();
        header('location: facturas');
    }

}
