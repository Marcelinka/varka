<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package varka25.ru
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	
	<link rel="preload" href="<?= get_template_directory_uri() . '/fonts/Cormorant-Regular.woff2' ?>" as="font" type="font/woff2" crossorigin="anonymous">
	<link rel="preload" href="<?= get_template_directory_uri() . '/fonts/Menlo-Regular.woff2' ?>" as="font" type="font/woff2" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
<div id="page" class="site">

	<header id="masthead" class="header">
		<nav id="site-navigation" class="menu-wrapper container">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'left',
				'menu_id' => ''
			) ); ?>

			<a href="/"><div class="menu__logo">
				<?= file_get_contents( get_template_directory_uri().'/img/svg/logo.svg' ) ?>
			</div></a>

			<?php wp_nav_menu( array(
				'theme_location' => 'right',
				'menu_id' => ''
			) );
			?>

			<button class="hidden hidden_tablets menu__button">
				<?= file_get_contents( get_template_directory_uri().'/img/svg/menu.svg' ) ?>
				<?= file_get_contents( get_template_directory_uri().'/img/svg/close-button.svg' ) ?>
			</button>

			<?php if(substr($_SERVER["REQUEST_URI"], 1, 7) == 'catalog') { ?>
				<button class="hidden hidden_tablets catalog-filters-button">
					<?= file_get_contents( get_template_directory_uri().'/img/svg/three-dots-vertical.svg' ) ?>
					<?= file_get_contents( get_template_directory_uri().'/img/svg/three-dots-horizontal.svg' ) ?>
				</button>
			<?php } ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div class="hidden hidden_tablets mobile-menu mobile-menu_hidden">
		<?php
		wp_nav_menu( array(
			'theme_location' => 'left',
			'menu_id' => ''
		) ); ?>
		<?php wp_nav_menu( array(
			'theme_location' => 'right',
			'menu_id' => ''
		) );
		?>
	</div>

	<div id="content" class="content">
