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
                        <li class="active">Roles</li>
                    </ol>


                    <div class="card-content">


                        <h4>Roles</h4>                        
                        <div class="toolbar">
                            <!--BOTON DE AGREGAR-->
                            <?= $this->Html->link('Agregar', ['action' => 'add'], ['id' => 'start-tour', 'class' => 'btn btn-primary mb-lg']) ?>
                            <!--MIGA DE PAN-->                           
                        </div>

                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Creado</th>
                                        <th>Modificado</th>
                                        <th>Estado</th>
                                        <th class="disabled-sorting text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Creado</th>
                                        <th>Modificado</th>
                                        <th>Estado</th>
                                        <th class="disabled-sorting text-right">Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($maGroups as $group) { ?>
                                        <tr>                                           
                                            <td><?= $group->name ?></td>
                                            <td><?= $group->created->format('Y-m-d') ?></td>
                                            <td><?= $group->modified->format('Y-m-d') ?></td>
                                            <td>
                                                <?php
                                                                                                
                                                if ($group->status_id == 1) {
                                                    echo '<span class="label label-success">' . $group->ma_status->value . '</span>';
                                                } elseif ($group->status_id == 2) {
                                                    echo '<span class="label label-danger">' . $group->ma_status->value . '</span>';
                                                } elseif ($group->status_id == 3) {
                                                    echo '<span class="label label-danger">' . $group->ma_status->value . '</span>';
                                                } else {
                                                    echo '<span class="label label-inverse">ERROR</span>';
                                                }
                                                ?>
                                            </td>


                                            <td class="text-right">
                                                <?=
                                                $this->Html->link($this->Html->image('/img/ico_editar.png', ['style' => 'width: 20px; height: auto; margin-left: 20px', "alt" => __('Editar'), "title" => __('Editar')]), ['action' => 'edit', $group->id], ['escape' => false]);
                                                ?>

                                                <?php
                                                if ($group->id == 1 || $group->id == 11 || $group->id == 12) {
                                                    echo $this->Html->image('/img/ico_delete.jpg', ['style' => 'width: 20px; height: auto; opacity: 0.5; margin-left: 20px', "alt" => __('Eliminar'), "title" => __('Eliminar')]);
                                                } else {
                                                    echo $this->Form->postLink(
                                                            $this->Html->image('/img/ico_delete.jpg', ['style' => 'width: 20px; height: auto; margin-left: 20px', "alt" => __('Eliminar'), "title" => __('Eliminar')]), ['action' => 'delete', $group->id], ['escape' => false, 'confirm' => __('¿Está seguro?')]
                                                    );
                                                }
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


