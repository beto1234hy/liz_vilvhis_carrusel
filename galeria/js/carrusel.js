const form = document.getElementById("formCarrusel");
const inputImagen = document.getElementById("imagen");
const carouselInner = document.getElementById("carouselInner");
const mensaje = document.getElementById("mensaje");

let imagenes = [];
let indiceActual = 0;

form.addEventListener("submit", async (e) => {
    e.preventDefault();

    if (!inputImagen.files[0]) {
        mensaje.innerText = "Selecciona una imagen";
        return;
    }

    const formData = new FormData();
    formData.append("imagen", inputImagen.files[0]);

    const res = await fetch("php/subir.php", {
        method: "POST",
        body: formData
    });

    const text = await res.text();
    mensaje.innerText = text;

    await cargarImagenes();
});

// ✅ Trae solo los IDs/rutas, no carga las imágenes todavía
async function cargarImagenes() {
    const res = await fetch("php/obtener_imagenes.php");
    imagenes = await res.json();

    if (imagenes.length === 0) {
        carouselInner.innerHTML = "<p>No hay imágenes</p>";
        return;
    }

    indiceActual = 0;
    renderCarrusel();
}

// ✅ Renderiza la estructura del carrusel
function renderCarrusel() {
    carouselInner.innerHTML = `
        <div style="text-align:center">

            <div id="imagenContainer" style="min-height:300px; display:flex; align-items:center; justify-content:center;">
                <p>Cargando...</p>
            </div>

            <p id="contadorImg" style="margin:8px 0; color:#555;"></p>

            <button id="btnAnterior" onclick="cambiarImagen(-1)">← Anterior</button>
            <button id="btnSiguiente" onclick="cambiarImagen(1)">Siguiente →</button>

        </div>
    `;

    cargarImagenActual();
}

// ✅ Carga la imagen actual con AJAX (fetch de la imagen en sí)
function cargarImagenActual() {
    const contenedor = document.getElementById("imagenContainer");
    const contador = document.getElementById("contadorImg");

    // Mostrar loading mientras carga
    contenedor.innerHTML = `<p>Cargando imagen ${indiceActual + 1}...</p>`;
    contador.innerText = `${indiceActual + 1} / ${imagenes.length}`;

    // Actualizar URL sin recargar la página
    const ruta = imagenes[indiceActual].ruta;
    history.pushState(null, "", "?imagen=" + encodeURIComponent(ruta));

    // Crear imagen y cargarla lazy
    const img = new Image();
    img.style.maxWidth = "500px";
    img.style.maxHeight = "400px";
    img.style.borderRadius = "8px";

    img.onload = () => {
        contenedor.innerHTML = "";
        contenedor.appendChild(img);
    };

    img.onerror = () => {
        contenedor.innerHTML = "<p>Error al cargar imagen</p>";
    };

    img.src = ruta;
}

// ✅ Navegar entre imágenes
function cambiarImagen(direccion) {
    indiceActual += direccion;

    if (indiceActual < 0) indiceActual = imagenes.length - 1;
    if (indiceActual >= imagenes.length) indiceActual = 0;

    cargarImagenActual();
}

// Iniciar al cargar la página
cargarImagenes();