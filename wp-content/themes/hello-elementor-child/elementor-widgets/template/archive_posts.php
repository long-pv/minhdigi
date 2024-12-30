<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

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

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $columns_desktop = $settings['columns'] ?? 1;
        $columns_tablet = $settings['columns_tablet'] ?? 1;
        $columns_mobile = $settings['columns_mobile'] ?? 1;
        $enable_pagination = $settings['enable_pagination'] === 'yes' ? true : false;

        if (is_archive()) {
            if (have_posts()) {
                echo '<div class="row">';
                $col_class = 'col-' . (12 / (int)  $columns_mobile) . ' col-md-' . (12 / (int)  $columns_tablet) . ' col-lg-' . (12 / (int)  $columns_desktop);
                while (have_posts()):
                    the_post();
?>
                    <div class="<?php echo $col_class; ?>">
                        <div class="archive-post-item">
                            <?php if (has_post_thumbnail()): ?>
                                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" class="img-fluid" alt="<?php the_title(); ?>">
                            <?php endif; ?>
                            <h3><?php the_title(); ?></h3>
                            <p><?php echo get_the_excerpt(); ?></p>
                        </div>
                    </div>
<?php
                endwhile;
                echo '</div>'; // Close .row

                if ($enable_pagination) {
                    global $wp_query;
                    echo '<div class="pagination">';
                    echo paginate_links(
                        array(
                            'total' => $wp_query->max_num_pages,
                            'current' => max(1, get_query_var('paged')),
                            'end_size' => 2,
                            'mid_size' => 1,
                            'prev_text' => __('Prev', 'child_theme'),
                            'next_text' => __('Next', 'child_theme'),
                        )
                    );
                    echo '</div>';
                }
            } else {
                echo 'There are no articles.';
            }
        } else {
            echo 'This is not a template archive.';
        }
    }
}
