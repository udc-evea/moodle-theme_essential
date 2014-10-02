<?php if(!isguestuser() and !is_siteadmin()): //si no es usuario INVITADO ni es ADMIN muesrto el chat ?> 
    <?php 
          //$urlInterno = $CFG->wwwroot."/theme/essential/layout/includes/";
          $urlInterno = $CFG->wwwroot."/../..";
          //$urlInterno = $urlInterno."moodle/theme/essential/layout/includes/";
          $apeNomUser = $USER->lastname.", ".$USER->firstname;
    ?>
    <div id="caja"> <!-- caja contenedora del menu + chat + form -->
        <div id="chatMenu"> <!-- caja contenedora del MENU del chat -->
            <div id="divNombreUsuario">
                <?php if(strlen($apeNomUser)>29){
                        $nombreUser = substr($apeNomUser,0,30)."...";
                      }else{
                        $nombreUser = $apeNomUser;
                      }
                ?>
                <p class="welcome" id="botonOcultaChat"
                   data-toggle="tooltip" data-placement="top" title="Chat general entre Docentes y Alumnos de la UDC."
                   ><b><?php echo $nombreUser ?></b></p>
            </div>
            <div id="divIconoMiniMaximizar">
                <i id="iconoChat" class="icon icon-chevron-up icon-white"></i>
            </div>
            <!--<button id="botonOcultaChat" name="Expandir/Bajar chat"></button> -->
        </div>
        <div id="chatContenido"> <!-- caja contenedora del chat + form -->
            <div id="chatbox">
                <?php
                    if(file_exists($urlInterno."log.html") && filesize($urlInterno."log.html") > 0){
                        $handle = fopen($urlInterno."log.html", "r");
                        $contents = fread($handle, $urlInterno."log.html");
                        fclose($handle);
                        echo $contents;
                    }
                ?>
            </div>
            <form name="message" action="" id="formChat">
                <div class="control-group">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon icon-retweet"></i></span>
                        <input name="usermsg" type="text" id="usermsg" size="40" placeholder="comentar" />
                    </div>
                </div>
                <input name="submitmsg" type="submit"  id="submitmsg" value="Enviar" hidefocus="true" tabindex="-1" />
                <input name="nameUser" type="hidden" id="nameUser" value="<?php echo $apeNomUser ?>"/>
                <span id="noteFooterChat">Chat general de la Universidad del Chubut</span>
            </form>
        </div>
    </div>

    <script>
        //funcion para ocultar la ventana de chat 
        //oculto la ventana del chat
        var abajo = true;
        var urlActual = document.location;
        var urlActual = String(urlActual);
        var cant = urlActual.length;
        var strComparacion = urlActual.substring(cant-7, cant-1);
        if(strComparacion === "moodle"){
            $( "#chatContenido" ).slideToggle(800); //mas lento
        }else{
            $( "#chatContenido" ).slideToggle(8);//mas rapido
        }                       
        // si clickeo el boton se oculta/muestra el chat
        $("#divIconoMiniMaximizar").click(function() {
            $( "#chatContenido" ).slideToggle(800);
            if(abajo){
                $("#divIconoMiniMaximizar i").removeClass("icon icon-chevron-up icon-white").addClass("icon icon-chevron-down icon-white");
                abajo = false;
            }else{
                $("#divIconoMiniMaximizar i").removeClass("icon icon-chevron-down icon-white").addClass("icon icon-chevron-up icon-white");
                abajo = true;
            }
        });
        
        //variable utilizada para determinar el tamaño del log.html
        var tamanio = 0;
        //variable utilizada para determinar si se scrollea o no el chat
        var scrolleo = true;
        
        //If user submits the form
        $("#submitmsg").click(function(){
            var clientmsg = $("#usermsg").val();
            var nameUser = $("#nameUser").val();
            var urlFinal = "../theme/essential/layout/includes/post.php";
            var urlActual = document.location;
            var urlActual = String(urlActual);
            var cant = urlActual.length;
            var strComparacion = urlActual.substring(cant-7, cant-1);
            if(strComparacion === "moodle"){
                urlFinal = "theme/essential/layout/includes/post.php";
            }
            
            $.post(urlFinal, {text: clientmsg, name: nameUser});
            //$("#usermsg").attr("value", "");
            $("#usermsg").val('');
            scrolleo = true;
            return false;
        });
                        
        //Load the file containing the chat log
        function loadLog(){
            var newTamanio = $("#chatbox").html().length;
            //var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 5; //Scroll height before the request
            var oldscrollHeight = $("#chatbox").scrollTop();
            var newscrollHeight = $("#chatbox").prop("scrollHeight") - 20; //Scroll height after the request
            
            var urlFinal = "../theme/essential/layout/includes/log.html";
            var urlActual = document.location;
            var urlActual = String(urlActual);
            var cant = urlActual.length;
            var strComparacion = urlActual.substring(cant-7, cant-1);
            if(strComparacion === "moodle"){
                urlFinal = "theme/essential/layout/includes/log.html";
            }
            $.ajax({
                url: urlFinal,//url: "theme/essential/layout/includes/log.html",
                cache: false,
                success: function(html){
                    $("#chatbox").html(html); //Insert chat log into the #chatbox div 
                    //alert("scrolleo: "+scrolleo);
                        //Auto-scroll 
                        //var newscrollHeight = $("#chatbox").prop("scrollHeight") - 20; //Scroll height after the request
                        if((newscrollHeight > oldscrollHeight)&&(scrolleo)){
                            $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                            scrolleo = false;
                            //alert("scrolleo: "+scrolleo);
                        }
                    }
             });
             //alert("Antes del If= tamanio: "+tamanio+" - NewTamanio: "+newTamanio);
             //compruebo si hay mensajes nuevos, y si hay cambio el color de la ventana a verde.
             var diff = Math.abs(newTamanio - tamanio);
             var multiplode35 = ((diff % 35) === 0);
             //alert("multiplo: "+multiplode35);
             if((newTamanio > tamanio) && (tamanio !== 0) && (tamanio !== 29) &&(!multiplode35)){
                 $("#caja").css("border","3px solid green");
                 $("#chatMenu").css("background-color","green");
             }
             tamanio = newTamanio;
             //alert("Despues del If = tamanio: "+tamanio+" - NewTamanio: "+newTamanio);
             //alert("tamOld: "+tamanio+" - NewTam: "+newTamanio);
        }
        //Defino el intervalo de actualiación del chat (1 segundo y medio)
        setInterval (loadLog, 1500);    //Reload file every 2500 ms or x ms if you wish to change the second parameter
        //cuando hacen click en el chat se pone el color azul base de siempre
        $("#caja").click(function(){
            $("#caja").css("border","3px solid #019DEB");
            $("#chatMenu").css("background-color","#019DEB");
        });
        $("#chatContenido").click(function(){
            $("#caja").css("border","3px solid #019DEB");
            $("#chatMenu").css("background-color","#019DEB");
        });
        $("#chatbox").click(function(){
            $("#caja").css("border","3px solid #019DEB");
            $("#chatMenu").css("background-color","#019DEB");
        });
        
    </script>
<?php endif; ?>