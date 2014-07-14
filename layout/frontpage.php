<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * The Essential theme is built upon the Bootstrapbase theme.
 *
 * @package    theme
 * @subpackage Essential
 * @author     Julian (@moodleman) Ridden
 * @author     Based on code originally written by G J Bernard, Mary Evans, Bas Brands, Stuart Lamour and David Scotson.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/* agrego las variables para mostrar el custom menu */
$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

$hashiddendock = (empty($PAGE->layout_options['noblocks']) && $PAGE->blocks->region_has_content('hidden-dock', $OUTPUT));
$sideregionsmaxwidth = (!empty($PAGE->theme->settings->sideregionsmaxwidth));

$hasalert1 = (empty($PAGE->theme->settings->enable1alert)) ? false : $PAGE->theme->settings->enable1alert;
$hasalert2 = (empty($PAGE->theme->settings->enable2alert)) ? false : $PAGE->theme->settings->enable2alert;
$hasalert3 = (empty($PAGE->theme->settings->enable3alert)) ? false : $PAGE->theme->settings->enable3alert;
$alertinfo = '<span class="fa-stack "><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-info fa-stack-1x fa-inverse"></i></span>';
$alertwarning = '<span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-warning fa-stack-1x fa-inverse"></i></span>';
$alertsuccess = '<span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fa fa-bullhorn fa-stack-1x fa-inverse"></i></span>';

$hasfrontpageblocks = (empty($PAGE->theme->settings->frontpageblocks)) ? false : $PAGE->theme->settings->frontpageblocks;
$hasanalytics = (empty($PAGE->theme->settings->useanalytics)) ? false : $PAGE->theme->settings->useanalytics;
$haslogo = (!empty($PAGE->theme->settings->logo));

theme_essential_check_colours_switch();
theme_essential_initialise_colourswitcher($PAGE);

$bodyclasses = array();
$bodyclasses[] = 'two-column';
$bodyclasses[] = 'essential-colours-' . theme_essential_get_colours();
if ($sideregionsmaxwidth) {
    $bodyclasses[] = 'side-regions-with-max-width';
}

$left = (!right_to_left());  // To know if to add 'pull-right' and 'desktop-first-column' classes in the layout for LTR.
echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <noscript>
            <link rel="stylesheet" type="text/css" href="<?php echo $CFG->wwwroot;?>/theme/essential/style/nojs.css" />
    </noscript>
    <!-- Google web fonts -->
    <?php //require_once(dirname(__FILE__).'/includes/fonts.php'); ?>
    <!-- iOS Homescreen Icons -->
    <?php //require_once(dirname(__FILE__).'/includes/iosicons.php'); ?>
    <!-- Start Google Analytics -->
    <?php if ($hasanalytics) { ?>
        <?php require_once(dirname(__FILE__).'/includes/analytics.php'); ?>
    <?php } ?>
    <!-- End Google Analytics -->
    <!-- agrego el Javascript y los CSS agregados 
        <link rel="stylesheet" type="text/css" href="<?php //echo $CFG->wwwroot;?>/theme/essential/style/css_agregadas.css" />
        <script type="text/javascript" src="<?php //echo $CFG->wwwroot."/theme/essential/javascript/funciones_agregadas.js";?>"></script>
        <script type="text/javascript" src="<?php //echo $CFG->wwwroot."/theme/essential/javascript/bloques.js";?>"></script> -->
    <!-- fin de agregar archivos -->
    <!-- SCRIPT para el modal del invitado -->
        <script type="text/javascript">
            $(document).ready(function(){
               $("#myModal").modal('show');
            });
        </script>
    <!-- FIN de SCRIPT del modal del invitado -->
</head>

