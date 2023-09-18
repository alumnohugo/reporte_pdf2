<div class="row justify-content-center mb-5">
    <form class="col-lg-8 border bg-light p-3" id="formularioDetalles" action="/ruta-al-controlador/buscarApi" method="GET">
        <h1 class="text-center">Búsqueda de ventas</h1>

        <div class="row mb-3">
            <div class="col">
                <label for="fechaInicio">Fecha de inicio:</label>
                <input type="date" id="fechaInicio" name="fechaInicio" class="form-control">
            </div>
            <div class="col">
                <label for="fechaFin">Fecha de fin:</label>
                <input type="date" id="fechaFin" name="fechaFin" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <button type="submit" class="btn btn-primary w-100">Buscar</button>
            </div>
        </div>
    </form>
</div>


<script src="<?= asset('./build/js/detalles/index.js')  ?>"></script>

