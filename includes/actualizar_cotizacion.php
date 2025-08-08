<?php
if (
    empty($_POST["id"])
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
    ||
    empty($_POST["tokenCSRF"])
) {
    exit;
}
Utiles::salirSiTokenCSRFNoCoincide($_POST["tokenCSRF"]);

Cotizaciones::actualizar($_POST["id"], $_POST["idCliente"], $_POST["descripcion"], $_POST["fecha"], $_POST["cond_pago"], $_POST["cond_entrega"], $_POST["fecha_venc"]);
Utiles::redireccionar("cotizaciones");
