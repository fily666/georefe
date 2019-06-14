<nav class="navbar navbar-transparent navbar-absolute">
    <div class="container-fluid">
        <div class="navbar-minimize">
            <button id="minimizeSidebar" class="btn btn-round btn-white btn-fill btn-just-icon">
                <i class="material-icons visible-on-sidebar-regular">more_vert</i>
                <i class="material-icons visible-on-sidebar-mini">view_list</i>
            </button>
        </div>
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"> Sistema de Información Sin Muros </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="<?= $this->Url->build(['controller' => 'Home', 'action' => 'index']) ?>" >
                        <i class="material-icons">dashboard</i>
                        <p class="hidden-lg hidden-md">Dashboard</p>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="material-icons">person</i>
                        <p class="hidden-lg hidden-md">Profile</p>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                        <?= $this->Html->link(__('Mapa'), ['controller' => 'Mapa', 'action' => 'index']) ?>
                        </li>
                        <li>                            
                            <a href="<?= $this->Url->build(array('controller' => 'Users', base64_encode($this->request->session()->read('Auth.User')['id']), 'action' => 'cambiocontrasena')) ?>"> 
                                Cambiar Contrase&ntilde;a
                            </a>
                        </li>
                        <li>
                            <a href="<?= $this->Url->build(array('controller' => 'Users', 'action' => 'logout')) ?>"> 
                                Cerrar Sesión
                            </a>
                        </li>                        
                    </ul>
                </li>

                <li class="separator hidden-lg hidden-md"></li>
            </ul>

        </div>
    </div>
</nav>