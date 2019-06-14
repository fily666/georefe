<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-text" data-background-color="rose">
                        <h4 class="card-title">Datos Complementarios de <?= $persona-> nombres . ' ' . $persona->apellidos ?></h4>    
                    </div>

                    <ol class="breadcrumb pull-right">
                        <li><?= $this->Html->link('Inicio', ['controller' => 'Home', 'action' => 'index']) ?>
                        </li>
                        <li><?= $this->Html->link('Personas', ['action' => 'index']) ?> 
                        </li>
                        <li class="active">Datos Complementarios</li>
                    </ol>

                    <div class="card-content">                        

                        <!--INICIO DEL PANEL PARA EL FORMULARIO-->
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <?= $this->Form->create($datosComplementarios, ['role' => 'form', 'class' => 'form-horizontal', 'id' => 'formAdd2']) ?>

                                <div class="form-horizontal">

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Fecha Nacimiento</label>
                                        <div class="col-lg-9">
                                            <?=
                                            $this->Form->input('fecha_nacimiento', [
                                                'class' => 'form-control form_date',
                                                'data-date-format' => 'yyyy-mm-dd',
                                                'type' => 'text',
                                                'value' => ($datosComplementarios != '' && $datosComplementarios->fecha_nacimiento != '') ? date_format($datosComplementarios->fecha_nacimiento, 'Y-m-d') : '',
                                                'id' => 'fecha_nacimiento',
                                                'label' => false
                                            ])
                                            ?>   
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Lugar de Nacimiento</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->input('lugar_nacimiento', ['class' => 'form-control', 'label' => false]) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Genero</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('id_genero', $lista2, ['class' => 'form-control', 'empty' => ':: Seleccione ::', 'label' => false]) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Estado Civil</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('id_estado_civil', $lista1, ['class' => 'form-control', 'empty' => ':: Seleccione ::', 'label' => false, 'onChange' => 'camposCasado(this.value)']) ?>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Nombre Conyugue</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->input('nombre_conyugue', ['id' => 'nombre_conyugue', 'class' => 'form-control', 'label' => false]) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Tipo documento del Conyugue</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('id_tipo_doc_conyugue', $lista3, ['id' => 'id_tipo_doc_conyugue', 'class' => 'form-control', 'empty' => ':: Seleccione ::', 'label' => false]) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Documento Conyugue</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->input('documento_conyugue', ['id' => 'documento_conyugue', 'class' => 'form-control', 'label' => false]) ?>
                                        </div>
                                               </div>


                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Nivel de Estudio</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('id_nivel_estudio', $lista4, ['id' => 'id_nivel_estudio', 'class' => 'form-control', 'empty' => ':: Seleccione ::', 'label' => false]) ?>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Profesi&oacute;n</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('id_profesion', $lista5, ['class' => 'form-control', 'empty' => ':: Seleccione ::', 'label' => false]) ?>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Ejerce Profesi&oacute;n</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('id_ejerce_profesion', $lista6, ['class' => 'form-control', 'empty' => ':: Seleccione ::', 'label' => false]) ?>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Nombre de la empresa</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->input('nombre_empresa', ['class' => 'form-control', 'label' => false]) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Direcci&oacute;n de la empresa</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->input('direccion_empresa', ['class' => 'form-control', 'label' => false]) ?>
                                        </div>
                                    </div> 


                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Tel&eacute;fono de la empresa</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->input('telefono_empresa', ['class' => 'form-control', 'label' => false]) ?>
                                        </div>
                                    </div> 



                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Ministerio</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->select('id_ministerio', $lista7, ['class' => 'form-control', 'empty' => ':: Seleccione ::', 'label' => false]) ?>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Ciudad</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->input('ciudad', ['class' => 'form-control', 'label' => false]) ?>
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Zona</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->input('zona', ['class' => 'form-control', 'label' => false]) ?>
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Barrio</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->input('barrio', ['class' => 'form-control', 'label' => false]) ?>
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

    camposCasado(<?= $datosComplementarios->id_estado_civil ?>);

    function camposCasado(id = null) {
        if (id !== 9 || id === null) {
            document.getElementById("nombre_conyugue").disabled = true;
            document.getElementById("id_tipo_doc_conyugue").disabled = true;
            document.getElementById("documento_conyugue").disabled = true;

            document.getElementById("nombre_conyugue").value = '';
            document.getElementById("id_tipo_doc_conyugue").value = '';
            document.getElementById("documento_conyugue").value = '';
        } else {
            document.getElementById("nombre_conyugue").disabled = false;
            document.getElementById("id_tipo_doc_conyugue").disabled = false;
            document.getElementById("documento_conyugue").disabled = false;
    }
    }


</script>


