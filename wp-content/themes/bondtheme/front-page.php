<?php get_header(); ?>
<?php
    $menuItems = getMenuItem();

?>
<div class="wrapper">

    <div id="map" style='width: 100vw; height: 100vh;' />
    <?php if( !empty( $menuItems ) ){ ?>
    <div class="main-nav">
        <div class="menu-arrow"></div>
        <div class="logo">
            <img src="/wp-content/themes/bondtheme/images/logo.svg" alt="Bond next door">
        </div>
        <nav class="navigation">
            <ul>
                <?php foreach ( $menuItems as $item ){ ?>
                <li class="navigation-item">
                    <a href="#"><?php echo $item['category']; ?></a>
                    <?php if( !empty( $item['child'] ) ){ ?>
                    <div class="navigation-sub">
                        <ul class="navigation-cities">
                            <li class="navigation-city">
                                <?php foreach ( $item['child'] as $childItem ){ ?>
                                <a data-id="<?php echo $childItem['cityId']; ?>" href="#"><?php echo $childItem['name']; ?></a>
                                <?php } ?>
                            </li>
                        </ul>
                    </div>
                    <?php } ?>
                </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
    <?php } ?>


    <div class="socials">
        <ul>
            <?php $social = get_field('social_link', 'options');	 ?>
            <li><a href="<?php echo !empty($social['facebook']) ? $social['facebook'] : "#" ; ?>"><img src="/wp-content/themes/bondtheme/images/facebook.svg" alt="facebook"></a></li>
            <li><a href="<?php echo !empty($social['twitter']) ? $social['twitter'] : "#" ; ?>"><img src="/wp-content/themes/bondtheme/images/twitter.svg" alt="twitter"></a></li>
            <li><a href="<?php echo !empty($social['information']) ? $social['information'] : "#" ; ?>"><img src="/wp-content/themes/bondtheme/images/information.svg" alt="information"></a></li>
        </ul>
    </div>
    <div class="city-popup-box">
        <div class="city-popup-wrapper">
            <div class="city-popup">
                <h3 class="popup-title">Birmingham</h3>
                <span id="basicFeature" data-startFeture="10" data-startScore="10"></span>
                <div class="city-popup-data">
                    <div class="city-popup-info">Density <span>3649 km2</span></div>
                    <div class="city-popup-info">Population <span>1086 m</span></div>
                    <div class="city-popup-info">Density <span>3649 km2</span></div>
                    <div class="city-popup-info">Population <span>1086 m</span></div>
                </div>
                <div class="city-popup-main">
                    <div class="city-popup-map">
                        <div class="map-wrapper">
                            <div style="width: 550px; height: 240px" id="mapInner"></div>
<!--                            <img src="/wp-content/themes/bondtheme/images/map-img.jpg" alt="map-img">-->
                        </div>
                    </div>
                    <div class="city-diagram-container">
                        <div class="city-diagram">
                            <div id="diagram"></div>
                        </div>
                        <div class="city-features">
                            <ul>
                                <li data-percent="10" class="navigation-item"><span></span>Handsome</li>
                                <li data-percent="20" class="navigation-item"><span></span>Handsome2</li>
                                <li data-percent="50" class="navigation-item"><span></span>Handsome3</li>
                                <li data-percent="90" class="navigation-item"><span></span>Handsome4</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="popup-text">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dolore dolorum nam numquam repellat sit temporibus. Aperiam deleniti doloremque ducimus et exercitationem harum, id illo, incidunt perferendis quasi sunt voluptatibus.
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dolore dolorum nam numquam repellat sit temporibus. Aperiam deleniti doloremque ducimus et exercitationem harum, id illo, incidunt perferendis quasi sunt voluptatibus.
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dolore dolorum nam numquam repellat sit temporibus. Aperiam deleniti doloremque ducimus et exercitationem harum, id illo, incidunt perferendis quasi sunt voluptatibus.
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci dolore dolorum nam numquam repellat sit temporibus. Aperiam deleniti doloremque ducimus et exercitationem harum, id illo, incidunt perferendis quasi sunt voluptatibus.
                    </p>
                </div>
                <div class="popup-close">
                    <img src="/wp-content/themes/bondtheme/images/close.svg" alt="close popup">
                </div>
            </div>
        </div>
    </div>
    <div class="main-popup">
        <div class="popup">
            <img class="popup-bond" src="/wp-content/themes/bondtheme/images/bond.svg" alt="bond">
            <div class="popup-content">
                <img src="/wp-content/themes/bondtheme/images/logo.svg" alt="bond next door" class="popup-logo">
                <div class="popup-text">
                    <?php
                        if( get_field('welcome_text', 'options') ){
                            echo get_field('welcome_text', 'options');
                        }
                    ?>
                </div>
                <div class="popup-numbers">
                    <img src="/wp-content/themes/bondtheme/images/fingerprint.svg" alt="fingerprint" class="fingerprint">
                    <span><img src="/wp-content/themes/bondtheme/images/0.svg" alt="0"></span>
                    <span><img src="/wp-content/themes/bondtheme/images/0.svg" alt="0"></span>
                    <span><img src="/wp-content/themes/bondtheme/images/7.svg" alt="7"></span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
