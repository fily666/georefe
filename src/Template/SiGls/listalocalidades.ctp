<div class="form-group">
    <label class="col-lg-2 control-label">Localidad</label>
    <div class="col-lg-9">
        <?=
        $this->Form->select('id_localidad', $lista7, ['id' => 'select4', 'class' => 'form-control',
        'empty' => ':: Seleccione ::', 'label' => false, 'style' => 'width: 100%'])
        ?>
    </div>
</div>