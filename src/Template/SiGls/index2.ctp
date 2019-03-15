<div class="content">
    <div class="container-fluid">
        <div class="row">           
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="purple">
                        <i class="material-icons">assignment</i>
                    </div>

                    <ol class="breadcrumb pull-right">
                        <li><?= $this->Html->link('Inicio', ['controller' => 'Home', 'action' => 'index']) ?></li>
                        <li><?= $this->Html->link('Grupos de Liderazgo', ['action' => 'index']) ?></li>
                        <li class="active">Asociaci&oacute;n de Temas</li>
                    </ol>

                    <div class="card-content">

                        <h4>Asociaci&oacute;n de Temas, <b> Grupo de Liderazgo <?= $gl->id ?></b></h4>                        


                        <div class="panel-body">
                            <?= $this->Form->create(null, ['role' => 'form', 'class' => 'form-horizontal', 'id' => 'formAdd3']) ?>

                            <div class="form-horizontal">

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Tema</label>
                                    <div class="col-lg-4">
                                        <?= $this->Form->select('id_tema', $lista1, [
                                            'id' => 'id_tema', 
                                            'class' => 'form-control', 
                                            'empty' => ':: Seleccione ::', 
                                            'label' => false, 
                                            'required' => true
                                            ]) ?>
                                    </div>
                                    <label class="col-lg-2 control-label">Fecha</label>
                                    <div class="col-lg-3">
                                        <?=
                                        $this->Form->input('fecha', [
                                            'class' => 'form-control form_date',
                                            'data-date-format' => 'yyyy-mm-dd',
                                            'type' => 'text',
                                            'id' => 'fecha',
                                            'label' => false,
                                            'required' => true
                                        ])
                                        ?>   
                                    </div>
                                </div>  

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Descripci&oacute;n otro tema</label>
                                     <div class="col-lg-4">
                                        <?= $this->Form->input('descripcion_tema', [
                                            'id' => 'descripcion_tema', 
                                            'class' => 'form-control', 
                                            'label' => false,
                                            'maxlength'=> '50',
                                            'type' => 'text',
                                            'title' => 'Maximo 50 caracteres']) ?>
                                    </div>
                                    <label class="col-lg-2 control-label">Cita B&iacute;blica otro tema</label>
                                    <div class="col-lg-3">
                                        <?= $this->Form->input('cita_biblica', [
                                            'id' => 'cita_biblica', 
                                            'class' => 'form-control', 
                                            'type' => 'text',
                                            'label' => false]) ?>
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



                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Tema</th>
                                        <th>Fecha</th>                                       
                                        <th>Estado</th>
                                        <th class="disabled-sorting text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Tema</th>
                                        <th>Fecha</th>                                      
                                        <th>Estado</th>
                                        <th class="disabled-sorting text-right">Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    foreach ($siGlTemas as $siGlTema) {
                                        ?>
                                        <tr>
                                            <td><?= $siGlTema->id ?></td>
                                            <td><?= $siGlTema->si_tema->tema ?></td>
                                            <td><?= ($siGlTema->fecha) ? date_format($siGlTema->fecha, 'Y-m-d') : '' ?></td>
                                           
                                            <td>
                                                <?php
                                                if ($siGlTema->status_id == 1) {
                                                    echo '<span class="label label-success">' . $siGlTema->ma_status->value . '</span>';
                                                } elseif ($siGlTema->status_id == 2) {
                                                    echo '<span class="label label-danger">' . $siGlTema->ma_status->value . '</span>';
                                                } elseif ($siGlTema->status_id == 3) {
                                                    echo '<span class="label label-danger">' . $siGlTema->ma_status->value . '</span>';
                                                } else {
                                                    echo '<span class="label label-inverse">ERROR</span>';
                                                }
                                                ?>
                                            </td>  

                                            <td class="text-right">

                                                <?=
                                                $this->Html->link($this->Html->image('/img/ico_editar.png', ['style' => 'width: 20px; height: auto; margin-left: 10px', "alt" => __('Editar'), "title" => __('Editar')]), ['action' => 'edit2', $siGlTema->id, $id], ['escape' => false]);
                                                ?>

                                                <?php
                                                echo $this->Form->postLink(
                                                        $this->Html->image('/img/ico_delete.jpg', ['style' => 'width: 20px; height: auto; margin-left: 10px', "alt" => __('Eliminar'), "title" => __('Eliminar')]), ['action' => 'delete2', $siGlTema->id, $id], ['escape' => false, 'confirm' => __('¿Está seguro?')]
                                                );
                                                ?>
                                            </td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end content-->
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
        <!-- end row -->
    </div>
</div>

<script>
    $("#select1").select2({
        allowClear: true
    });
</script>    

<script>

    $("#id_tema").change(validaTemaGL);
    document.getElementById("cita_biblica").disabled = true;
    document.getElementById("descripcion_tema").disabled = true;

    function validaTemaGL() {
        var idTema = document.getElementById("id_tema").value;
        
        if (idTema != 98 || idTema == null) {
            document.getElementById("cita_biblica").disabled = true;
            document.getElementById("descripcion_tema").disabled = true;
        }else{
            document.getElementById("cita_biblica").disabled = false;
            document.getElementById("descripcion_tema").disabled = false;
        }  
       
    }
</script>    