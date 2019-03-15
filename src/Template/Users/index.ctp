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
                        <li class="active">Usuarios</li>
                    </ol>


                    <div class="card-content">


                        <h4>Usuarios</h4>                        
                        <div class="toolbar">
                            <!--BOTON DE AGREGAR-->
                            <?= $this->Html->link('Agregar', ['action' => 'add'], ['id' => 'start-tour', 'class' => 'btn btn-primary mb-lg']) ?>
                            <!--MIGA DE PAN-->                           
                        </div>

                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No. Documento</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Rol</th>
                                        <th>Correo Electr&oacute;nico</th>
                                        <th>Estado</th>
                                        <th class="disabled-sorting text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No. Documento</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Rol</th>
                                        <th>Correo Electr&oacute;nico</th>
                                        <th>Estado</th>
                                        <th class="disabled-sorting text-right">Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>

                                    <?php 
                                    
                                    foreach ($users as $user) { ?>
                                        <tr>
                                            <td><?= $user->person->documento ?></td>
                                            <td><?= $user->person->nombres ?></td>
                                            <td><?= $user->person->apellidos ?></td>
                                            <td><?= $user->ma_group->name ?></td>
                                            <td><?= $user->person->email ?></td>                                            
                                            <td>
                                                <?php
                                                if ($user->status_id == 1) {
                                                    echo '<span class="label label-success">' . $user->ma_status->value . '</span>';
                                                } elseif ($user->status_id == 2) {
                                                    echo '<span class="label label-danger">' . $user->ma_status->value . '</span>';
                                                } elseif ($user->status_id == 3) {
                                                    echo '<span class="label label-danger">' . $user->ma_status->value . '</span>';
                                                } else {
                                                    echo '<span class="label label-inverse">ERROR</span>';
                                                }
                                                ?>
                                            </td>  


                                            <td class="text-right">



                                                <?=
                                                $this->Html->link($this->Html->image('/img/ico_editar.png', ['style' => 'width: 20px; height: auto; margin-left: 10px', "alt" => __('Editar'), "title" => __('Editar')]), ['action' => 'edit', $user->id], ['escape' => false]);
                                                ?>

                                                <?=
                                                $this->Html->link($this->Html->image('/img/ico_mensaje.png', ['style' => 'width: 30px; height: auto; margin-left: 10px', 'alt' => __('Enviar nuevo password'), 'title' => __('Enviar nuevo password')]), ['action' => 'sendmailpassword', $user->id], ['escape' => false]);
                                                ?>

                                                <?php
                                                echo $this->Form->postLink(
                                                        $this->Html->image('/img/ico_delete.jpg', ['style' => 'width: 20px; height: auto; margin-left: 10px', "alt" => __('Eliminar'), "title" => __('Eliminar')]), ['action' => 'delete', $user->id], ['escape' => false, 'confirm' => __('¿Está seguro?')]
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