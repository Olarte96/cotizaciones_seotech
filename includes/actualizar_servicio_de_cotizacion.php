<?php
if (
    empty($_POST["idServicio"])
    ||
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
    exit("Uno o más datos no fueron enviados");
}
Utiles::salirSiTokenCSRFNoCoincide($_POST["tokenCSRF"]);

Cotizaciones::actualizarServicio(
    $_POST["idServicio"],
    $_POST["servicio"],
    $_POST["costo"],
    $_POST["cantidad"]
);
Utiles::redireccionar("detalles_caracteristicas_cotizacion&id=" . $_POST["idCotizacion"]);
