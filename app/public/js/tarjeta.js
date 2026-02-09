
document.getElementById('tarjetaForm').addEventListener('submit', e => {
    e.preventDefault();

    const numero = document.getElementById('numeroTarjeta');
    const nombre = document.getElementById('nombreTitular');
    const mes = document.getElementById('mes');
    const anio = document.getElementById('anio');
    const cvv = document.getElementById('cvv');

    let valido = true;

    // Regex solo números
    const soloNumeros = /^[0-9]+$/;

    // Número tarjeta (16)
    if (!soloNumeros.test(numero.value) || numero.value.length !== 16) {
        valido = false;
        document.getElementById('errorNumero').classList.remove('hidden');
    } else {
        document.getElementById('errorNumero').classList.add('hidden');
    }

    // Nombre (mín 5)
    if (nombre.value.trim().length < 5) {
        valido = false;
        document.getElementById('errorNombre').classList.remove('hidden');
    } else {
        document.getElementById('errorNombre').classList.add('hidden');
    }

    // Mes
    if (!soloNumeros.test(mes.value) || mes.value < 1 || mes.value > 12) {
        valido = false;
    }

    // Año
    if (!soloNumeros.test(anio.value) || anio.value.length !== 2) {
        valido = false;
    }

    // CVV
    if (!soloNumeros.test(cvv.value) || cvv.value.length !== 3) {
        valido = false;
        document.getElementById('errorCvv').classList.remove('hidden');
    } else {
        document.getElementById('errorCvv').classList.add('hidden');
    }

    if (valido) {
        alert('✅ Tarjeta válida (validación básica)');
        // aquí recién podrías enviar el formulario
    }
});
