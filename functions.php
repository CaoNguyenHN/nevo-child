<?php
/**
 * Nevo child theme functions and definitions.
 *
 * Add your custom PHP in this file.
 * Only edit this file if you have direct access to it on your server (to fix errors if they happen).
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
add_action( 'wp_head', 'nevo_load_favicon' );
/**
 * Echo favicon link.
 *
 * @since 1.0.0
 *
 * @return void Return early if WP Site Icon is used.
 */
function nevo_load_favicon() {

	// Defer to the WP site icon functionality if in use.
	if ( function_exists( 'has_site_icon' ) && has_site_icon() )
		return;
	
	// Get the appropriate favicon URL.
	$favicon_url = nevo_get_favicon_url();

	// If a favicon URL is present then use it to echo the full favicon <link> code.
	if ( $favicon_url )
		echo '<link rel="icon" href="' . esc_url( $favicon_url ) . '" />' . "\n";

}

/**
 * Return the appropriate favicon URL.
 *
 * The 'nevo_pre_load_favicon' filter is made available
 * so that the child theme can define its own custom favicon URL.
 * 
 * The value of the final $favicon_url variable uses the
 * 'nevo_favicon_url' filter.
 *
 * @since 1.0.0
 *
 * @return string Path to favicon.
 */
function nevo_get_favicon_url() {
	// Get the path of the child theme and parent theme
	$child_dir_uri = get_stylesheet_directory_uri();
	$parent_dir_uri = get_template_directory_uri();

	// Check the filter to allow the child theme to automatically assign a favicon
	$pre = apply_filters('nevo_pre_load_favicon', false);

	// If there is a favicon from the filter, use it
	if ($pre !== false) {
		$favicon_url = $pre;
	}
	// Check if the child theme has a favicon
	elseif ($child_dir_uri . '/assets/images/favicon.png') {
		$favicon_url = $child_dir_uri . '/assets/images/favicon.png';
	}
	// If not, check if the parent theme has a favicon
	elseif ($parent_dir_uri . '/assets/images/favicon.png') {
		$favicon_url = $parent_dir_uri . '/assets/images/favicon.png';
	} else {
		$favicon_url = ''; // If favicon not found
	}

	// Allow editing of favicon path via filter
	$favicon_url = apply_filters('nevo_favicon_url', $favicon_url);

	return trim($favicon_url);
}

function child_theme_enqueue_scripts() {
	if ( is_page_template('template-parts/frontpage.php') ) {
		// enqueue SwiperJS CSS
		//wp_enqueue_style('swiper-bundle-css', get_stylesheet_directory_uri() . '/assets/css/swiper-bundle.min.css', null, '9.1.1');
		// enqueue Glightbox CSS
		//wp_enqueue_style('glightbox-css', get_stylesheet_directory_uri() . '/assets/css/glightbox.min.css', null, '3.2.0');
		// enqueue Aos CSS
		wp_register_style('aos-style', get_stylesheet_directory_uri() . '/assets/css/aos.css', [], '3.0');
		
		// enqueue SwiperJS JavaScript
		//wp_enqueue_script('swiper-bundle-js', get_stylesheet_directory_uri() . '/assets/js/swiper-bundle.min.js', null, '9.1.1');
		
		// enqueue Glightbox JavaScript
		//wp_enqueue_script('glightbox-js', get_stylesheet_directory_uri() . '/assets/js/glightbox.min.js', null, '3.2.0');
		
		// enqueue Aos JavaScript
		wp_register_script('aos-script', get_stylesheet_directory_uri() . '/assets/js/aos.js', [], '3.0', true);
		
		wp_enqueue_style( 'aos-style' );
		wp_enqueue_script( 'aos-script' );
		
		// default aos init
		/* 	bù đắp: -100
			thời lượng: 1100
			nới lỏng: giảm bớt
			chậm trễ: 0
			một lần: đúng
		*/
		$aos_init = apply_filters( 'nevo_child_aos_init',
		'var aoswp_params = {
		"offset":"-100",
		"duration":"1100",
		"easing":"ease",
		"delay":"0",
		"once":true};'
		);
		
		// minify the aos init inline script before inject
		$aos_init = preg_replace(['/(?:(?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:(?<!\:|\\\|\'|\")\/\/.*))/','/\>[^\S ]+/s','/[^\S ]+\</s','#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/))|\s*+;\s*+(})\s*+|\s*+([*$~^|]?+=|[{};,>~]|\s(?![0-9\.])|!important\b)\s*+|([[(:])\s++|\s++([])])|\s++(:)\s*+(?!(?>[^{}"\']++|"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')*+{)|^\s++|\s++\z|(\s)\s+#si'],['','>','<','$1$2$3$4$5$6$7'], $aos_init);
		
		// inject aos init inline script
		wp_add_inline_script( 'aos-script', wp_kses_data($aos_init), 'before' );
	}
	// Remove woo blocks-style
	wp_dequeue_style( 'wc-blocks-style' );
	// enqueue Main JavaScript
	//wp_enqueue_script('main-js', get_stylesheet_directory_uri() . '/assets/js/main.js', array(), '0.1', true);
	
	//wp_enqueue_script('lazyload-js', get_stylesheet_directory_uri() . '/assets/js/lazyload.min.js', array(), '17.5.0', true);
	//wp_enqueue_script('lazyload-init', get_stylesheet_directory_uri() . '/assets/js/lazyload-init.js', array('lazyload-js'), '1.0', true);
	
}
add_action( 'wp_enqueue_scripts', 'child_theme_enqueue_scripts' );

