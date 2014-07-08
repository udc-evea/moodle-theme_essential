<!-- FUNCION Contar cantidad de mensajes sin leer -->
<?php function message_count_unread_messages_1($user1=null, $user2=null) {
                global $USER, $DB;

                if (empty($user1)) {
                    $user1 = $USER;
                }

                if (!empty($user2)) {
                    return $DB->count_records_select('message', "useridto = ? AND useridfrom = ?",
                        array($user1->id, $user2->id), "COUNT('id')");
                } else {
                    return $DB->count_records_select('message', "useridto = ?",
                        array($user1->id), "COUNT('id')");
                }
            }
            
            $cant = message_count_unread_messages_1($USER);
            //echo "<br>Mensajes: ".$cant."<br><br>";
?>
<!-- FIN FUNCION Contar cantidad de mensajes sin leer -->
<!-- FUNCION identificar usuario (student, teacher or admin) -->
<?php function identificar($isAdmin, $isTeacher, $isStudent){
        global $COURSE, $USER;
        if(isloggedin()){
            //$coursecontext = get_context_instance(CONTEXT_COURSE, $COURSE->id);
            $cContext = context_course::instance($COURSE->id); // global $COURSE
            $isStudent = current(get_user_roles($cContext, $USER->id))->shortname=='student'? true : false;
            $isTeacher = current(get_user_roles($cContext, $USER->id))->shortname=='editingteacher'? true : false;
            $isAdmin = is_siteadmin();
                //if (!has_capability('moodle/course:viewhiddensections', $coursecontext)) {
                //    echo "is Student<br/>";
                //}
                //if (has_capability('moodle/course:viewhiddensections', $coursecontext)) {
                //    echo "is Teacher or ADMIN<br/>";
                //}
                /*
                $context = get_context_instance(CONTEXT_COURSE,$COURSE->id);
                if (has_capability('moodle/legacy:student', $context, $USER->id, false) ) {
                    echo "is Student<br/>";
                }
                if (has_capability('moodle/legacy:teacher', $context, $USER->id, false) ) {
                    echo "is Assitent Teacher<br/>";
                }
                if (has_capability('moodle/legacy:editingteacher', $context, $USER->id, false)) {
                    echo "is Teacher<br/>";
                }
                if (has_capability('moodle/legacy:admin', $context, $USER->id, false)) {
                    echo "is ADMIN<br/>";
                }
                if (is_siteadmin()) {
                    echo "is ADMIN<br/>";
                }else if ($isStudent) {
                    echo "is STUDENT<br/>";
                }else if($isTeacher){
                    echo "is TEACHER<br/>";
                }else{
                    echo "No se que es <br>";
                }*/
                
            } 
    } //fin function "identificar"
?>
<!-- FIN FUNCION identificar usuario (student, teacher or admin) -->

<!-- FUNCION generar cadena aleatoria -->
<?php
    function cadenaAleatoria(){
        $caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; //posibles caracteres a usar
        $numerodeletras=6; //numero de letras para generar el texto
        $cadena = ""; //variable para almacenar la cadena generada
        for($i=0;$i<$numerodeletras;$i++){
            $cadena .= substr($caracteres,rand(0,strlen($caracteres)),1); /*Extraemos 1 caracter de los caracteres 
            entre el rango 0 a Numero de letras que tiene la cadena */
        }
        return $cadena;
    }
?>
<!-- FIN FUNCION generar cadena aleatoria -->

