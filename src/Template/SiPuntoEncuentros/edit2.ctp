<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-text" data-background-color="rose">
                        <h4 class="card-title">Editar Asociación Tema</h4>    
                    </div>

                    <ol class="breadcrumb pull-right">
                        <li><?= $this->Html->link('Inicio', ['controller' => 'Home', 'action' => 'index']) ?></li>
                        <li><?= $this->Html->link('Puntos de Encuentro', ['action' => 'index']) ?></li>
                        <li><?= $this->Html->link('Asociación de Tema', ['action' => 'index2', $puntoEncuentro->id]) ?></li>
                        <li class="active">Editar Asociación Tema</li>
                    </ol>

                    <div class="card-content">                        

                        <!--INICIO DEL PANEL PARA EL FORMULARIO-->
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <?= $this->Form->create($siPuntosEncuentroTema, ['role' => 'form', 'class' => 'form-horizontal', 'id' => 'formEdit']) ?>

                                <div class="form-horizontal">                                    
                                    
                                    <div class="form-group">
                                    <label class="col-lg-2 control-label">Tema</label>
                                    <div class="col-lg-9">
                                        <?= $this->Form->select('id_tema', $lista1, ['class' => 'form-control', 'disabled' => true, 'label' => false]) ?>
                                    </div>
                                </div>  

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Fecha entrega</label>
                                        <div class="col-lg-9">
                                            <?=
                                            $this->Form->input('fecha', [
                                                'class' => 'form-control form_date',
                                                'data-date-format' => 'yyyy-mm-dd',
                                                'type' => 'text',
                                                'value' => ($siPuntosEncuentroTema != '' && $siPuntosEncuentroTema->fecha != '') ? date_format($siPuntosEncuentroTema->fecha, 'Y-m-d') : '',
                                                'id' => 'fecha',
                                                'label' => false,
                                                'required' => true
                                            ])
                                            ?>   
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Coordinador Tema</label>
                                        <div class="col-lg-9">
                                            <?=
                                            $this->Form->select('id_lider', $lista2, ['id' => 'select1', 'class' => 'form-control', 'empty' => ':: Seleccione ::'
                                                , 'label' => false, 'style' => 'width: 100%'])
                                            ?>
                                        </div>
                                    </div>


                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <?= $this->Html->link('Cancelar', ['action' => 'index2', $puntoEncuentro->id], ['class' => 'btn btn-primary']); ?>
                                        <?= $this->Form->button(__('Guardar'), ['class' => 'btn btn-success']); ?>
                                    </div>
                                </div>
                                <?= $this->Form->end() ?>
                            </div>
                        </div>
                        <!--FIN DEL PANEL PARA EL FORMULARIO-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $("#select1").select2({
        allowClear: true
    });

</script>


