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

$haslogo = (!empty($PAGE->theme->settings->logo));
$hasboringlayout = (empty($PAGE->theme->settings->layout)) ? false : $PAGE->theme->settings->layout;
$hasanalytics = (empty($PAGE->theme->settings->useanalytics)) ? false : $PAGE->theme->settings->useanalytics;
$sideregionsmaxwidth = (!empty($PAGE->theme->settings->sideregionsmaxwidth));

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
    <!-- Google web fonts -->
    <?php require_once(dirname(__FILE__).'/includes/fonts.php'); ?>
    <!-- iOS Homescreen Icons -->
    <?php require_once(dirname(__FILE__).'/includes/iosicons.php'); ?>
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
<script>alert('layout Columns 2')</script> -->
<?php echo $OUTPUT->standard_top_of_body_html() ?>

<?php //require_once(dirname(__FILE__).'/includes/header.php'); ?>
<?php include 'includes/barraFixedTop.php'; ?>
<br>
<!-- Start Main Regions -->
<div id="page" class="container-fluid">

    <div id="page-content" class="row-fluid">
        <section id="region-main" class="span12<?php if ($left) { echo ' pull-right'; } ?>">
            <div id="page-navbar" class="clearfix">
                <div class="breadcrumb-nav linksRastro"><?php echo $OUTPUT->navbar(); ?></div>
                <nav class="breadcrumb-button"><?php echo $OUTPUT->page_heading_button(); ?></nav>
            </div>
            <?php
            echo $OUTPUT->course_content_header();
            echo $OUTPUT->main_content();
            echo $OUTPUT->course_content_footer();
            ?>
        </section>
        <?php
        $classextra = '';
        if ($left) {
            $classextra = ' desktop-first-column';
        }
        echo $OUTPUT->blocks('side-pre', 'span3'.$classextra);
        ?>
    </div>
    
    <!-- End Main Regions -->

    <footer id="page-footer" class="container-fluid">
        <?php require_once(dirname(__FILE__).'/includes/footer.php'); ?>
    </footer>

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
<a href="#top" class="back-to-top" title="<?php print_string('backtotop', 'theme_essential'); ?>"><i class="fa fa-angle-up "></i></a>
</body>
</html>
