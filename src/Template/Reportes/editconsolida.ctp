<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-text" data-background-color="rose">
                        <h4 class="card-title">Editar datos Consolidaci&oacute;n</h4>    
                    </div>

                    <ol class="breadcrumb pull-right">
                        <li><?= $this->Html->link('Inicio', ['controller' => 'Home', 'action' => 'index']) ?>
                        </li>
                        <li><?= $this->Html->link('Reporte Consolidacion', ['action' => 'reporte5']) ?> 
                        </li>
                        <li class="active">Editar datos Consolidaci&oacute;n</li>
                    </ol>

                    <div class="card-content">                        

                        <!--INICIO DEL PANEL PARA EL FORMULARIO-->
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <?= $this->Form->create($verificacion, ['role' => 'form', 'class' => 'form-horizontal', 'id' => 'formAddVerificacion']) ?>

                                <div class="form-horizontal">

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Persona entrega</label>
                                        <div class="col-lg-9">
                                            <span style="color:#424242"><?= $persona->nombres . ' ' . $persona->apellidos ?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Lider de GT</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('id_lider_GT', $lista1, ['id' => 'select1', 'class' => 'form-control', 'empty' => ':: Seleccione ::'
                                                , 'label' => false, 'style' => 'width: 100%']) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Lider de Consolidac&oacute;n</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('id_lider_consolida', $lista2, ['id' => 'select2', 'class' => 'form-control', 'empty' => ':: Seleccione ::'
                                                , 'label' => false, 'style' => 'width: 100%']) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Pastor</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('id_pastor', $lista3, ['id' => 'select3', 'class' => 'form-control', 'empty' => ':: Seleccione ::'
                                                , 'label' => false, 'style' => 'width: 100%']) ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <?= $this->Html->link('Cancelar', ['action' => 'reporte5'], ['class' => 'btn btn-primary']); ?>
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

    $(document).ready(function () {
        $("#formAddVerificacion").validate({
            rules: {
                id_lider_GT: {
                    required: true,
                    minlength: 1,
                    maxlength: 20
                },
                id_lider_consolida: {
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
                id_lider_GT: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 20 caracteres"
                },
                id_lider_consolida: {
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


