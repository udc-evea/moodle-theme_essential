<?php if(!isguestuser() and !is_siteadmin()): //si no es usuario INVITADO ni es ADMIN muesrto el chat ?> 
    <?php 
          //$urlInterno = $CFG->wwwroot."/theme/essential/layout/includes/";
          $urlInterno = $CFG->wwwroot."/../..";
          //$urlInterno = $urlInterno."moodle/theme/essential/layout/includes/";
          $apeNomUser = $USER->lastname.", ".$USER->firstname;
    ?>
    <div id="caja"> <!-- caja contenedora del menu + chat + form -->
        <div id="chatMenu"> <!-- caja contenedora del MENU del chat -->
            <p class="welcome" id="botonOcultaChat"><b><?php echo $apeNomUser ?></b><i id="iconoChat" class="icon icon-minus icon-white"></i></p>
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
        $( "#botonOcultaChat" ).click(function() {
            $( "#chatContenido" ).slideToggle(800);
        });        

        $.parpadearChat = function(color){
            $("#botonOcultaChat").css("background-color", color);
        };

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
            
            //$.parpadearChat("#E3FDFF");
            //setTimeout(parpadearChat("#E3FDFF"),1000); //color mas claro
            //setTimeout(parpadearChat("#019DEB"),1000); //color base
            
            return false;
        });
        
        //Load the file containing the chat log
        function loadLog(){
            //var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 5; //Scroll height before the request
            var oldscrollHeight = $("#chatbox").scrollTop();
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
                        //Auto-scroll 
                        var newscrollHeight = $("#chatbox").prop("scrollHeight") - 20; //Scroll height after the request
                        if(newscrollHeight > oldscrollHeight){
                            $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                        }               
                    }
                });
                
                $.parpadearChat("#019DEB");
            }            
        //Defino el intervalo de actualiación del chat
        setInterval (loadLog, 2500);    //Reload file every 2500 ms or x ms if you wish to change the second parameter
    </script>
<?php endif; ?>