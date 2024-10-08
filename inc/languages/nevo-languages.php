<?php
/**
 * Language function for nevo theme.
 *
 * @package Nevo
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* Change text-transform title
*/
//add_filter('the_title', 'change_title_case');
function change_title_case($title) {
    //$title = ucwords(strtolower($title)); // tất cả chữ cái đầu thành chữ hoa
	$display  = Nevo()->get_setting_tab( 'magazine_settings', 'normal' );
	$display = wp_parse_args(
		$display,
		array(
			'text_decoration'       => '',
		)
	);
	if ($display['text_decoration'] === 'underline') {
		$title = ucfirst(strtolower($title)); // chỉ chữ đầu tiên là chữ hoa
	}
	//$title = ucfirst(strtolower($title)); // chỉ chữ đầu tiên là chữ hoa
    return $title;
}

/**
 * ========================================================================================================
 * Theme's native Breadcrumb 
 * ========================================================================================================
 */

/*
* Change Breadcrumb Home label.
*/
add_filter( 'nevo_breadcrumb_home_label', 'nevo_custom_breadcrumb_home_label' );
function nevo_custom_breadcrumb_home_label( $modified_text ) {
	$modified_text = __( 'Home', 'nevo' ); // Change the text here
    return $modified_text;
}
/**
 * ========================================================================================================
 * Archive Page
 * ========================================================================================================
 */
/*
* Define a custom filter for the "Previous" link title
*/
add_filter('nevo_next_posts_link_text', 'nevo_custom_next_posts_link_text');
function nevo_custom_next_posts_link_text( $modified_text ) {
	$modified_text = __( 'Older posts', 'nevo' ); // Change the text here
    return $modified_text;
}
/*
* Define a custom filter for the "Previous" link title
*/
add_filter('nevo_previous_posts_link_text', 'nevo_custom_previous_posts_link_text');
function nevo_custom_previous_posts_link_text( $modified_text ) {
	$modified_text = __( 'Newer posts', 'nevo' ); // Change the text here
    return $modified_text;
}
/**
 * ========================================================================================================
 * Search Page
 * ========================================================================================================
 */

/*
* Change Search Page Title
*/
add_filter( 'nevo_search_title_output', 'nevo_custom_search_title_output' );
function nevo_custom_search_title_output( $modified_text ) {
	$modified_text = sprintf(
		'<h1 class="page-title">%s</h1>',
		sprintf(
			/* translators: 1: Search query name */
			__( 'Search Results for: %s', 'nevo' ), // Change the text here
			'<span>' . get_search_query() . '</span>'
		)
	);
    return $modified_text;
}
/**
 * ========================================================================================================
 * Search Form
 * ========================================================================================================
 */

/*
* Change Search label
*/
add_filter( 'nevo_search_label', 'nevo_custom_search_label' );
function nevo_custom_search_label( $modified_text ) {
    $modified_text = __( 'Search for:', 'nevo' ); // Change the text here
    return $modified_text;
}
/*
* Change Search placeholder
*/
add_filter( 'nevo_search_placeholder', 'nevo_custom_search_placeholder' );
function nevo_custom_search_placeholder( $modified_text ) {
    $modified_text = __( 'Search &hellip;', 'nevo' ); // Change the text here
    return $modified_text;
}
/*
* Change Search Button
*/
add_filter( 'nevo_search_button', 'nevo_custom_search_button' );
function nevo_custom_search_button( $modified_text ) {
    $modified_text = __( 'Search', 'nevo' ); // Change the text here
    return $modified_text;
}
/**
 * ========================================================================================================
 * Single Post
 * ========================================================================================================
 */

/*
* Define a custom filter for the "Previous post" text
*/
add_filter( 'nevo_previous_post_text', 'nevo_custom_previous_post_text' );
function nevo_custom_previous_post_text( $modified_text ) {
    // Modify the text as needed
    $modified_text = __( 'Previous post', 'nevo' ); // Change the text here
    // Make sure to return the modified text
    return $modified_text;
}

/*
* Define a custom filter for the "Next post" text
*/
add_filter( 'nevo_next_post_text', 'nevo_custom_next_post_text' );
function nevo_custom_next_post_text( $modified_text ) {
    // Modify the text as needed
    $modified_text = __( 'Next post', 'nevo' ); // Change the text here
    // Make sure to return the modified text
    return $modified_text;
}
/*
* Define a custom filter for the "Share" text
*/
add_filter( 'nevo_share_text', 'nevo_custom_share_text' );
function nevo_custom_share_text( $modified_text ) {
    // Modify the text as needed
    $modified_text = __( 'Share', 'nevo' ); // Change the text here
    // Make sure to return the modified text
    return $modified_text;
}

