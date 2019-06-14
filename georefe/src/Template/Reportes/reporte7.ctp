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

                        <h4>Grupos de Transformaci&oacute;n asociados al Lider de Acompa&ntilde;amiento</h4>                        

                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>                                        
                                        <th>Estado</th>
                                        <th>Direcci&oacute;n</th>
                                        <th>Tel&eacute;fono</th>
                                        <th>D&iacute;a</th>
                                        <th>Hora</th>
                                        <th>L&iacute;der GT</th>
                                        <th>L&iacute;der Acompa&ntilde;amiento</th>
                                        <th>Pastor</th>
                                        <th>Seguimiento</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>                                        
                                        <th>Estado</th>
                                        <th>Direcci&oacute;n</th>
                                        <th>Tel&eacute;fono</th>
                                        <th>D&iacute;a</th>
                                        <th>Hora</th>
                                        <th>L&iacute;der</th>
                                        <th>L&iacute;der Acompa&ntilde;amiento</th>
                                        <th>Pastor</th>
                                        <th>Seguimiento</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    foreach ($siGts as $siGt) {
                                        ?>
                                        <tr>
                                            <td><?= $siGt->ma_status->value ?></td>                                           
                                            <td><?= $siGt->direccion ?></td>
                                            <td><?= ($siGt->telefono != '') ? $siGt->telefono : '' ?></td>
                                            <td><?= ($siGt->dia_reunion != '') ? $siGt->dia_reunion->valor : '' ?></td>
                                            <td><?= ($siGt->hora_reunion != '') ? date_format($siGt->hora_reunion, 'H:m a') : '' ?></td>                                            
                                            <td><?= ($siGt->lider1 != '') ? ($siGt->lider1->person->nombres . ' ' . $siGt->lider1->person->apellidos) : '' ?></td>
                                            <td><?= ($siGt->lider2 != '') ? ($siGt->lider2->person->nombres . ' ' . $siGt->lider2->person->apellidos) : '' ?></td>
                                            <td><?= $siGt->si_pastore->person->nombres . ' ' . $siGt->si_pastore->person->apellidos ?></td>
                                            <td class="text-right">                                              
                                                <?= $this->Html->link('Asistencia', ['action' => 'asistenciagt', $siGt->id], ['id' => 'start-tour', 'class' => 'btn btn-primary mb-lg']) ?>
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