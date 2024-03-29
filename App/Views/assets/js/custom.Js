const solicitudFetch = (url, metodo = 'GET', cuerpo = null, encabezados = {}) => {
    return new Promise((resolve, reject) => {
        const opciones = {
            method: metodo,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                ...encabezados,
            },
        };

        if (cuerpo !== null) {
            if (cuerpo instanceof FormData || typeof cuerpo.append === 'function') {
                opciones.body = cuerpo;
            } else {
                opciones.headers['Content-Type'] = 'application/json';
                opciones.body = JSON.stringify(cuerpo);
            }
        }
        fetch(url, opciones)
            .then((response) => {
                if (!response.ok) {}
                return response.json();
            })
            .then((data) => {
                resolve(data);
            })
            .catch((error) => {
                reject(error);
            });
    });
};