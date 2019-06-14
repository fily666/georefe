<div class="content">
    <div class="container-fluid">
        <div class="row">           
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="purple">
                        <i class="material-icons">assignment</i>
                    </div>

                    <ol class="breadcrumb pull-right">
                        <li><?= $this->Html->link('Inicio', ['controller' => 'Home', 'action' => 'index']) ?>
                        </li>
                        <li class="active">Verificaci&oacute;n</li>
                    </ol>

                    <div class="card-content">

                        <h4>Verificaci&oacute;n</h4>                        
                        <div class="toolbar">
                            <!--BOTON DE AGREGAR-->
                            <?= $this->Html->link('Agregar', ['action' => 'add'], ['id' => 'start-tour', 'class' => 'btn btn-primary mb-lg']) ?>
                            <!--MIGA DE PAN-->                           
                        </div>

                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>N&uacute;mero de Identificaci&oacute;n</th>
                                        <th>Nombre</th>
                                        <th>Fecha Entrega</th>
                                        <th>Lider Acompa&ntilde;amiento</th>
                                        <th>Pastor</th>
                                        <th>Estado Llamada</th>
                                        <th>Resultado Llamada</th>
                                        <th class="disabled-sorting text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Número de Identificación</th>
                                        <th>Nombre</th>
                                        <th>Fecha Entrega</th>
                                        <th>Lider Acompa&ntilde;amiento</th>
                                        <th>Pastor</th>
                                        <th>Estado Llamada</th>
                                        <th>Resultado Llamada</th>
                                        <th class="disabled-sorting text-right">Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($siverientregas as $siverientrega) { ?>
                                        <tr>
                                            <td> <?= $this->Html->image('/attachments/users/' . $siverientrega->persona->fotografia, ['alt' => 'Avatar', 'style' => 'width: 50px; height: 60px']); ?></td>

                                            <td>                                              
                                                <a href="#datodBasicosModal" data-toggle="modal" data-id="<?= $siverientrega->persona->id ?>" class="btn-block"><?= $siverientrega->persona->documento ?></a>
                                            </td>
                                            <td><?= ($siverientrega->persona->nombres . ' ' . ' ' . $siverientrega->persona->apellidos) ?></td>                              
                                            <td><?= ($siverientrega->fecha_entrega != '') ? date_format($siverientrega->fecha_entrega, 'Y-m-d') : '' ?></td>              
                                            <td><?= ($siverientrega->lider_asignado->person->nombres . ' ' . ' ' . $siverientrega->lider_asignado->person->apellidos) ?></td>
                                            <td><?= ($siverientrega->pastor->person->nombres . ' ' . ' ' . $siverientrega->pastor->person->apellidos) ?></td>
                                            <td>
                                                <?php
                                                if ($siverientrega->estado_llamada->id == 249) {
                                                    echo '<span class="label label-success">' . $siverientrega->estado_llamada->valor . '</span>';
                                                } elseif ($siverientrega->estado_llamada->id == 250) {
                                                    echo '<span class="label label-warning">' . $siverientrega->estado_llamada->valor . '</span>';
                                                } elseif ($siverientrega->estado_llamada->id == 251) {
                                                    echo '<span class="label label-danger">' . $siverientrega->estado_llamada->valor . '</span>';
                                                } elseif ($siverientrega->estado_llamada->id == 252) {
                                                    echo '<span class="label label-danger">' . $siverientrega->estado_llamada->valor . '</span>';
                                                } else {
                                                    echo '<span class="label label-inverse">ERROR</span>';
                                                }
                                                ?>
                                            </td>  

                                            <td class="text-center">
                                                <?php if ($siverientrega->estado_llamada->id != 251) { ?>
                                                    <a href="#resultadoLlamadaModal" data-toggle="modal" data-id="<?= $siverientrega->id ?>" class="btn-block2">
                                                        <?= $this->Html->image('/img/ico_encuesta.png', ['style' => 'width: 20px; height: auto; margin-left: 10px', "alt" => __('Resultado Llamada'), "title" => __('Resultado Llamada')]) ?>
                                                    </a>
                                                    <?php
                                                } else {
                                                    echo '<a href="#" class="btn-block2">';
                                                    echo $this->Html->image('/img/ico_encuesta.png', ['style' => 'width: 20px; height: auto; margin-left: 10px; opacity: 0.5', "alt" => __('Resultado Llamada'), "title" => __('No hay resultado de llamada')]);
                                                    echo '</a>';
                                                }
                                                ?>
                                            </td>   

                                            <td class="text-right">

                                                <?=
                                                $this->Html->link($this->Html->image('/img/ico_editar.png', ['style' => 'width: 20px; height: auto; margin-left: 10px', "alt" => __('Editar'), "title" => __('Editar')]), ['action' => 'edit', $siverientrega->id], ['escape' => false]);
                                                ?>

                                                <?php
                                                echo $this->Form->postLink(
                                                        $this->Html->image('/img/ico_delete.jpg', ['style' => 'width: 20px; height: auto; margin-left: 10px', "alt" => __('Eliminar'), "title" => __('Eliminar')]), ['action' => 'delete', $siverientrega->id], ['escape' => false, 'confirm' => __('¿Está seguro?')]
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


    <!-- Modal Información del redultado de la encuesta-->
    <div class="modal fade" id="resultadoLlamadaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Resultado de la llamada</h4>
                </div>
                <div class="modal-body2"></div>
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

    $('.btn-block2').on('click', function () {
        var id = $(this).data('id');
        $('.modal-body2').html('Cargando...');
        $.ajax({
            type: 'POST',
            url: '<?= $this->Url->build(array('action' => 'resultadollamada')) ?>',
            data: {id: id},
            success: function (data) {
                $('.modal-body2').html(data);
            },
            error: function (err) {
                alert("error" + JSON.stringify(err));
            }
        });
    });

</script>