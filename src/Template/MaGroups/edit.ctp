<?php

function array_orderby() {
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row)
                $tmp[$key] = $row[$field];
            $args[$n] = $tmp;
        }
    }
    $args[] = &$data;
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-text" data-background-color="rose">
                        <h4 class="card-title">Editar Rol</h4>    
                    </div>

                    <ol class="breadcrumb pull-right">
                        <li><?= $this->Html->link('Inicio', ['controller' => 'Home', 'action' => 'index']) ?>
                        </li>
                        <li><?= $this->Html->link('Roles', ['action' => 'index']) ?> 
                        </li>
                        <li class="active">Editar Rol</li>
                    </ol>

                    <div class="card-content">                        

                        <!--INICIO DEL PANEL PARA EL FORMULARIO-->
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <?= $this->Form->create($group, ['role' => 'form', 'class' => 'form-horizontal']) ?>

                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Nombre</label>
                                        <div class="col-sm-10">
                                            <?= $this->Form->input('name', ['class' => 'form-control', 'label' => false]) ?>
                                            <?= $this->Form->input('status_id', ['type' => 'hidden', 'value' => 1, 'class' => 'form-control', 'label' => false]) ?>
                                            <?= $this->Form->input('creator_id', ['type' => 'hidden', 'value' => $this->request->session()->read('Auth.User.id'), 'class' => 'form-control', 'label' => false]) ?>
                                            <?= $this->Form->input('modifier_id', ['type' => 'hidden', 'value' => 0, 'class' => 'form-control', 'label' => false]) ?>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="last-child">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Seleccionar Acciones</label>
                                        <div class="col-sm-10">
                                            <span style="color:#FB0808"><?= $this->Flash->render() ?></span>

                                            <?php
                                            foreach ($options as $action) :
                                                ?>
                                                <div class="col-md-3 panel panel-default" style="overflow-y: scroll ; margin-left: 10px; height: 200px">
                                                    <!-- POPOVERS -->
                                                    <div class="box border">
                                                        <div class="box-title">
                                                            <h4><i class="fa fa-bars"></i> <?= $action['name']; ?></h4>                                                               
                                                        </div>
                                                        <div class="box-body right">

                                                            <?php
                                                            $sorted = array_orderby($action['ma_actions'], 'name', SORT_ASC);
                                                            foreach ($sorted as $rol) :
                                                                ?>
                                                                <label>
                                                                    <input type="checkbox" id="action<?= $rol['id'] ?>" class="flat-red" name="ma_actions[]" value="<?= $rol['id'] ?>" 
                                                                           <?php if (in_array($rol['id'], $selected)) echo ' checked'; ?> > <?= $rol['name'] ?> 
                                                                </label><br/>   
                                                            <?php endforeach ?>


                                                        </div>
                                                    </div>
                                                </div>


                                            <?php endforeach ?>                     
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-primary']); ?>
                                        <?= $this->Form->button(__('Editar'), ['class' => 'btn btn-success']); ?>
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
