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
                        <li class="active">Call Center</li>
                    </ol>

                    <div class="card-content">

                        <h4>Call Center</h4>                        

                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Número de Identificación</th>
                                        <th>Nombre</th>
                                        <th>Lider GT</th>
                                        <th>Estado Llamada</th>
                                        <th>Encuesta</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Número de Identificación</th>
                                        <th>Nombre</th>
                                        <th>Lider GT</th>
                                        <th>Estado Llamada</th>
                                        <th>Encuesta</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($encuestas as $encuesta) { ?>
                                        <tr>
                                            <td> <?= $this->Html->image('/attachments/users/' . $encuesta->entrega->persona->fotografia, ['alt' => 'Avatar', 'style' => 'width: 50px; height: 60px']); ?></td>

                                            <td>                                              
                                                <a href="#datodBasicosModal" data-toggle="modal" data-id="<?= $encuesta->entrega->persona->id ?>" class="btn-block"><?= $encuesta->entrega->persona->documento ?></a>
                                            </td>
                                            <td><?= ($encuesta->entrega->persona->nombres . ' ' . ' ' . $encuesta->entrega->persona->apellidos) ?></td>                                            
                                            <td><?= ($encuesta->entrega->lider_llamada != '') ? ($encuesta->entrega->lider_llamada->person->nombres . ' ' . ' ' . $encuesta->entrega->lider_llamada->person->apellidos) : '' ?></td>

                                            <td>
                                                <?php
                                                if ($encuesta->entrega->estado_llamada->id == 249) {
                                                    echo '<span class="label label-success">' . $encuesta->entrega->estado_llamada->valor . '</span>';
                                                } elseif ($encuesta->entrega->estado_llamada->id == 250) {
                                                    echo '<span class="label label-warning">' . $encuesta->entrega->estado_llamada->valor . '</span>';
                                                } elseif ($encuesta->entrega->estado_llamada->id == 251) {
                                                    echo '<span class="label label-danger">' . $encuesta->entrega->estado_llamada->valor . '</span>';
                                                } elseif ($encuesta->entrega->estado_llamada->id == 252) {
                                                    echo '<span class="label label-danger">' . $encuesta->entrega->estado_llamada->valor . '</span>';
                                                } else {
                                                    echo '<span class="label label-inverse">ERROR</span>';
                                                }
                                                ?>
                                            </td>  

                                            <td class="text-center">
                                                <a href="#resultadoLlamadaModal" data-toggle="modal" data-id="<?= $encuesta->id ?>" class="btn-block2">
                                                    <?= $this->Html->image('/img/ico_encuesta.png', ['style' => 'width: 20px; height: auto; margin-left: 10px', "alt" => __('Encuesta'), "title" => __('Encuesta')]) ?>
                                                </a>                                                   
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


<!-- Modal Información del redultado de la encuesta-->
<div class="modal fade" id="resultadoLlamadaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Encuesta</h4>
            </div>
            <div class="modal-body2"></div>

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
            type: 'GET',
            url: '<?= $this->Url->build(array('action' => 'encuesta')) ?>/' + id,
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