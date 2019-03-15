Entre las fechas, <?= '<b>' . $fecha1 . '</b> a <b>' . $fecha2 . '</b>, se encontraron <b>' . count($siPuntoEncuentros->toArray()) . '</b>' ?> Puntos de Encuentro: 
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
        foreach ($siPuntoEncuentros as $siPuntoEncuentro) {
            ?>
            <tr>
                <td><?= $siPuntoEncuentro->descripcion ?></td>
                <td><?= date_format($siPuntoEncuentro->fecha_inicio, 'Y-m-d') ?></td>
                <td><?= date_format($siPuntoEncuentro->fecha_fin, 'Y-m-d') ?></td>
                <td><?= $siPuntoEncuentro->ma_propiedade->valor ?></td>
                <td><?= $siPuntoEncuentro->coordinador->person->nombres . ' ' . $siPuntoEncuentro->coordinador->person->apellidos ?></td>
                <td><?= $siPuntoEncuentro->ma_status->value ?></td>
                <td>Punto de Encuentro</td>
            </tr>
        <?php } ?>
    </tbody>
</table> 


