<?php
/**
 * Template Name: SEO MENTOR
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package seothanhcong
 */

get_header();
?>

<!--  -->
<div class="about_page">
    <!-- Banner Start -->
    <?php
    $banner = get_field('banner') ?? '';

    // Kiểm tra tồn tại và gán giá trị
    $title = isset($banner['title']) ? $banner['title'] : '';
    $list_content = isset($banner['list_content']) ? $banner['list_content'] : [];
    $button = isset($banner['button']) ? $banner['button'] : [];
    $image = isset($banner['image']) ? $banner['image'] : null;
    ?>

    <section class="section__space">
        <div class="banner">
            <div class="container">
                <div class="row banner__inner">
                    <div class="col-lg-6">
                        <!-- Title -->
                        <?php if (!empty($title)): ?>
                            <h2 class="banner__title"><?php echo esc_html($title); ?></h2>
                        <?php endif; ?>

                        <!-- List -->
                        <?php if (!empty($list_content) && is_array($list_content)): ?>
                            <ul class="banner__list">
                                <?php foreach ($list_content as $item):
                                    $icon = isset($item['icon']) ? $item['icon'] : '';
                                    $text = isset($item['content']) ? $item['content'] : '';
                                    ?>
                                    <li class="list__item">
                                        <?php if (!empty($icon)): ?>
                                            <img class="list__icon" src="<?php echo esc_url($icon); ?>"
                                                alt="<?php echo esc_attr($icon['alt'] ?? ''); ?>">
                                        <?php endif; ?>
                                        <?php if (!empty($text)): ?>
                                            <span class="list__desc"><?php echo esc_html($text); ?></span>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <!-- Button -->
                        <?php if (!empty($button['url']) && !empty($button['title'])): ?>
                            <a href="<?php echo esc_url($button['url']); ?>" class="banner__button banner__button--text"
                                <?php echo (isset($button['target']) && $button['target'] === '_blank') ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
                                <?php echo esc_html($button['title']); ?>
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="col-lg-6">
                        <?php if (!empty($image)): ?>
                            <div class="banner__wrapper">
                                <img class="banner__img" src="<?php echo esc_url($image); ?>"
                                    alt="<?php echo esc_attr($image['alt'] ?? ''); ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner End -->

    <!-- Contact Form Start -->
    <?php
    $contact_form = get_field('contact_form') ?? '';

    // Kiểm tra tồn tại và gán giá trị
    $title = isset($contact_form['title']) ? $contact_form['title'] : '';
    $content = isset($contact_form['content']) ? $contact_form['content'] : '';
    $contact_form = isset($contact_form['contact_form']) ? $contact_form['contact_form'] : '';
    ?>

    <section class="section__space">
        <div class="container">
            <div class="row contact_form__row">
                <div class="col-lg-10">
                    <div class="contact_form">
                        <?php if (!empty($title)): ?>
                            <h2 class="contact_form__title"><?php echo esc_html($title); ?></h2>
                        <?php endif; ?>

                        <?php if (!empty($content)): ?>
                            <div class="contact_form__desc editor"><?php echo wp_kses_post($content); ?></div>
                        <?php endif; ?>

                        <!-- Form -->
                        <?php if (!empty($contact_form)): ?>
                            <?php echo do_shortcode('[contact-form-7 id="' . esc_attr($contact_form) . '" html_class="form_contact"]'); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Form End -->

    <!-- Learn Start -->
    <?php
    $learn_about = get_field('learn_about') ?? '';

    // Kiểm tra và gán dữ liệu
    $learn_icon = isset($learn_about['icon']) ? $learn_about['icon'] : null;
    $title = isset($learn_about['title']) ? $learn_about['title'] : '';
    $content = isset($learn_about['content']) ? $learn_about['content'] : '';
    $button = isset($learn_about['button']) ? $learn_about['button'] : [];
    $image = isset($learn_about['image']) ? $learn_about['image'] : null;
    ?>

    <section class="section__space">
        <div class="learn">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <?php if (!empty($title)): ?>
                            <div class="learn__title">
                                <div class="title__content">
                                    <?php if (!empty($learn_icon['url'])): ?>
                                        <img src="<?php echo esc_url($learn_icon['url']); ?>"
                                            alt="<?php echo esc_attr($learn_icon['alt'] ?? ''); ?>" class="title__icon" />
                                    <?php endif; ?>
                                    <h2 class="title__text">
                                        <?php echo esc_html($title); ?>
                                    </h2>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($content)): ?>
                            <div class="learn__desc"><?php echo wp_kses_post($content); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($button['url']) && !empty($button['title'])): ?>
                            <a href="<?php echo esc_url($button['url']); ?>" class="learn__button
                                        learn__button--text">
                                <?php echo esc_html($button['title']); ?>
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="col-lg-6">
                        <?php if (!empty($image['url'])): ?>
                            <div class="learn__wrapper">
                                <img class="learn__img" src="<?php echo esc_url($image['url']); ?>" alt="
                                        <?php echo esc_attr($image['alt'] ?? ''); ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Learn End -->

    <!-- Customer Start -->
    <?php
    $customer = get_field('customer') ?? '';

    // Kiểm tra và gán dữ liệu
    $title_cus = isset($customer['title']) ? $customer['title'] : '';
    $list_cus = isset($customer['customer']) && is_array($customer['customer']) ? $customer['customer'] : [];
    ?>

    <section class="section__space">
        <div class="customer">
            <div class="container">
                <?php if (!empty($title_cus)): ?>
                    <h2 class="customer__title"><?php echo esc_html($title_cus); ?>
                    </h2>
                <?php endif; ?>

                <?php if (!empty($list_cus)): ?>
                    <div class="row">
                        <?php foreach ($list_cus as $item): ?>         <?php
                                      $img = isset($item['image']) ? $item['image'] : [];
                                      $position = isset($item['position']) ? $item['position'] : '';
                                      $content_cus = isset($item['content']) ? $item['content'] : '';
                                      ?>
                            <div class="col-lg-4">
                                <div class="audience">
                                    <?php if (!empty($img) && is_array($img)): ?>
                                        <div class="audience__img"> <img src="<?php echo esc_url($img['url']); ?>"
                                                alt="<?php echo esc_attr($img['alt'] ?? ''); ?>">
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($position)): ?>
                                        <div class="audience__position">
                                            <?php echo esc_html($position); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($content_cus)): ?>
                                        <div class="audience__list">
                                            <?php echo wp_kses_post($content_cus); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- Customer End -->

    <!-- Why Choose Us Start -->
    <?php
    $why_choose_us = get_field('why_choose_us') ?? [];

    // Gán dữ liệu với kiểm tra điều kiện
    $icon = isset($why_choose_us['icon']) && is_array($why_choose_us['icon']) ? $why_choose_us['icon'] : null;
    $title_main = !empty($why_choose_us['title']) ? $why_choose_us['title'] : '';
    $list_contents = isset($why_choose_us['content']) && is_array($why_choose_us['content']) ? $why_choose_us['content'] : [];
    ?>
    <section class="section__space">
        <div class="why_choose_us">
            <div class="container">
                <div class="why_choose_us__inner">
                    <?php if (!empty($icon)): ?>
                        <img src="<?php echo esc_url($icon['url'] ?? ''); ?>"
                            alt="<?php echo esc_attr($icon['alt'] ?? 'Icon'); ?>" class="why_choose_us__icon">
                    <?php endif; ?>

                    <?php if (!empty($title_main)): ?>
                        <h2 class="why_choose_us__title">
                            <?php echo esc_html($title_main); ?>
                        </h2>
                    <?php endif; ?>
                </div>

                <div class="why_choose_us__content">
                    <?php foreach ($list_contents as $index => $item): ?>     <?php
                                $number = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
                                $title = $item['title'] ?? '';
                                $content = $item['content'] ?? '';
                                $image = isset($item['image']) && is_array($item['image']) ? $item['image'] : null;
                                ?>

                        <?php if ($index % 2 == 0): ?>
                            <!-- Giao diện 1: Index chẵn (0, 2, 4, ...) -->
                            <div class="feature">
                                <div class="row feature__row">
                                    <div class="col-lg-7">
                                        <div class="feature__content">
                                            <div class="feature__number">
                                                <?php echo esc_html($number); ?>
                                            </div>
                                            <div class="feature__text">
                                                <?php if (!empty($title)): ?>
                                                    <h3 class="feature__title"><?php echo esc_html($title); ?>
                                                    </h3>
                                                <?php endif; ?>
                                                <?php if (!empty($content)): ?>
                                                    <div class="feature__desc">
                                                        <?php echo wp_kses_post($content); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if (!empty($image)): ?>
                                        <div class="col-lg-5">
                                            <div class="feature__image"> <img src="<?php echo esc_url($image['url']); ?>"
                                                    alt="<?php echo esc_attr($image['alt'] ?? 'Ảnh minh họa'); ?>" />
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <!-- Giao diện 2: Index lẻ (1, 3, 5, ...) -->
                            <div class="feature">
                                <div class="row feature__row">
                                    <?php if (!empty($image)): ?>
                                        <div class="col-lg-5">
                                            <div class="feature__image"> <img src="<?php echo esc_url($image['url']); ?>"
                                                    alt="<?php echo esc_attr($image['alt'] ?? 'Ảnh minh họa'); ?>" />
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-lg-7">
                                        <div class="feature__content">
                                            <div class="feature__text">
                                                <?php if (!empty($title)): ?>
                                                    <h3 class="feature__title"><?php echo esc_html($title); ?>
                                                    </h3>
                                                <?php endif; ?>
                                                <?php if (!empty($content)): ?>
                                                    <div class="feature__desc">
                                                        <?php echo wp_kses_post($content); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="feature__number">
                                                <?php echo esc_html($number); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
    <!-- why choose Us End -->

    <!-- Project Start -->
    <?php
    // Lấy dữ liệu từ ACF field 'project'
    $project = get_field('project') ?? [];

    // Kiểm tra tiêu đề section
    $title_project = !empty($project['title']) ? $project['title'] : '';

    // Query bài viết thuộc chuyên mục/taxonomy "du-an" (hoặc gắn post type là 'project')
    $args = [
        'post_type' => 'project', // Tùy thuộc vào CPT của bạn, có thể là 'du_an', 'case_study', v.v.
        'posts_per_page' => 6,
        'post_status' => 'publish',
    ];

    $query = new WP_Query($args);
    ?>

    <section class="section__space">
        <div class="container">
            <div class="project">
                <?php if (!empty($title_project)): ?>
                    <h2 class="project__heading"><?php the_title(); ?>
                    </h2>
                <?php endif; ?>

                <?php if ($query->have_posts()): ?>
                    <div class="row">
                        <?php while ($query->have_posts()):
                            $query->the_post(); ?>
                            <?php
                            $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                            $stat_1 = get_field('stat_1') ?? ['value' => '', 'label' => ''];
                            $stat_2 = get_field('stat_2') ?? ['value' => '', 'label' => ''];
                            ?>
                            <div class="col-lg-4">
                                <div class="project__item">
                                    <a href="<?php the_permalink(); ?>" class="project__wrapper">
                                        <?php if (!empty($image_url)): ?>
                                            <img src="<?php echo esc_url($image_url); ?>"
                                                alt="<?php echo esc_attr(get_the_title()); ?>" class="project__image" />
                                        <?php endif; ?>
                                    </a>
                                    <div class="project__content">
                                        <a href="<?php the_permalink(); ?>" class="project__title">
                                            <h3 class="project__text"><?php the_title(); ?></h3>
                                        </a>
                                        <div class="project__stats row">
                                            <?php if (!empty($stat_1['value'])): ?>
                                                <div class="col-6">
                                                    <div class="project__stat">
                                                        <div class="stat__info">
                                                            <span
                                                                class="stat__value"><?php echo esc_html($stat_1['value']); ?></span>
                                                            <span class="stat__icon">▲</span>
                                                        </div>
                                                        <span class="stat__label"><?php echo esc_html($stat_1['label']); ?></span>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($stat_2['value'])): ?>
                                                <div class="col-6">
                                                    <div class="project__stat">
                                                        <div class="stat__info">
                                                            <span
                                                                class="stat__value"><?php echo esc_html($stat_2['value']); ?></span>
                                                            <span class="stat__icon">▲</span>
                                                        </div>
                                                        <span class="stat__label"><?php echo esc_html($stat_2['label']); ?></span>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>
    <!-- Project End -->

    <!-- Reviews Start -->
    <?php
    $reviews = get_field('reviews') ?? [];

    // Kiểm tra và gán dữ liệu
    $reviews_list = isset($reviews['reviews']) && is_array($reviews['reviews']) ? $reviews['reviews'] : [];
    ?>

    <?php if (!empty($reviews_list)): ?>
        <section class="section__space">
            <div class="reviews">
                <div class="container">
                    <div class="row"> <?php foreach ($reviews_list as $item):
                        $avatar = isset($item['avatar']) && is_array($item['avatar']) ? $item['avatar']['url'] ?? '' : '';
                        $alt = isset($item['avatar']['alt']) ? $item['avatar']['alt'] : '';
                        $title = isset($item['title']) ? $item['title'] : '';
                        $content = isset($item['content']) ? $item['content'] : '';
                        ?>
                            <div class="col-lg-6">
                                <div class="reviews__item">
                                    <?php if (!empty($avatar)): ?>
                                        <div class="reviews__avatar">
                                            <div class="reviews__avatar--wrapper"> <img src="<?php echo esc_url($avatar); ?>"
                                                    alt="<?php echo esc_attr($alt); ?>" class="reviews__image" />
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($title)): ?>
                                        <h5 class="reviews__name"><?php echo esc_html($title); ?>
                                        </h5>
                                    <?php endif; ?>

                                    <?php if (!empty($content)): ?>
                                        <div class="reviews__content editor">
                                            <?php echo wp_kses_post($content); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <!-- Reviews End -->

    <!--  -->
</div>

<?php
get_footer();
