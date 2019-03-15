<table cellspacing="0" border="0" style="width: 100%">
    <colgroup width="85"></colgroup>
    <colgroup width="113"></colgroup>
    <colgroup width="85"></colgroup>
    <tr>
        <td rowspan=10 align="left">
            <?= $this->Html->image('/attachments/users/' . $persona->fotografia, ['alt' => 'Avatar', 'style' => 'width: auto; height: 150px']); ?>
        </td>
        <td><b>Nombres:</b></td>
        <td  ><?= $persona->nombres ?></td>
    </tr>
    <tr>
        <td><b>Apellidos:</b></td>
        <td><?= $persona->apellidos ?></td>
    </tr>
    <tr>
        <td><b>Tipo Documento:</b></td>
        <td><?= $persona->ma_propiedade->valor ?></td>
    </tr>
    <tr>
        <td><b>Documento:</b></td>
        <td><?= $persona->documento ?></td>
    </tr>
    <tr>
        <td><b>Teléfono:</b></td>
        <td><?= $persona->telefono1 ?></td>
    </tr>
    <tr>
        <td><b>Celular:</b></td>
        <td><?= $persona->celular ?></td>
    </tr>  
    <tr>
        <td><b>Edad:</b></td>
        <td><?= $persona->edad ?></td>
    </tr>
    <tr>
        <td><b>Barrio:</b></td>
        <td><?= ($persona->barrio != '') ?($persona->barrio->valor) : ''  ?></td>
    </tr>
    <tr>
        <td height="17" align="left"><b>Email:</b></td>
        <td colspan=2 align="left" valign=middle><?= $persona->email ?></td>
    </tr>
    <tr>
        <td height="17" align="left"><b>Dirección:</b></td>
        <td colspan=2 align="left" valign=middle><?= $persona->direccion ?></td>
    </tr>
</table>
