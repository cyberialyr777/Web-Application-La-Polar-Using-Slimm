<?php 
namespace App\Controllers;
use App\Models\Deudas;
use App\Models\Proveedores;
use Carbon\Carbon;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class CreditoController {
    function index (Request $request, Response $response, array $args){
        $view = Twig::fromRequest($request);
        $reg = Deudas::get();
        $proveedores = Proveedores::get();
        $params = ['deudas' => $reg, 'proveedores' => $proveedores];
        return $view->render($response, "credito.html", $params);
}
public function agregar_deuda(Request $request, Response $response, array $args)
    {
        $data = $request->getParsedBody();
        $nuevoCliente = new Deudas();
        $nuevoCliente->NUMERO_DE_FACTURA = $data['numero_de_factura'];
        $nuevoCliente->ID_PROVEEDOR = $data['id_proveedor'];
        $nuevoCliente->MONTO = $data['monto'];
        $fechaLimite = Carbon::createFromFormat('d/m/Y', $data['fecha_limite'])->format('Y-m-d');
        $nuevoCliente->FECHA_LIMITE = $fechaLimite;
        $nuevoCliente->FECHA_CREACION = date('Y-m-d H:i:s');
        $nuevoCliente->FECHA_ACTUALIZACION = date('Y-m-d H:i:s');
        $nuevoCliente->save();
        header('location: credito');
    }
    public function eliminar_deuda(Request $request, Response $response, array $args)
    {
        $data = $request->getParsedBody();
        $id = $data['id'];
        $delete = Deudas::find($id);
        $delete->delete();
        header('location: credito');
    }
    public function indexEditarDeudas(Request $request, Response $response, array $args)
    {
        $view = Twig::fromRequest($request);
        $proveedores = Proveedores::get();
        $data = $request->getParsedBody();
        $id = $data['numero_de_factura'];
        $query = Deudas::where('NUMERO_DE_FACTURA', $id)->get();
        $params = ['deudas' => $query, 'proveedores' => $proveedores];
        return $view->render($response, "editar_deudas.html", $params);
    }
    public function editar_deudas(Request $request, Response $response, array $args)
    {
        $data = $request->getParsedBody();
        $id = $data['numero_de_factura'];
        $nuevoCliente = Deudas::find($id);
        // $nuevoCliente->NUMERO_DE_FACTURA = $data['numero_de_factura'];
        $nuevoCliente->ID_PROVEEDOR = $data['id_proveedor'];
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
        $nuevoCliente->FECHA_ACTUALIZACION = date('Y-m-d H:i:s');
        $nuevoCliente->save();
        header('location: credito');
    }
}