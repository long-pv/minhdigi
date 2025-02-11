<?php
if (!defined('ABSPATH')) exit; // Bảo mật

class Elementor_Timeline_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'timeline_widget';
    }

    public function get_title()
    {
        return __('Timeline Widget', 'child_theme');
    }

    public function get_icon()
    {
        return 'eicon-time-line';
    }

    public function get_categories()
    {
        return ['custom_builder_theme'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Timeline Items', 'child_theme'),
            ]
        );

        $this->add_control(
            'timeline_items',
            [
                'label' => __('Items', 'child_theme'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'year',
                        'label' => __('Year', 'child_theme'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => __('2024', 'child_theme'),
                    ],
                    [
                        'name' => 'events',
                        'label' => __('Events', 'child_theme'),
                        'type' => \Elementor\Controls_Manager::WYSIWYG,
                        'default' => '', // Mặc định rỗng
                    ],
                    [
                        'name' => 'image',
                        'label' => __('Image', 'child_theme'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => '',
                        ],
                    ]
                ],
                'title_field' => '{{{ year }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        if (empty($settings['timeline_items'])) return;
?>

        <div class="timeline_widget">
            <div class="timeline_line"></div>
            <div class="timeline_list">
                <?php foreach ($settings['timeline_items'] as $index => $item) : ?>
                    <div class="timeline_item row <?php echo ($index % 2 == 0) ? 'timeline_item_chan' : 'timeline_item_le'; ?>">
                        <div class="timeline_year col-auto p-0">
                            <div class="timeline_year_inner">
                                <span class="timeline_year_text">
                                    <?php echo esc_html($item['year']); ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 timeline_content_block <?php echo ($index % 2 == 0) ? 'order-lg-2 order-2' : 'order-lg-1 order-2'; ?>">
                            <div class="timeline_content">
                                <?php if (!empty($item['events'])) : ?>
                                    <div class="timeline_events">
                                        <?php echo $item['events']; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 timeline_image_block <?php echo ($index % 2 == 0) ? 'order-lg-1 order-1' : 'order-lg-2 order-1'; ?>">
                            <div class="timeline_image">
                                <?php if (!empty($item['image']['url'])) : ?>
                                    <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($item['year']); ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

<?php
    }
}
