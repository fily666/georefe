<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-text" data-background-color="rose">
                        <h4 class="card-title">Cambio Contrase&ntilde;a</h4>    
                    </div>

                    <div class="card-content">                        

                        CAMBIO DE CONTRASE&Ntilde;A.
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
    $(document).ready(function () {
        $("#formusrpass").validate({
            rules: {
                pass1: {
                    required: true,
                    minlength: 6,
                    maxlength: 15
                },
                pass2: {
                    equalTo: "#pass1",
                    required: true,
                    minlength: 6,
                    maxlength: 15
                }
            },
            messages: {
                pass1: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 6 caracteres",
                    maxlength: "El campo admite como máximo 15 caracteres"
                },
                pass2: {
                    equalTo: "Las contraseñas no coinciden",
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 6 caracteres",
                    maxlength: "El campo admite como máximo 15 caracteres"
                }
            },
            submitHandler: function (form) {
                form.submit();
            },
            debug: true
        });
    });
</script>