require get_stylesheet_directory() . '/inc/filter-images-alt/filter-for-images-alt.php';

require get_stylesheet_directory() . '/inc/languages/nevo-languages.php';

require get_stylesheet_directory() . '/inc/wp-optimize/optimize.php';

$optimisations = [
    'block_external_HTTP'       => false, // Chặn các yêu cầu đến địa chỉ http bên ngoài. Do đó, chặn tất cả các yêu cầu được thực hiện bởi các plugin đến các địa chỉ bên ngoài.
	'defer_CSS'                 => false, // Trì hoãn việc tải tất cả các kịch bản đã đăng ký bằng cách sử dụng hàm loadCSS từ Filament Group.
	'defer_JS'                  => true,  // Thêm defer="defer" cho tất cả các tệp JavaScript đã được đăng ký. (trì hoãn quá trình sử lý js)
	'classic_widget'      		=> true, // Bật màn hình cài đặt widget cổ điển trong Giao diện - Widget và Tùy biến. Vô hiệu hóa trình chỉnh sửa khối khỏi việc quản lý tiện ích con.
	'disable_comments'          => false, // Tắt chức năng bình luận và loại bỏ nó khỏi menu quản trị.
	'disable_classic_styles'    => true, // loại bỏ kiểu dáng classic theme.
	'disable_block_styling'     => true, // Loại bỏ kiểu dáng khối Gutenberg mặc định.
	'disable_global_styles'     => true, // Xóa Các Biến CSS WordPress/Gutenberg Mặc Định Và Định Nghĩa SVG Khỏi Giao Diện Người Dùng
	'disable_embed'             => true, // Loại bỏ các tệp script được đăng ký bởi hệ thống nhúng phương tiện của WordPress.
	'disable_emoji'             => true,  // Loại bỏ các tệp script được đăng ký để hiển thị biểu tượng cảm xúc.
	'disable_feeds'             => true, // Loại bỏ các nguồn cấp dữ liệu bài viết.
	'disable_heartbeat'         => true, // Hủy đăng ký các tệp script heartbeat, thường làm nhiệm vụ tự động lưu.
	'disable_jquery'            => true, // Loại bỏ tệp script jQuery mặc định. NẾU trang web hoặc plugin phụ thuộc jQuery thì không nên loại bỏ-------------.
	'disable_jquery_migrate'    => true,  // Loại bỏ tệp script jQuery Migrate. NẾU trang web hoặc plugin phụ thuộc jQuery thì không nên loại bỏ-------------.
	'disable_rest_api'          => true, // Vô hiệu hóa rest api.
	'disable_RSD'               => true,  // Loại bỏ liên kết RDS trong phần head của trang web.
	'disable_shortlinks'        => true,  // Loại bỏ các liên kết ngắn trong phần head của trang web.
	'disable_theme_editor'      => false, // Vô hiệu hóa trình chỉnh sửa tệp cho chủ đề và plugin.
	'disable_version_numbers'   => true,  // Loại bỏ phiên bản được liên kết trong các tệp script và kiểu đã được đăng ký.
	'disable_WLW_manifest'      => true,  // Loại bỏ các liên kết WLW Manifest trong phần head của trang web.
	'disable_WP_version'        => true,  // Loại bỏ phiên bản WP trong phần head của trang web.
	'disable_XMLRPC'            => true,  // Vô hiệu hóa chức năng xmlrpc.
	'jquery_to_footer'          => true,  // Di chuyển tệp script jQuery mặc định xuống cuối trang.
	'limit_comments_JS'         => true,  // Giới hạn việc sử dụng JS cho bình luận chỉ đối với các thực thể đơn lẻ
	'limit_revisions'           => true,  // Giới hạn số lần sửa đổi thành 5
	'remove_comments_style'     => true,  // Loại bỏ kiểu dáng .recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}
	'slow_heartbeat'            => true,  // Chậm lại nhịp tim thành một lần mỗi phút
	'instant_page'           	=> true,  // Tải trước khi người dùng click vào liên kết
	'smooth_scroll'         	=> true
];
$optimize = new Optimize( $optimisations );

