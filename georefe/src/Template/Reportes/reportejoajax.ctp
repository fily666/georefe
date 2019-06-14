<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
<?php echo $this->Html->script('jquery.datatables') ?>

<?= $this->Html->link(__('Exportar Informe'), ['action' => 'reporte3jopdf', $fecha1, $fecha2, '_ext' => 'pdf'], ['class' => 'btn btn-primary']); ?><br/><br/>

Entre las fechas, <?= '<b>' . $fecha1 . '</b> a <b>' . $fecha2 . '</b>, se encontraron <b>' . count($siJornadas->toArray()) . '</b>' ?> Jornadas: 

<div class="material-datatables">

    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
        <thead>
            <tr>
                <th>Descipci&oacute;n</th>
                <th>Fecha Inicio</th>         
                <th>Fecha Fin</th>
                <th>Tipo</th>
                <th>Coordinador</th>
                <th>Estado</th>
                <th>Proceso</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Descipci&oacute;n</th>
                <th>Fecha Inicio</th>         
                <th>Fecha Fin</th>
                <th>Tipo</th>
                <th>Coordinador</th>
                <th>Estado</th>
                <th>Proceso</th>
            </tr>
        </tfoot>
        <tbody>
            <?php
            foreach ($siJornadas as $siJornada) {
                ?>
                <tr>
                    <td><?= $siJornada->descripcion?></td>
                    <td><?= date_format($siJornada->fecha_inicio, 'Y-m-d') ?></td>
                    <td><?= date_format($siJornada->fecha_fin, 'Y-m-d') ?></td>
                    <td><?= $siJornada->ma_propiedade->valor?></td>
                    <td><?= $siJornada->coordinador->person->nombres . ' ' . $siJornada->coordinador->person->apellidos ?></td>
                    <td><?= $siJornada->ma_status->value ?></td>
                    <td>Jornada</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>


<script>
    $(document).ready(function () {

        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();

        demo.initVectorMap();

//DATA TABLES
        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "Todos"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Buscar",
                decimal: "",
                emptyTable: "No hay datos disponibles en la tabla",
                info: "_START_ a _END_ de _TOTAL_ registros",
                infoEmpty: "0 ta 0 de 0 registros",
                infoFiltered: "(filtrado de _MAX_ total registros)",
                infoPostFix: "",
                thousands: ",",
                lengthMenu: "Mostrar _MENU_ Registros",
                loadingRecords: "Cargando...",
                processing: "Procesando...",
                zeroRecords: "No se encontraron registros coincidentes",
                paginate: {
                    first: "Primero",
                    last: "Último",
                    next: "Siguiente",
                    previous: "Anterior"
                }
            }

        });


        var table = $('#datatables').DataTable();

        // Edit record
        table.on('click', '.edit', function () {
            $tr = $(this).closest('tr');

            var data = table.row($tr).data();
            alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
        });

        // Delete a record
        table.on('click', '.remove', function (e) {
            $tr = $(this).closest('tr');
            table.row($tr).remove().draw();
            e.preventDefault();
        });

        //Like record
        table.on('click', '.like', function () {
            alert('You clicked on Like button');
        });

        $('.card .material-datatables label').addClass('form-group');

    });
</script>