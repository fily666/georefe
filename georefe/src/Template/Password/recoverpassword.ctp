<!-- START panel-->
<div class="panel panel-dark panel-flat">
    <div class="panel-heading text-center">
        <a href="#">
            <?= $this->Html->image('logo.png', ['alt' => 'App Logo', 'class' => 'block-center img-responsive']); ?>
        </a>
    </div>
    <div class="panel-body">
        <p class="text-center pv">RECUPERACI&Oacute;N DE CONTRASE&Ntilde;A.</p>    
        <?= $this->Flash->render() ?> 
        <?= $this->Form->create(null, ['id' => 'formrecuppass', 'role' => 'form', 'class' => 'mb-lg']) ?>
        <div class="form-group has-feedback">
            <label for="signupInputPassword1" class="text-muted">Documento</label>
            <?= $this->Form->input('user', ['id' => 'user', 'type' => 'text', 'label' => false, 'autocomplete' => 'off', 'required' => true, 'class' => 'form-control', 'placeholder' => 'Ingrese el documento registrado']) ?>  
        </div>                
        <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-block btn-primary mt-lg']); ?>
        <?= $this->Form->end() ?>    
    </div>
</div>
<!-- END panel-->

<script>
    $(document).ready(function () {
        $("#formrecuppass").validate({
            rules: {
                user: {
                    required: true,
                },
            },
            messages: {
                user: {
                    required: "Este campo es obligatorio"
                },
            },
            submitHandler: function (form) {
                form.submit();
            },
            debug: true
        });
    });
</script>

