<div class="form-group">
    <label class="col-lg-2 control-label">Barrio</label>
    <div class="col-lg-9">
        <?=
        $this->Form->select('id_barrio', $lista8, ['id' => 'select5', 'class' => 'form-control',
        'empty' => ':: Seleccione ::', 'label' => false, 'style' => 'width: 100%'])
        ?>
    </div>
</div>