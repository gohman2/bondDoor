<?php get_header(); ?>
<?php
    $menuItems = getMenuItem();

?>
<div class="wrapper">

    <div id="map" style='width: 100vw; height: 100vh;'></div>
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
            <li><a class="info-popup-opener" href="#"><img src="/wp-content/themes/bondtheme/images/information.svg" alt="information"></a></li>
        </ul>
    </div>
    <div class="city-popup-box">
        <div class="city-popup-wrapper">
            <div class="city-popup">
                <div class="city-popup-top">
                    <h3 class="popup-title"></h3>
                    <span id="basicFeature" data-startFeture="" data-startScore=""></span>
                    <div class="city-popup-data"></div>
                </div>
                <div class="city-popup-main">
                    <div class="city-popup-map">
                        <div class="map-wrapper">
                            <div style="width: 550px; height: 240px" id="mapInner"></div>
                        </div>
                    </div>
                    <div class="city-diagram-container">
                        <div class="city-diagram">
                            <div id="diagram"></div>
                        </div>
                        <div class="city-features">
                            <ul></ul>
                        </div>
                    </div>
                </div>
                <div class="popup-text">
                    <div></div>
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
    <div class="info-popup-box">
        <div class="info-popup-wrapper">
            <div class="info-popup">
                <?php $about_section = get_field('about_section', 'options'); ?>
                <h3 class="popup-title"><?php echo $about_section['title'] ?></h3>
                <div class="popup-text">
                    <?php echo $about_section['content'] ?>
                </div>
                <div class="popup-close">
                    <img src="/wp-content/themes/bondtheme/images/close.svg" alt="close popup">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="preloader-wrapper">
    <div class="preloader">
        <img src="/wp-content/themes/bondtheme/images/preloader.svg" alt="Loading..." class="loader">
    </div>
</div>
<?php
get_footer();
