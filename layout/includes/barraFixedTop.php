<header  role="banner" class="navbar" >
                <nav role="navigation" class="navbar-inner navbar-fixed-top">
                    <div class="container-fluid">
                        <a class="brand" href="<?php echo $CFG->wwwroot;?>">
                            <img src="/moodle/theme/essential/pix/logo-home-udc.png" alt='Home' title="Inicio">
                            &nbsp;UDC<?php //echo $SITE->shortname; ?></a> <!-- <i class="icon-home icon-white"> </i> -->
                        <a class="btn btn-navbar" data-toggle="workaround-collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <div class="nav-collapse collapse">
                            <!-- Muestro el Custom Menu -->
                            <?php if ($hascustommenu) {
                                if(!isguestuser()){
                                    echo $custommenu;
                                }
                            } ?>
                            <!-- FIN del Custom Menu -->
                            <!-- Botones personalizados del Usuario -->                                
                                <?php include 'botones_usuario.php'?>
                            <!-- Fin de los botones personalizados del Usuario -->
                            <!-- Inicio info del login del usuario -->
                            <ul class="nav pull-right">
                                <li class="dropdown">
                                    <?php echo $OUTPUT->login_info() ?>
                                </li>
                            </ul>
                            <!-- Fin info del login del usuario -->
                        </div>
                    </div>
                </nav>
</header>
<br>