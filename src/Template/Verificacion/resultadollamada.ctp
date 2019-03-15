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
            <?= ($encuesta != '') ? $encuesta->medio_info_s_m->valor : '' ?>
        </td>
    </tr>
    <tr>
        <td  align="left" style="border-bottom: 1px solid #000000;">
            <b>3. Resultado Llamada</b>
        </td>
        <td  align="left" style="border-bottom: 1px solid #000000;">
            <?= ($encuesta != '') ? $encuesta->resultado_llamada->valor : '' ?>
        </td>
    </tr>
    <tr>
        <td  align="left" style="border-bottom: 1px solid #000000;">
            <b> 4. Prioridad</b>
        </td>
        <td  align="left" style="border-bottom: 1px solid #000000;">
            <?= ($encuesta != '') ? $encuesta->prioridad->valor : '' ?>
        </td>
    </tr>
    <tr>
        <td  align="left" style="border-bottom: 1px solid #000000;">
            <b>5. Fase de Consolidación</b>
        </td>
        <td  align="left" style="border-bottom: 1px solid #000000;">
            <?= ($encuesta != '') ? $encuesta->fase_consolidacion->valor : '' ?>
        </td>
    </tr>
    <tr>
        <td  align="left" style="border-bottom: 1px solid #000000;">
            <b>6. observaciones</b>
        </td>
        <td  align="left" style="border-bottom: 1px solid #000000;">
            <?= ($encuesta != '') ? $encuesta->observacion : '' ?>
        </td>
    </tr>
</table>