/**
 * ========================================================================================================
 * Comments
 * ========================================================================================================
 */

/*
* Text custom function for form comment title
* Hàm tùy chỉnh văn bản cho tiêu đề comment form
*/
add_filter('nevo_comment_form_title', 'nevo_custom_comment_form_title');
function nevo_custom_comment_form_title($title) {
    $comments_number = get_comments_number();

    $custom_title = sprintf(
        esc_html(
            /* translators: 1: number of comments, 2: post title */
            _nx(
                '%1$s Comment', // Change the text here
                '%1$s Comments', // Change the text here
                $comments_number,
                'comments title',
                'nevo'
            )
        ),
        number_format_i18n($comments_number),
        get_the_title()
    );

    return $custom_title;
}

/*
* Change leave_comment_text
*/
add_filter( 'nevo_leave_comment', 'nevo_custom_leave_comment_text' );
function nevo_custom_leave_comment_text( $modified_text ) {
    $modified_text = __( 'Leave a Comment', 'nevo' ); // Change the text here
    return $modified_text;
}

/*
* Change Submit button text
*/
add_filter( 'nevo_post_comment', 'nevo_custom_post_comment' );
function nevo_custom_post_comment( $modified_text ) {
    $modified_text = __( 'Post Comment', 'nevo' ); // Change the text here
    return $modified_text;
}

/*
* Define a custom filter for comment moderation text
*/
add_filter( 'nevo_comment_moderation_text', 'nevo_custom_comment_moderation_text' );
function nevo_custom_comment_moderation_text( $modified_text ) {
    $modified_text = esc_html__( 'Your comment is awaiting moderation.', 'nevo' ); // Change the text here
    // Make sure to return the modified text
    return $modified_text;
}

/*
* Define a custom filter for the "Comments are closed." text
*/
add_filter( 'nevo_comments_closed_text', 'nevo_custom_comments_closed_text' );
function nevo_custom_comments_closed_text( $modified_text ) {
	// Modify the text as needed
    $modified_text = esc_html__( 'Comments are closed.', 'nevo' ); // Change the text here
    // Make sure to return the modified text
    return $modified_text;
}

/*
* Define a custom filter for the "Older Comments" text
*/
add_filter( 'nevo_previous_comments_link_text', 'nevo_custom_previous_comments_link_text' );
function nevo_custom_previous_comments_link_text( $modified_text ) {
    $modified_text = __( '&larr; Older Comments', 'nevo' ); // Change the text here
    // Make sure to return the modified text
    return $modified_text;
}

/*
* Define a custom filter for the "Newer Comments" text
*/
add_filter( 'nevo_next_comments_link_text', 'nevo_custom_next_comments_link_text' );
function nevo_custom_next_comments_link_text( $modified_text ) {
    $modified_text = __( 'Newer Comments &rarr;', 'nevo' ); // Change the text here
    // Make sure to return the modified text
    return $modified_text;
}

add_filter( 'nevo_comment_time_text', 'nevo_custom_comment_time_text' );
function nevo_custom_comment_time_text( $modified_text ) {
    $modified_text = __( 'ago', 'nevo' ); // Change the text here
    // Make sure to return the modified text
    return $modified_text;
}

/*
* Change the cookies consent form
* Thay đổi biểu mẫu chấp thuận cookie
*/
add_filter( 'comment_form_default_fields', 'nevo_comment_form_change_cookies_consent' );
function nevo_comment_form_change_cookies_consent( $fields ) {
	if( !is_admin() ) {
		$commenter = wp_get_current_commenter();
		$consent   = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
		$fields['cookies'] = '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
						 '<label for="wp-comment-cookies-consent">Save my name, and email in this browser for the next time I comment.</label></p>'; // Change the text here
	}
	return $fields;
}
/*
* Recent Comments Widget
* Define a custom filter for the "On" text
*/
add_filter( 'nevo_comment_on_text', 'nevo_custom_comment_on_text' );
function nevo_custom_comment_on_text( $modified_text ) {
    $modified_text = __( 'On', 'nevo' ); // Change the text here
    // Make sure to return the modified text
    return $modified_text;
}
/**
 * ========================================================================================================
 * Nothing found
 * ========================================================================================================
 */

