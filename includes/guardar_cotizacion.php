<?php
if (
    empty($_POST["tokenCSRF"])
    ||
    empty($_POST["idCliente"])
    ||
    empty($_POST["descripcion"])
    ||
    empty($_POST["fecha"])
    ||
    empty($_POST["cond_pago"])
    ||
    empty($_POST["cond_entrega"])
    ||
    empty($_POST["fecha_venc"])
) {
    exit;
}
Utiles::salirSiTokenCSRFNoCoincide($_POST["tokenCSRF"]);
Cotizaciones::nueva($_POST["idCliente"], $_POST["descripcion"], $_POST["fecha"], $_POST["cond_pago"], $_POST["cond_entrega"], $_POST["fecha_venc"]);
Utiles::redireccionar("cotizaciones");