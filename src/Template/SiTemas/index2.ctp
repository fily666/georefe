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
                        <li><?= $this->Html->link('Temas', ['action' => 'index']) ?></li>
                        <li class="active">Temas de <?= $tipoTema->valor ?></li>
                    </ol>

                    <div class="card-content">

                        <h4>Temas de <?= $tipoTema->valor ?></h4>                        
                        <div class="toolbar">
                            <!--BOTON DE AGREGAR-->
                            <?= $this->Html->link('Agregar', ['action' => 'add', $tipoTema->id], ['id' => 'start-tour', 'class' => 'btn btn-primary mb-lg']) ?>
                            <!--MIGA DE PAN-->                           
                        </div>

                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>                                      
                                        <th>Tema</th>
                                        <th>Estado</th>
                                        <th class="disabled-sorting text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Tema</th>
                                        <th>Estado</th>
                                        <th class="disabled-sorting text-right">Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($temas as $tema) { ?>
                                        <tr>
                                            <td><?= $tema->tema ?></td>                                          

                                            <td>
                                                <?php
                                                if ($tema->status_id == 1) {
                                                    echo '<span class="label label-success">' . $tema->ma_status->value . '</span>';
                                                } elseif ($tema->status_id == 2) {
                                                    echo '<span class="label label-danger">' . $tema->ma_status->value . '</span>';
                                                } elseif ($tema->status_id == 3) {
                                                    echo '<span class="label label-danger">' . $tema->ma_status->value . '</span>';
                                                } else {
                                                    echo '<span class="label label-inverse">ERROR</span>';
                                                }
                                                ?>
                                            </td>  

                                            <td class="text-right">

                                                <?=
                                                $this->Html->link($this->Html->image('/img/ico_editar.png', ['style' => 'width: 20px; height: auto; margin-left: 10px', "alt" => __('Editar'), "title" => __('Editar')]), ['action' => 'edit', $tema->id, $tipoTema->id], ['escape' => false]);
                                                ?>

                                                <?php
                                                echo $this->Form->postLink(
                                                        $this->Html->image('/img/ico_delete.jpg', ['style' => 'width: 20px; height: auto; margin-left: 10px', "alt" => __('Eliminar'), "title" => __('Eliminar')]), ['action' => 'delete', $tema->id, $tipoTema->id], ['escape' => false, 'confirm' => __('¿Está seguro?')]
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