<?php

?><!DOCTYPE html>
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if (gt IE 7) | (!IE)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'hometask' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_head();
?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'hometask_before' ); ?>
<div id="container" class="hfeed">
	<div id="page" class="blog">
		<div id="header">
			<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
			<<?php echo $heading_tag; ?> id="site-title">
				<span>
					<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</span>
			</<?php echo $heading_tag; ?>>

			<div id="nav" role="navigation">
			  <?php ?>
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Перейти к содержанию', 'hometask' ); ?>"><?php _e( 'К содержанию', 'hometask' ); ?></a></div>
				<?php ?>
				<?php wp_nav_menu( array( 'theme_location' => 'primary',        // (string) Расположение меню в шаблоне. (указывается ключ которым было зарегистрировано меню в функции register_nav_menus)
                    'menu'            => '',              // (string) Название выводимого меню (указывается в админке при создании меню, приоритетнее
                    // чем указанное местоположение theme_location - если указано, то параметр theme_location игнорируется)
                    'container'       => '',           // (string) Контейнер меню. Обворачиватель ul. Указывается тег контейнера (по умолчанию в тег div)
                    'container_class' => 'menu-header',              // (string) class контейнера (div тега)
                    'container_id'    => 'main-menu',              // (string) id контейнера (div тега)
                    'menu_class'      => 'horizontal-navigation',          // (string) class самого меню (ul тега)
                    'menu_id'         => '',              // (string) id самого меню (ul тега)
                    'echo'            => true,            // (boolean) Выводить на экран или возвращать для обработки
                    'fallback_cb'     => 'wp_page_menu',  // (string) Используемая (резервная) функция, если меню не существует (не удалось получить)
                    'before'          => '',              // (string) Текст перед <a> каждой ссылки
                    'after'           => '',              // (string) Текст после </a> каждой ссылки
                    'link_before'     => '',              // (string) Текст перед анкором (текстом) ссылки
                    'link_after'      => '',              // (string) Текст после анкора (текста) ссылки
                    'depth'           => 2,               // (integer) Глубина вложенности (0 - неограничена, 2 - двухуровневое меню)
                    'walker'          => '',              // (object) Класс собирающий меню. Default: new Walker_Nav_Menu
                     ) ); ?>
			</div><!-- #nav -->

			<div id="pic">
				<a href="<?php echo home_url( '/' ); ?>" rel="home">
				<?php
					
					if ( is_singular() &&
							has_post_thumbnail( $post->ID ) &&
							( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
							$image[1] >= HEADER_IMAGE_WIDTH ) :
					
						echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
					elseif ( get_header_image() ) : ?>
						<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
				<?php endif; ?>
				</a>
			</div><!-- #pic -->
		</div><!-- #header -->

		<div id="content-box">
