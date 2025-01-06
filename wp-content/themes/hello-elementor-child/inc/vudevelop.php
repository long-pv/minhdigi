<?php
/*
 * Set post views count using post meta
 */
function set_post_views($postID)
{
    $countKey = 'post_views_count';
    $count = get_post_meta($postID, $countKey, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $countKey);
        add_post_meta($postID, $countKey, '1');
    } else {
        $count++;
        update_post_meta($postID, $countKey, $count);
    }
}

// 
/**
 * Breadcrumbs
 */
function wp_breadcrumbs()
{
    $delimiter = '
	<span class="icon">
		<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M6.6665 11.3333L9.72861 8.58922C10.0902 8.26515 10.0902 7.73485 9.72861 7.41077L6.6665 4.66666" stroke="#818181" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>
	</span>
	';

    $home = __('Home', 'basetheme');
    $before = '<span class="current">';
    $after = '</span>';
    if (!is_admin() && !is_home() && (!is_front_page() || is_paged())) {

        global $post;

        echo '<nav>';
        echo '<div id="breadcrumbs" class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">';

        $homeLink = home_url();
        echo '<a href="' . $homeLink . '">' . $home . '</a>' . $delimiter . ' ';

        switch (true) {
            case is_category() || is_archive():
                $cat_obj = get_queried_object();
                echo $before . $cat_obj->name . $after;
                break;

            case is_single() && !is_attachment():
                $post_type = $post->post_type;

                if ($post_type == 'post') {
                    $categories = get_the_category($post->ID);

                    if (!empty($categories)) {
                        $first_category = $categories[0];
                        echo '<a aria-label="' . $first_category->name . '" href="' . get_category_link($first_category->term_id) . '">' . $first_category->name . '</a>' . $delimiter . ' ';
                    }
                }

                if ($post_type == 'product') {
                    $categories = get_the_terms($post->ID, 'product_cat');

                    if (!empty($categories)) {
                        $first_category = $categories[0];
                        echo '<a aria-label="' . $first_category->name . '" href="' . get_term_link($first_category->term_id, 'product_cat') . '">' . $first_category->name . '</a>' . $delimiter . ' ';
                    }
                }

                echo $before . $post->post_title . $after;
                break;

            case is_page():
                if ($post->post_parent) {
                    $parent_id = $post->ID;
                    echo generate_page_parent($parent_id, $delimiter);
                }

                echo $before . get_the_title() . $after;
                break;

            case is_search():
                echo $before . 'Search' . $after;
                break;

            case is_404():
                echo $before . 'Error 404' . $after;
                break;
        }

        echo '</div>';
        echo '</nav>';
    }
} // end wp_breadcrumbs()

// Generate breadcrumbs ancestor page
function generate_page_parent($parent_id, $delimiter)
{
    $breadcrumbs = [];
    $output = '';

    while ($parent_id) {
        $page = get_post($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id = $page->post_parent;
    }


    $breadcrumbs = array_reverse($breadcrumbs);
    array_pop($breadcrumbs);

    foreach ($breadcrumbs as $crumb) {
        $output .= $crumb . $delimiter;
    }

    return rtrim($output);
}

//
function custom_comment_form_defaults($defaults)
{
    $defaults['title_reply'] = 'Bình luận'; // Đổi tiêu đề
    $defaults['label_submit'] = 'Bình luận'; // Đổi tên nút gửi
    return $defaults;
}
add_filter('comment_form_defaults', 'custom_comment_form_defaults');

//
function custom_comment_form_fields($fields)
{
    unset($fields['author']); // Xóa trường Name
    unset($fields['email']);  // Xóa trường Email
    unset($fields['url']);    // Xóa trường Website
    return $fields;
}
add_filter('comment_form_default_fields', 'custom_comment_form_fields');

// Thay đổi placeholder của comment box
function custom_comment_form_textarea($args)
{
    $args['comment_field'] = '<textarea id="comment" name="comment" rows="4" placeholder="Hãy trở thành người đầu tiên bình luận"></textarea>';
    return $args;
}
add_filter('comment_form_defaults', 'custom_comment_form_textarea');

//
function custom_remove_comment_form_notes($args)
{
    // Ẩn dòng "Logged in as..."
    $args['logged_in_as'] = '';

    // Ẩn dòng "Required fields are marked *"
    $args['comment_notes_before'] = '';

    return $args;
}
add_filter('comment_form_defaults', 'custom_remove_comment_form_notes');

//
// // Đổi từ "says:"
add_filter('comment_author_says_text', function () {
    return 'nói rằng:'; // Thay đổi từ "says" sang "nói rằng"
});

//
add_filter('gettext', function ($translated_text, $text, $domain) {
    if ($text === 'One Response') {
        $translated_text = 'Một bình luận'; // Thay đổi theo ý bạn
    }
    if ($text === '% Responses') {
        $translated_text = '% bình luận'; // Thay đổi tiêu đề nhiều bình luận
    }
    // Kiểm tra chuỗi cần thay đổi
    if ($text === 'says:') {
        $translated_text = 'nói rằng:'; // Thay đổi sang chuỗi mong muốn
    }
    return $translated_text;
}, 10, 3);

// Đổi từ "Reply"
add_filter('comment_reply_link', function ($link) {
    return str_replace('Reply', 'Trả lời', $link); // Thay đổi từ "Reply" sang "Trả lời"
});

// Đổi định dạng ngày
add_filter('get_comment_date', function ($date) {
    return date_i18n('d/m/Y', strtotime($date)); // Thay đổi định dạng ngày
});

// Đổi định dạng giờ
add_filter('get_comment_time', function ($time) {
    return date_i18n('H:i', strtotime($time)); // Thay đổi định dạng giờ
});
