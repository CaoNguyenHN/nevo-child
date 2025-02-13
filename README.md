# nevo-child
Nevo Child is the official child theme of Nevo Theme, providing you with a solid foundation to customize and extend your website. With Nevo Child, you have complete freedom to modify the source code and create unique designs without affecting the original theme. Additionally, the theme comes with built-in language translation files and folders, making it easy for you to translate your website into Vietnamese. Simply navigate to nevo-child/inc/languages/nevo-languages.php and replace the English content with Vietnamese.

Users can use favicon directly on child theme with extension file, add favicon.ico and favicon.png file extension at nevo-child/assets/images/favicon

Nevo Child là chủ đề con chính thức của Nevo Theme, mang đến cho bạn nền tảng vững chắc để tùy chỉnh và mở rộng trang web của mình. Với Nevo Child, bạn hoàn toàn tự do điều chỉnh mã nguồn, tạo nên những giao diện độc đáo mà không ảnh hưởng đến chủ đề gốc. Ngoài ra, chủ đề còn tích hợp sẵn thư mục và file dịch ngôn ngữ, giúp bạn dễ dàng Việt hóa website. Chỉ cần truy cập nevo-child/inc/languages/nevo-languages.php và thay đổi nội dung từ tiếng Anh sang tiếng Việt.

Người dùng có thể sử dụng favicon ngay trên child theme với tệp mở rộng, thêm đuôi tệp favicon.ico và favicon.png trên địa chỉ nevo-child/assets/images/favicon

# Custom - You can customize by accessing the functions.php file

```php
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
    'disable_rest_api'          => true, // Vô hiệu hóa REST API.
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
```
