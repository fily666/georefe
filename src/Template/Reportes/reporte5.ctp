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
                        <li class="active">Personas nuevas sin seguimiento</li>
                    </ol>

                    <div class="card-content">

                        <h4>Personas nuevas sin seguimiento</h4> 
                        <span style="color:#424242">Reporte que lista las personas que completaron 1 semana sin registro de llamada realizada, con respecto a la fecha de entrega</span>

                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>N&uacute;mero de Identificaci&oacute;n</th>
                                        <th>Nombre</th>
                                        <th>Fecha Entrega</th>
                                        <th>Lider GT Encargado</th>
                                        <th>Lider Consolidacion</th>
                                        <th>Pastor</th>
                                        <th>Estado Llamada</th>
                                        <th class="disabled-sorting text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>N&uacute;mero de Identificaci&oacute;n</th>
                                        <th>Nombre</th>
                                        <th>Fecha Entrega</th>
                                        <th>Lider GT Encargado</th>
                                        <th>Lider Consolidacion</th>
                                        <th>Pastor</th>
                                        <th>Estado Llamada</th>
                                        <th class="disabled-sorting text-right">Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($siverientregas as $siverientrega) { ?>
                                        <tr>
                                            <td><?= ($siverientrega->persona->documento != '') ? ($siverientrega->persona->documento) : '' ?></td>
                                            <td><?= ($siverientrega->persona->nombres . ' ' . ' ' . $siverientrega->persona->apellidos) ?></td>                                            
                                            <td><?= ($siverientrega->fecha_entrega != '') ? date_format($siverientrega->fecha_entrega, 'Y-m-d') : '' ?></td>
                                            <td><?= ($siverientrega->lider_llamada != '') ? ($siverientrega->lider_llamada->person->nombres . ' ' . ' ' . $siverientrega->lider_llamada->person->apellidos) : '' ?></td>
                                            <td><?= ($siverientrega->lider_consolida != '') ? ($siverientrega->lider_consolida->person->nombres . ' ' . ' ' . $siverientrega->lider_consolida->person->apellidos) : '' ?></td>
                                            <td><?= ($siverientrega->pastor->person->nombres . ' ' . ' ' . $siverientrega->pastor->person->apellidos) ?></td>
                                            <td>
                                                <?php
                                                if ($siverientrega->estado_llamada->id == 251) {
                                                    echo '<span class="label label-danger">' . $siverientrega->estado_llamada->valor . '</span>';
                                                } elseif ($siverientrega->estado_llamada->id == 252) {
                                                    echo '<span class="label label-danger">' . $siverientrega->estado_llamada->valor . '</span>';
                                                } else {
                                                    echo '<span class="label label-inverse">ERROR</span>';
                                                }
                                                ?>
                                            </td>  
                                            <td class="text-right">
                                                <?=
                                                $this->Html->link($this->Html->image('/img/ico_editar.png', ['style' => 'width: 20px; height: auto; margin-left: 10px', "alt" => __('Editar'), "title" => __('Editar')]), ['action' => 'editconsolida', $siverientrega->id], ['escape' => false]);
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