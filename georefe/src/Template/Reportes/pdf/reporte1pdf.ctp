<div id="contentpag" >
    <table border='0' style="border-collapse: collapse; width: 400px; height: auto ">
        <tr>
            <td style='text-align: center; background-color: #6699ff; width: 50px; height: 40px'>X</td>
            <td>Asistió</td>           
            <td style='text-align: center; background-color: #ff0000; width: 50px; height: 40px'>F</td>
            <td>No Asistió</td> 
        </tr>
    </table> 

    <br/>

    <table border='1' style="border-collapse: collapse; width: 100%; height: auto ">
        <thead>
            <tr>
                <th>Asistente</th>
                <th>Documento</th>
                <?php
                $count = 1;
                foreach ($temas as $tema) {
                    ?>
                    <th>   <?= $count ?>  </th>
                    <?php
                    $count++;
                }
                ?>
                <th style="background-color: #04B404">Vistos</th>
                <th style="background-color: #EDBD26">Faltan</th>
                <th>Porcentaje</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($siGtAsistentes as $siGtAsistente) { ?>
                <tr>
                    <td><?= $siGtAsistente->persona->nombres . ' ' . $siGtAsistente->persona->apellidos ?></td>

                    <td>                                              
                        <?= $siGtAsistente->persona->documento ?>
                    </td>

                    <?php
                    $vistos = 0;
                    $faltan = 0;
                    foreach ($siGtAsistencias as $siGtAsistencia) {
                        if ($siGtAsistente->id == $siGtAsistencia->id_gt_asistente) {

                            if ($siGtAsistencia->asistio) {
                                echo "<td style='text-align: center; background-color: #6699ff'> X </td>";
                                $vistos++;
                            } else {
                                echo "<td style='text-align: center; background-color:#ff0000'> F </td>";
                                $faltan++;
                            }
                        }
                    }
                    ?>

                    <td style="text-align: center; background-color: #04B404">                                              
                        <?= $vistos ?>
                    </td>

                    <td style="text-align: center; background-color: #EDBD26">                                              
                        <?= $faltan ?>
                    </td>

                    <td style="text-align: center">                                              
                        <?= (($vistos / ($vistos + $faltan)) * 100) . " %" ?>
                    </td>
                </tr>        
            <?php } ?>
        </tbody>
    </table> 
    <br/>
    <b style="float: left">TEMARIO:</b><br/><br/>
    <table border='0' style="border-collapse: collapse; width: 100%; height: auto ">
        <?php
        $count3 = 1;
        foreach ($temas as $tema) {
            if ($count3 % 2 == 0) {
                $color = '#C1C1C1';
            } else {
                $color = '#FFFFFF';
            }
            ?>
            <tr>
                <td style="width: 150px; text-align: left; background-color: <?= $color ?>"><b>Tema <?= $count3 ?> :</b></td>
                <td style="width: 150px; text-align: left; background-color: <?= $color ?>"><?= ($tema->fecha != '' ? date_format($tema->fecha, 'Y-m-d') : 'Sin fecha programada' ) ?></td>
                <td style="text-align: left; background-color: <?= $color ?>"><?= $tema->si_tema->tema ?></td>                          
                <?php
                $count3++;
            }
            ?>
        </tr>
    </table> 
    <br/>
    <p style="float: left"><b>Nota:</b> Se tomá como parámetro el haber asistido por lo menos al 70% de los temas del GT</p>
</div>