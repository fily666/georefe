<div class="content">
    <div class="container-fluid">
        <div class="row">           
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="purple">
                        <i class="material-icons">assignment</i>
                    </div>

                    <ol class="breadcrumb pull-right">
                        <li><?= $this->Html->link('Inicio', ['controller' => 'Home', 'action' => 'index']) ?></li>
                        <li><?= $this->Html->link('Gts', ['action' => 'index']) ?></li>
                        <li class="active">Asistentes Gt</li>
                    </ol>

                    <div class="card-content">

                        <h4>Asistentes Gt, <b><?= $gt->id ?></b></h4>                        

                        <div class="panel-body">
                            <?= $this->Form->create(null, ['role' => 'form', 'class' => 'form-horizontal', 'id' => 'formAdd']) ?>

                            <div class="form-horizontal">

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Buscar Asistente</label>
                                    <div class="col-lg-9">
                                        <?=
                                        $this->Form->select('id_datos_basicos', $lista1, ['id' => 'select1', 'class' => 'form-control', 'empty' => ':: Seleccione ::'
                                            , 'label' => false, 'required' => true, 'style' => 'width: 100%'])
                                        ?>
                                    </div>
                                </div>

                                

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Tipo Asistente</label>
                                    <div class="col-lg-9">
                                        <?=
                                        $this->Form->select('id_tipo_asistente', $lista4, ['class' => 'form-control', 'empty' => ':: Seleccione ::'
                                            , 'label' => false, 'style' => 'width: 100%'])
                                        ?>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-primary']); ?>
                                    <?= $this->Form->button(__('Guardar'), ['class' => 'btn btn-success']); ?>
                                </div>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>

                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>                                        
                                        <th>Nombres</th>
                                        <th>Documento</th>
                                        <th>Tipo Asistente</th>
                                        <th>Tel. Fijo</th>
                                        <th>Tel. Celular</th>                                     
                                        <th>Estado</th>
                                        <th class="disabled-sorting text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nombres</th>
                                        <th>Documento</th>
                                        <th>Tipo Asistente</th>
                                        <th>Tel. Fijo</th>
                                        <th>Tel. Celular</th>                                       
                                        <th>Estado</th>
                                        <th class="disabled-sorting text-right">Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($siGtAsistentes as $siGtAsistente) { ?>
                                        <tr>
                                            <td><?= $siGtAsistente->persona->nombres . ' ' . $siGtAsistente->persona->apellidos ?></td>
                                            <td>                                              
                                                <a href="#datodBasicosModal" data-toggle="modal" data-id="<?= $siGtAsistente->persona->id ?>" class="btn-block"><?= $siGtAsistente->persona->documento ?></a>
                                            </td>
                                            <td><?= $siGtAsistente->ma_propiedade->valor ?></td>
                                            <td><?= $siGtAsistente->persona->telefono1 ?></td>
                                            <td><?= $siGtAsistente->persona->celular ?></td>                                           

                                            <td>
                                                <?php
                                                if ($siGtAsistente->status_id == 1) {
                                                    echo '<span class="label label-success">' . $siGtAsistente->ma_status->value . '</span>';
                                                } elseif ($siGtAsistente->status_id == 2) {
                                                    echo '<span class="label label-danger">' . $siGtAsistente->ma_status->value . '</span>';
                                                } elseif ($siGtAsistente->status_id == 3) {
                                                    echo '<span class="label label-danger">' . $siGtAsistente->ma_status->value . '</span>';
                                                } else {
                                                    echo '<span class="label label-inverse">ERROR</span>';
                                                }
                                                ?>
                                            </td>  

                                            <td class="text-right">
                                                <?php
                                                echo $this->Form->postLink(
                                                        $this->Html->image('/img/ico_delete.jpg', ['style' => 'width: 20px; height: auto; margin-left: 10px', "alt" => __('Eliminar'), "title" => __('Eliminar')]), ['action' => 'delete3', $siGtAsistente->id, $gt->id], ['escape' => false, 'confirm' => __('¿Está seguro?')]
                                                );
                                                ?>
                                            </td>  
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end content-->
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
        <!-- end row -->
    </div>
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

    $("#select1").select2({
        allowClear: true
    });

    $("#select2").select2({
        allowClear: true
    });

    $("#select3").select2({
        allowClear: true
    });


    $("#select4").select2({
        allowClear: true
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