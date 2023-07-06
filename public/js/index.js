function onChangeSelect() {
    const selectFecha = document.getElementById('fecha');
    const selectEstado = document.getElementById('estado');
    const valor1 = selectFecha.value;
    const valor2 = selectEstado.value;

    // Objeto con los valores a enviar
    const data = {
      estado: valor1,
      fecha: valor2
    };
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Realizar la petición utilizando fetch
    fetch('http://127.0.0.1:8000/api/filtrar-denuncias', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': token
      },
      body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
      // Manejar la respuesta del servidor
      console.log(data);
    })
    .catch(error => {
      // Manejar errores de la petición
      //console.error(error);
    });
}