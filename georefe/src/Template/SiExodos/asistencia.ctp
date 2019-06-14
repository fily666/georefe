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
                        <li><?= $this->Html->link('Éxodo', ['action' => 'index']) ?></li>
                        <li class="active">Asistencia a &Eacute;xodo</li>
                    </ol>

                    <div class="card-content">

                        <h4>Asistencia a &Eacute;xodo, <b> <?= $exodo->descripcion ?></b></h4>                        


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
                                            <th title="<?= $tema->si_tema->tema ?>"><?= $count ?></th>
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
                                            <th title="<?= $tema->si_tema->tema ?>"><?= $count2 ?></th>
                                            <?php
                                            $count2++;
                                        }
                                        ?>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php foreach ($siExodoAsistentes as $siExodoAsistente) { ?>
                                        <tr>
                                            <td><?= $siExodoAsistente->persona->nombres . ' ' . $siExodoAsistente->persona->apellidos ?></td>

                                            <td>                                              
                                                <a href="#datodBasicosModal" data-toggle="modal" data-id="<?= $siExodoAsistente->persona->id ?>" class="btn-block"><?= $siExodoAsistente->persona->documento ?></a>
                                            </td>

                                            <?php
                                            
                                            //pr($siExodoAsistencias->toArray());
                                            
                                            foreach ($siExodoAsistencias as $siExodoAsistencia) {
                                                if ($siExodoAsistente->id == $siExodoAsistencia->id_exodo_asistente) {
                                                    ?>
                                                    <td> 
                                                        <input id="<?= $siExodoAsistencia->id ?>" type="checkbox" <?= ($siExodoAsistencia->asistio) ? "checked" : "" ?> class="checkAsistencia" onchange="asistencia(<?= $siExodoAsistencia->id ?>)" name="<?= $siExodoAsistencia->id ?>">                                                                                                    
                                                    </td>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tr>        
                                    <?php } ?>
                                </tbody>
                            </table>

                            <hr/>

                            <b>TEMARIO:</b><br/><br/>
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0">
                                <?php
                                $count3 = 1;
                                foreach ($temas as $tema) {
                                    ?>
                                    <tr>
                                        <td>Tema <?= $count3 ?></td>
                                        <td><?= ($tema->fecha != '' ? date_format($tema->fecha, 'Y-m-d') : 'Sin fecha programada' ) ?></td>
                                        <td><?= $tema->si_tema->tema ?></td>                          
                                        <?php
                                        $count3++;
                                    }
                                    ?>
                                </tr>
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


<!-- Modal Información basica por persona-->
<div class="modal fade" id="datodBasicosModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Datos B&aacute;sicos</h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div> 
</div>


<script>

    function asistencia(id) {
        var asistiojs = (document.getElementById(id).checked) ? 1 : 0;
        $.ajax({
            type: 'POST',
            url: '<?= $this->Url->build(array('action' => 'addasistencia')) ?>',
            data: {id: id, asistio: asistiojs}
        });
    }


    $('.btn-block').on('click', function () {
        var id = $(this).data('id');
        $('.modal-body').html('Cargando...');
        $.ajax({
            type: 'POST',
            url: '<?= $this->Url->build(array('action' => 'datosbasicos')) ?>',
            data: {id: id},
            success: function (data) {
                $('.modal-body').html(data);
            },
            error: function (err) {
                alert("error" + JSON.stringify(err));
            }
        });
    });
</script>