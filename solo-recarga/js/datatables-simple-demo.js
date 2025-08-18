window.addEventListener('DOMContentLoaded', event => {
    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple, {
            labels: {
                placeholder: "Buscar...",
                perPage: "Entradas por página", // << aquí se traduce "entries per page"
                noRows: "No se encontraron resultados",
                info: "Mostrando {start} a {end} de {rows} entradas",
                loading: "Cargando...",
                pagination: {
                    previous: "Anterior",
                    next: "Siguiente",
                    navigate: "Ir a la página",
                    page: "Página",
                    showing: "Mostrando",
                    of: "de"
                }
            }
        });
    }
});
