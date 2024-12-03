function iniciarJuego() {
    fetch('/iniciar_juego', {
        method: 'POST',
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Error HTTP: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.mensaje) {
            alert(data.mensaje); // Mostrar mensaje de éxito
        } else if (data.error) {
            alert("Error: " + data.error); // Mostrar mensaje de error
        }
    })
    .catch(err => {
        alert("Error al conectar con el servidor: " + err.message);
    });
}
