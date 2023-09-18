import { Toast } from "bootstrap";
import Swal from "sweetalert2";

const btnBuscar = document.querySelector('form');

const buscar = async (event) => {
    event.preventDefault();

    const fechaInicio = document.getElementById('fechaInicio').value;
    const fechaFin = document.getElementById('fechaFin').value;

    const url = `/reporte_pdf2/API/detalles/buscar?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`;

    try {
        const respuesta = await fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'fetch'
            }
        });

        if (respuesta.ok) {
            const data = await respuesta.json();
            console.log(data);
           
        } else {
            console.log('Error en la respuesta del servidor');
        }
    } catch (error) {
        console.log(error);
    }
}

btnBuscar.addEventListener('submit', buscar);
