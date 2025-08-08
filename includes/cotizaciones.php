<?php
$cotizaciones = Cotizaciones::todas();
$tokenCSRF = Utiles::obtenerTokenCSRF();
?>

<div class="row">
    <div class="col-sm">
        <br>
        <h1>Realizar cotizaciones</h1>
        <br>
    </div>
</div>

<div class="row">
    <div class="col-sm">
        <p>
            <a href="<?php echo BASE_URL ?>/?p=nueva_cotizacion" class="btn btn-primary">
                <i class="fa fa-plus"></i> Nueva cotización
            </a>
        </p>
    </div>
    
</div>

<div class="row">
    <div class="col-sm">
        <div class="table-responsive">
            <table id="example1" class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Detalles</th>
                    <th>Imprimir</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($cotizaciones as $cotizacion) { ?>
                    <tr>
                        <td><?php echo $cotizacion->id ?></td>
                        <td><?php echo htmlentities($cotizacion->razonSocial) ?></td>
                        <td><?php echo htmlentities($cotizacion->descripcion) ?></td>
                        <td><?php echo htmlentities($cotizacion->fecha) ?></td>
                        <td>
                            <a class="btn btn-info"
                               href="<?php echo BASE_URL ?>/?p=detalles_caracteristicas_cotizacion&id=<?php echo $cotizacion->id ?>">
                                <i class="fa fa-info"></i>
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-info"
                               href="<?php echo BASE_URL ?>/?p=imprimir_cotizacion&id=<?php echo $cotizacion->id ?>">
                                <i class="fa fa-print"></i>
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-warning"
                               href="<?php echo BASE_URL ?>/?p=editar_cotizacion&id=<?php echo $cotizacion->id ?>">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-danger"
                               href="<?php echo BASE_URL ?>/?p=eliminar_cotizacion&id=<?php echo $cotizacion->id ?>&tokenCSRF=<?php echo $tokenCSRF ?>">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "pageLength": 10, // Establece el número de registros por página
                "language":{
                    "search": "Buscar",
                    "info": "Mostrando pagina _PAGE_ de _PAGES_",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Siguiente"
                },
                "buttons": {
                        "copy": "Copiar",
                        "print": "Imprimir",
                        "colvis": "Ocultar columnas"
                }
            },
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>