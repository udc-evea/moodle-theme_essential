<?php $loginUrl = "$CFG->wwwroot\login\index.php";
              //$registrarseUrl="$CFG->wwwroot\login\signup.php";
              $registrarseUrl="http://udc.edu.ar/inscripcion";
              ?>
        <div id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                        <h4 class="modal-title">Usuario Invitado</h4>
                    </div>
                    <div class="modal-body">
                        <p>Usted ha entrado como un "Usuario Invitado".</p>
                        <p>Puede observar el contenido completo del curso que así lo habilite,<br>
                        pero no podrá participar en él. </p>
                        <p>Si usted quiere realizar algunos de estos cursos, por favor 
                            <a href="<?php echo $loginUrl; ?>">identifíquese como usuario</a> o 
                            <a href="<?php echo $registrarseUrl; ?>">regístrese</a>.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Continuar como invitado</button>
                    </div>
                </div>
            </div>
        </div>