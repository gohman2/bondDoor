<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package bondTheme
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<header class="page-header">
                    <a href="/" class="logo404"><img src="/wp-content/themes/bondtheme/images/logo.svg" alt="bond next door"></a>
                    <div class="popup-numbers numbers404">
                        <span><img src="/wp-content/themes/bondtheme/images/4.svg" alt="4"></span>
                        <span><img src="/wp-content/themes/bondtheme/images/0.svg" alt="0"></span>
                        <span><img src="/wp-content/themes/bondtheme/images/4.svg" alt="4"></span>
                    </div>
                    <h1 class="title404"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'bondtheme' ); ?></h1>
                    <p><?php esc_html_e( 'It looks like nothing was found at this location.', 'bondtheme' ); ?></p>
                </header><!-- .page-header -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
