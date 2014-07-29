<?php if(!isguestuser() and !is_siteadmin()): //si no es usuario INVITADO ni es ADMIN muesrto el chat ?> 
    <?php 
          $urlInterno = $CFG->wwwroot."/theme/essential/layout/includes/";
          $apeNomUser = $USER->lastname.", ".$USER->firstname;
    ?>
    <div id="caja"> <!-- caja contenedora del menu + chat + form -->
        <div id="chatMenu"> <!-- caja contenedora del MENU del chat -->
            <p class="welcome"><b><?php echo $apeNomUser ?></b></p>
            <button id="botonOcultaChat" name="Expandir/Bajar chat"></button>
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
            <form name="message" action="">
                <input name="usermsg" type="text" id="usermsg" size="40" />
                <input name="submitmsg" type="submit"  id="submitmsg" value="Enviar" />
                <input name="nameUser" type="hidden" id="nameUser" value="<?php echo $apeNomUser ?>"/>
            </form>
        </div>
    </div>

    <script>
        //funcion para ocultar la ventana de chat 
        //oculto la ventana del chat
        $( "#chatContenido" ).slideToggle(800);        
        // si clickeo el boton se oculta/muestra el chat
        $( "#botonOcultaChat" ).click(function() {
            $( "#chatContenido" ).slideToggle(800);
        });

        //If user submits the form
        $("#submitmsg").click(function(){
            var clientmsg = $("#usermsg").val();
            var nameUser = $("#nameUser").val();
            $.post("theme/essential/layout/includes/post.php", {text: clientmsg, name: nameUser});
            $("#usermsg").attr("value", "");
            return false;
        });

        //Load the file containing the chat log
        function loadLog(){     
            var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
            $.ajax({
                url: "theme/essential/layout/includes/log.html",
                cache: false,
                success: function(html){        
                    $("#chatbox").html(html); //Insert chat log into the #chatbox div
                        //Auto-scroll           
                        var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
                        if(newscrollHeight > oldscrollHeight){
                            $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                        }               
                    },
                });
            }
        //Defino el intervalo de actualiación del chat
        setInterval (loadLog, 2500);    //Reload file every 2500 ms or x ms if you wish to change the second parameter
    </script>
<?php endif; ?>