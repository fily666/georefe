Entre las fechas, <?= '<b>' . $fecha1 . '</b> a <b>' . $fecha2 . '</b>, se encontraron <b>' . count($siJornadas->toArray()) . '</b>' ?> Jornadas: 
<br/><br/><br/>
<table border='1' style="border-collapse: collapse; width: 100%; height: auto ">
    <thead>
        <tr>
            <th>Descipci&oacute;n</th>
            <th>Fecha Inicio</th>         
            <th>Fecha Fin</th>
            <th>Tipo</th>
            <th>Coordinador</th>
            <th>Estado</th>
            <th>Proceso</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($siJornadas as $siJornada) {
            ?>
            <tr>
                <td><?= $siJornada->descripcion ?></td>
                <td><?= date_format($siJornada->fecha_inicio, 'Y-m-d') ?></td>
                <td><?= date_format($siJornada->fecha_fin, 'Y-m-d') ?></td>
                <td><?= $siJornada->ma_propiedade->valor ?></td>
                <td><?= $siJornada->coordinador->person->nombres . ' ' . $siJornada->coordinador->person->apellidos ?></td>
                <td><?= $siJornada->ma_status->value ?></td>
                <td>Jornada</td>
            </tr>
        <?php } ?>
    </tbody>
</table> 


