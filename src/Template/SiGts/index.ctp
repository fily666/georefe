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
                        <li class="active">Grupos de Transformaci&oacute;n</li>
                    </ol>

                    <div class="card-content">

                        <h4>Grupos de Transformaci&oacute;n</h4>                        
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
                                        <th>Estado</th>
                                        <th>Direcci&oacute;n</th>
                                        <th>Tel&eacute;fono</th>
                                        <th>D&iacute;a</th>
                                        <th>Hora</th>
                                        <th>L&iacute;der</th>
                                        <th>Pastor</th>
                                        <th class="disabled-sorting text-right">Acciones</th>
                                        <th>Seguimiento</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Estado</th>
                                        <th>Direcci&oacute;n</th>
                                        <th>Tel&eacute;fono</th>
                                        <th>D&iacute;a</th>
                                        <th>Hora</th>
                                        <th>L&iacute;der</th>
                                        <th>Pastor</th>
                                        <th class="disabled-sorting text-right">Acciones</th>
                                        <th>Seguimiento</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                   // pr($siGts->toArray());

                                    foreach ($siGts as $siGt) {
                                        ?>
                                        <tr>
                                            <td><?= $siGt->id ?></td>
                                            <td><?= $siGt->ma_status->value ?></td>                                           
                                            <td><?= $siGt->direccion ?></td>
                                            <td><?= ($siGt->telefono != '') ? $siGt->telefono : '' ?></td>
                                            <td><?= ($siGt->dia_reunion != '') ? $siGt->dia_reunion->valor : '' ?></td>
                                            <td><?= ($siGt->hora_reunion != '') ? date_format($siGt->hora_reunion, 'H:m a') : '' ?></td>                                            
                                            <td><?= $siGt->lider1->person->nombres . ' ' . $siGt->lider1->person->apellidos ?></td>
                                            <td><?= $siGt->si_pastore->person->nombres . ' ' . $siGt->si_pastore->person->apellidos ?></td>


                                            <td class="text-right">

                                                <?=
                                                $this->Html->link($this->Html->image('/img/ico_editar.png', ['style' => 'width: 20px; height: auto;', "alt" => __('Editar'), "title" => __('Editar')]), ['action' => 'edit', $siGt->id], ['escape' => false]);
                                                ?>

                                                <?php
                                                echo $this->Form->postLink(
                                                        $this->Html->image('/img/ico_delete.jpg', ['style' => 'width: 20px; height: auto;', "alt" => __('Eliminar'), "title" => __('Eliminar')]), ['action' => 'delete', $siGt->id], ['escape' => false, 'confirm' => __('¿Está seguro?')]
                                                );
                                                ?>

                                                <?=
                                                $this->Html->link($this->Html->image('/img/ico_asociar_temas.png', ['style' => 'width: 20px; height: auto;', "alt" => __('Asociar Temas'), "title" => __('Asociar Temas')]), ['action' => 'index2', $siGt->id], ['escape' => false]);
                                                ?>

                                            </td>    

                                            <td> 
                                                <div class="dropdown small">
                                                    <button class="btn btn-primary dropdown-toggle small" type="button" data-toggle="dropdown">Seguimiento
                                                        <span class="caret"></span></button>
                                                    <ul class="dropdown-menu small">
                                                        <li><?= $this->Html->link('Asistentes', ['action' => 'asistentes', $siGt->id]) ?></li>                                            
                                                        <li><?= $this->Html->link('Asistencia', ['action' => 'asistencia', $siGt->id]) ?></li>                                            
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