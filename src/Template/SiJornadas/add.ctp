<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-text" data-background-color="rose">
                        <h4 class="card-title">Agregar Jornada</h4>    
                    </div>

                    <ol class="breadcrumb pull-right">
                        <li><?= $this->Html->link('Inicio', ['controller' => 'Home', 'action' => 'index']) ?></li>
                        <li><?= $this->Html->link('Jornadas', ['action' => 'index']) ?> 
                        </li>
                        <li class="active">Agregar Jornada</li>
                    </ol>

                    <div class="card-content">                        

                        <!--INICIO DEL PANEL PARA EL FORMULARIO-->
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <?= $this->Form->create($siJornada, ['role' => 'form', 'class' => 'form-horizontal', 'id' => 'formAddPE']) ?>

                                <div class="form-horizontal">

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Descripci&oacute;n</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->input('descripcion', ['id' => 'descripcion', 'class' => 'form-control', 'label' => false]) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Coordinador &Eacute;xodo</label>
                                        <div class="col-lg-9">
                                            <?=
                                            $this->Form->select('id_coordinador_exd', $lista1, ['id' => 'select1', 'class' => 'form-control',
                                                'empty' => ':: Seleccione ::', 'label' => false, 'style' => 'width: 100%'])
                                            ?>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Fecha inicial</label>
                                        <div class="col-lg-9">
                                            <?=
                                            $this->Form->input('fecha_inicio', [
                                                'class' => 'form-control form_date',
                                                'data-date-format' => 'yyyy-mm-dd',
                                                'type' => 'text',
                                                'id' => 'fecha_inicio',
                                                'label' => false
                                            ])
                                            ?>   
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Fecha final</label>
                                        <div class="col-lg-9">
                                            <?=
                                            $this->Form->input('fecha_fin', [
                                                'class' => 'form-control form_date',
                                                'data-date-format' => 'yyyy-mm-dd',
                                                'type' => 'text',
                                                'id' => 'fecha_fin',
                                                'label' => false
                                            ])
                                            ?>   
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Tipo de jornada</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('id_tipo_jornada', $lista2, ['id' => 'id_tipo_jornada', 'class' => 'form-control', 'empty' => ':: Seleccione ::', 'label' => false]) ?>
                                        </div>
                                    </div> 


                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Estado</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('status_id', $lista3, ['id' => 'status_id', 'class' => 'form-control', 'empty' => ':: Seleccione ::', 'label' => false]) ?>
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

    $(document).ready(function () {
        $("#formAddPE").validate({
            rules: {

                descripcion: {
                    required: true,
                    minlength: 1,
                    maxlength: 60
                },
                select1: {
                    required: true,
                    minlength: 1,
                    maxlength: 30
                },
                fecha_inicio: {
                    required: true,
                    minlength: 1,
                    maxlength: 20
                },
                id_tipo_jornada: {
                    required: true,
                    minlength: 1,
                    maxlength: 20
                },
                status_id: {
                    required: true,
                    minlength: 1,
                    maxlength: 20

                }
            },
            messages: {
                descripcion: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 60 caracteres"
                },
                select1: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 30 caracteres"
                },
                fecha_inicio: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 20 caracteres"
                },
                id_tipo_jornada: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 20 caracteres"
                },
                status_id: {
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


