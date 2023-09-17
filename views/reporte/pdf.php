<style>
    h1 {
        color: red;
    }
</style>
<div class="row justify-content-center" id="divTabla">
    <div class="col-lg-8">
        <h1>Reporte de Ventas</h1>
        <table class="table table-bordered table-hover" id="tablaDetalles" style="border: 1px solid black;">
            <thead class="table-dark">
                <tr>
                    <th style="border: 1px solid black;" colspan="4">NOMBRE DEL CLIENTE: <?= $data[0]['nombre_cliente'] ?></th>
                </tr>
                <tr>
                    <th style="border: 1px solid black;">NO.</th>
                    <th style="border: 1px solid black;">PRODUCTO</th>
                    <th style="border: 1px solid black;">PRECIO</th>
                    <th style="border: 1px solid black;">FECHA</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $index => $venta) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $venta['nombre_producto'] ?></td>
                        <td><?= $venta['producto_precio'] ?></td>
                        <td><?= $venta['venta_fecha'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
