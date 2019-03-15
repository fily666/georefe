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
                        <li class="active">Grupos de Liderazgo</li>
                    </ol>

                    <div class="card-content">

                        <h4>Grupos de Liderazgo</h4>                        
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
                                        <th class="disabled-sorting text-right">Seguimiento</th>
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
                                        <th class="disabled-sorting text-right">Seguimiento</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    foreach ($siGls as $siGl) {
                                        ?>
                                        <tr>
                                            <td><?= $siGl->id ?></td>
                                            <td><?= $siGl->ma_status->value ?></td>                                            
                                            <td><?= $siGl->direccion ?></td>
                                            <td><?= ($siGl->telefono != '') ? $siGl->telefono : '' ?></td>
                                            <td><?= ($siGl->dia_reunion != '') ? $siGl->dia_reunion->valor : '' ?></td>
                                            <td><?= ($siGl->hora_reunion != '') ? date_format($siGl->hora_reunion, 'H:m a') : '' ?></td>                                            
                                            <td><?= $siGl->lider->person->nombres . ' ' . $siGl->lider->person->apellidos ?></td>
                                            <td><?= $siGl->si_pastore->person->nombres . ' ' . $siGl->si_pastore->person->apellidos ?></td>


                                            <td class="text-right">

                                                <?=
                                                $this->Html->link($this->Html->image('/img/ico_editar.png', ['style' => 'width: 20px; height: auto;', "alt" => __('Editar'), "title" => __('Editar')]), ['action' => 'edit', $siGl->id], ['escape' => false]);
                                                ?>

                                                <?php
                                                echo $this->Form->postLink(
                                                        $this->Html->image('/img/ico_delete.jpg', ['style' => 'width: 20px; height: auto;', "alt" => __('Eliminar'), "title" => __('Eliminar')]), ['action' => 'delete', $siGl->id], ['escape' => false, 'confirm' => __('¿Está seguro?')]
                                                );
                                                ?>

                                                <?=
                                                $this->Html->link($this->Html->image('/img/ico_asociar_temas.png', ['style' => 'width: 20px; height: auto;', "alt" => __('Asociar Temas'), "title" => __('Asociar Temas')]), ['action' => 'index2', $siGl->id], ['escape' => false]);
                                                ?>

                                            </td>    

                                            <td> 
                                                <div class="dropdown small">
                                                    <button class="btn btn-primary dropdown-toggle small" type="button" data-toggle="dropdown">Seguimiento
                                                        <span class="caret"></span></button>
                                                    <ul class="dropdown-menu small">
                                                        <li><?= $this->Html->link('Asistentes', ['action' => 'asistentes', $siGl->id]) ?></li>                                            
                                                        <li><?= $this->Html->link('Asistencia', ['action' => 'asistencia', $siGl->id]) ?></li>                                            
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