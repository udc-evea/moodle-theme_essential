<!-- CODIGO ORIGINAL DEL ARCHIVO -->
<?php
//$hasmarketing1image = (!empty($PAGE->theme->settings->marketing1image));
//$hasmarketing2image = (!empty($PAGE->theme->settings->marketing2image));
//$hasmarketing3image = (!empty($PAGE->theme->settings->marketing3image)); 
?>
<!--
<div class="row-fluid" id="middle-blocks">
    <div class="span4">
        <!-- Advert #1 
        <div class="service">
            <!-- Icon & title. Font Awesome icon used. --
            <h5><span><i class="fa fa-<?php /*echo $PAGE->theme->settings->marketing1icon ?>"></i> <?php echo $PAGE->theme->settings->marketing1 ?></span></h5>
            <?php if ($hasmarketing1image) { ?>
            	<div class="marketing-image1"></div>
            <?php } ?>
            
            <?php echo $PAGE->theme->settings->marketing1content ?>
            <p align="right">
				<a href="<?php echo $PAGE->theme->settings->marketing1buttonurl ?>" target="<?php echo $PAGE->theme->settings->marketing1target ?>" id="button">
					<?php echo $PAGE->theme->settings->marketing1buttontext ?>
				</a>
			</p>
        </div>
    </div>
    
    <div class="span4">
        <!-- Advert #2 --
        <div class="service">
            <!-- Icon & title. Font Awesome icon used. --
            <h5><span><i class="fa fa-<?php echo $PAGE->theme->settings->marketing2icon ?>"></i> <?php echo $PAGE->theme->settings->marketing2 ?></span></h5>
            <?php if ($hasmarketing2image) { ?>
            	<div class="marketing-image2"></div>
            <?php } ?>
            
            <?php echo $PAGE->theme->settings->marketing2content ?>
            <p align="right">
				<a href="<?php echo $PAGE->theme->settings->marketing2buttonurl ?>" target="<?php echo $PAGE->theme->settings->marketing2target ?>" id="button">
					<?php echo $PAGE->theme->settings->marketing2buttontext ?>
				</a>
			</p>
        </div>
    </div>
    
    <div class="span4">
        <!-- Advert #3 
        <div class="service">
            <!-- Icon & title. Font Awesome icon used. 
            <h5><span><i class="fa fa-<?php echo $PAGE->theme->settings->marketing3icon ?>"></i> <?php echo $PAGE->theme->settings->marketing3 ?></span></h5>
            <?php if ($hasmarketing3image) { ?>
            	<div class="marketing-image3"></div>
            <?php } ?>
            
            <?php echo $PAGE->theme->settings->marketing3content ?>
            <p align="right">
				<a href="<?php echo $PAGE->theme->settings->marketing3buttonurl ?>" target="<?php echo $PAGE->theme->settings->marketing3target ?>" id="button">
					<?php echo $PAGE->theme->settings->marketing3buttontext */?> 
			<!--	</a>
			</p>
        </div>
    </div>
</div>
-->
  

<!--  
 *******************************************************************************
              LOS SPOT EN FORMA DE SLIDE - (Nico)
*******************************************************************************
-->
<?php
$cant = 0;
    $spot1 = false;$spot2 = false;$spot3 = false;
    if (!empty($PAGE->theme->settings->marketing1image)){
        $spot1 = true;
        $cant++;
    }
    if (!empty($PAGE->theme->settings->marketing2image)){
        $spot2 = true;
        $cant++;
    }
    if (!empty($PAGE->theme->settings->marketing3image)){
        $spot3 = true;
        $cant++;
    }
?>
<?php if($cant > 0): ?>
    <div id="contenedor" style ="display: block;" class="da-slider" style="background-position: 50% 0%;margin-top: 50px;">
        <div id="carouselSpot" class="carousel slide">
            <ol class="carousel-indicators">
                <!--<li data-target="#carouselSpot" data-slide-to="0" class="active"></li>
                <li data-target="#carouselSpot" data-slide-to="1"></li>
                <li data-target="#carouselSpot" data-slide-to="2"></li>-->
            </ol>
            <!-- Carousel items -->
            <div class="carousel-inner">
                <?php if($spot1):?>
                    <div class="active item">
                        <!-- Advert #1 -->
                            <!-- Icon & title. Font Awesome icon used. -->
                            <div><h3 style="color: #2E9AFE; font-size: 13pt" align="center"><strong><?php echo $PAGE->theme->settings->marketing1 ?></strong></h3></div>                        
                            <div class="marketing-image1"></div>
                            <br>
                            <div style="color: #A4A4A4; padding: 10px"><i><?php echo substr($PAGE->theme->settings->marketing1content,0,100); ?></i></div>
                            <div align="right"><p>
                                <a href="<?php echo $PAGE->theme->settings->marketing1buttonurl ?>" 
                                id="button" target="<?php echo $PAGE->theme->settings->marketing1target ?>">
                                                        <?php echo $PAGE->theme->settings->marketing1buttontext ?>
                                </a></p>
                            </div>
                    </div>
                <?php endif;?>
                <?php if($spot2):?>
                    <div class="item">
                        <!-- Advert #2 -->
                            <!-- Icon & title. Font Awesome icon used. -->
                            <div><h3 style="color: #2E9AFE; font-size: 13pt" align="center"><strong><?php echo $PAGE->theme->settings->marketing2 ?></strong></h3></div>                        
                            <div class="marketing-image2"></div>
                            <br>
                            <div style="color: #A4A4A4; padding: 10px"><i><?php echo substr($PAGE->theme->settings->marketing2content,0,100); ?></i></div>
                            <div align="right"><p>
                                <a href="<?php echo $PAGE->theme->settings->marketing2buttonurl ?>" 
                                id="button" target="<?php echo $PAGE->theme->settings->marketing2target ?>">
                                                        <?php echo $PAGE->theme->settings->marketing2buttontext ?>
                                </a></p>
                            </div>
                    </div>
                <?php endif;?>
                <?php if($spot3):?>
                    <div class="item">
                        <!-- Advert #3 -->
                            <!-- Icon & title. Font Awesome icon used. -->
                            <div><h3 style="color: #2E9AFE; font-size: 13pt" align="center"><strong><?php echo $PAGE->theme->settings->marketing3 ?></strong></h3></div>                        
                            <div class="marketing-image3"></div>
                            <br>
                            <div style="color: #A4A4A4; padding: 10px"><i><?php echo substr($PAGE->theme->settings->marketing3content,0,100); ?></i></div>
                            <div align="right"><p>
                                <a href="<?php echo $PAGE->theme->settings->marketing3buttonurl ?>" 
                                id="button" target="<?php echo $PAGE->theme->settings->marketing3target ?>">
                                                        <?php echo $PAGE->theme->settings->marketing3buttontext ?>
                                </a></p>
                            </div>
                    </div>
                <?php endif;?>
            </div>
            <?php if($cant > 1): ?>
                <!-- Carousel nav -->
                <nav class="da-arrows">
                    <span class="da-arrows-prev" href="#carouselSpot" data-slide="prev"></span>
                    <span class="da-arrows-next" href="#carouselSpot" data-slide="next"></span>
                </nav>
                <!--
                <a class="carousel-control left" href="#carouselSpot" data-slide="prev">&lsaquo;</a>
                <a class="carousel-control right" href="#carouselSpot" data-slide="next">&rsaquo;</a>
                -->
            <?php endif;?>
        </div>
    </div>
<?php endif;?>
 
<script>
    $(document).ready(function(){
        $('.carousel').carousel({
            interval: 3000
        })
    });
</script>