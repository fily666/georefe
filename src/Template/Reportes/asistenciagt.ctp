<style>
    .checkAsistencia {
        width:20px;
        height:20px;        
    }

</style>

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
                        <li><?= $this->Html->link('Reporte Lider Acompañamiento', ['action' => 'reporte7']) ?></li>
                        <li class="active">Asistencia a Grupos de Transformaci&oacute;n</li>
                    </ol>

                    <div class="card-content">

                        <h4>Asistencia a Grupos de Transformaci&oacute;n, <b> <?= $gt->id ?></b></h4>                        


                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Asistente</th>
                                        <th>Documento</th>
                                        <?php
                                        $count = 1;
                                        foreach ($temas as $tema) {
                                            ?>
                                            <th class="disabled-sorting" title="<?= $tema->si_tema->tema ?>"><?= $count ?></th>
                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Asistente</th>
                                        <th>Documento</th>
                                        <?php
                                        $count2 = 1;
                                        foreach ($temas as $tema) {
                                            ?>
                                            <th class="disabled-sorting" title="<?= $tema->si_tema->tema ?>"><?= $count2 ?></th>
                                            <?php
                                            $count2++;
                                        }
                                        ?>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($siGtAsistentes as $siGtAsistente) { ?>
                                        <tr>
                                            <td><?= $siGtAsistente->persona->nombres . ' ' . $siGtAsistente->persona->apellidos ?></td>
                                            <td><?= $siGtAsistente->persona->documento ?></td>
                                            <?php
                                            foreach ($siGtAsistencias as $siGtAsistencia) {
                                                if ($siGtAsistente->id == $siGtAsistencia->id_gt_asistente) {
                                                    ?>
                                                    <td> 
                                                        <input id="<?= $siGtAsistencia->id ?>" type="checkbox" disabled <?= ($siGtAsistencia->asistio) ? "checked" : "" ?> class="checkAsistencia" name="<?= $siGtAsistencia->id ?>">
                                                    </td>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tr>        
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--end content-->
                </div>
                <!--end card -->
            </div>
            <!--end col-md-12 -->
        </div>
        <!--end row -->
    </div>
</div>