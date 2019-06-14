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
                        <li class="active">Reporte Sin Muros Individual</li>
                    </ol>

                    <div class="card-content">

                        <h4>Reporte Sin Muros Individual</h4>  

                        <div class="row">  
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Buscar persona entrega</label>
                                    <div class="col-lg-9">
                                        <?=
                                        $this->Form->select('id_datos_basicos', $lista1, ['id' => 'select1', 'class' => 'form-control', 'empty' => ':: Seleccione ::',
                                            'label' => false, 'style' => 'width: 100%'])
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="button" onclick="buscar()" title="Buscar" class="btn btn-primary btn-round btn-just-icon">
                                    <i class="material-icons">search</i>
                                    <div class="ripple-container"></div>
                                </button>
                            </div>
                        </div>

                        <hr style="border: solid #whitesmoke 1px"/>

                        <div id="auxPersona"></div>


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

    function buscar() {
        var persona = document.getElementById("select1").value;

        if (persona !== '') {
            cargarDatos(persona);
        } else {
            bootbox.dialog({
                message: "Debe seleccionar una persona.", title: "Campos Requeridos"
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

    function cargarDatos(persona) {
        var url = "<?= $this->Url->build(['action' => 'datospersonaajax']) ?>/" + persona;
        $("#auxPersona").html('<p style="position: relative; margin-left: 18%; margin-top: 50px; margin-bottom: 50px"><b>Cargando Información, espere por favor ...</b></p>');
        $.ajax({
            method: 'GET',
            url: url,
            data: ''
        }).done(function (res) {
            $("#auxPersona").html(res);
        });
    }

    $("#select1").select2({
        allowClear: true
    });


</script>

