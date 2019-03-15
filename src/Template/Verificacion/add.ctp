<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-text" data-background-color="rose">
                        <h4 class="card-title">Agregar Verificaci&oacute;n</h4>    
                    </div>

                    <ol class="breadcrumb pull-right">
                        <li><?= $this->Html->link('Inicio', ['controller' => 'Home', 'action' => 'index']) ?>
                        </li>
                        <li><?= $this->Html->link('Verificación', ['action' => 'index']) ?> 
                        </li>
                        <li class="active">Agregar Verificaci&oacute;n</li>
                    </ol>

                    <div class="card-content">                            

                        <!--INICIO DEL PANEL PARA EL FORMULARIO-->
                        <div class="panel panel-default">
                            <div class="panel-body" style="height: auto">
                                <?= $this->Form->create($verificacion, ['role' => 'form', 'class' => 'form-horizontal', 'id' => 'formAddVerificacion']) ?>

                                <div class="form-horizontal">

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Buscar persona entrega</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('id_datos_basicos', $lista1, ['id' => 'select1', 'class' => 'form-control', 'empty' => ':: Seleccione ::',
                                                'label' => false, 'style' => 'width: 100%']) ?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Lider de GT</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('id_lider_GT', $lista2, ['id' => 'select2', 'class' => 'form-control', 'empty' => ':: Seleccione ::'
                                                , 'label' => false, 'style' => 'width: 100%']) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Lider de Acompa&ntilde;amiento</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('id_lider_asignado', $lista3, ['id' => 'select3', 'class' => 'form-control', 'empty' => ':: Seleccione ::'
                                                , 'label' => false, 'style' => 'width: 100%']) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Pastor</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('id_pastor', $lista4, ['id' => 'select4', 'class' => 'form-control', 'empty' => ':: Seleccione ::'
                                                , 'label' => false, 'style' => 'width: 100%']) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Lider de Consolidac&oacute;n</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('id_lider_consolida', $lista5, ['id' => 'select5', 'class' => 'form-control', 'empty' => ':: Seleccione ::'
                                                , 'label' => false, 'style' => 'width: 100%']) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Quien lo invito</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('id_datos_basicos_invito', $lista6, ['id' => 'select6', 'class' => 'form-control', 'empty' => ':: Seleccione ::'
                                                , 'label' => false, 'style' => 'width: 100%']) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Fecha entrega</label>
                                        <div class="col-lg-9">
                                            <?=
                                            $this->Form->input('fecha_entrega', [
                                                'class' => 'form-control form_date',
                                                'data-date-format' => 'yyyy-mm-dd',
                                                'type' => 'text',
                                                'id' => 'fecha_nacimiento',
                                                'label' => false
                                            ])
                                            ?>   
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Tipo de entrega</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('id_tipo_entrega', $lista7, ['class' => 'form-control', 'empty' => ':: Seleccione ::', 'label' => false]) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Fecha y hora tentativa para Llamada</label>
                                        <div class="col-lg-9">
                                            <?=
                                            $this->Form->input('fecha_hora_llamada', [
                                                'class' => 'form-control form_datetime',
                                                'data-date-format' => 'yyyy-mm-dd h:i',
                                                'type' => 'text',
                                                'id' => 'fecha_nacimiento',
                                                'label' => false
                                            ])
                                            ?>   
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Fase de entrega</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('id_fase', $lista8, ['class' => 'form-control', 'empty' => ':: Seleccione ::', 'label' => false]) ?>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Si tiene una Petici&oacute;n</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->input('peticion', ['type' => 'textarea', 'class' => 'form-control', 'label' => false, 'rows' => '10', 'cols' => '20', 'maxlength' => '500']) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Si tiene una Observaci&oacute;n</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->input('observaciones', ['type' => 'textarea', 'class' => 'form-control', 'label' => false, 'rows' => '10', 'cols' => '20', 'maxlength' => '500']) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Comentarios del resultado de la Visita</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->input('resultado_visita', ['type' => 'textarea', 'class' => 'form-control', 'label' => false, 'rows' => '10', 'cols' => '20', 'maxlength' => '500']) ?>
                                        </div>
                                    </div>


                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-primary']); ?>
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

    $("#select2").select2({
        allowClear: true
    });

    $("#select3").select2({
        allowClear: true
    });

    $("#select4").select2({
        allowClear: true
    });

    $("#select5").select2({
        allowClear: true
    });

    $("#select6").select2({
        allowClear: true
    });

    $(document).ready(function () {
        $("#formAddVerificacion").validate({
            rules: {
                id_lider_gt: {
                    required: true,
                    minlength: 1,
                    maxlength: 20
                },
                id_lider_asignado: {
                    required: true,
                    minlength: 1,
                    maxlength: 20
                },
                id_lider_GT: {
                    required: true,
                    minlength: 1,
                    maxlength: 20
                },
                id_guia: {
                    required: true,
                    minlength: 1,
                    maxlength: 20
                },
                id_datos_basicos: {
                    required: true,
                    minlength: 1,
                    maxlength: 20
                },
                id_pastor: {
                    required: true,
                    minlength: 1,
                    maxlength: 20
                }
            },
            messages: {
                id_lider_gt: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 20 caracteres"
                },
                id_lider_asignado: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 20 caracteres"
                },
                id_lider_GT: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 20 caracteres"
                },
                id_guia: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 20 caracteres"
                },
                id_datos_basicos: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 20 caracteres"
                },
                id_pastor: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 20 caracteres"
                }


            },
            submitHandler: function (form) {
                form.submit();
            },
            debug: true
        });
    });
</script>


