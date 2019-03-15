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
                        <li class="active">Jornadas</li>
                    </ol>

                    <div class="card-content">

                        <h4>Jornadas</h4>                        
                        <div class="toolbar">
                            <!--BOTON DE AGREGAR-->
                            <?= $this->Html->link('Agregar', ['action' => 'add'], ['id' => 'start-tour', 'class' => 'btn btn-primary mb-lg']) ?>
                            <!--MIGA DE PAN-->                           
                        </div>

                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Descripci&oacute;n</th>
                                        <th>Coordinador &Eacute;xodo</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Tipo</th>
                                        <th>Estado</th>
                                        <th class="disabled-sorting text-right">Acciones</th>
                                        <th>Seguimiento</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Descripci&oacute;n</th>
                                        <th>Coordinador &Eacute;xodo</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Fin</th>
                                        <th>Tipo</th>
                                        <th>Estado</th>
                                        <th class="disabled-sorting text-right">Acciones</th>
                                        <th>Seguimiento</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($siJornadas as $siJornada) { ?>
                                        <tr>
                                            <td><?= $siJornada->id ?></td>
                                            <td><?= $siJornada->descripcion ?></td>
                                            <td><?= $siJornada->coordinador->person->nombres . ' ' . $siJornada->coordinador->person->apellidos ?></td>
                                            <td><?= date_format($siJornada->fecha_inicio, 'Y-m-d') ?></td>
                                            <td><?= ($siJornada->fecha_fin != '') ? date_format($siJornada->fecha_fin, 'Y-m-d') : '' ?></td>
                                            <td><?= $siJornada->ma_propiedade->valor ?></td>

                                            <td>
                                                <?php
                                                if ($siJornada->status_id == 9) {
                                                    echo '<span class="label label-success">' . $siJornada->ma_status->value . '</span>';
                                                } elseif ($siJornada->status_id == 10) {
                                                    echo '<span class="label label-danger">' . $siJornada->ma_status->value . '</span>';
                                                } elseif ($siJornada->status_id == 11) {
                                                    echo '<span class="label label-danger">' . $siJornada->ma_status->value . '</span>';
                                                } elseif ($siJornada->status_id == 12) {
                                                    echo '<span class="label label-danger">' . $siJornada->ma_status->value . '</span>';
                                                } else {
                                                    echo '<span class="label label-inverse">ERROR</span>';
                                                }
                                                ?>
                                            </td>  

                                            <td class="text-right">

                                                <?=
                                                $this->Html->link($this->Html->image('/img/ico_editar.png', ['style' => 'width: 20px; height: auto; margin-left: 10px', "alt" => __('Editar'), "title" => __('Editar')]), ['action' => 'edit', $siJornada->id], ['escape' => false]);
                                                ?>

                                                <?php
                                                echo $this->Form->postLink(
                                                        $this->Html->image('/img/ico_delete.jpg', ['style' => 'width: 20px; height: auto; margin-left: 10px', "alt" => __('Eliminar'), "title" => __('Eliminar')]), ['action' => 'delete', $siJornada->id], ['escape' => false, 'confirm' => __('¿Está seguro?')]
                                                );
                                                ?>

                                                <?=
                                                $this->Html->link($this->Html->image('/img/ico_asociar_temas.png', ['style' => 'width: 20px; height: auto; margin-left: 10px', "alt" => __('Asociar Temas'), "title" => __('Asociar Temas')]), ['action' => 'index2', $siJornada->id], ['escape' => false]);
                                                ?>

                                            </td>    

                                            <td> 
                                                <div class="dropdown small">
                                                    <button class="btn btn-primary dropdown-toggle small" type="button" data-toggle="dropdown">Seguimiento
                                                        <span class="caret"></span></button>
                                                    <ul class="dropdown-menu small">
                                                        <li><?= $this->Html->link('Asitentes', ['action' => 'asistentes', $siJornada->id]) ?></li>                                            
                                                        <li><?= $this->Html->link('Asistencia', ['action' => 'asistencia', $siJornada->id]) ?></li>                                            
                                                    </ul>
                                                </div>
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