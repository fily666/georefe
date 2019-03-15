<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="purple">
                        <i class="material-icons">assignment</i>
                    </div>

                    <ol class="breadcrumb pull-right">
                        <li><?=$this->Html->link('Inicio', ['controller' => 'Home', 'action' => 'index'])?>
                        </li>
                        <li class="active">Personas</li>
                    </ol>


                    <div class="card-content">


                        <h4>Personas</h4>
                        <div class="toolbar">
                            <!--BOTON DE AGREGAR-->
                            <?=$this->Html->link('Agregar', ['action' => 'add'], ['id' => 'start-tour', 'class' => 'btn btn-primary mb-lg'])?>
                            <!--MIGA DE PAN-->
                        </div>

                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Tipo de Identificación</th>
                                        <th>Número de Identificación</th>
                                        <th>Nombre</th>
                                        <th>Estado</th>
                                        <th class="disabled-sorting text-right">Acciones</th>
                                        <th>Información Adicional</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Tipo de Identificación</th>
                                        <th>Número de Identificación</th>
                                        <th>Nombre</th>
                                        <th>Estado</th>
                                        <th class="disabled-sorting text-right">Acciones</th>
                                        <th>Información Adicional</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($persons as $person) {?>
                                        <tr>
                                            <td> <?=$this->Html->image('/attachments/users/' . $person->fotografia, ['alt' => 'Avatar', 'style' => 'width: 50px; height: 60px']);?></td>
                                            <td><?=$person->ma_propiedade->valor?></td>
                                            <td>
                                                <a href="#datodBasicosModal" data-toggle="modal" data-id="<?=$person->id?>" class="btn-block"><?=$person->documento?></a>
                                            </td>
                                            <td><?=($person->nombres . ' ' . ' ' . $person->apellidos)?></td>

                                            <td>
                                                <?php
if ($person->status_id == 1) {
    echo '<span class="label label-success">' . $person->ma_status->value . '</span>';
} elseif ($person->status_id == 2) {
    echo '<span class="label label-danger">' . $person->ma_status->value . '</span>';
} elseif ($person->status_id == 3) {
    echo '<span class="label label-danger">' . $person->ma_status->value . '</span>';
} else {
    echo '<span class="label label-inverse">ERROR</span>';
}
    ?>
                                            </td>

                                            <td class="text-right">

                                                <?=
    $this->Html->link($this->Html->image('/img/ico_editar.png', ['style' => 'width: 20px; height: auto; margin-left: 10px', "alt" => __('Editar'), "title" => __('Editar')]), ['action' => 'edit', $person->id], ['escape' => false]);
    ?>

                                                <?php
echo $this->Form->postLink(
        $this->Html->image('/img/ico_delete.jpg', ['style' => 'width: 20px; height: auto; margin-left: 10px', "alt" => __('Eliminar'), "title" => __('Eliminar')]), ['action' => 'delete', $person->id], ['escape' => false, 'confirm' => __('¿Está seguro?')]
    );
    ?>
                                            </td>

                                            <td>
                                                <div class="dropdown small">
                                                    <button class="btn btn-primary dropdown-toggle small" type="button" data-toggle="dropdown">Formularios
                                                        <span class="caret"></span></button>
                                                    <ul class="dropdown-menu small">
                                                        <li><?=$this->Html->link('Datos Complementarios', ['action' => 'add2', $person->id])?></li>
                                                        <li><?=$this->Html->link('Datos de Parientes', ['action' => 'add3', $person->id])?></li>
                                                    </ul>
                                                </div>
                                            </td>

                                        </tr>
                                    <?php }?>
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


<script>

    $('.btn-block').on('click', function () {
        var id = $(this).data('id');
        $('.modal-body').html('Cargando...');
        $.ajax({
            type: 'POST',
            url: '<?=$this->Url->build(array('action' => 'datosbasicos'))?>',
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


