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
    // Get the paths and URIs of the child and parent themes
    $child_dir_uri  = get_stylesheet_directory_uri();
    $parent_dir_uri = get_template_directory_uri();
    $child_dir_path = get_stylesheet_directory();
    $parent_dir_path = get_template_directory();

    // Check the filter to allow the child theme to automatically assign a favicon
    $pre = apply_filters('nevo_pre_load_favicon', false);

    // If there is a favicon from the filter, use it (ensure it's a valid URL)
    if ($pre !== false) {
        return esc_url(trim($pre));
    }

    // Function to check if favicon exists in a given path and return its URI
    static $cached_favicon = null; // Cache to avoid redundant checks

    if ($cached_favicon === null) {
        $find_favicon = function($dir_path, $dir_uri) {
            foreach (['png', 'ico'] as $ext) {
                $favicon_path = "$dir_path/assets/images/favicon.$ext";
                if (@is_file($favicon_path)) { // Use @ to suppress warnings if path is inaccessible
                    return "$dir_uri/assets/images/favicon.$ext";
                }
            }
            return false;
        };

        // Check child theme, then parent theme for favicon
        $cached_favicon = $find_favicon($child_dir_path, $child_dir_uri) ?: 
                          $find_favicon($parent_dir_path, $parent_dir_uri) ?: '';
    }

    // Allow editing of favicon path via filter
    return esc_url(trim(apply_filters('nevo_favicon_url', $cached_favicon)));
}

function child_theme_enqueue_scripts() {
	
	// Remove woo blocks-style
	wp_dequeue_style( 'wc-blocks-style' );
	// enqueue Main JavaScript
	//wp_enqueue_script('main-js', get_stylesheet_directory_uri() . '/assets/js/main.js', array(), '0.1', true);
	
}
add_action( 'wp_enqueue_scripts', 'child_theme_enqueue_scripts' );

require get_stylesheet_directory() . '/inc/filter-images-alt/filter-for-images-alt.php';

require get_stylesheet_directory() . '/inc/languages/nevo-languages.php';

require get_stylesheet_directory() . '/inc/wp-optimize/optimize.php';

$true = true;
if(class_exists( 'WooCommerce' ) || function_exists( 'wc' ) || did_action('elementor/loaded') ){
	$true = false;
}

