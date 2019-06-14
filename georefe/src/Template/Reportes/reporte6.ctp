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
                        <li class="active">Grupos de Transformaci&oacute;n por Barrio</li>
                    </ol>

                    <div class="card-content">

                        <h4>Grupos de Transformaci&oacute;n por Barrio</h4>                        

                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Direcci&oacute;n</th>
                                        <th>Localidad</th>
                                        <th>Barrio</th>
                                        <th>Tel&eacute;fono</th>
                                        <th>D&iacute;a</th>
                                        <th>Hora</th>
                                        <th>L&iacute;der</th>
                                        <th>Pastor</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Direcci&oacute;n</th>
                                        <th>Localidad</th>
                                        <th>Barrio</th>
                                        <th>Tel&eacute;fono</th>
                                        <th>D&iacute;a</th>
                                        <th>Hora</th>
                                        <th>L&iacute;der</th>
                                        <th>Pastor</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    foreach ($siGts as $siGt) {
                                        ?>
                                        <tr>
                                            <td><?= $siGt->id ?></td>
                                            <td><?= $siGt->direccion ?></td>
                                            <td><?= ($siGt->localidad != '') ? $siGt->localidad->valor : '' ?></td>
                                            <td><?= ($siGt->barrio != '') ? $siGt->barrio->valor : '' ?></td>
                                            <td><?= ($siGt->telefono != '') ? $siGt->telefono : '' ?></td>
                                            <td><?= ($siGt->dia_reunion != '') ? $siGt->dia_reunion->valor : '' ?></td>
                                            <td><?= ($siGt->hora_reunion != '') ? date_format($siGt->hora_reunion, 'H:m a') : '' ?></td>                                            
                                            <td><?= $siGt->lider1->person->nombres . ' ' . $siGt->lider1->person->apellidos ?></td>
                                            <td><?= $siGt->si_pastore->person->nombres . ' ' . $siGt->si_pastore->person->apellidos ?></td>
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