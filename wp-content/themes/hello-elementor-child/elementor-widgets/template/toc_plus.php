<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

class TOC_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'TOC_Widget';
    }

    public function get_title()
    {
        return __('TOC Widget', 'child_theme');
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

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <div class="single_post_toc_block">
            <div class="single_post_toc_title">Nội dung</div>
            <div id="sticky-navigator">
            </div>
        </div>
<?php
    }
}
