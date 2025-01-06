<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Archive_Posts_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'Archive_Posts_Widget';
    }

    public function get_title()
    {
        return __('Archive Posts', 'child_theme');
    }

    public function get_icon()
    {
        return 'eicon-code-bold'; // https://elementor.github.io/elementor-icons/
    }

    public function get_categories()
    {
        return ['custom_builder_theme'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'child_theme'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Thêm ô select để chọn post type
        $this->add_control(
            'post_type',
            [
                'label' => __('Select Post Type', 'child_theme'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'post',
                'options' => $this->get_post_types()
            ]
        );

        // $this->add_control(
        //     'posts_per_page',
        //     [
        //         'label' => __('Number of Posts', 'child_theme'),
        //         'type' => \Elementor\Controls_Manager::SELECT,
        //         'options' => [
        //             10 => '10',
        //             15 => '15',
        //             20 => '20',
        //             25 => '25',
        //             30 => '30',
        //             35 => '35',
        //             40 => '40',
        //             45 => '45',
        //             50 => '50',
        //         ],
        //         'default' => '10',
        //     ]
        // );

        $this->add_responsive_control(
            'columns',
            [
                'label' => __('Number of Columns', 'child_theme'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 3,
                'options' => [
                    1 => __('1 Columns', 'child_theme'),
                    2 => __('2 Columns', 'child_theme'),
                    3 => __('3 Columns', 'child_theme'),
                    4 => __('4 Columns', 'child_theme'),
                    6 => __('6 Columns', 'child_theme'),
                    12 => __('12 Columns', 'child_theme'),
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'device_default' => [
                    'desktop' => 3,
                    'tablet' => 2,
                    'mobile' => 1,
                ],
            ]
        );

        $this->add_control(
            'enable_pagination',
            [
                'label' => __('Enable Pagination', 'child_theme'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'child_theme'),
                'label_off' => __('No', 'child_theme'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    private function get_post_types()
    {
        $post_types = get_post_types(['public' => true], 'objects');
        $options = [];
        foreach ($post_types as $post_type) {
            $options[$post_type->name] = $post_type->label;
        }
        return $options;
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $columns_desktop = $settings['columns'] ?? 1;
        $columns_tablet = $settings['columns_tablet'] ?? 1;
        $columns_mobile = $settings['columns_mobile'] ?? 1;
        $enable_pagination = $settings['enable_pagination'] === 'yes' ? true : false;
        $post_type = $settings['post_type'] ?? 'post';
        // $posts_per_page = $settings['posts_per_page'] ?? 10;
        $posts_per_page = 9;
        $paging = !empty($_GET['paging']) ? intval($_GET['paging']) : 1;

        $query_args = [
            'post_type' => $post_type,
            'posts_per_page' => $posts_per_page,
            'paged' => $paging,
        ];

        // category
        if (is_category()) {
            $category = get_queried_object();
            $query_args['cat'] = $category->term_id;
        }

        // tag
        if (is_tag()) {
            $tag = get_queried_object();
            $query_args['tag_id'] = $tag->term_id;
        }

        $query_post = new WP_Query($query_args);

        // 
        if ($query_post->have_posts()) {
            echo '<div class="archive_post_list">';
            echo '<div class="row archive_post_row">';
            // Xảy ra lỗi
            $col_class = 'col-' . (12 / (int) $columns_mobile) . ' col-md-' . (12 / (int) $columns_tablet) . ' col-lg-' . (12 / (int) $columns_desktop);

            while ($query_post->have_posts()):
                $query_post->the_post();
                ?>
                <div class="<?php echo esc_attr($col_class); ?>">
                    <article class="archive_post_item" data-mh="archive_post_item">
                        <?php if (has_post_thumbnail()): ?>
                            <a class="d-block archive_post_item__img" href="<?php the_permalink(); ?>">
                                <?php echo get_the_post_thumbnail(get_the_ID(), 'large'); ?>
                            </a>
                        <?php endif; ?>
                        <div class="row archive_post_item__inner">
                            <div class="col-6">
                                <div class="category">
                                    <?php
                                    $categories = get_the_category();
                                    if (!empty($categories)) {
                                        $first_category = $categories[0];
                                        echo '<a href="' . esc_url(get_category_link($first_category->term_id)) . '">' . esc_html($first_category->name) . '</a>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="date">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_263_2373)">
                                            <path
                                                d="M5.673 0C5.85865 0 6.0367 0.0737498 6.16797 0.205025C6.29925 0.336301 6.373 0.514348 6.373 0.7V2.009H13.89V0.709C13.89 0.523348 13.9637 0.345301 14.095 0.214025C14.2263 0.0827498 14.4043 0.009 14.59 0.009C14.7757 0.009 14.9537 0.0827498 15.085 0.214025C15.2162 0.345301 15.29 0.523348 15.29 0.709V2.009H18C18.5303 2.009 19.0388 2.21958 19.4139 2.59443C19.7889 2.96929 19.9997 3.47774 20 4.008V18.001C19.9997 18.5313 19.7889 19.0397 19.4139 19.4146C19.0388 19.7894 18.5303 20 18 20H2C1.46974 20 0.961184 19.7894 0.58614 19.4146C0.211096 19.0397 0.00026513 18.5313 0 18.001L0 4.008C0.00026513 3.47774 0.211096 2.96929 0.58614 2.59443C0.961184 2.21958 1.46974 2.009 2 2.009H4.973V0.699C4.97327 0.513522 5.04713 0.335731 5.17838 0.204672C5.30963 0.0736123 5.48752 -1.89263e-07 5.673 0ZM1.4 7.742V18.001C1.4 18.0798 1.41552 18.1578 1.44567 18.2306C1.47583 18.3034 1.52002 18.3695 1.57574 18.4253C1.63145 18.481 1.69759 18.5252 1.77039 18.5553C1.84319 18.5855 1.92121 18.601 2 18.601H18C18.0788 18.601 18.1568 18.5855 18.2296 18.5553C18.3024 18.5252 18.3685 18.481 18.4243 18.4253C18.48 18.3695 18.5242 18.3034 18.5543 18.2306C18.5845 18.1578 18.6 18.0798 18.6 18.001V7.756L1.4 7.742ZM6.667 14.619V16.285H5V14.619H6.667ZM10.833 14.619V16.285H9.167V14.619H10.833ZM15 14.619V16.285H13.333V14.619H15ZM6.667 10.642V12.308H5V10.642H6.667ZM10.833 10.642V12.308H9.167V10.642H10.833ZM15 10.642V12.308H13.333V10.642H15ZM4.973 3.408H2C1.92121 3.408 1.84319 3.42352 1.77039 3.45367C1.69759 3.48382 1.63145 3.52802 1.57574 3.58374C1.52002 3.63945 1.47583 3.70559 1.44567 3.77839C1.41552 3.85119 1.4 3.92921 1.4 4.008V6.343L18.6 6.357V4.008C18.6 3.92921 18.5845 3.85119 18.5543 3.77839C18.5242 3.70559 18.48 3.63945 18.4243 3.58374C18.3685 3.52802 18.3024 3.48382 18.2296 3.45367C18.1568 3.42352 18.0788 3.408 18 3.408H15.29V4.337C15.29 4.52265 15.2162 4.7007 15.085 4.83197C14.9537 4.96325 14.7757 5.037 14.59 5.037C14.4043 5.037 14.2263 4.96325 14.095 4.83197C13.9637 4.7007 13.89 4.52265 13.89 4.337V3.408H6.373V4.328C6.373 4.51365 6.29925 4.6917 6.16797 4.82297C6.0367 4.95425 5.85865 5.028 5.673 5.028C5.48735 5.028 5.3093 4.95425 5.17803 4.82297C5.04675 4.6917 4.973 4.51365 4.973 4.328V3.408Z"
                                                fill="black" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_263_2373">
                                                <rect width="20" height="20" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <?php echo get_the_date('d/m/Y');
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="archive_post_item__content" data-mh="archive_post_item__content">
                            <a class="d-flex archive_post_item__content-inner" href="<?php the_permalink(); ?>">
                                <h3 class="archive_post_item__title line-2"><?php echo get_the_title(); ?></h3>
                            </a>
                            <p class="archive_post_item__desc line-3"><?php echo get_the_excerpt(); ?></p>
                        </div>
                        <!--  -->
                        <div class="archive_post_item__footer row">
                            <div class="col-7">
                                <div class="author">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M19 20.75C19.2652 20.75 19.5196 20.6446 19.7071 20.4571C19.8946 20.2696 20 20.0152 20 19.75V18.504C20.004 15.698 16.026 13.5 12 13.5C7.974 13.5 4 15.698 4 18.504V19.75C4 20.0152 4.10536 20.2696 4.29289 20.4571C4.48043 20.6446 4.73478 20.75 5 20.75H19ZM15.604 6.854C15.604 7.32728 15.5108 7.79593 15.3297 8.23319C15.1485 8.67045 14.8831 9.06775 14.5484 9.40241C14.2138 9.73707 13.8164 10.0025 13.3792 10.1837C12.9419 10.3648 12.4733 10.458 12 10.458C11.5267 10.458 11.0581 10.3648 10.6208 10.1837C10.1836 10.0025 9.78625 9.73707 9.45159 9.40241C9.11692 9.06775 8.85146 8.67045 8.67034 8.23319C8.48922 7.79593 8.396 7.32728 8.396 6.854C8.396 5.89816 8.77571 4.98147 9.45159 4.30559C10.1275 3.62971 11.0442 3.25 12 3.25C12.9558 3.25 13.8725 3.62971 14.5484 4.30559C15.2243 4.98147 15.604 5.89816 15.604 6.854Z"
                                            stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="user-name">
                                        <?php echo get_the_author_meta('nickname'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="view-count">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15 12C15 12.7956 14.6839 13.5587 14.1213 14.1213C13.5587 14.6839 12.7956 15 12 15C11.2044 15 10.4413 14.6839 9.87868 14.1213C9.31607 13.5587 9 12.7956 9 12C9 11.2044 9.31607 10.4413 9.87868 9.87868C10.4413 9.31607 11.2044 9 12 9C12.7956 9 13.5587 9.31607 14.1213 9.87868C14.6839 10.4413 15 11.2044 15 12Z"
                                            stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M2 12C3.6 7.903 7.336 5 12 5C16.664 5 20.4 7.903 22 12C20.4 16.097 16.664 19 12 19C7.336 19 3.6 16.097 2 12Z"
                                            stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span class="count">
                                        <?php echo get_field('post_views_count') ?? 0; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <?php
            endwhile;
            echo '</div>'; // Close .row
            echo '</div>';

            if ($enable_pagination) {
                echo '<div class="pagination_custom">';
                echo paginate_links(
                    array(
                        'total' => $query_post->max_num_pages,
                        'current' => max(1, $paging),
                        'format' => '?paging=%#%',
                        'end_size' => 2,
                        'mid_size' => 1,
                    )
                );
                echo '</div>';
            }
        } else {
            echo '<p>' . __('There are no articles.', 'child_theme') . '</p>';
        }
        wp_reset_postdata();
    }
}
