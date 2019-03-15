<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-text" data-background-color="rose">
                        <h4 class="card-title">Cambiar Contrase&ntilde;a</h4>    
                    </div>

                    <ol class="breadcrumb pull-right">
                        <li><?= $this->Html->link('Inicio', ['controller' => 'Home', 'action' => 'index']) ?></li>
                        <li class="active">Cambiar Contrase&ntilde;a</li>
                    </ol>

                    <div class="card-content">                        

                        <!--INICIO DEL PANEL PARA EL FORMULARIO-->
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <?php echo $this->Flash->render(); ?>
                                <?= $this->Form->create(null, ['id' => 'formusrpass', 'role' => 'form', 'class' => 'mb-lg']) ?>

                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Contrase&ntilde;a</label>
                                        <div class="col-sm-10">
                                            <?= $this->Form->input('pass1', ['id' => 'pass1', 'type' => 'password', 'label' => false, 'autocomplete' => 'off', 'required' => true, 'class' => 'form-control', 'placeholder' => 'Contraseña']) ?>  

                                        </div>
                                    </div>
                                </fieldset>    


                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Repetir Contrase&ntilde;a</label>
                                        <div class="col-sm-10">
                                            <?= $this->Form->input('pass2', ['id' => 'pass2', 'type' => 'password', 'label' => false, 'autocomplete' => 'off', 'required' => true, 'class' => 'form-control', 'placeholder' => 'Repetir Contraseña']) ?>  
                                        </div>
                                    </div>
                                </fieldset>                               


                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
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

    $("#person_id").select2({
        allowClear: true
    });

    $("#group_id").select2({
        allowClear: true
    });

    $(document).ready(function () {
        $("#formuseredit").validate({
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