<?php

namespace Controllers;
use Exception;
use Model\Detalle;
use MVC\Router;

class DetalleController{
            public static function index(Router $router){

         
            $router->render('detalles/index',[
    
                // 'detalle'=>$detalles,
    
                
            ]);
        }



   
    public static function buscarApi()
    {
        // $cliente = Cliente::all();
        $fechaInicio = $_GET['fechaInicio'];
        $fechaFin = $_GET['fechaFin'];
       

        $sql = "SELECT 
        p.producto_nombre AS nombre_producto,
        p.producto_precio,
        dv.detalle_cantidad AS cantidad,
        c.cliente_nombre AS nombre_cliente,
        v.venta_fecha
    FROM detalle_ventas dv
    INNER JOIN ventas v ON dv.detalle_venta = v.venta_id AND dv.detalle_situacion = '1'
    INNER JOIN productos p ON dv.detalle_producto = p.producto_id
    INNER JOIN clientes c ON v.venta_cliente = c.cliente_id
        WHERE 
            (v.venta_fecha BETWEEN '$fechaInicio'::DATE AND '$fechaFin'::DATE)
            OR
            (v.venta_fecha >= '$fechaInicio'::DATE AND '$fechaFin'::DATE IS NULL)
            OR
            (v.venta_fecha <= '$fechaFin'::DATE AND '$fechaInicio'::DATE IS NULL)
            OR
            ('$fechaInicio'::DATE IS NULL AND '$fechaFin'::DATE IS NULL)
         ";
       
        
        
        try {
            
            $cliente = Detalle::fetchArray($sql);
            header('Content-Type: application/json');

            echo json_encode($cliente);
        } catch (Exception $e) {
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }





}
