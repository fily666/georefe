<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-text" data-background-color="rose">
                        <h4 class="card-title">Editar Persona</h4>    
                    </div>

                    <ol class="breadcrumb pull-right">
                        <li><?= $this->Html->link('Inicio', ['controller' => 'Home', 'action' => 'index']) ?>
                        </li>
                        <li><?= $this->Html->link('Personas', ['action' => 'index']) ?> 
                        </li>
                        <li class="active">Editar Persona</li>
                    </ol>

                    <div class="card-content">                        

                        <!--INICIO DEL PANEL PARA EL FORMULARIO-->
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <?= $this->Form->create($person, ['role' => 'form', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'id' => 'formAEditPerson']) ?>

                                <div class="form-horizontal">

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Nombres</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->input('nombres', ['class' => 'form-control required', 'label' => false]) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Apellidos</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->input('apellidos', ['class' => 'form-control required', 'label' => false]) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Tipo de Documento</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('id_tipo_documento', $doctypes, ['class' => 'form-control', 'empty' => ':: Seleccione ::', 'label' => false]) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Documento</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->input('documento', ['class' => 'form-control', 'label' => false]) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">E-mail</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->input('email', ['class' => 'form-control', 'label' => false]) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Edad</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->input('edad', [
                                                'id' => 'edad', 
                                                'class' => 'form-control', 
                                                'type' => 'text',
                                                'required' => true,
                                                'label' => false]) ?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Barrio</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('id_barrio', $barrios, [ 'class' => 'form-control', 'empty' => ':: Seleccione ::',
                                                'label' => false, 'style' => 'width: 100%']) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Direci&oacute;n</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->input('direccion', ['class' => 'form-control', 'label' => false]) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Tel&eacute;fonos</label>
                                        <div class="col-lg-5">
                                            <?= $this->Form->input('telefono1', ['class' => 'form-control', 'label' => false]) ?>
                                        </div>
                                        <div class="col-lg-4">
                                            <?= $this->Form->input('telefono2', ['class' => 'form-control', 'label' => false]) ?>
                                        </div>
                                    </div>    

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Celular</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->input('celular', ['class' => 'form-control', 'label' => false]) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Fotograf&iacute;a</label>
                                        <div class="fileinput fileinput-new text-center col-lg-4" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail">
                                                <?= $this->Html->image('/attachments/users/' . $person->fotografia, ['alt' => 'Avatar', 'style' => 'width: auto; height: 150px']); ?>
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                            <div>
                                                <span class="btn btn-rose btn-round btn-file">
                                                    <span class="fileinput-new">Seleccione imagen</span>
                                                    <span class="fileinput-exists">Cambiar</span>
                                                    <input type="file" name="fotografia" />
                                                </span>
                                                <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remover</a>
                                            </div>
                                            La foto debe ser de cara ó completa, de modo claro y visible, no se permite cualquier imagen.
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
    
    $(document).ready(function () {
        $("#formAEditPerson").validate({
            rules: {
                nombres: {
                    required: true,
                    minlength: 1,
                    maxlength: 30
                },
                apellidos: {
                    required: true,
                    minlength: 1,
                    maxlength: 30
                },
                id_tipo_documento: {
                    required: true,
                    minlength: 1,
                    maxlength: 20
                },
                documento: {
                    required: true,
                    minlength: 1,
                    maxlength: 20
                },
                id_barrio: {
                    required: true,
                    minlength: 1,
                    maxlength: 20
                },
                edad: {
                    required: true,
                    minlength: 1,
                    maxlength: 20
                },
                direccion: {
                    required: false,
                    minlength: 1,
                    maxlength: 80
                },
                email: {
                    required: false,
                    minlength: 1,
                    maxlength: 60,
                    email: true
                },
                telefono1: {
                    required: false,
                    minlength: 1,
                    maxlength: 30
                },
                celular: {
                    required: false,
                    minlength: 1,
                    maxlength: 30
                }
            },
            messages: {
                nombres: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 30 caracteres"
                },
                apellidos: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 30 caracteres"
                },
                id_tipo_documento: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 20 caracteres"
                },
                documento: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 20 caracteres"
                },
                direccion: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 80 caracteres"
                },
                email: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 60 caracteres"
                },
                id_barrio: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 80 caracteres"
                },
                edad: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 80 caracteres"
                },
                telefono1: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 30 caracteres"
                },
                celular: {
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


