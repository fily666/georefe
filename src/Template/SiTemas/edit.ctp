<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-text" data-background-color="rose">
                        <h4 class="card-title">Editar Tema de <?= $tipoTema->valor ?></h4>    
                    </div>

                    <ol class="breadcrumb pull-right">
                        <li><?= $this->Html->link('Inicio', ['controller' => 'Home', 'action' => 'index']) ?></li>
                        <li><?= $this->Html->link('Temas', ['action' => 'index']) ?></li>
                        <li class="active"><?= $this->Html->link('Temas de ' . $tipoTema->valor, ['action' => 'index2', $tipoTema->id]) ?></li>
                        <li class="active">Editar tema de <?= $tipoTema->valor ?></li>
                    </ol>

                    <div class="card-content">                        

                        <!--INICIO DEL PANEL PARA EL FORMULARIO-->
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <?= $this->Form->create($siTema, ['role' => 'form', 'class' => 'form-horizontal', 'id' => 'formAddTema']) ?>

                                <div class="form-horizontal">

                                    <div class="form-group">
                                        <label class="col-lg-2 control-label">Tema</label>
                                        <div class="col-lg-9">
                                            <?= $this->Form->input('tema', ['id' => 'tema', 'class' => 'form-control', 'label' => false, 'required' => true]) ?>
                                        </div>
                                    </div>



                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <?= $this->Html->link('Cancelar', ['action' => 'index2', $tipoTema->id], ['class' => 'btn btn-primary']); ?>
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

