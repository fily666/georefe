<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-text" data-background-color="rose">
                        <h4 class="card-title">Datos de Parientes de <?= $persona-> nombres . ' ' . $persona->apellidos ?></h4>    
                    </div>

                    <ol class="breadcrumb pull-right">
                        <li><?= $this->Html->link('Inicio', ['controller' => 'Home', 'action' => 'index']) ?>
                        </li>
                        <li><?= $this->Html->link('Personas', ['action' => 'index']) ?> 
                        </li>
                        <li class="active">Datos de Parientes</li>
                    </ol>

                    <div class="card-content">                        

                        <!--INICIO DEL PANEL PARA EL FORMULARIO-->
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <?= $this->Form->create(null, ['role' => 'form', 'class' => 'form-horizontal', 'id' => 'formAdd3']) ?>

                                <div class="form-horizontal">

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Documento de Pariente</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->input('documento', ['class' => 'form-control', 'label' => false, 'required' => true]) ?>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Parentesco</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('id_parentesco', $lista1, ['id' => 'id_parentesco', 'class' => 'form-control', 'empty' => ':: Seleccione ::', 'label' => false, 'required' => true]) ?>
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
                                            <th>Foto</th>
                                            <th>Número de Identificación</th>
                                            <th>Parentesco</th>
                                            <th>Nombre</th>
                                            <th class="disabled-sorting text-right">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Foto</th>
                                            <th>Número de Identificación</th>
                                            <th>Parentesco</th>
                                            <th>Nombre</th>
                                            <th class="disabled-sorting text-right">Eliminar</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php 
                                        foreach ($parientes as $person) { ?>
                                            <tr>
                                                <td> <?= $this->Html->image('/attachments/users/' . $person['pariente']['fotografia'], ['alt' => 'Avatar', 'style' => 'width: 50px; height: 60px']); ?></td>

                                                <td>                                              
                                                    <a href="#datodBasicosModal" data-toggle="modal" data-id="<?= $person['pariente']['id'] ?>" class="btn-block"><?= $person['pariente']['documento'] ?></a>
                                                </td>
                                                <td><?= $person['ma_propiedade']['valor'] ?></td>
                                                <td><?= ($person['pariente']['nombres'] . ' ' . ' ' . $person['pariente']['apellidos']) ?></td>                                                

                                                <td class="text-right">

                                                    <?php
                                                    echo $this->Form->postLink(
                                                            $this->Html->image('/img/ico_delete.jpg', ['style' => 'width: 20px; height: auto; margin-left: 10px', "alt" => __('Eliminar'), "title" => __('Eliminar')]), ['action' => 'deletepariente', $person['id'], $person['id_datos_basicos']], ['escape' => false, 'confirm' => __('¿Está seguro?')]
                                                    );
                                                    ?>
                                                </td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>



                        </div>
                        <!--FIN DEL PANEL PARA EL FORMULARIO-->
                    </div>
                </div>
            </div>
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
</div>

<script>

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