/* add_filter('the_title', 'change_title_case');

function change_title_case($title) {
    //$title = ucwords(strtolower($title)); // tất cả chữ cái đầu thành chữ hoa
	$title = ucfirst(strtolower($title)); // chỉ chữ đầu tiên là chữ hoa
    return $title;
}

add_filter('comment_form_default_fields', 'nevo_remove_website_field', 9999);
function nevo_remove_website_field($fields) {
   unset($fields['url']);
   return $fields;
}
 */
add_action( 'manage_posts_custom_column', 'nevo_custom_columns_content', 10, 2 );
function nevo_custom_columns_content( $column_name, $post_id ) {
    if ( $column_name === 'featured_image' ) {
		$attrs = array(
			'style' => 'border-radius:6px;'
		);
        if ( has_post_thumbnail( $post_id ) ) {
            echo get_the_post_thumbnail( $post_id, array( 50, 50 ), $attrs );
        } else {
            echo '<span class="dashicons dashicons-admin-media" style="font-size: 2.5rem;"></span>';
        }
    }
}

add_filter( 'manage_post_posts_columns', 'nevo_custom_columns' );
function nevo_custom_columns( $columns ) {
    $new_columns = array();
    $thumbnail_column = array(
        'featured_image' => 'Image',
        'cb' => '<input type="checkbox" />'
    );

    $new_columns = array_merge( $thumbnail_column, $columns );
    return $new_columns;
}
add_action('admin_head', 'nevo_featured_image_column_width');
function nevo_featured_image_column_width() {
	echo '<style type="text/css">.column-featured_image{width:50px;}</style>';
}

// Add WordPress WordCount Column
add_filter('manage_posts_columns', 'nevo_add_wordcount_column');
function nevo_add_wordcount_column($nevo_columns) {
    $nevo_columns['nevo_wordcount'] = 'Word Count';
    return $nevo_columns;
}
// Show WordCount in Admin Panel
add_action('manage_posts_custom_column',  'nevo_show_wordcount');
function nevo_show_wordcount($name) 
{
    global $post;
    switch ($name) 
    {
        case 'nevo_wordcount':
            $nevo_wordcount = nevo_post_wordcount($post->ID);
            echo $nevo_wordcount;
    }
}
// Get individual post word count
function nevo_post_wordcount($post_id) {
    $nevo_post_content = get_post_field( 'post_content', $post_id );
    $nevo_final_wordcount = str_word_count( strip_tags( strip_shortcodes($nevo_post_content) ) );
    return $nevo_final_wordcount;
}