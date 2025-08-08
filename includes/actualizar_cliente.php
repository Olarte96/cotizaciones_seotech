<?php
if (
    empty($_POST["razonSocial"])
    ||
    empty($_POST["nit"])
    ||
    empty($_POST["ciudad"])
    ||
    empty($_POST["id"])
    ||
    empty($_POST["tokenCSRF"])
) {
    exit;
}
Utiles::salirSiTokenCSRFNoCoincide($_POST["tokenCSRF"]);

Clientes::actualizar($_POST["id"], $_POST["razonSocial"], $_POST["nit"], $_POST["ciudad"]);
Utiles::redireccionar("clientes");
