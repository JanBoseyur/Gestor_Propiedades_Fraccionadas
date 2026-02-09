
document.addEventListener('DOMContentLoaded', () => {

    const form = document.getElementById('tarjetaForm');
    if (!form) return;

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const numero = document.getElementById('numeroTarjeta').value.trim();
        const nombre = document.getElementById('nombreTitular').value.trim();
        const mes = document.getElementById('mes').value.trim();
        const anio = document.getElementById('anio').value.trim();
        const cvv = document.getElementById('cvv').value.trim();

        const soloNumeros = /^[0-9]+$/;
        let valido = true;

        /* ================= VALIDACIONES ================= */

        if (!soloNumeros.test(numero) || numero.length !== 16) {
            document.getElementById('errorNumero').classList.remove('hidden');
            valido = false;
        } else {
            document.getElementById('errorNumero').classList.add('hidden');
        }

        if (nombre.length < 5) {
            document.getElementById('errorNombre').classList.remove('hidden');
            valido = false;
        } else {
            document.getElementById('errorNombre').classList.add('hidden');
        }

        if (!soloNumeros.test(mes) || mes < 1 || mes > 12) {
            valido = false;
        }

        if (!soloNumeros.test(anio) || anio.length !== 2) {
            valido = false;
        }

        if (!soloNumeros.test(cvv) || cvv.length !== 3) {
            document.getElementById('errorCvv').classList.remove('hidden');
            valido = false;
        } else {
            document.getElementById('errorCvv').classList.add('hidden');
        }

        if (!valido) return;

        /* ================= MARCAR PAGADO ================= */

        const gastoId = form.dataset.gastoId;

        try {
            const data = await res.json();
            const res = await fetch(`/pagos/crear/${gastoId}`, {
                method: 'GET',
                credentials: 'include', // <- esto es clave
                headers: {
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'),
                    'Accept': 'application/json'
                }
            });

            alert('Pago realizado correctamente');
            location.reload();

        } catch (error) {
            alert('Error al procesar el pago ❌');
        }
    });

});
