<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-text" data-background-color="rose">
                        <h4 class="card-title">Editar Grupo de Liderazgo</h4>    
                    </div>

                    <ol class="breadcrumb pull-right">
                        <li><?= $this->Html->link('Inicio', ['controller' => 'Home', 'action' => 'index']) ?></li>
                        <li><?= $this->Html->link('Grupos de Liderazgo', ['action' => 'index']) ?> 
                        </li>
                        <li class="active">Editar Grupo de Liderazgo</li>
                    </ol>

                    <div class="card-content">                        

                        <!--INICIO DEL PANEL PARA EL FORMULARIO-->
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <?= $this->Form->create($siGl, ['role' => 'form', 'class' => 'form-horizontal', 'id' => 'formAdd']) ?>

                                <div class="form-horizontal">

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Fecha inicial</label>
                                        <div class="col-lg-9">
                                            <?=
                                            $this->Form->input('fecha_inicia', [
                                                'class' => 'form-control form_date',
                                                'data-date-format' => 'yyyy-mm-dd',
                                                'type' => 'text',
                                                'value' => ($siGl->fecha_inicia != null ) ? date_format($siGl->fecha_inicia, 'Y-m-d') : '',
                                                'id' => 'fecha_inicio',
                                                'label' => false
                                            ])
                                            ?>   
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Tel&eacute;fono</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->input('telefono', ['id' => 'telefono', 'class' => 'form-control', 'label' => false]) ?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Direcci&oacute;n</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->input('direccion', ['id' => 'direccion', 'class' => 'form-control', 'label' => false]) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">D&iacute;a de encuentro</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('id_dia_reunion', $lista1, ['id' => 'id_dia_encuentro', 'class' => 'form-control', 'empty' => ':: Seleccione ::', 'label' => false]) ?>
                                        </div>
                                    </div> 


                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Hora</label>
                                        <div class="col-lg-9">
                                            <?=
                                            $this->Form->input('hora_reunion', [
                                                'class' => 'form-control form_time',
                                                'data-date-format' => 'hh:ii',
                                                'type' => 'text',
                                                'value' => date_format($siGl->hora_reunion, 'H:m') ,
                                                'id' => 'hora_reunion',
                                                'label' => false
                                            ])
                                            ?>   
                                        </div>
                                    </div>                                 


                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Lider Grupo Liderazgo</label>
                                        <div class="col-lg-9">
                                            <?=
                                            $this->Form->select('id_lider', $lista2, ['id' => 'select1', 'class' => 'form-control',
                                                'empty' => ':: Seleccione ::', 'label' => false, 'style' => 'width: 100%'])
                                            ?>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Pastor</label>
                                        <div class="col-lg-9">
                                            <?=
                                            $this->Form->select('id_pastor', $lista3, ['id' => 'select2', 'class' => 'form-control',
                                                'empty' => ':: Seleccione ::', 'label' => false, 'style' => 'width: 100%'])
                                            ?>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Estado</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('status_id', $lista4, ['id' => 'status_id', 'class' => 'form-control', 'empty' => ':: Seleccione ::', 'label' => false]) ?>
                                        </div>
                                    </div> 


                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Categoria</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('id_categoria', $lista5, ['id' => 'id_categoria', 'class' => 'form-control', 'empty' => ':: Seleccione ::', 'label' => false]) ?>
                                        </div>
                                    </div> 


                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Ciudad</label>
                                        <div class="col-lg-9">
                                            <?=
                                            $this->Form->select('id_ciudad', $lista6, ['id' => 'select3', 'class' => 'form-control',
                                                'empty' => ':: Seleccione ::', 'label' => false, 'style' => 'width: 100%'])
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Localidad</label>
                                        <div class="col-lg-9">
                                            <?=
                                            $this->Form->select('id_localidad', $lista7, ['id' => 'select4', 'class' => 'form-control',
                                                'empty' => ':: Seleccione ::', 'label' => false, 'style' => 'width: 100%'])
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Barrio</label>
                                        <div class="col-lg-9">
                                            <?=
                                            $this->Form->select('id_barrio', $lista8, ['id' => 'select5', 'class' => 'form-control',
                                                'empty' => ':: Seleccione ::', 'label' => false, 'style' => 'width: 100%'])
                                            ?>
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

    $(document).ready(function () {
        $("#formAdd").validate({
            rules: {

                direccion: {
                    required: true,
                    minlength: 1,
                    maxlength: 60
                },
                select1: {
                    required: true,
                    minlength: 1,
                    maxlength: 30
                },
                select2: {
                    required: true,
                    minlength: 1,
                    maxlength: 30
                },
                select3: {
                    required: true,
                    minlength: 1,
                    maxlength: 30
                },
                select4: {
                    required: true,
                    minlength: 1,
                    maxlength: 30
                },
                select5: {
                    required: true,
                    minlength: 1,
                    maxlength: 30
                },
                fecha_inicio: {
                    required: true,
                    minlength: 1,
                    maxlength: 20
                },
                id_tipo_gl: {
                    required: true,
                    minlength: 1,
                    maxlength: 20
                },
                id_dia_encuentro: {
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
                direccion: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 60 caracteres"
                },
                id_dia_encuentro: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 20 caracteres"
                },
                select1: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 30 caracteres"
                },
                select2: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 30 caracteres"
                },
                select3: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 30 caracteres"
                },
                select4: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 30 caracteres"
                },
                select5: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 30 caracteres"
                },
                fecha_inicio: {
                    required: "Este campo es obligatorio",
                    minlength: "El campo admite como mínimo 1 caracteres",
                    maxlength: "El campo admite como máximo 20 caracteres"
                },
                id_tipo_gl: {
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

<script>
    $(document).ready(function() {
        $("#select3").change(function(){
            $.ajax({
                type: "GET",
                url: "<?=$this->Url->build(array('action' => 'listalocalidades'));?>/"+$(this).val(),
                beforeSend: function() {
                    document.getElementById("select4").disabled = true;
                    document.getElementById("select5").disabled = true;
			    },
                success: function(respuesta){
                    $('#select4').html(respuesta);
                    document.getElementById("select4").disabled = false;
                }
            });
        });

        $("#select4").change(function(){
            $.ajax({
                type: "GET",
                url: "<?=$this->Url->build(array('action' => 'listabarrios'));?>/"+$(this).val(),
                beforeSend: function() {
                    document.getElementById("select5").disabled = true;
			    },
                success: function(respuesta){
                    $('#select5').html(respuesta);
                    document.getElementById("select5").disabled = false;
                }
            });
        });

    });
</script>