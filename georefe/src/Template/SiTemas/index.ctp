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
                        <li class="active">Temas</li>
                    </ol>

                    <div class="card-content">

                        <h4>Temas</h4>                        

                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Tipo de Tema</th>                                       
                                        <th>Estado</th>
                                        <th class="disabled-sorting text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Temas</th>                                       
                                        <th>Estado</th>
                                        <th class="disabled-sorting text-right">Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php  foreach ($temas as $tema) { ?>
                                        <tr>
                                            <td><?= $tema->id ?></td>
                                            <td><?= $tema->valor ?></td>                                           

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
                                                $this->Html->link($this->Html->image('/img/ico_editar.png', ['style' => 'width: 20px; height: auto; margin-left: 10px', "alt" => __('Editar'), "title" => __('Listar por Tipo')]), ['action' => 'index2', $tema->id], ['escape' => false]);
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