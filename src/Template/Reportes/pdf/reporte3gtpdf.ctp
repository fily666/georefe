Entre las fechas, <?= '<b>' . $fecha1 . '</b> a <b>' . $fecha2 . '</b>, se encontraron <b>' . count($siGts->toArray()) . '</b>' ?> Grupos de Transformación:
<br/><br/><br/>
<table border='1' style="border-collapse: collapse; width: 100%; height: auto ">
    <thead>
        <tr>
            <th>Id</th>
            <th>Fecha Inicio</th>
            <th>Estado</th>
            <th>Categoria</th>
            <th>Direcci&oacute;n</th>
            <th>Tel&eacute;fono</th>
            <th>D&iacute;a</th>
            <th>Hora</th>
            <th>Pastor</th>
            <th>Asistentes</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($siGts as $siGt) { ?>
            <tr>
                <td><?= $siGt->id ?></td>
                <td><?= date_format($siGt->fecha_inicia, 'Y-m-d') ?></td>
                <td><?= $siGt->ma_status->value ?></td>
                <td><?= $siGt->categorium->valor ?></td>                                            
                <td><?= $siGt->direccion ?></td>
                <td><?= ($siGt->telefono != '') ? $siGt->telefono : '' ?></td>
                <td><?= ($siGt->dia_reunion != '') ? $siGt->dia_reunion->valor : '' ?></td>
                <td><?= ($siGt->hora_reunion != '') ? date_format($siGt->hora_reunion, 'H:m a') : '' ?></td>                                            
                <td><?= $siGt->si_pastore->person->nombres . ' ' . $siGt->si_pastore->person->apellidos ?></td>
                <td>                                              
                    <?= 'Total: ' . $asistentesGt[$siGt->id] ?>
                </td> 
            </tr>
        <?php } ?>
    </tbody>
</table> 


