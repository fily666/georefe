<!--
Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
Tip 2: you can also add an image using data-image tag
Tip 3: you can change the color of the sidebar with data-background-color="white | black"
-->
<div class="logo">
    <a href="#" class="simple-text logo-mini">
        SM
    </a>
    <a href="#" class="simple-text logo-normal">
        SIN MUROS
    </a>
</div>
<div class="sidebar-wrapper">
    <div class="user">
        <div class="photo">
            <?= $this->Html->image('/attachments/users/' . $this->request->session()->read('Auth.User')['person']['fotografia'], ['alt' => 'Avatar']); ?>
        </div>
        <div class="info">
            <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                <span>                          
                    <?= $this->request->session()->read('Auth.User')['person']['nombres'] ?><br/>     
                    <b style="font-size: 10px"><?= $this->request->session()->read('Auth.User')['ma_group']['name'] ?></b>
                    <b class="caret"></b>
                </span>
            </a>
            <div class="clearfix"></div>
            <div class="collapse" id="collapseExample">
                <ul class="nav">
                    <li>
                        <a href="<?= $this->Url->build(array('controller' => 'Users', base64_encode($this->request->session()->read('Auth.User')['id']), 'action' => 'cambiocontrasena')) ?>">
                            <span class="sidebar-mini"> CC </span>
                            <span class="sidebar-normal"> Cambiar Contrase&ntilde;a </span>
                        </a>
                    </li>             
                    <li>
                        <a href="<?= $this->Url->build(array('controller' => 'Users', 'action' => 'logout')) ?>">
                            <span class="sidebar-mini"> CS </span>
                            <span class="sidebar-normal"> Cerrar Sesi&oacute;n </span>
                        </a>
                    </li>   
                </ul>
            </div>
        </div>
    </div>
    <ul class="nav">

        <!--HOME-->
        <?php if (isset($this->request->session()->read('Auth.User.permissions')['Home'])) { ?>
            <li class="<?= ($this->request->params['controller'] == 'Home' ? 'active' : '') ?>">                   
                <a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index']) ?>" title="Dashboard" >
                    <i class="material-icons">dashboard</i>
                    <p> Dashboard </p>
                </a>
            </li>
        <?php } ?>


        <!--MODULO ADMINISTRADOR-->    
        <?php
        if (isset($this->request->session()->read('Auth.User.permissions')['MaGroups']) ||
                isset($this->request->session()->read('Auth.User.permissions')['Persons']) ||
                isset($this->request->session()->read('Auth.User.permissions')['SiTemas']) ||
                isset($this->request->session()->read('Auth.User.permissions')['Users'])) {
            ?>
            <li class="<?=
            ($this->request->params['controller'] == 'MaGroups' ||
            $this->request->params['controller'] == 'Persons' ||
            $this->request->params['controller'] == 'SiTemas' ||
            $this->request->params['controller'] == 'Users' ? 'active' : '')
            ?>">           

                <a data-toggle="collapse" href="#admin">
                    <i class="material-icons">apps</i>
                    <p> Administraci&oacute;n
                        <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse <?=
                ($this->request->params['controller'] == 'MaGroups' ||
                $this->request->params['controller'] == 'Persons' ||
                $this->request->params['controller'] == 'SiTemas' ||
                $this->request->params['controller'] == 'Users' ? 'in' : '')
                ?>" id="admin">

                    <ul class="nav">
                        <?php if (isset($this->request->session()->read('Auth.User.permissions')['MaGroups'])) { ?>
                            <li class="<?= ($this->request->params['controller'] == 'MaGroups' ? 'active' : '') ?>" >
                                <a href="<?= $this->Url->build(array('controller' => 'MaGroups', 'action' => 'index')) ?>"
                                   title="Roles">
                                    <span class="sidebar-mini"> R </span>
                                    <span class="sidebar-normal"> Roles </span>

                                </a>
                            </li>
                        <?php } ?>

                        <?php if (isset($this->request->session()->read('Auth.User.permissions')['Users'])) { ?>
                            <li class="<?= ($this->request->params['controller'] == 'Users' ? 'active' : '') ?>">                   
                                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>" 
                                   title="Usuarios" >                                        
                                    <span class="sidebar-mini"> U </span>
                                    <span class="sidebar-normal"> Usuarios </span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if (isset($this->request->session()->read('Auth.User.permissions')['Persons'])) { ?>
                            <li class="<?= ($this->request->params['controller'] == 'Persons' ? 'active' : '') ?>">                   
                                <a href="<?= $this->Url->build(['controller' => 'Persons', 'action' => 'index']) ?>" 
                                   title="Personas" >                                        
                                    <span class="sidebar-mini"> P </span>
                                    <span class="sidebar-normal"> Personas </span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if (isset($this->request->session()->read('Auth.User.permissions')['SiTemas'])) { ?>
                            <li class="<?= ($this->request->params['controller'] == 'SiTemas' ? 'active' : '') ?>">                   
                                <a href="<?= $this->Url->build(['controller' => 'SiTemas', 'action' => 'index']) ?>" 
                                   title="Temas" >                                        
                                    <span class="sidebar-mini"> T </span>
                                    <span class="sidebar-normal"> Temas </span>
                                </a>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
            </li>
        <?php } ?>



        <!--MODULO AMBIENTES EVANGELISTICOS-->    
        <?php
        if (isset($this->request->session()->read('Auth.User.permissions')['Verificacion']) ||
                isset($this->request->session()->read('Auth.User.permissions')['CallCenter']) ||
                isset($this->request->session()->read('Auth.User.permissions')['SiExodos']) ||
                isset($this->request->session()->read('Auth.User.permissions')['SiJornadas']) ||
                isset($this->request->session()->read('Auth.User.permissions')['SiPuntoEncuentros'])) {
            ?>
            <li class="<?=
            ($this->request->params['controller'] == 'Verificacion' ||
            $this->request->params['controller'] == 'CallCenter' ||
            $this->request->params['controller'] == 'SiExodos' ||
            $this->request->params['controller'] == 'SiJornadas' ||
            $this->request->params['controller'] == 'SiPuntoEncuentros' ? 'active' : '')
            ?>">           

                <a data-toggle="collapse" href="#ambientes">
                    <i class="material-icons">content_paste</i>
                    <p> Ambientes Evangel&iacute;sticos
                        <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse <?=
                ($this->request->params['controller'] == 'Verificacion' ||
                $this->request->params['controller'] == 'CallCenter' ||
                $this->request->params['controller'] == 'SiExodos' ||
                $this->request->params['controller'] == 'SiJornadas' ||
                $this->request->params['controller'] == 'SiPuntoEncuentros' ? 'in' : '')
                ?>" id="ambientes">

                    <ul class="nav">

                        <?php if (isset($this->request->session()->read('Auth.User.permissions')['Verificacion'])) { ?>
                            <li class="<?= ($this->request->params['controller'] == 'Verificacion' ? 'active' : '') ?>" >
                                <a href="<?= $this->Url->build(array('controller' => 'Verificacion', 'action' => 'index')) ?>"
                                   title="Verificaci&oacute;n">
                                    <span class="sidebar-mini"> V </span>
                                    <span class="sidebar-normal"> Verificaci&oacute;n </span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if (isset($this->request->session()->read('Auth.User.permissions')['CallCenter'])) { ?>
                            <li class="<?= ($this->request->params['controller'] == 'CallCenter' ? 'active' : '') ?>" >
                                <a href="<?= $this->Url->build(array('controller' => 'CallCenter', 'action' => 'index')) ?>"
                                   title="Call Center">
                                    <span class="sidebar-mini"> CC </span>
                                    <span class="sidebar-normal"> Call Center</span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if (isset($this->request->session()->read('Auth.User.permissions')['SiPuntoEncuentros'])) { ?>
                            <li class="<?= ($this->request->params['controller'] == 'SiPuntoEncuentros' ? 'active' : '') ?>" >
                                <a href="<?= $this->Url->build(array('controller' => 'SiPuntoEncuentros', 'action' => 'index')) ?>"
                                   title="Puntos de Encuentro">
                                    <span class="sidebar-mini"> PE </span>
                                    <span class="sidebar-normal"> Puntos de Encuentro</span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if (isset($this->request->session()->read('Auth.User.permissions')['SiExodos'])) { ?>
                            <li class="<?= ($this->request->params['controller'] == 'SiExodos' ? 'active' : '') ?>" >
                                <a href="<?= $this->Url->build(array('controller' => 'SiExodos', 'action' => 'index')) ?>"
                                   title="Éxodos">
                                    <span class="sidebar-mini"> Ex </span>
                                    <span class="sidebar-normal"> Éxodos</span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if (isset($this->request->session()->read('Auth.User.permissions')['SiJornadas'])) { ?>
                            <li class="<?= ($this->request->params['controller'] == 'SiJornadas' ? 'active' : '') ?>" >
                                <a href="<?= $this->Url->build(array('controller' => 'SiJornadas', 'action' => 'index')) ?>"
                                   title="Jornadas">
                                    <span class="sidebar-mini"> J </span>
                                    <span class="sidebar-normal"> Jornadas</span>
                                </a>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
            </li>
        <?php } ?>


        <!--MODULO GRUPOS-->    
        <?php
        if (isset($this->request->session()->read('Auth.User.permissions')['SiGts']) || 
                isset($this->request->session()->read('Auth.User.permissions')['SiGls'])) {
            ?>
            <li class="<?=
            ($this->request->params['controller'] == 'SiGts' ||
            $this->request->params['controller'] == 'SiGts' ? 'active' : '')
            ?>">           

                <a data-toggle="collapse" href="#gt">
                    <i class="material-icons">group</i>
                    <p> Grupos
                        <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse <?=
                ($this->request->params['controller'] == 'SiGts' || 
                $this->request->params['controller'] == 'SiGls' ? 'in' : '') 
                ?>" id="gt">

                    <ul class="nav">

                        <?php if (isset($this->request->session()->read('Auth.User.permissions')['SiGts'])) { ?>
                            <li class="<?= ($this->request->params['controller'] == 'SiGts' ? 'active' : '') ?>" >
                                <a href="<?= $this->Url->build(array('controller' => 'SiGts', 'action' => 'index')) ?>"
                                   title="Grupos Transformación">
                                    <span class="sidebar-mini"> GT </span>
                                    <span class="sidebar-normal"> Grupos Transformaci&oacute;n</span>
                                </a>
                            </li>
                        <?php } ?>
                        
                        <?php if (isset($this->request->session()->read('Auth.User.permissions')['SiGls'])) { ?>
                            <li class="<?= ($this->request->params['controller'] == 'SiGls' ? 'active' : '') ?>" >
                                <a href="<?= $this->Url->build(array('controller' => 'SiGls', 'action' => 'index')) ?>"
                                   title="Grupos Liderazgo">
                                    <span class="sidebar-mini"> GL </span>
                                    <span class="sidebar-normal"> Grupos Liderazgo</span>
                                </a>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
            </li>
        <?php } ?>



        <!--REPORTES-->    
        <?php if (isset($this->request->session()->read('Auth.User.permissions')['Reportes'])) { ?>
            <li class="<?= ($this->request->params['controller'] == 'Reportes' ? 'active' : '') ?>">           

                <a data-toggle="collapse" href="#reportes">
                    <i class="material-icons">group</i>
                    <p> Reportes
                        <b class="caret"></b>
                    </p>
                </a>

                <div class="collapse <?= ($this->request->params['controller'] == 'Reportes' ? 'in' : '') ?>" id="reportes">

                    <ul class="nav">


                        <?php if (isset($this->request->session()->read('Auth.User.permissions')['Reportes'][0])) { ?>
                            <li class="<?= ($this->request->params['controller'] == 'Reportes' && $this->request->params['action'] == 'reporte1' || $this->request->params['action'] == 'repotasistencia' ? 'active' : '') ?>" >
                                <a href="<?= $this->Url->build(array('controller' => 'Reportes', 'action' => 'reporte1')) ?>"
                                   title="Lideres GT ">
                                    <span class="sidebar-mini"> R1 </span>
                                    <span class="sidebar-normal"> Lideres GT </span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if (isset($this->request->session()->read('Auth.User.permissions')['Reportes'][1])) { ?>
                            <li class="<?= ($this->request->params['controller'] == 'Reportes' && $this->request->params['action'] == 'reporte2' ? 'active' : '') ?>" >
                                <a href="<?= $this->Url->build(array('controller' => 'Reportes', 'action' => 'reporte2')) ?>"
                                   title="Individual GT ">
                                    <span class="sidebar-mini"> R2 </span>
                                    <span class="sidebar-normal"> Individual </span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if (isset($this->request->session()->read('Auth.User.permissions')['Reportes'][2])) { ?>
                            <li class="<?= ($this->request->params['controller'] == 'Reportes' && $this->request->params['action'] == 'reporte3' ? 'active' : '') ?>" >
                                <a href="<?= $this->Url->build(array('controller' => 'Reportes', 'action' => 'reporte3')) ?>"
                                   title="Sin Muros Números ">
                                    <span class="sidebar-mini"> R3 </span>
                                    <span class="sidebar-normal"> Sin Muros Números </span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if (isset($this->request->session()->read('Auth.User.permissions')['Reportes'][3])) { ?>
                            <li class="<?= ($this->request->params['controller'] == 'Reportes' && $this->request->params['action'] == 'reporte4' || $this->request->params['action'] == 'reporteasistenciagl' ? 'active' : '') ?>" >
                                <a href="<?= $this->Url->build(array('controller' => 'Reportes', 'action' => 'reporte4')) ?>"
                                   title="Lideres Grupo Liderazgo ">
                                    <span class="sidebar-mini"> R4 </span>
                                    <span class="sidebar-normal"> Lideres Grupo Liderazgo </span>
                                </a>
                            </li>
                        <?php } ?>

                        <?php if (isset($this->request->session()->read('Auth.User.permissions')['Reportes'][4])) { ?>
                            <li class="<?= ($this->request->params['controller'] == 'Reportes' && $this->request->params['action'] == 'reporte5' || $this->request->params['action'] == 'editconsolida' ? 'active' : '') ?>" >
                                <a href="<?= $this->Url->build(array('controller' => 'Reportes', 'action' => 'reporte5')) ?>"
                                   title="Consolidacion ">
                                    <span class="sidebar-mini"> R5 </span>
                                    <span class="sidebar-normal"> Consolidacion </span>
                                </a>
                            </li>
                        <?php } ?>
                        
                        <?php if (isset($this->request->session()->read('Auth.User.permissions')['Reportes'][5])) { ?>
                            <li class="<?= ($this->request->params['controller'] == 'Reportes' && $this->request->params['action'] == 'reporte6' ? 'active' : '') ?>" >
                                <a href="<?= $this->Url->build(array('controller' => 'Reportes', 'action' => 'reporte6')) ?>"
                                   title="Grupos por Barrio ">
                                    <span class="sidebar-mini"> R6 </span>
                                    <span class="sidebar-normal"> Grupos por Barrio </span>
                                </a>
                            </li>
                        <?php } ?>
                        
                        <?php if (isset($this->request->session()->read('Auth.User.permissions')['Reportes'][6])) { ?>
                            <li class="<?= ($this->request->params['controller'] == 'Reportes' && $this->request->params['action'] == 'reporte7' || $this->request->params['action'] == 'asistenciagt' ? 'active' : '') ?>" >
                                <a href="<?= $this->Url->build(array('controller' => 'Reportes', 'action' => 'reporte7')) ?>"
                                   title="Lider Acompañamiento GT ">
                                    <span class="sidebar-mini"> R7 </span>
                                    <span class="sidebar-normal"> Lider Acompa&ntilde;amiento GT </span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </li>
        <?php } ?>

    </ul>
</div>
