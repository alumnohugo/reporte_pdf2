<?php

namespace Controllers;

use Mpdf\Mpdf;
use MVC\Router;

class ReporteController {
    public static function pdf(Router $router) {
     
        $data = [
            [
                'cantidad' => '3',
                'nombre_cliente' => 'Cliente 3',
                'nombre_producto' => 'Producto 2',
                'producto_precio' => '15.99',
                'venta_fecha' => '2023-09-10',
            ],
       
        ];

      
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
    }
}

?>
