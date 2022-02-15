<?php
// Admin Functions
	// Load /functions/ folder
		include('functions/loader.php');
	// Add title tag support
		add_theme_support( 'title-tag' );
	// Add support for custom styles in WordPress editor
		add_editor_style('/css/admin/editor-style.css');
	// Add default content width
		if ( ! !empty( $content_width ) ) $content_width = 1200;
	// Add support for WordPress custom menus
		add_action( 'init', 'register_my_menu' );
	// Register areas for custom menus
		function register_my_menu() {
			register_nav_menu( 'menu-header', __( 'Header Menu' ) );
			register_nav_menu( 'menu-footer', __( 'Footer Menu' ) );
			register_nav_menu( 'menu-shop', __( 'Shop Menu' ) );
		}
	// Enable post thumbnails
		add_theme_support('post-thumbnails');
		add_image_size( 'cta-size', 600, 600 );
	// Remove inline gallery styling
		add_filter( 'use_default_gallery_style', '__return_false' );
	// Remove inline caption style
		add_filter( 'img_caption_shortcode_width', '__return_false' );
// Scripts
	// Load custom javascript files
		add_action( 'wp_enqueue_scripts', 'td_load_javascript_files' );
		function td_load_javascript_files() {
			$rand = rand( 1, 9999 );
			wp_register_script( 'theme-vendor', get_template_directory_uri() . '/js/min/vendor.min.js', array('jquery'), $rand, true );
			wp_enqueue_script( 'theme-vendor' );
			wp_register_script( 'theme-functions', get_template_directory_uri() . '/js/min/custom.min.js', array('jquery'), $rand, true );
			wp_enqueue_script( 'theme-functions' );
		}
// Styles
	// Load Stylesheet
		function td_load_styles () {
			$rand = rand( 1, 9999 );
			wp_enqueue_style('td-font', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap', null, null);
			wp_enqueue_style( 'td-style', get_stylesheet_uri(), '', $rand );
		}
		add_action( 'wp_enqueue_scripts', 'td_load_styles' );
	// Gutenberg CSS removal
	function wps_deregister_styles() {
		wp_dequeue_style( 'wp-block-library' );
	}
	add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );
// Miscellaneous
	// Remove related YouTube videos
		add_filter('oembed_dataparse','td_strip_related_videos', 10, 3);
		function td_strip_related_videos($return, $data, $url) {
			if ($data->provider_name == 'YouTube') {
				$data->html = str_replace('feature=oembed', 'feature=oembed&#038;rel=0&#038;showinfo=0', $data->html);
				return $data->html;
			} else return $return;
		}
		function td_custom_youtube_settings($code){
			if(strpos($code, 'youtu.be') !== false || strpos($code, 'youtube.com') !== false){
				$return = preg_replace("@src=(['\"])?([^'\">\s]*)@", "src=$1$2&showinfo=0&rel=0&autohide=1", $code);
				return $return;
			}
			return $code;
		}
		add_filter('embed_handler_html', 'td_custom_youtube_settings');
		add_filter('embed_oembed_html', 'td_custom_youtube_settings');
	// Conditional statement for blog pages
		function is_blog_page(){
			global $wp_query;
			if (is_home() || is_category() || is_tag() || is_singular('post')) return true;
			return false;
		}
	// Custom body class
		add_filter( 'body_class', 'td_body_class' );
		function td_body_class( $classes ) {
			if (is_blog_page())
			$classes[] = 'page--blog';
			if (!is_front_page())
			$classes[] = 'not-home';
			return $classes;
		}
	// Apple Icons
		add_action('wp_head', 'td_favicon_header');
		function td_favicon_header() {
			?>
			<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri();?>/images/favicon/favicon.png" sizes="32x32" type="image/x-icon" />			
			<link rel="icon" sizes="192x192" href="<?php echo get_stylesheet_directory_uri();?>/images/favicon/icon.png">
			<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri();?>/images/favicon/icon.png">
			<meta name="msapplication-square310x310logo" content="<?php echo get_stylesheet_directory_uri();?>/images/favicon/icon_largetile.png">
			<?php
		}
// Add Current Class When On Single
	function td_menu_item_classes( $classes, $item, $args ) {
		$posts_page = get_option('page_for_posts');
		if( ( is_singular( 'post' ) || is_category() || is_tag() ) && $posts_page == $item->object_id )
		    $classes[] = 'current-menu-item';
		return array_unique( $classes );
	}
	add_filter( 'nav_menu_css_class', 'td_menu_item_classes', 10, 3 );
// Display Hamburger
	function td_display_hamburger() {
		echo '
		<div class="hamburger js-nav-toggle">
			<div class="hamburger__line hamburger__line--top"></div>
			<div class="hamburger__line hamburger__line--middle"></div>
			<div class="hamburger__line hamburger__line--bottom"></div>
		</div>';
	}
?>

<?php 
add_filter( 'site_transient_update_themes', 'remove_update_themes' );
function remove_update_themes( $value ) {
    return null;
}

add_action( 'wp_footer' , 'custom_quantity_fields_script' );
function custom_quantity_fields_script(){
    ?>
    <script type='text/javascript'>
    jQuery( function( $ ) {
        if ( ! String.prototype.getDecimals ) {
            String.prototype.getDecimals = function() {
                var num = this,
                    match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                if ( ! match ) {
                    return 0;
                }
                return Math.max( 0, ( match[1] ? match[1].length : 0 ) - ( match[2] ? +match[2] : 0 ) );
            }
        }
        // Quantity "plus" and "minus" buttons
        $( document.body ).on( 'click', '.plus, .minus', function() {
            var $qty        = $( this ).closest( '.quantity' ).find( '.qty'),
                currentVal  = parseFloat( $qty.val() ),
                max         = parseFloat( $qty.attr( 'max' ) ),
                min         = parseFloat( $qty.attr( 'min' ) ),
                step        = $qty.attr( 'step' );

            // Format values
            if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
            if ( max === '' || max === 'NaN' ) max = '';
            if ( min === '' || min === 'NaN' ) min = 0;
            if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

            // Change the value
            if ( $( this ).is( '.plus' ) ) {
                if ( max && ( currentVal >= max ) ) {
                    $qty.val( max );
                } else {
                    $qty.val( ( currentVal + parseFloat( step )).toFixed( step.getDecimals() ) );
                }
            } else {
                if ( min && ( currentVal <= min ) ) {
                    $qty.val( min );
                } else if ( currentVal > 0 ) {
                    $qty.val( ( currentVal - parseFloat( step )).toFixed( step.getDecimals() ) );
                }
            }

            // Trigger change event
            $qty.trigger( 'change' );
        });
    });
    </script>
    <?php
}

function select2Update() {
	wp_dequeue_script('select2');
	wp_register_script( 'select2Full', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js' );
	wp_enqueue_script('select2Full');
}
add_action('admin_enqueue_scripts', 'select2Update', 100);


?>