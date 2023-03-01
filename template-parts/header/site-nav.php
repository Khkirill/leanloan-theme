<?php if ( has_nav_menu( 'primary' ) ) : ?>
	<nav id="site-navigation" class="primary-navigation" role="navigation"
         aria-label="<?php esc_attr_e( 'Primary menu', 'ln' ); ?>">
		<div class="menu-button-container">
			<button id="primary-mobile-menu" class="button" aria-controls="primary-menu-list" aria-expanded="false">
			</button><!-- #primary-mobile-menu -->
		</div><!-- .menu-button-container -->
		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'primary',
				'menu_class'      => 'menu-wrapper',
				'container_class' => 'primary-menu-container',
				'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
				'fallback_cb'     => false,
			)
		);
		?>
	</nav><!-- #site-navigation -->
<?php endif; ?>
<nav class="nav-top js-nav-top">
    <div class="nav-top__inner">
        <a href="/" class="nav-top__logo-link">
            <img class="nav-top__logo nav-top__logo-mobile" src="https://leanloan.com.ua/images/small-logo.png" alt="">
            <img class="nav-top__logo nav-top__logo-desktop" src="https://leanloan.com.ua/images/logo.png" alt="">
        </a>
        <button class="nav-top__toggle js-nav-top__toggle">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <div class="nav-top__menu-wrapper">
            <ul class="nav-top__menu">
                <li class="nav-top__menu-item">
                    <a href="/help.php" class="nav-top__menu-link">Поддержка</a>
                </li>
                <li class="nav-top__menu-item">
                    <a href="/contacts.php" class="nav-top__menu-link">Контакты</a>
                </li>
                <li class="nav-top__menu-item">
                    <a href="/about.php" class="nav-top__menu-link">О нас</a>
                </li>
                <li class="nav-top__menu-item">
                    <a href="/all-services.php" class="nav-top__menu-link shine-link">Все сервисы</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