<body <?php echo $OUTPUT->body_attributes($bodyclasses); ?>>
    <!-- Muestro en que pagina estoy 
    <script>alert('layout frontpage')</script> -->
    <?php echo $OUTPUT->standard_top_of_body_html() ?>    
    <div id="cabecera" class="row-fluid">
        <div id="caja-flotante">
            <?php require_once(dirname(__FILE__).'/includes/header.php'); ?>
        </div>
        <div id="barra-fija">
            <?php include 'includes/barraFixedTop.php'; ?>
        </div>
    </div>
    <div id="page" class="container-fluid">
        <!-- Si el usuario es INVITADO muestro MODAL -->
        <?php if(isguestuser()): ?>
            <?php require_once(dirname(__FILE__).'/includes/modal_invitado.php'); ?>
        <?php endif;?>
        <!-- FIN del modal si el usuario es INVITADO -->
        
        <!-- Inicio del boton derecho de AYUDA GENERAL -->
        <?php if(!(isloggedin()) || isguestuser()):?> <!-- si no esta logueado o si es el "invitado" lo muestro -->
        <div style="float: right;">
            <div style="position: fixed;">
                <?php $host = 'http://udc.edu.ar';//$CFG->wwwroot.'/theme/udcessential/layout/includes/ayudaGeneral.php'; ?>
                <a href="<?php echo $host; ?>" target="_blank"><img src="/moodle/theme/essential/pix/ayuda.png" alt='Ayuda' title="Ayuda General" width="50px" height="50px" style="padding-left: 15%" ></a>
            </div>
        </div>
        <?php endif;?>
        <!-- Fin del boton derecho de AYUDA GENERAL -->
        
        <!-- Inicio del div que contiene las ALERTAS, SLIDES y SPOTS -->
        <div class="row-fluid">
            
          <!-- Start Alerts -->
          <div class="span12">
            <!-- Alert #1 -->
            <?php if ($hasalert1) { ?>  
                <div class="useralerts alert alert-<?php echo $PAGE->theme->settings->alert1type ?>">  
                <a class="close" data-dismiss="alert" href="#">×</a>
                <?php 
                if ($PAGE->theme->settings->alert1type == 'info') {
                    $alert1icon = $alertinfo;
                } else if ($PAGE->theme->settings->alert1type == 'error') {
                    $alert1icon = $alertwarning;
                } else {
                    $alert1icon = $alertsuccess;
                } 
                $alert1title = 'alert1title_'.current_language();
                $alert1text = 'alert1text_'.current_language();
                echo $alert1icon.'<span class="title">'.$PAGE->theme->settings->$alert1title.'</span>'.$PAGE->theme->settings->$alert1text; ?> 
            </div>
            <?php } ?>

            <!-- Alert #2 -->
            <?php if ($hasalert2) { ?>  
                <div class="useralerts alert alert-<?php echo $PAGE->theme->settings->alert2type ?>">  
                <a class="close" data-dismiss="alert" href="#">×</a>
                <?php 
                if ($PAGE->theme->settings->alert2type == 'info') {
                    $alert2icon = $alertinfo;
                } else if ($PAGE->theme->settings->alert2type == 'error') {
                    $alert2icon = $alertwarning;
                } else {
                    $alert2icon = $alertsuccess;
                } 
                $alert2title = 'alert2title_'.current_language();
                $alert2text = 'alert2text_'.current_language();
                echo $alert2icon.'<span class="title">'.$PAGE->theme->settings->$alert2title.'</span>'.$PAGE->theme->settings->$alert2text; ?> 
            </div>
            <?php } ?>

            <!-- Alert #3 -->
            <?php if ($hasalert3) { ?>  
                <div class="useralerts alert alert-<?php echo $PAGE->theme->settings->alert3type ?>">  
                <a class="close" data-dismiss="alert" href="#">×</a>
                <?php 
                if ($PAGE->theme->settings->alert3type == 'info') {
                    $alert3icon = $alertinfo;
                } else if ($PAGE->theme->settings->alert3type == 'error') {
                    $alert3icon = $alertwarning;
                } else {
                    $alert3icon = $alertsuccess;
                } 
                $alert3title = 'alert3title_'.current_language();
                $alert3text = 'alert3text_'.current_language();
                echo $alert3icon.'<span class="title">'.$PAGE->theme->settings->$alert3title.'</span>'.$PAGE->theme->settings->$alert3text; ?> 
            </div>
            <?php } ?>
          </div>
          <!-- End Alerts -->
          <!-- Si el usuario NO esta logueado, muestro RSS, SPOTS y SLIDES -->
            <?php if ($USER->id == 0):?>
                <!-- Inicio RSS y los dos SLIDES -->
                <div class="row-fluid">
                    <!-- INICIO del código RSS insertado -->
                    <div class="span3" align="center">
                              <?php
                                $hostAtestear = "www.google.com";
                                // Veo si puedo obtener la dir IP y compruebo si hay internet o no
                                $conexion = gethostbyname($hostAtestear);
                                //Si devuelve la dir IP es porque tengo internet
                                if ($conexion != $hostAtestear): ?>
                                    <div  style="padding-top: 10px; border-bottom: 5px #00adf7 solid;">
                                      <!-- start feedwind code -->
                                      <script type="text/javascript">
                                           rssmikle_url="http://udc.edu.ar/wordpress/feed/";
                                           rssmikle_frame_width="100%";
                                           rssmikle_frame_height="297";
                                           rssmikle_target="_blank";
                                           rssmikle_font="Arial, Helvetica, sans-serif";
                                           rssmikle_font_size="12";
                                           rssmikle_border="off"; //on
                                           rssmikle_css_url="";
                                           autoscroll="on"; //off
                                           rssmikle_title="on";
                                           rssmikle_title_bgcolor="#0066FF";
                                           rssmikle_title_color="#FFFFFF";
                                           rssmikle_title_bgimage="";
                                           rssmikle_item_bgcolor="#F7F5F5";//"#FFFFFF";
                                           rssmikle_item_bgimage="http://localhost/moodle/theme/image.php/udcessential/theme/1391712447/bg/header";
                                           rssmikle_item_title_length="55";
                                           rssmikle_item_title_color="#666666";
                                           rssmikle_item_border_bottom="on";
                                           rssmikle_item_description="on";
                                           rssmikle_item_description_length="100%";
                                           rssmikle_item_description_color="#666666";
                                           rssmikle_item_date="off";
                                           rssmikle_item_description_tag="off";
                                           rssmikle_item_podcast="off";
                                      </script>
                                      <script type="text/javascript" src="http://widget.feed.mikle.com/js/rssmikle.js"></script>
                                      <!--<div style="font-size:10px; text-align:center;">
                                          <a href="http://feed.mikle.com/" target="_blank" style="color:#CCCCCC;">RSS widget</a>
                                          Please display the above link in your web page according to Terms of Service.
                                      </div>-->
                                      <!-- end feedwind code -->
                                    </div>
                                <!-- si no hay internet, muestro un div con el error -->
                                <?php else:?>
                                  <div  style="height: 300px;"> <!-- class="alert alert-danger"-->
                                      <div style="position: static;">
                                          <img src="/moodle/theme/essential/pix/udc_pagina.png" alt="Sin conexión" style="width: 80%; height: 60%;">
                                      </div>
                                      <p> <!-- style="padding-top: 120px;" -->No Hay Conexión a Internet.<br>
                                          No se pueden mostrar las noticias vía RSS</p>
                                  </div>
                                <?php endif; ?>
                    </div>
                    <!-- FIN del código RSS insertado -->
                    
                    <!-- Start Slideshow -->
                    <div class="span6">
                    <?php 
                        if($PAGE->theme->settings->toggleslideshow==1) {
                            require_once(dirname(__FILE__).'/includes/slideshow.php');
                        } else if($PAGE->theme->settings->toggleslideshow==2 && !isloggedin()) {
                            require_once(dirname(__FILE__).'/includes/slideshow.php');
                        } else if($PAGE->theme->settings->toggleslideshow==3 && isloggedin()) {
                            require_once(dirname(__FILE__).'/includes/slideshow.php');
                        } 
                    ?>
                    </div>
                    <!-- End Slideshow -->
                    
                    <!-- Start Marketing Spots -->
                    <div class="span3" style="float: right;">
                    <?php 
                        if($PAGE->theme->settings->togglemarketing==1) {
                            require_once(dirname(__FILE__).'/includes/marketingspots.php');
                        } else if($PAGE->theme->settings->togglemarketing==2 && !isloggedin()) {
                            require_once(dirname(__FILE__).'/includes/marketingspots.php');
                        } else if($PAGE->theme->settings->togglemarketing==3 && isloggedin()) {
                            require_once(dirname(__FILE__).'/includes/marketingspots.php');
                        } 
                    ?>
                    </div>
                    <!-- End Marketing Spots -->
                </div> 
                <!-- FIN del RSS y los dos SLIDES -->
            <?php endif; ?>
        </div>
        
        <!-- FUNCION nueva que antes no estaba - la comento -->
        <!-- Start Middle Blocks -->
        <?php /* 
            if($PAGE->theme->settings->frontpagemiddleblocks==1) {
                require_once(dirname(__FILE__).'/includes/middleblocks.php');
            } else if($PAGE->theme->settings->frontpagemiddleblocks==2 && !isloggedin()) {
                require_once(dirname(__FILE__).'/includes/middleblocks.php');
            } else if($PAGE->theme->settings->frontpagemiddleblocks==3 && isloggedin()) {
                require_once(dirname(__FILE__).'/includes/middleblocks.php');
            } */
        ?>
        <!-- End Middle Blocks -->
        <!-- FIN de FUNCION nueva -->

        <div class="row-fluid">
            <!-- Start Frontpage Content -->
            <?php if($PAGE->theme->settings->usefrontcontent ==1) { 
                echo $PAGE->theme->settings->frontcontentarea;
                ?>
                <div class="bor" style="margin-top: 10px;"></div>   
            <?php }?>
            <!-- End Frontpage Content -->
        </div>
        
            <!-- Start Main Regions -->
            <div id="page-content" class="row-fluid">
                <?php if ($hasfrontpageblocks==1) { ?>
                <section id="region-main" class="span12 pull-right">
                <?php } else { ?>
                <section id="region-main" class="span12 desktop-first-column">
                <?php } ?>
                    <div id="page-navbar" class="clearfix">
                        <div class="breadcrumb-nav"><?php echo $OUTPUT->navbar(); ?></div>
                        <nav class="breadcrumb-button"><?php echo $OUTPUT->page_heading_button(); ?></nav>
                    </div>
                    <?php
                    echo $OUTPUT->course_content_header();
                    echo $OUTPUT->main_content();
                    echo $OUTPUT->course_content_footer();
                    ?>
                </section>
                <?php
                if ($hasfrontpageblocks==1) {
                    echo $OUTPUT->blocks('side-pre', 'span4 desktop-first-column');
                } else {
                    echo $OUTPUT->blocks('side-pre', 'span4 pull-right');
                }
                ?>
            </div>
            <!-- End Main Regions -->

            <?php /*if (is_siteadmin()) { ?>
            <div class="hidden-blocks">
                <div class="row-fluid">
                    <h4><?php echo get_string('visibleadminonly', 'theme_essential') ?></h4>
                    <?php
                        echo $OUTPUT->essentialblocks('hidden-dock');
                    ?>
                </div>
            </div>
            <?php } */?>           

        </div>

        <a href="#top" class="back-to-top" title="<?php print_string('backtotop', 'theme_essential'); ?>"><i class="fa fa-angle-up "></i></a>
        
        <footer id="page-footer" class="container-fluid">
            <?php require_once(dirname(__FILE__).'/includes/footer.php'); ?>
        </footer>

        <?php echo $OUTPUT->standard_footer_html(); ?>
        
        <?php echo $OUTPUT->standard_end_of_body_html() ?>
    
    </div>
    
    <script type="text/javascript">
        jQuery(document).ready(function() {
            var offset = 220;
            var duration = 500;
            jQuery(window).scroll(function() {
                if (jQuery(this).scrollTop() > offset) {
                    jQuery('.back-to-top').fadeIn(duration);
                } else {
                    jQuery('.back-to-top').fadeOut(duration);
                }
            });

            jQuery('.back-to-top').click(function(event) {
                event.preventDefault();
                jQuery('html, body').animate({scrollTop: 0}, duration);
                return false;
            })
        });
    </script>
    
</body>
</html>
