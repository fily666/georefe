<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <!--<link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png" />-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <?php echo $this->Html->meta('favicon.ico', 'img/favicon.ico', array('type' => 'icon')); ?>
        <title>SISM | <?= $module['name'] ?></title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <!-- Bootstrap core CSS     -->
        <?php echo $this->Html->css('bootstrap.min'); ?>   
        <!--  Material Dashboard CSS    -->
        <?php echo $this->Html->css('material-dashboard.css?v=1.2.1'); ?>  
        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <?php echo $this->Html->css('demo'); ?>  
        <!--     Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    </head>

    <body class="off-canvas-sidebar">
        <!-- PAGE -->      
        <?php echo $this->fetch('content'); ?>       
        <!--/PAGE -->
    </body>

    <!--   Core JS Files   -->
    <?php echo $this->Html->script('jquery-3.2.1.min') ?>
    <?php echo $this->Html->script('bootstrap.min') ?>
    <?php echo $this->Html->script('material.min') ?>
    <?php echo $this->Html->script('material.min') ?>
    <?php echo $this->Html->script('perfect-scrollbar.jquery.min') ?>
    <?php echo $this->Html->script('perfect-scrollbar.jquery.min') ?>

    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <!-- Library for adding dinamically elements -->
    <?php echo $this->Html->script('arrive.min') ?>
    <!-- Forms Validations Plugin -->
    <?php echo $this->Html->script('arrive.min') ?>
    <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
    <?php echo $this->Html->script('arrive.min') ?>
    <!--  Charts Plugin, full documentation here: https://gionkunz.github.io/chartist-js/ -->
    <?php echo $this->Html->script('arrive.min') ?>
    <!--  Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <?php echo $this->Html->script('arrive.min') ?>
    <!--  Notifications Plugin, full documentation here: http://bootstrap-notify.remabledesigns.com/    -->
    <?php echo $this->Html->script('arrive.min') ?>
    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <?php echo $this->Html->script('arrive.min') ?>
    <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
    <?php echo $this->Html->script('arrive.min') ?>
    <!-- Sliders Plugin, full documentation here: https://refreshless.com/nouislider/ -->
    <script src="../../assets/js/nouislider.min.js"></script>
    <?php echo $this->Html->script('arrive.min') ?>
    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <?php echo $this->Html->script('jquery.select-bootstrap') ?>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
    <?php echo $this->Html->script('jquery.datatables') ?>
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
    <script type="text/javascript">
        $().ready(function () {
            demo.checkFullPageBackgroundImage();

            setTimeout(function () {
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });
    </script>

</html>
