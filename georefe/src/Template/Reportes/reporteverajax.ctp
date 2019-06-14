<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
<?php echo $this->Html->script('jquery.datatables') ?>

<?= $this->Html->link(__('Exportar Informe'), ['action' => 'reporte3verpdf', $fecha1, $fecha2, '_ext' => 'pdf'], ['class' => 'btn btn-primary']); ?><br/><br/>

Entre las fechas, <?= '<b>' . $fecha1 . '</b> a <b>' . $fecha2 . '</b>, se encontraron <b>' . count($siVeriEntregas->toArray()) . '</b>' ?> Verificaciones: 

<div class="material-datatables">

    <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Documento</th>         
                <th>Fecha Entrega</th>
                <th>Pastor</th>
                <th>Líder</th>
                <th>Proceso</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Nombre</th>
                <th>Documento</th>         
                <th>Fecha Entrega</th>
                <th>Pastor</th>
                <th>Líder</th>
                <th>Proceso</th>
            </tr>
        </tfoot>
        <tbody>
            <?php
            foreach ($siVeriEntregas as $siVeriEntrega) {
                ?>
                <tr>
                    <td><?= $siVeriEntrega->persona->nombres . ' ' . $siVeriEntrega->persona->apellidos ?></td>
                    <td>                                              
                        <a href="#datodBasicosModal" data-toggle="modal" data-id="<?= $siVeriEntrega->persona->id ?>" class="btn-block"><?= $siVeriEntrega->persona->documento ?></a>
                    </td>
                    <td><?= date_format($siVeriEntrega->fecha_entrega, 'Y-m-d') ?></td>
                    <td><?= $siVeriEntrega->pastor->person->nombres . ' ' . $siVeriEntrega->pastor->person->apellidos ?></td>
                    <td><?= $siVeriEntrega->lider_asignado->person->nombres . ' ' . $siVeriEntrega->lider_asignado->person->apellidos ?></td>
                    <td>Verificación</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

  <!-- Modal Información basica por persona-->
    <div class="modal fade" id="datodBasicosModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Datos B&aacute;sicos</h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div> 
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


    $('.btn-block').on('click', function () {
        var id = $(this).data('id');
        $('.modal-body').html('Cargando...');
        $.ajax({
            type: 'POST',
            url: '<?= $this->Url->build(array('action' => 'datosbasicos')) ?>',
            data: {id: id},
            success: function (data) {
                $('.modal-body').html(data);
            },
            error: function (err) {
                alert("error" + JSON.stringify(err));
            }
        });
    });



</script>