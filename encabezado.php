<!DOCTYPE html>
<html lang="es">

<head>
    <script async
        src="https://www.googletagmanager.com/gtag/js?id=<?php echo Comun::env("ID_SEGUIMIENTO"); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', '<?php echo Comun::env("ID_SEGUIMIENTO"); ?>');
    </script>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="twitter:image" content="https://parzibyte.me/blog/wp-content/uploads/2019/01/Sistema-web-para-cotizaciones-y-presupuestos.png"/>
    <meta name="twitter:description" content="Aplicación web para cotizaciones y presupuestos. Gestiona clientes, costos y tiempos"/>
    <meta name="twitter:card" content="summary"/>
    <meta name="description" content="Aplicación web para cotizaciones y presupuestos. Gestiona clientes, costos y tiempos">
    <meta property="og:image" content="https://parzibyte.me/blog/wp-content/uploads/2019/01/Sistema-web-para-cotizaciones-y-presupuestos.png"/>
    <meta property="og:locale" content="es_LA"/>
    <meta property="og:url" content="https://www.parzibyte.me/apps/cotizaciones"/>
    <meta property="og:site_name" content="parzibyte.me"/>
    <meta property="og:title" content="Generador de cotizaciones y presupuestos | Parzibyte's apps"/>
    <meta property="og:description" content="Aplicación web para cotizaciones y presupuestos. Gestiona clientes, costos y tiempos"/>
    <title>Generador de cotizaciones y presupuestos | Serotech SAS</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/css/font-awesome.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <!-- Estilos Personalizados -->
    <style>
        /*Estilos tomados de https://getbootstrap.com/docs/4.0/examples/sticky-footer-navbar/*/
        html {
            position: relative;
            min-height: 100%;
        }
        body {
            /* Margin bottom by footer height */
            margin-bottom: 60px;
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            /* Set the fixed height of the footer here */
            height: 60px;
            /*line-height: 60px; !* Vertically center the text there *!*/
            background-color: #f5f5f5;
        }
    </style>
</head>

 <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <!-- DataTables Responsive JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <!-- Inicialización de DataTables -->
 <!-- Otros scripts -->
    <script src="<?php echo BASE_URL ?>/js/vue.js"></script>
    <script src="<?php echo BASE_URL ?>/js/cotizaciones.js"></script>

<body>
