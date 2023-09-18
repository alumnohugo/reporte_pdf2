<?php

namespace Controllers;
use Model\Detalle;
use Mpdf\Mpdf;
use Exception;
use MVC\Router;

class ReporteController {
    public static function pdf(Router $router) {
        $fechaInicio = $_GET['fechaInicio'];
        $fechaFin = $_GET['fechaFin'];

        // Realiza la consulta SQL
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
            ('$fechaInicio'::DATE IS NULL AND '$fechaFin'::DATE IS NULL)";

        try {
            // Realiza la consulta a la base de datos
            $cliente = Detalle::fetchArray($sql);

            // Crea el arreglo de datos a partir de los resultados de la consulta
            $data = [];
            foreach ($cliente as $venta) {
                $data[] = [
                    'cantidad' => $venta['cantidad'],
                    'nombre_cliente' => $venta['nombre_cliente'],
                    'nombre_producto' => $venta['nombre_producto'],
                    'producto_precio' => $venta['producto_precio'],
                    'venta_fecha' => $venta['venta_fecha'],
                ];
            }

            // Resto de tu código...

            $mpdf = new Mpdf([
                "orientation" => "P",
                "default_font_size" => 12,
                "default_font" => "arial",
                "format" => "Letter",
                "mode" => 'utf-8'
            ]);
            $mpdf->SetMargins(30, 35, 25);

            // Carga la vista PDF con los datos
            $html = $router->load('reporte/pdf', [
                'data' => $data, // Pasa los datos al archivo PDF
            ]);

            // Genera el PDF y envíalo
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        } catch (Exception $e) {
            // Manejar errores si es necesario
            echo json_encode([
                'detalle' => $e->getMessage(),
                'mensaje' => 'Ocurrió un error',
                'codigo' => 0
            ]);
        }
    }
}

?>
