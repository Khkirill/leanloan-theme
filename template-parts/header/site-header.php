<?php
$wrapper_classes  = 'site-header';
$wrapper_classes .= has_custom_logo() ? ' has-logo' : '';
$wrapper_classes .= true === get_theme_mod( 'display_title_and_tagline', true ) ? ' has-title-and-tagline' : '';
$wrapper_classes .= has_nav_menu( 'primary' ) ? ' has-menu' : '';
?>

<header id="masthead" class="<?php echo esc_attr( $wrapper_classes ); ?>" role="banner">

    <?php get_template_part( 'template-parts/header/site-branding' ); ?>
    <?php get_template_part( 'template-parts/header/site-nav' ); ?>

    <div class="head-section">
        <div class="container">
            <?php if(is_front_page()): ?>
                <h1 class="headtext-top">Новости</h1>
                <p class="headtext-under">
                    Актуальные новости, статьи и исследования в сфере финансовых компаний Украины</p>
            <?php elseif(is_category()): ?>
                <h1 class="headtext-top">
                    <?php single_cat_title() ?>
                </h1>
                <div class="headtext-under">
                    <?= get_the_archive_description() ?>
                </div>
            <?php elseif(is_single()): /*?>
                <h1 class="headtext-top">
	                <?php the_title() ?>
                </h1>
                <div class="headtext-under">
	                <?php the_excerpt();  ?>
                </div>
	        <?php */ endif; ?>
        </div>
    </div>

    <div style="position: relative;">
        <div class="sdl-shape">
            <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>

</header><!-- #masthead -->