<!-- Si el usuario esta logueado y no es el INVITADO, muestro los botones -->
<?php if (isloggedin()&&(!isguestuser())) {?>
    <ul class="nav">
        <div class="nav-collapse collapse" style="margin: 0">
            <div class="btn-group" id="btn_course_links">
                <!-- <a href="<?php //echo $CFG->wwwroot;?>" class="btn btn-info" title="Inicio"><i class="icon-white icon-home"></i></a>  
                <a href="<?php //echo $CFG->wwwroot."/calendar/view.php?view=month";?>" class="btn btn-info" title="Próximos eventos"><i class="icon-white icon-calendar"></i></a>-->
                <?php 
                    global $USER, $COURSE;
                    //guardo los datos del usuario de moodle para enviarlos al FAQ
                    $moodleUserName = $USER->firstname.", ".$USER->lastname; //guardo nombre y apellido
                    $moodleUserMail = $USER->email;//guardo el mail

                    $currentcontext = $this->page->context->get_course_context(false);
                    $contextid=$currentcontext->id;
                    
                    $isStudent = false;
                    $isTeacher = false;
                    
                    $cContext = context_course::instance($COURSE->id); // global $COURSE
                    $isStudent = current(get_user_roles($cContext, $USER->id))->shortname=='student'? true : false;
                    $isTeacher = current(get_user_roles($cContext, $USER->id))->shortname=='editingteacher'? true : false;
                    
                    //Host donde esta alojado el PhpMyFAQ
                    $host = 'http://udc.edu.ar';
                    //$host = 'http://social.udc.edu.ar/moodle/theme/udcessential/layout/includes/';
                    //$host = 'http://localhost/phpmyfaq'; //CAMBIAR cuando quede fijo, ej: http://test.udc.edu.ar/faq
                    if($isStudent){
                        $title = 'Ayuda al estudiante';
                        $href = $host;//.'ayudaEstudiante.php';
                        $icon = 'icon-question-sign';
                        //$FaqUserName = 'alumno';
                        //$FaqUserPass = 'alumno';
                    }else if($isTeacher){
                        $title = 'Ayuda al docente';
                        $href = $host;//.'ayudaDocentes.php';
                        $icon = 'icon-book';
                        //$FaqUserName = 'docente';
                        //$FaqUserPass = 'docente';
                    }
                ?>
                <!-- <a href="<?php //echo $CFG->wwwroot."/user/index.php?contextid=".$contextid;?>" class="btn btn-info" title="Próximos eventos"><i class="icon-white icon-user"></i></a> -->
                <?php if(($isStudent || $isTeacher)):?>
                <!--
                <div class="btn-group" style="margin-top: 0px">
                    <form action="<?php echo $host ?>" method="post" accept-charset="utf-8">
                        <input type="hidden" name="faqloginaction" value="login">
                        <input type="hidden" name="faqusername" id="faqusername" required="required" value="<?php echo $FaqUserName ?>">
                        <input type="hidden" name="faqpassword" id="faqpassword" required="required" value="<?php echo $FaqUserPass ?>">
                        <input type="hidden" name="moodleUserName" id="moodleusername" required="required" value="<?php echo $moodleUserName ?>">
                        <input type="hidden" name="moodleUserMail" id="moodleusermail" required="required" value="<?php echo $moodleUserMail ?>">
                        <button class="btn btn-info" type="submit" title="<?php echo $title ?>">
                            <i class="icon-white <?php echo $icon ?>"></i>
                        </button>
                    </form>
                </div> -->
                    <a href="<?php echo $href ?>" class="btn btn-info" title="<?php echo $title ?>" target="_blank">
                    <i class="icon-white <?php echo $icon ?>"></i></a>
                    <!--<a href="<?php //echo $href ?>" class="btn btn-info" title="<?php //echo $title ?>" target="_blank">
                    <i class="icon-white <?php //echo $icon ?>"></i></a> -->
                <?php endif;?>
                <a href="<?php echo $CFG->wwwroot."/message/index.php";?>" class="btn btn-info" title="Mensajes"><i class="icon-white icon-envelope"></i>
                <?php if($cant>0):?>
                    <span class="badge" style='background-color: red'><?php echo $cant; ?></span> 
                <?php endif;?></a>
            </div>
        </div>
    </ul>
    <ul class="nav">
        <div class="btn-toolbar" id="bloques"></div>
    </ul>
<?php }?>
<!-- Fin de los botones del usuario -->
