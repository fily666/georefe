<nav class="navbar navbar-primary navbar-transparent navbar-absolute">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="">Sistema de Informaci&oacute;n Sin Muros</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!--<li>
                    <a href="../dashboard.html">
                        <i class="material-icons">dashboard</i> Dashboard
                    </a>
                </li>
                <li class="">
                    <a href="register.html">
                        <i class="material-icons">person_add</i> Register
                    </a>
                </li>-->
                <li class=" active ">
                    <a href="">
                        <i class="material-icons">fingerprint</i> Login
                    </a>
                </li>
                <!-- <li class="">
                     <a href="lock.html">
                         <i class="material-icons">lock_open</i> Lock
                     </a>
                 </li>-->
            </ul>
        </div>
    </div>
</nav>
<div class="wrapper wrapper-full-page">  
    <div class="full-page login-page" filter-color="black" data-image="<?= $this->Url->image('login.jpeg') ?>">         
        <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                        <?=
                        $this->Form->create(null, array(
                            'role' => 'form',
                            'autocomplete' => 'off'
                        ))
                        ?>   
                        <div class="card card-login card-hidden">
                            <div class="card-header text-center" data-background-color="rose">
                                <h4 class="card-title">Login</h4>
                                <div class="social-line">
                                    <a href="#btn" class="btn btn-just-icon btn-simple">
                                        <i class="fa fa-facebook-square"></i>
                                    </a>
                                    <a href="#pablo" class="btn btn-just-icon btn-simple">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                    <a href="#eugen" class="btn btn-just-icon btn-simple">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <p class="category text-center">
                                Solo personal autorizado Sin Muros
                            </p>
                            <div class="card-content">                                                                     

                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">face</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Usuario</label>
                                        <?= $this->Form->input('username', ['label' => false, 'required' => true, 'autocomplete' => 'off', 'class' => 'form-control']) ?>  
                                    </div>
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="material-icons">lock_outline</i>
                                    </span>
                                    <div class="form-group label-floating">
                                        <label class="control-label">Contrase&ntilde;a</label>
                                        <?= $this->Form->input('password', ['label' => false, 'required' => true, 'class' => 'form-control']) ?>
                                    </div>
                                </div>

                            </div>
                            <div class="footer text-center">
                                <?= $this->Form->button(__('Iniciar sesión'), ['class' => 'btn btn-rose btn-simple btn-wd btn-lg']) ?>                               
                            </div>
                        </div>
                        <?= $this->Form->end() ?>
                        <?php echo $this->Flash->render(); ?>
                        <?= $this->Flash->render('auth') ?>   
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <!--<nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portofolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Blog
                            </a>
                        </li>
                    </ul>
                </nav>-->
                <p class="copyright pull-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    <a href="https://www.sinmuros.org/" target="black">Sin Muros Ministerio Internacional</a>. Todos los derechos reservado Sin Muros Team.
                </p>
            </div>
        </footer>
    </div>
</div>