$optimisations = [
    'block_external_HTTP'       => false, // Chặn các yêu cầu đến địa chỉ HTTP bên ngoài. Do đó, chặn tất cả các yêu cầu được thực hiện bởi các plugin đến các địa chỉ bên ngoài.
                                        // Block requests to external HTTP addresses. This blocks all requests made by plugins to external addresses.
    'defer_CSS'                 => false, // Trì hoãn việc tải tất cả các kịch bản đã đăng ký bằng cách sử dụng hàm loadCSS từ Filament Group.
                                        // Defer the loading of all registered scripts using the loadCSS function from Filament Group.
    'defer_JS'                  => false,  // Thêm defer="defer" cho tất cả các tệp JavaScript đã được đăng ký. (trì hoãn quá trình xử lý JS)
                                        // Add defer="defer" to all registered JavaScript files. (delays JS execution)
    'classic_widget'            => true, // Bật màn hình cài đặt widget cổ điển trong Giao diện - Widget và Tùy biến. Vô hiệu hóa trình chỉnh sửa khối khỏi việc quản lý tiện ích con.
                                        // Enable the classic widget screen in Appearance - Widgets and Customizer. Disable block editor for widget management.
    'disable_comments'          => false, // Tắt chức năng bình luận và loại bỏ nó khỏi menu quản trị.
                                        // Disable the comment feature and remove it from the admin menu.
    'disable_classic_styles'    => true, // Loại bỏ kiểu dáng của giao diện classic theme.
                                        // Remove styles associated with classic themes.
    'disable_block_styling'     => true, // Loại bỏ kiểu dáng mặc định của các khối Gutenberg.
                                        // Remove default Gutenberg block styles.
    'disable_global_styles'     => true, // Xóa các biến CSS WordPress/Gutenberg mặc định và định nghĩa SVG khỏi giao diện người dùng.
                                        // Remove default WordPress/Gutenberg CSS variables and SVG definitions from the frontend.
    'disable_embed'             => true, // Loại bỏ các tệp script được đăng ký bởi hệ thống nhúng phương tiện của WordPress.
                                        // Remove scripts registered by WordPress media embedding.
    'disable_emoji'             => true, // Loại bỏ các tệp script được đăng ký để hiển thị biểu tượng cảm xúc.
                                        // Remove scripts registered for emoji rendering.
    'disable_feeds'             => true, // Loại bỏ các nguồn cấp dữ liệu bài viết.
                                        // Remove post feeds.
    'disable_heartbeat'         => true, // Hủy đăng ký các tệp script heartbeat, thường làm nhiệm vụ tự động lưu.
                                        // Unregister heartbeat scripts, typically used for autosave tasks.
    'disable_jquery'            => $true, // Loại bỏ tệp script jQuery mặc định. Nếu trang web hoặc plugin phụ thuộc jQuery thì không nên loại bỏ.
                                        // Remove the default jQuery script. Do not remove if the site or plugins rely on jQuery.
    'disable_jquery_migrate'    => $true, // Loại bỏ tệp script jQuery Migrate. Nếu trang web hoặc plugin phụ thuộc jQuery thì không nên loại bỏ.
                                        // Remove jQuery Migrate script. Do not remove if the site or plugins rely on jQuery.
    'disable_rest_api'          => $true, // Vô hiệu hóa REST API.
                                        // Disable REST API.
    'disable_RSD'               => true, // Loại bỏ liên kết RSD trong phần head của trang web.
                                        // Remove RSD links from the website's head section.
    'disable_shortlinks'        => true, // Loại bỏ các liên kết ngắn trong phần head của trang web.
                                        // Remove shortlinks from the website's head section.
    'disable_theme_editor'      => false, // Vô hiệu hóa trình chỉnh sửa tệp cho chủ đề và plugin.
                                        // Disable the file editor for themes and plugins.
    'disable_version_numbers'   => true, // Loại bỏ phiên bản được liên kết trong các tệp script và kiểu đã được đăng ký.
                                        // Remove version numbers linked in registered scripts and styles.
    'disable_WLW_manifest'      => true, // Loại bỏ các liên kết WLW Manifest trong phần head của trang web.
                                        // Remove WLW Manifest links from the website's head section.
    'disable_WP_version'        => true, // Loại bỏ phiên bản WP trong phần head của trang web.
                                        // Remove WP version from the website's head section.
    'disable_XMLRPC'            => true, // Vô hiệu hóa chức năng XML-RPC.
                                        // Disable XML-RPC functionality.
    'jquery_to_footer'          => true, // Di chuyển tệp script jQuery mặc định xuống cuối trang.
                                        // Move the default jQuery script to the footer.
    'limit_comments_JS'         => true, // Giới hạn việc sử dụng JS cho bình luận chỉ đối với các thực thể đơn lẻ.
                                        // Limit comment JS usage to single entities only.
    'limit_revisions'           => true, // Giới hạn số lần sửa đổi thành 5.
                                        // Limit post revisions to 5.
    'remove_comments_style'     => true, // Loại bỏ kiểu dáng .recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}
                                        // Remove styles like .recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}
    'slow_heartbeat'            => true, // Chậm lại nhịp tim thành một lần mỗi phút.
                                        // Slow down the heartbeat to one per minute.
    'instant_page'              => true, // Tải trước khi người dùng click vào liên kết.
                                        // Preload pages before the user clicks links.
    'smooth_scroll'             => true  // Kích hoạt cuộn trang mượt mà.
                                        // Enable smooth scrolling on the website.
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
