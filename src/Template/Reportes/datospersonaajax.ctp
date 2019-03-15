
<!--MODULO DE DATOS DE LA PERSONA-->
<div class="row">

    <?= $this->Html->link(__('Exportar Informe'), ['action' => 'reportedatospersonapdf', $id_persona, '_ext' => 'pdf'], ['class' => 'btn btn-primary']); ?><br/><br/>

    <div class="col-md-12">
        <h4><b>1. Datos b&aacute;sicos de la persona</b></h4>
    </div>

    <div class="col-md-8">


        <div class="col-md-4" style="text-align: left">

            <?= $this->Html->image('/attachments/users/' . $persona->fotografia, ['alt' => 'Avatar', 'style' => 'width: 200px; height: auto']); ?>

        </div>



        <div class="col-md-8">
            <table cellspacing="0" border="0" style="width: 100%">

                <tr>
                    <td style="width: 20%"><b>Nombre:</b></td>
                    <td style="width: 80%"><?= $persona->nombres . ' ' . $persona->apellidos ?></td>
                </tr>
                <tr>
                    <td><b>Tipo Documento:</b></td>
                    <td><?= $persona->ma_propiedade->valor ?></td>
                </tr>
                <tr>
                    <td><b>Documento:</b></td>
                    <td><?= $persona->documento ?></td>
                </tr>
                <tr>
                    <td><b>Teléfono:</b></td>
                    <td><?= $persona->telefono1 ?></td>
                </tr>
                <tr>
                    <td><b>Celular:</b></td>
                    <td><?= $persona->celular ?></td>
                </tr>  

                <tr>
                    <td><b>Email:</b></td>
                    <td><?= $persona->email ?></td>
                </tr>
                <tr>
                    <td><b>Dirección:</b></td>
                    <td><?= $persona->direccion ?></td>
                </tr>
            </table>

        </div>
    </div>


    <div class="col-md-12">
        <h4><b>2. Verificaci&oacute;n</b></h4>

        <?php if (count($verificaciones->toArray()) > 0) { ?>
            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Lider Acompa&ntilde;amiento</th>
                        <th>Gu&iacute;a</th>
                        <th>Pastor</th>
                        <th>Estado Llamada</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($verificaciones as $siverientrega) { ?>
                        <tr>    
                            <td><?= date_format($siverientrega->fecha_entrega, 'Y-m-d') ?></td>
                            <td><?= ($siverientrega->lider_asignado->person->nombres . ' ' . ' ' . $siverientrega->lider_asignado->person->apellidos) ?></td>
                            <td><?= ($siverientrega->guium->nombres . ' ' . ' ' . $siverientrega->guium->apellidos) ?></td>
                            <td><?= ($siverientrega->pastor->person->nombres . ' ' . ' ' . $siverientrega->pastor->person->apellidos) ?></td>
                            <td>
                                <?php
                                if ($siverientrega->estado_llamada->id == 249) {
                                    echo '<span class="label label-success">' . $siverientrega->estado_llamada->valor . '</span>';
                                } elseif ($siverientrega->estado_llamada->id == 250) {
                                    echo '<span class="label label-warning">' . $siverientrega->estado_llamada->valor . '</span>';
                                } elseif ($siverientrega->estado_llamada->id == 251) {
                                    echo '<span class="label label-danger">' . $siverientrega->estado_llamada->valor . '</span>';
                                } elseif ($siverientrega->estado_llamada->id == 252) {
                                    echo '<span class="label label-danger">' . $siverientrega->estado_llamada->valor . '</span>';
                                } else {
                                    echo '<span class="label label-inverse">ERROR</span>';
                                }
                                ?>
                            </td>                         
                        </tr>
                    <?php } ?>
                </tbody>
            </table>       

            <?php
        } else {
            echo '<p>La persona no reporta datos de verificación.</p>';
        }
        ?>

    </div>



    <div class="col-md-12">
        <h4><b>3. Punto de Encuentro</b></h4>

        <?php if (count($siPuntoEncuentros->toArray()) > 0) { ?>
            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Descripción</th>
                        <th>Coordinador Éxodo</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Tipo</th>                       
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($siPuntoEncuentros as $siPuntoEncuentro) { ?>
                        <tr>    
                            <td><?= ($siPuntoEncuentro->si_punto_encuentro->id) ?></td>
                            <td><?= ($siPuntoEncuentro->si_punto_encuentro->descripcion) ?></td>
                            <td><?= ($siPuntoEncuentro->si_punto_encuentro->coordinador->person->nombres . ' ' . ' ' . $siPuntoEncuentro->si_punto_encuentro->coordinador->person->apellidos) ?></td>
                            <td><?= date_format($siPuntoEncuentro->si_punto_encuentro->fecha_inicio, 'Y-m-d') ?></td>
                            <td><?= date_format($siPuntoEncuentro->si_punto_encuentro->fecha_fin, 'Y-m-d') ?></td>
                            <td><?= ($siPuntoEncuentro->si_punto_encuentro->ma_propiedade->valor) ?></td>                                         
                        </tr>
                    <?php } ?>
                </tbody>
            </table>       

            <?php
        } else {
            echo '<p>La persona no reporta datos de punto de encuentro.</p>';
        }
        ?>


    </div>


    <div class="col-md-12">
        <h4><b>4. &Eacute;xodo</b></h4>

        <?php if (count($siExodoAsistentes->toArray()) > 0) { ?>
            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Descripción</th>
                        <th>Coordinador Éxodo</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Tipo</th>                       
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($siExodoAsistentes as $siExodoAsistente) { ?>
                        <tr>    
                            <td><?= ($siExodoAsistente->si_exodo->id) ?></td>
                            <td><?= ($siExodoAsistente->si_exodo->descripcion) ?></td>
                            <td><?= ($siExodoAsistente->si_exodo->coordinador->person->nombres . ' ' . ' ' . $siExodoAsistente->si_exodo->coordinador->person->apellidos) ?></td>
                            <td><?= date_format($siExodoAsistente->si_exodo->fecha_inicio, 'Y-m-d') ?></td>
                            <td><?= date_format($siExodoAsistente->si_exodo->fecha_fin, 'Y-m-d') ?></td>
                            <td><?= ($siExodoAsistente->si_exodo->ma_propiedade->valor) ?></td>                                         
                        </tr>
                    <?php } ?>
                </tbody>
            </table>       

            <?php
        } else {
            echo '<p>La persona no reporta datos de éxodo.</p>';
        }
        ?>


    </div>


    <div class="col-md-12">
        <h4><b>5. Jornada</b></h4>

        <?php if (count($siJornadaAsistentes->toArray()) > 0) { ?>
            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Descripción</th>
                        <th>Coordinador Éxodo</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Tipo</th>                       
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($siJornadaAsistentes as $siJornadaAsistente) { ?>
                        <tr>    
                            <td><?= ($siJornadaAsistente->si_jornada->id) ?></td>
                            <td><?= ($siJornadaAsistente->si_jornada->descripcion) ?></td>
                            <td><?= ($siJornadaAsistente->si_jornada->coordinador->person->nombres . ' ' . ' ' . $siJornadaAsistente->si_jornada->coordinador->person->apellidos) ?></td>
                            <td><?= date_format($siJornadaAsistente->si_jornada->fecha_inicio, 'Y-m-d') ?></td>
                            <td><?= date_format($siJornadaAsistente->si_jornada->fecha_fin, 'Y-m-d') ?></td>
                            <td><?= ($siJornadaAsistente->si_jornada->ma_propiedade->valor) ?></td>                                         
                        </tr>
                    <?php } ?>
                </tbody>
            </table>       

            <?php
        } else {
            echo '<p>La persona no reporta datos de jornada.</p>';
        }
        ?>


    </div>


    <div class="col-md-12">
        <h4><b>6. Grupo de Transformaci&oacute;n</b></h4>


        <?php if (count($siGts->toArray()) > 0) { ?>
            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Estado</th>
                        <th>Categoría</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Día</th>
                        <th>Hora</th>
                        <th>Pastor</th>
                        <th>Fecha Inicial</th>                    
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($siGts as $siGt) { ?>
                        <tr>    
                            <td><?= ($siGt->si_gt->id) ?></td>
                            <td><?= ($siGt->si_gt->ma_status->value) ?></td>
                            <td><?= ($siGt->si_gt->categorium->valor) ?></td>
                            <td><?= ($siGt->si_gt->direccion) ?></td>
                            <td><?= ($siGt->si_gt->telefono) ?></td>
                            <td><?= ($siGt->si_gt->dia_reunion->valor) ?></td>
                            <td><?= date_format($siGt->si_gt->hora_reunion, 'H:m a') ?></td>
                            <td><?= ($siGt->si_gt->si_pastore->person->nombres . ' ' . ' ' . $siGt->si_gt->si_pastore->person->apellidos) ?></td>
                            <td><?= date_format($siGt->si_gt->fecha_inicia, 'Y-m-d') ?></td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>       

            <?php
        } else {
            echo '<p>La persona no reporta datos de grupo de transformación.</p>';
        }
        ?>

        <?php if (count($siGts->toArray()) > 0) { ?>
            <b>Asistencia</b>

            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                    <tr>
                        <th>Tema</th>
                        <th>Fecha</th>                    
                        <th>Asistencia</th>                    
                    </tr>
                </thead>            
                <tbody>
                    <?php
                    $vistos = 0;
                    $faltan = 0;
                    foreach ($siGtAsistencias as $siGtAsistencia) {
                        ?>
                        <tr>
                            <td><?= $siGtAsistencia->si_gt_tema->si_tema->tema ?></td>
                            <td><?= date_format($siGtAsistencia->si_gt_tema->fecha, 'Y-m-d') ?></td>
                            <td> 
                                <?php
                                if ($siGtAsistencia->asistio) {
                                    echo $this->Html->image('/img/checked.png', ['style' => 'width: 20px; height: auto;', "alt" => __('aisitió'), "title" => __('Asistió')]);
                                    $vistos++;
                                } else {
                                    echo $this->Html->image('/img/cancel.png', ['style' => 'width: 20px; height: auto;', "alt" => __('no asistió'), "title" => __('No Asistió')]);
                                    $faltan++;
                                }
                                ?>                                                                                                   
                            </td>
                        </tr>        
                    <?php } ?>
                </tbody>
            </table>
            <?php
            echo '<br/><b>Vistos:</b> ' . $vistos;
            echo '<br/><b>Faltan:</b> ' . $faltan;
            echo '<br/><b>Porcentaje:</b> : ' . (($vistos / ($vistos + $faltan)) * 100) . " %";
        }
        ?>

    </div>



</div>