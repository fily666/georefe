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
                        <li class="active">Lista Grupos de Liderazgo</li>
                    </ol>

                    <div class="card-content">

                        <h4>Lista Grupos de Liderazgo</h4>                        

                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Estado</th>
                                        <th>Categoria</th>
                                        <th>Direcci&oacute;n</th>
                                        <th>Tel&eacute;fono</th>
                                        <th>D&iacute;a</th>
                                        <th>Hora</th>
                                        <th>L&iacute;der</th>
                                        <th>Pastor</th>
                                        <th class="disabled-sorting text-center">Reporte</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Estado</th>
                                        <th>Categoria</th>
                                        <th>Direcci&oacute;n</th>
                                        <th>Tel&eacute;fono</th>
                                        <th>D&iacute;a</th>
                                        <th>Hora</th>
                                        <th>L&iacute;der</th>
                                        <th>Pastor</th>
                                        <th class="disabled-sorting text-center">Reporte</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    foreach ($siGls as $siGl) {
                                        ?>
                                        <tr>
                                            <td><?= $siGl->id ?></td>
                                            <td><?= $siGl->ma_status->value ?></td>
                                            <td><?= $siGl->categorium->valor ?></td>                                            
                                            <td><?= $siGl->direccion ?></td>
                                            <td><?= ($siGl->telefono != '') ? $siGl->telefono : '' ?></td>
                                            <td><?= ($siGl->dia_reunion != '') ? $siGl->dia_reunion->valor : '' ?></td>
                                            <td><?= ($siGl->hora_reunion != '') ? date_format($siGl->hora_reunion, 'H:m a') : '' ?></td>                                            
                                            <td><?= $siGl->lider->person->nombres . ' ' . $siGl->lider->person->apellidos ?></td>
                                            <td><?= $siGl->si_pastore->person->nombres . ' ' . $siGl->si_pastore->person->apellidos ?></td>


                                            <td class="text-right">                                              
                                                <?= $this->Html->link('Ver', ['action' => 'reporteasistenciagl', $siGl->id], ['id' => 'start-tour', 'class' => 'btn btn-primary mb-lg']) ?>
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