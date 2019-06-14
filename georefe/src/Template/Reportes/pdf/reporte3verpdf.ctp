Entre las fechas, <?= '<b>' . $fecha1 . '</b> a <b>' . $fecha2 . '</b>, se encontraron <b>' . count($siVeriEntregas->toArray()) . '</b>' ?> Verificaciones: 
<br/><br/><br/>
<table border='1' style="border-collapse: collapse; width: 100%; height: auto ">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Documento</th>         
            <th>Fecha Entrega</th>
            <th>Pastor</th>
            <th>Líder</th>
            <th>Proceso</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($siVeriEntregas as $siVeriEntrega) {
            ?>
            <tr>
                <td><?= $siVeriEntrega->persona->nombres . ' ' . $siVeriEntrega->persona->apellidos ?></td>
                <td><?= $siVeriEntrega->persona->documento ?></td>
                <td><?= date_format($siVeriEntrega->fecha_entrega, 'Y-m-d') ?></td>
                <td><?= $siVeriEntrega->pastor->person->nombres . ' ' . $siVeriEntrega->pastor->person->apellidos ?></td>
                <td><?= $siVeriEntrega->lider_asignado->person->nombres . ' ' . $siVeriEntrega->lider_asignado->person->apellidos ?></td>
                <td>Verificación</td>
            </tr>
        <?php } ?>
    </tbody>
</table> 


