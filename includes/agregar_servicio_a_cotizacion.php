<?php
if (
    empty($_POST["idCotizacion"])
    ||
    empty($_POST["servicio"])
    ||
    empty($_POST["costo"])
    ||
    empty($_POST["cantidad"])
    ||
    empty($_POST["tokenCSRF"])
) {
    exit;
}
Utiles::salirSiTokenCSRFNoCoincide($_POST["tokenCSRF"]);

Cotizaciones::agregarServicio($_POST["idCotizacion"], $_POST["servicio"], $_POST["costo"], $_POST["cantidad"]);
Utiles::redireccionar("detalles_caracteristicas_cotizacion&id=" . $_POST["idCotizacion"]);
