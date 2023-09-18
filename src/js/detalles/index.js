import { Toast } from "bootstrap";
import Swal from "sweetalert2";

const btnBuscar = document.querySelector('form');

const buscar = async (event) => {
    event.preventDefault();

    const url = `/reporte_pdf2/API/pdf`;

    try {
        const respuesta = await fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'fetch'
            }
        });

        if (respuesta.ok) {
          
            window.location.href = '/reporte_pdf2/pdf';
        } else {
            console.log('Error en la respuesta del servidor');
        }
    } catch (error) {
        console.log(error);
    }
}

btnBuscar.addEventListener('submit', buscar);
