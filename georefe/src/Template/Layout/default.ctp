<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!doctype html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>SISM | <?= $this->fetch('title') ?></title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <?php echo $this->Html->meta('favicon.ico', 'img/favicon.ico', array('type' => 'icon')); ?>

        <!-- Bootstrap core CSS     -->
        <!--<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />-->
        <?php echo $this->Html->css('bootstrap.min'); ?>
        <!--  Material Dashboard CSS    -->
        <!--<link href="../assets/css/material-dashboard.css?v=1.2.1" rel="stylesheet" />-->
        <?php echo $this->Html->css('material-dashboard.css?v=1.2.1'); ?>
        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <!--<link href="../assets/css/demo.css" rel="stylesheet" />-->
        <?php echo $this->Html->css('demo'); ?>


        <!--     Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!--   Core JS Files   -->
        <?php echo $this->Html->script('jquery-3.2.1.min') ?>
        <?php echo $this->Html->script('bootstrap.min') ?>
        <?php echo $this->Html->script('material.min') ?>
        <?php echo $this->Html->script('perfect-scrollbar.jquery.min') ?>

        <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
        <?php echo $this->Html->script('jquery.datatables') ?>


        <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
        <!-- Library for adding dinamically elements -->
        <?php echo $this->Html->script('arrive.min') ?>
        <!-- Forms Validations Plugin -->
        <?php echo $this->Html->script('jquery.validate.min') ?>
        <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
        <?php echo $this->Html->script('moment.min') ?>
        <!--  Charts Plugin, full documentation here: https://gionkunz.github.io/chartist-js/ -->
        <?php echo $this->Html->script('chartist.min') ?>
        <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
        <?php echo $this->Html->script('jquery.bootstrap-wizard') ?>
        <!--  Notifications Plugin, full documentation here: http://bootstrap-notify.remabledesigns.com/    -->
        <?php echo $this->Html->script('jquery.bootstrap-wizard') ?>
        <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
        <?php echo $this->Html->script('bootstrap-datetimepicker') ?>
        <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
        <?php echo $this->Html->script('jquery-jvectormap') ?>
        <!-- Sliders Plugin, full documentation here: https://refreshless.com/nouislider/ -->
        <?php echo $this->Html->script('nouislider.min') ?>
        <!--  Google Maps Plugin    -->
        <!--script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script -->
        <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
        <?php echo $this->Html->script('jquery.select-bootstrap') ?>

        <!-- Sweet Alert 2 plugin, full documentation here: https://limonte.github.io/sweetalert2/ -->
        <?php echo $this->Html->script('sweetalert2') ?>
        <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
        <?php echo $this->Html->script('jasny-bootstrap.min') ?>
        <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
        <?php echo $this->Html->script('fullcalendar.min') ?>
        <!-- Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
        <?php echo $this->Html->script('jquery.tagsinput') ?>
        <!-- Material Dashboard javascript methods -->
        <?php echo $this->Html->script('material-dashboard.js?v=1.2.1') ?>
        <!-- Material Dashboard DEMO methods, don't include it in your project! -->
        <?php echo $this->Html->script('demo') ?>

        <!-- ===============  DATE PICKER ===============-->
        <?php
        echo $this->Html->css('/vendor/datepicker/css/bootstrap-datetimepicker.min');
        echo $this->Html->script('/vendor/datepicker/js/bootstrap-datetimepicker.min');
        echo $this->Html->script('/vendor/datepicker/js/locales/bootstrap-datetimepicker.es');
        ?>

        <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
        <?php echo $this->Html->script('bootstrap-datetimepicker') ?>

        <!-- ===============  SELECT2 ===============-->
        <?php
        echo $this->Html->css('/vendor/select2/dist/css/select2');
        echo $this->Html->script('/vendor/select2/dist/js/select2');
        ?>


        <style type="text/css">
            body {
                overflow-y: hidden;
            }

            .global {
                height: 600px;
                width: 100%;
                border: 1px solid #ddd;
                background: #f1f1f1;
                overflow-y: scroll;
            }
        </style>


    </head>
    <body>
        <div class="wrapper">

            <div class="sidebar" data-active-color="rose" data-background-color="black">
                <!--header start-->
                <?php echo $this->element('sidebar'); ?>
                <!--header end-->
            </div>

            <!--sidebar start-->
            <div class="main-panel">
                <?php echo $this->element('header'); ?>
                <!--sidebar end-->

                <!-- page start-->
                <div class="content global">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <?= $this->Flash->render() ?>
                                <?= $this->fetch('content') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- page end-->

                <!--footer start-->
                <?php echo $this->element('footer'); ?>
                <!--footer end-->
            </div>
        </div>
    </body>
    <!-- =============== PAGE VENDOR SCRIPTS ===============-->
    <!-- SPARKLINE-->
    <?php echo $this->Html->script('/vendor/sparkline/index') ?>
    <!-- FLOT CHART-->
    <?php echo $this->Html->script('/vendor/Flot/jquery.flot') ?>
    <?php echo $this->Html->script('/vendor/flot.tooltip/js/jquery.flot.tooltip.min') ?>
    <?php echo $this->Html->script('/vendor/Flot/jquery.flot.resize') ?>
    <?php echo $this->Html->script('/vendor/Flot/jquery.flot.pie') ?>
    <?php echo $this->Html->script('/vendor/Flot/jquery.flot.time') ?>
    <?php echo $this->Html->script('/vendor/Flot/jquery.flot.categories') ?>
    <?php echo $this->Html->script('/vendor/flot-spline/js/jquery.flot.spline.min') ?>
    <!-- CLASSY LOADER-->
    <?php echo $this->Html->script('/vendor/jquery-classyloader/js/jquery.classyloader.min') ?>
    <!-- MOMENT JS-->
    <?php echo $this->Html->script('/vendor/moment/min/moment-with-locales.min') ?>
    <!-- DEMO-->
    <?php echo $this->Html->script('demo/demo-flot') ?>
    <!-- =============== APP SCRIPTS ===============-->
    <?php echo $this->Html->script('app') ?>
    <?php echo $this->fetch('script'); ?>
    <!-- =============== PAGE VENDOR SCRIPTS ===============-->
    <?php
    //MENSAJES TIPO BOOTBOX
    echo $this->Html->script('/js/bootbox.min');
    ?>


    <script type="text/javascript">

        $('.form_datetime').datetimepicker({
            language: 'es',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1,
            ampm: true
        });
        $('.form_date').datetimepicker({
            language: 'es',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0
        });
        $('.form_time').datetimepicker({
            language: 'es',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 1,
            minView: 0,
            maxView: 1,
            forceParse: 0,
            ampm: true
        });

        $(document).ready(function () {

            // Javascript method's body can be found in assets/js/demos.js
            demo.initDashboardPageCharts();

            demo.initVectorMap();

            //DATA TABLES
            $('#datatables').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Buscar",
                    decimal: "",
                    emptyTable: "No hay datos disponibles en la tabla",
                    info: "_START_ a _END_ de _TOTAL_ registros",
                    infoEmpty: "0 ta 0 de 0 registros",
                    infoFiltered: "(filtrado de _MAX_ total registros)",
                    infoPostFix: "",
                    thousands: ",",
                    lengthMenu: "Mostrar _MENU_ Registros",
                    loadingRecords: "Cargando...",
                    processing: "Procesando...",
                    zeroRecords: "No se encontraron registros coincidentes",
                    paginate: {
                        first: "Primero",
                        last: "Último",
                        next: "Siguiente",
                        previous: "Anterior"
                    }
                }

            });


            var table = $('#datatables').DataTable();

            // Edit record
            table.on('click', '.edit', function () {
                $tr = $(this).closest('tr');

                var data = table.row($tr).data();
                alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
            });

            // Delete a record
            table.on('click', '.remove', function (e) {
                $tr = $(this).closest('tr');
                table.row($tr).remove().draw();
                e.preventDefault();
            });

            //Like record
            table.on('click', '.like', function () {
                alert('You clicked on Like button');
            });

            $('.card .material-datatables label').addClass('form-group');

        });

        $(document).ready(function () {
            md.initSliders();
            demo.initFormExtendedDatetimepickers();
        });


    </script>
</html>