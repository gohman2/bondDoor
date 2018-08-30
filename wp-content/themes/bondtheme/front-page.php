<?php get_header(); ?>
<?php
    $menuItems = getMenuItem();

?>
<div class="wrapper">
    <div id="map" style='width: 100vw; height: 100vh;' />
    <?php if( !empty( $menuItems ) ){ ?>
    <div class="main-nav">
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
                                <a href="#"><?php echo $childItem; ?></a>
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
    <div class="city-popup-wrapper">
        <div class="city-popup">
            <h3 class="popup-title">Birmingham</h3>
        </div>
    </div>
    <div class="main-popup">
        <div class="popup">
            <img class="popup-bond" src="/wp-content/themes/bondtheme/images/bond.svg" alt="bond">
            <div class="popup-content">
                <img src="/wp-content/themes/bondtheme/images/logo.svg" alt="bond next door" class="popup-logo">
                <div class="popup-text">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci animi aperiam atque deleniti doloribus ducimus enim error et harum in, ipsum maiores numquam officiis quo quod totam velit voluptates voluptatum ipsum maiores numquam officiis quo quod totam velit voluptates voluptatum?
                </div>
                <div class="popup-numbers">
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