/*
* Change Page Title
*/
add_filter( 'nevo_no_content_page_title_text', 'nevo_custom_no_content_page_title_text' );
function nevo_custom_no_content_page_title_text( $modified_text ) {
    $modified_text = __( 'Nothing Found', 'nevo' ); // Change the text here
    return $modified_text;
}

/*
* Change Page Content ON Home
*/
add_filter( 'nevo_no_content_publishable_page_content_text', 'nevo_custom_no_content_publishable_page_content_text' );
function nevo_custom_no_content_publishable_page_content_text( $modified_text ) {
    $modified_text = __( 'Ready to publish your first post?', 'nevo' ); // Change the text here
    return $modified_text;
}

/*
* Change Page Content ON Search
*/
add_filter( 'nevo_no_content_search_page_content_text', 'nevo_custom_no_content_search_page_content_text' );
function nevo_custom_no_content_search_page_content_text( $modified_text ) {
    $modified_text = __( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'nevo' ); // Change the text here
    return $modified_text;
}

/*
* Change Page Content
*/
add_filter( 'nevo_no_content_page_content_text', 'nevo_custom_no_content_page_content_text' );
function nevo_custom_no_content_page_content_text( $modified_text ) {
    $modified_text = __( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'nevo' ); // Change the text here
    return $modified_text;
}

/**
 * ========================================================================================================
 * 404
 * ========================================================================================================
 */

/*
* Change 404 Page Title
*/
add_filter( 'nevo_404_title', 'nevo_custom_404_title' );
function nevo_custom_404_title( $modified_text ) {
    $modified_text = __( 'Oops! That page can&rsquo;t be found.', 'nevo' ); // Change the text here
    return $modified_text;
}

/*
* Change 404 Page Content text
*/
add_filter( 'nevo_404_text', 'nevo_custom_404_text' );
function nevo_custom_404_text( $modified_text ) {
    $modified_text = __( 'It looks like nothing was found at this location. Maybe try searching?', 'nevo' ); // Change the text here
    return $modified_text;
}

/**
 * ========================================================================================================
 * Popup Login Form
 * ========================================================================================================
 */

/*
* Define a custom filter for the "Lost your password?" text
*/
add_filter( 'nevo_lost_password_text', 'nevo_custom_lost_password_text' );
function nevo_custom_lost_password_text( $modified_text ) {
    // Modify the text as needed
    $modified_text = esc_html__( 'Lost your password ?', 'nevo' ); // Change the text here
    // Make sure to return the modified text
    return $modified_text;
}

/*
* Define a custom filter for the "Log in" button text
*/
add_filter( 'nevo_login_button_text', 'nevo_custom_login_button_text' );
function nevo_custom_login_button_text( $modified_text ) {
    // Modify the text as needed
    $modified_text = __( 'Log in', 'nevo' ); // Change the text here
    // Make sure to return the modified text
    return $modified_text;
}

/*
* Define a custom filter for the "Remember Me" text
*/
add_filter( 'nevo_remember_me_text', 'nevo_custom_remember_me_text' );
function nevo_custom_remember_me_text( $modified_text ) {
    // Modify the text as needed
    $modified_text = __( 'Remember Me.', 'nevo' ); // Change the text here
    // Make sure to return the modified text
    return $modified_text;
}

/*
* Define a custom filter for the "Dashboard" link text
*/
add_filter( 'nevo_dashboard_link_text', 'nevo_custom_dashboard_link_text' );
function nevo_custom_dashboard_link_text( $modified_text ) {
    // Modify the text as needed
    $modified_text = __( 'Dashboard', 'nevo' ); // Change the text here
    // Make sure to return the modified text
    return $modified_text;
}

/*
* Define a custom filter for the "Your Profile" link text
*/
add_filter( 'nevo_your_profile_link_text', 'nevo_custom_your_profile_link_text' );
function nevo_custom_your_profile_link_text( $modified_text ) {
    // Modify the text as needed
    $modified_text = __( 'Your Profile', 'nevo' ); // Change the text here
    // Make sure to return the modified text
    return $modified_text;
}

/*
* Define a custom filter for the "Logout" link text
*/
add_filter( 'nevo_logout_link_text', 'nevo_custom_logout_link_text' );
function nevo_custom_logout_link_text( $modified_text ) {
    // Modify the text as needed
    $modified_text = __( 'Log out', 'nevo' ); // Change the text here
    // Make sure to return the modified text
    return $modified_text;
}