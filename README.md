# nevo-child
Nevo Child is the official child theme of Nevo Theme, providing you with a solid foundation to customize and extend your website. With Nevo Child, you have complete freedom to modify the source code and create unique designs without affecting the original theme. Additionally, the theme comes with built-in language translation files and folders, making it easy for you to translate your website into Vietnamese. Simply navigate to nevo-child/inc/languages/nevo-languages.php and replace the English content with Vietnamese.

Users can use favicon directly on child theme with extension file, add favicon.ico and favicon.png file extension at nevo-child/assets/images/favicon

Nevo Child là chủ đề con chính thức của Nevo Theme, mang đến cho bạn nền tảng vững chắc để tùy chỉnh và mở rộng trang web của mình. Với Nevo Child, bạn hoàn toàn tự do điều chỉnh mã nguồn, tạo nên những giao diện độc đáo mà không ảnh hưởng đến chủ đề gốc. Ngoài ra, chủ đề còn tích hợp sẵn thư mục và file dịch ngôn ngữ, giúp bạn dễ dàng Việt hóa website. Chỉ cần truy cập nevo-child/inc/languages/nevo-languages.php và thay đổi nội dung từ tiếng Anh sang tiếng Việt.

Người dùng có thể sử dụng favicon ngay trên child theme với tệp mở rộng, thêm đuôi tệp favicon.ico và favicon.png trên địa chỉ nevo-child/assets/images/favicon

# Custom - You can customize by accessing the functions.php file

$defaults =  [
            'block_external_HTTP'       => false,
	    
            'defer_CSS'                 => false,
            'defer_JS'                  => false,
			'classic_widget'      		=> false,
            'disable_comments'          => false,
			'disable_classic_styles'    => false,
            'disable_block_styling'     => false,
			'disable_global_styles'     => false,
            'disable_embed'             => false,
            'disable_emoji'             => true,
            'disable_feeds'             => false,
            'disable_heartbeat'         => false,
            'disable_jquery'            => false,
            'disable_jquery_migrate'    => false,
            'disable_rest_api'          => false,
            'disable_RSD'               => true,
            'disable_shortlinks'        => true,  
            'disable_theme_editor'      => false,                     
            'disable_version_numbers'   => true,            
            'disable_WLW_manifest'      => true,
            'disable_WP_version'        => true,            
            'disable_XMLRPC'            => true,
            'jquery_to_footer'          => true,
            'limit_comments_JS'         => true,
            'limit_revisions'           => true,
            'remove_comments_style'     => true,
            'slow_heartbeat'            => true,
			'instant_page'           	=> true,
			'smooth_scroll'         	=> true
        ];
