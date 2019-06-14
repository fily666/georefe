Entre las fechas, <?= '<b>' . $fecha1 . '</b> a <b>' . $fecha2 . '</b>, se encontraron <b>' . count($siExodos->toArray()) . '</b>' ?> Exodos: 
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
        foreach ($siExodos as $siExodo) {
            ?>
            <tr>
                <td><?= $siExodo->descripcion ?></td>
                <td><?= date_format($siExodo->fecha_inicio, 'Y-m-d') ?></td>
                <td><?= date_format($siExodo->fecha_fin, 'Y-m-d') ?></td>
                <td><?= $siExodo->ma_propiedade->valor ?></td>
                <td><?= $siExodo->coordinador->person->nombres . ' ' . $siExodo->coordinador->person->apellidos ?></td>
                <td><?= $siExodo->ma_status->value ?></td>
                <td>Exodo</td>
            </tr>
        <?php } ?>
    </tbody>
</table> 


