<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-text" data-background-color="rose">
                        <h4 class="card-title">Agregar Usuario</h4>    
                    </div>

                    <ol class="breadcrumb pull-right">
                        <li><?= $this->Html->link('Inicio', ['controller' => 'Home', 'action' => 'index']) ?>
                        </li>
                        <li><?= $this->Html->link('Usuarios', ['action' => 'index']) ?> 
                        </li>
                        <li class="active">Agregar Usuario</li>
                    </ol>

                    <div class="card-content">                        

                        <!--INICIO DEL PANEL PARA EL FORMULARIO-->
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <?= $this->Form->create($user, ['id' => 'formusernuev', 'role' => 'form', 'class' => 'form-horizontal']) ?>

                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Persona</label>
                                        <div class="col-sm-10">
                                            <?= $this->Form->input('person_id', ['id' => 'person_id', 'class' => 'form-control', 'style' => 'width: 100%'
                                                , 'label' => false, 'options' => $persons, 'empty' => ':: Seleccione ::', 'required' => false]) ?>
                                        </div>
                                    </div>
                                </fieldset>    


                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Rol</label>
                                        <div class="col-sm-10">
                                            <?= $this->Form->input('group_id', ['id' => 'group_id', 'class' => 'form-control', 'style' => 'width: 100%'
                                                , 'label' => false, 'options' => $maGroups, 'empty' => ':: Seleccione ::', 'required' => false]) ?>
                                        </div>
                                    </div>
                                </fieldset>                               


                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-primary']); ?>
                                        <?= $this->Form->button(__('Crear'), ['class' => 'btn btn-success']); ?>
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
    
    $("#person_id").select2({
        allowClear: true
    });
    
     $("#group_id").select2({
        allowClear: true
    });
    
    $(document).ready(function () {
        $("#formusernuev").validate({
            rules: {
                "person_id": {
                    required: true,
                    minlength: 1,
                    maxlength: 20
                },
                group_id: {
                    required: true,
                    minlength: 1,
                    maxlength: 20
                }
            },
            messages: {
                "person_id": {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 20 caracteres"
                },
                group_id: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 30 caracteres"
                }
            },
            submitHandler: function (form) {
                form.submit();
            },
            debug: true
        });
    });
</script>