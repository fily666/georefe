<div class="content">
    <div class="container-fluid">
        <div class="row">           
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="purple">
                        <i class="material-icons">assignment</i>
                    </div>

                    <ol class="breadcrumb pull-right">
                        <li><?= $this->Html->link('Inicio', ['controller' => 'Home', 'action' => 'index']) ?>
                        </li>
                        <li class="active">Reporte Sin Muros Números</li>
                    </ol>

                    <div class="card-content">

                        <h4>Reporte Sin Muros Números</h4>  

                        <div class="row">       
                            <div class="col-md-3">
                                <label class="col-lg-5 control-label">Fecha Desde</label>
                                <div class="col-lg-7">
                                    <?=
                                    $this->Form->input('fecha_inicio', [
                                        'class' => 'form-control form_date',
                                        'data-date-format' => 'yyyy-mm-dd',
                                        'type' => 'text',
                                        'id' => 'fecha1',
                                        'label' => false,
                                        'required' => true
                                    ])
                                    ?>   
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="col-lg-4 control-label">Fecha Hasta</label>
                                <div class="col-lg-8">
                                    <?=
                                    $this->Form->input('fecha_fin', [
                                        'class' => 'form-control form_date',
                                        'data-date-format' => 'yyyy-mm-dd',
                                        'type' => 'text',
                                        'id' => 'fecha2',
                                        'label' => false,
                                        'required' => true
                                    ])
                                    ?>   
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="col-lg-3 control-label">Procesos</label>
                                <div class="col-md-9">
                                    <?=
                                    $this->Form->select('id_datos_basicos', $lista7, ['id' => 'select1', 'class' => 'form-control', 'empty' => ':: Seleccione ::',
                                        'label' => false,
                                        'required' => true,
                                        'style' => 'width: 100%'])
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="button" onclick="tabla()" title="Buscar" class="btn btn-primary btn-round btn-just-icon">
                                    <i class="material-icons">search</i>
                                    <div class="ripple-container"></div>
                                </button>
                            </div>
                        </div>

                        <hr style="border: solid #whitesmoke 1px"/>

                        <div id="auxVer"></div>
                        <div id="auxPE"></div>
                        <div id="auxEx"></div>
                        <div id="auxGT"></div>
                        <div id="auxJo"></div>


                    </div>
                    <!-- end content-->
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
        <!-- end row -->
    </div>
</div>
<script>

    function tabla() {

        var proceso = document.getElementById("select1").value;
        var fecha1 = document.getElementById("fecha1").value;
        var fecha2 = document.getElementById("fecha2").value;

        if (proceso !== '' && fecha1 !== '' && fecha2 !== '') {

            //Reporte Verificación
            if (proceso === '1168') {
                cargarReporteVer(fecha1, fecha2);
            } //Reporte Punto de Encuentro
            else if (proceso === '1169') {
                cargarReportePE(fecha1, fecha2);
            } //Reporte Exodo
            else if (proceso === '1170') {
                cargarReporteEx(fecha1, fecha2);
            } //Reporte GT  
            else if (proceso === '1171') {
                cargarReporteGT(fecha1, fecha2);
            } //Reporte Jornada
            else if (proceso === '1172') {
                cargarReporteJo(fecha1, fecha2);
            } else {
                alert('ERROR EN CODIGO DEL PROCESO ');
            }

        } else {
            bootbox.dialog({
                message: "Debe seleccionar: Proceso, Fecha Inicio y Fecha Fin.", title: "Campos Requeridos"
                , buttons: {
                    main: {
                        label: "Cerrar", className: "btn-primary", callback: function () {
                            return true;
                        }
                    }
                }
            });
        }
    }

    function cargarReporteVer(fecha1, fecha2) {
        var url = "<?= $this->Url->build(['action' => 'reporteverajax']) ?>/" + fecha1 + "/" + fecha2;
        $("#auxPE").html('');
        $("#auxEx").html('');
        $("#auxGT").html('');
        $("#auxJo").html('');
        $("#auxVer").html('<p style="position: relative; margin-left: 18%; margin-top: 50px; margin-bottom: 50px"><b>Cargando Información, espere por favor ...</b></p>');
        $.ajax({
            method: 'GET',
            url: url,
            data: ''
        }).done(function (res) {
            $("#auxVer").html(res);
        });
    }

    function cargarReportePE(fecha1, fecha2) {
        var url = "<?= $this->Url->build(['action' => 'reportepeajax']) ?>/" + fecha1 + "/" + fecha2;
        $("#auxVer").html('');
        $("#auxEx").html('');
        $("#auxGT").html('');
        $("#auxJo").html('');
        $("#auxPE").html('<p style="position: relative; margin-left: 18%; margin-top: 50px; margin-bottom: 50px"><b>Cargando Información, espere por favor ...</b></p>');
        $.ajax({
            method: 'GET',
            url: url,
            data: ''
        }).done(function (res) {
            $("#auxPE").html(res);
        });
    }

    function cargarReporteEx(fecha1, fecha2) {
        var url = "<?= $this->Url->build(['action' => 'reporteexajax']) ?>/" + fecha1 + "/" + fecha2;
        $("#auxVer").html('');
        $("#auxPE").html('');
        $("#auxGT").html('');
        $("#auxJo").html('');
        $("#auxEx").html('<p style="position: relative; margin-left: 18%; margin-top: 50px; margin-bottom: 50px"><b>Cargando Información, espere por favor ...</b></p>');
        $.ajax({
            method: 'GET',
            url: url,
            data: ''
        }).done(function (res) {
            $("#auxEx").html(res);
        });
    }

    function cargarReporteGT(fecha1, fecha2) {
        var url = "<?= $this->Url->build(['action' => 'reportegtajax']) ?>/" + fecha1 + "/" + fecha2;
        $("#auxVer").html('');
        $("#auxPE").html('');
        $("#auxEx").html('');
        $("#auxJo").html('');
        $("#auxGT").html('<p style="position: relative; margin-left: 18%; margin-top: 50px; margin-bottom: 50px"><b>Cargando Información, espere por favor ...</b></p>');
        $.ajax({
            method: 'GET',
            url: url,
            data: ''
        }).done(function (res) {
            $("#auxGT").html(res);
        });
    }

    function cargarReporteJo(fecha1, fecha2) {
        var url = "<?= $this->Url->build(['action' => 'reportejoajax']) ?>/" + fecha1 + "/" + fecha2;
        $("#auxVer").html('');
        $("#auxPE").html('');
        $("#auxGT").html('');
        $("#auxEx").html('');
        $("#auxJo").html('<p style="position: relative; margin-left: 18%; margin-top: 50px; margin-bottom: 50px"><b>Cargando Información, espere por favor ...</b></p>');
        $.ajax({
            method: 'GET',
            url: url,
            data: ''
        }).done(function (res) {
            $("#auxJo").html(res);
        });
    }


</script>

