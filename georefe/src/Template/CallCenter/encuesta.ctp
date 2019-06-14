<?= $this->Form->create(null, ['role' => 'form', 'class' => 'form-horizontal', 'id' => 'formAddVerificacion']) ?>
<table cellspacing="0" border="0" style="width: 90%; margin-left: 5%; margin-top: 20px">
    <colgroup width="364"></colgroup>
    <colgroup width="347"></colgroup>
    <tr>
        <td  align="left" style="border-bottom: 1px solid #000000;" >
            <b>1. Nombre del encuestado</b>
        </td>
        <td align="left" style="border-bottom: 1px solid #000000;">
            <?= ($persona != '') ? $persona->nombres . ' ' . $persona->apellidos : '' ?>
        </td>
    </tr>
    <tr>
        <td  align="left" style="border-bottom: 1px solid #000000;">
            <b>2. A través de que medio obtuvo información de Sin Muros?</b>
        </td>
        <td  align="left" style="border-bottom: 1px solid #000000;">
            <?=           
            $this->Form->select('id_medio_info_sm', $lista1, ['class' => 'form-control', 'empty' => ':: Seleccione ::', 'label' => false,
            'value' => ($encuesta->medio_info_s_m != '') ? $encuesta->medio_info_s_m->id : '']) ?>         
        </td>
    </tr>
    <tr>
        <td  align="left" style="border-bottom: 1px solid #000000;">
            <b>3. Resultado Llamada</b>
        </td>
        <td  align="left" style="border-bottom: 1px solid #000000;">         
            <?= $this->Form->select('id_resultado_llamada', $lista2, ['class' => 'form-control', 'empty' => ':: Seleccione ::', 'label' => false,
            'value' => ($encuesta->resultado_llamada != '') ? $encuesta->resultado_llamada->id : '']) ?>  
        </td>
    </tr>
    <tr>
        <td  align="left" style="border-bottom: 1px solid #000000;">
            <b> 4. Prioridad</b>
        </td>
        <td  align="left" style="border-bottom: 1px solid #000000;">
            <?= $this->Form->select('id_prioridad', $lista3, ['class' => 'form-control', 'empty' => ':: Seleccione ::', 'label' => false,
            'value' => ($encuesta->prioridad != '') ? $encuesta->prioridad->id : '']) ?>  
        </td>
    </tr>
    <tr>
        <td  align="left" style="border-bottom: 1px solid #000000;">
            <b>5. Fase de Consolidación</b>
        </td>
        <td  align="left" style="border-bottom: 1px solid #000000;">
            <?= $this->Form->select('id_fase_consolidacion', $lista4, ['class' => 'form-control', 'empty' => ':: Seleccione ::', 'label' => false,
            'value' => ($encuesta->fase_consolidacion != '') ? $encuesta->fase_consolidacion->id : '']) ?>  
        </td>
    </tr>
    <tr>
        <td  align="left" style="border-bottom: 1px solid #000000;">
            <b>6. observaciones</b>
        </td>
        <td  align="left" style="border-bottom: 1px solid #000000;">
            <?= $this->Form->input('observacion', ['type' => 'textarea', 'class' => 'form-control', 'label' => false,
            'value' => ($encuesta->observacion != '') ? $encuesta->observacion : '',
            'rows' => '10', 'cols' => '20', 'maxlength' => '500']) ?>
        </td>
    </tr>
</table>

<div class="modal-footer">
 <?= $this->Form->button(__('Guardar'), ['class' => 'btn btn-success']); ?>
</div>

<?= $this->Form->end() ?>