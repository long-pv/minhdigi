<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Profile_Card_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'Profile_Card_Widget';
    }

    public function get_title()
    {
        return __('Profile Card', 'child_theme');
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
        //
        $thong_tin_ket_noi = get_field('thong_tin_ket_noi', 'option') ?? null;
        //
        if ($thong_tin_ket_noi) {
            ?>
            <div class="profile-card">
                <div class="profile-card__inner">
                    <div class="profile-card__info">
                        <div class="profile-card__inner-info">
                            <div class="profile-card__avatar">
                                <?php if (!empty($thong_tin_ket_noi['anh_dai_dien'])) {
                                    // ID của ảnh
                                    $attachment_id = $thong_tin_ket_noi['anh_dai_dien'];
                                    // Lấy URL của ảnh
                                    $image_url = wp_get_attachment_url($attachment_id);
                                    // Lấy thuộc tính alt của ảnh
                                    $image_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
                                    //
                                    echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="profile-card__infofull">
                            <h2 class="profile-card__name"><?php if (isset($thong_tin_ket_noi['ten'])) {
                                echo $thong_tin_ket_noi['ten'];
                            } ?>
                            </h2>
                            <p class="profile-card__role"><?php if (isset($thong_tin_ket_noi['ten_cong_ty'])) {
                                echo $thong_tin_ket_noi['ten_cong_ty'];
                            } ?></p>
                        </div>
                    </div>

                    <div class="profile-card__contact">
                        <div class="profile-card__social-title">
                            <?php if (!empty($thong_tin_ket_noi['doan_chi_dan'])) {
                                echo $thong_tin_ket_noi['doan_chi_dan'];
                            } ?>
                        </div>
                        <div class="profile-card__social-links">
                            <a href="<?php if (isset($thong_tin_ket_noi['duong_dan_facebook'])) {
                                echo $thong_tin_ket_noi['duong_dan_facebook'];
                            } ?>" target="_blank" class="profile-card__social-link">
                                <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="0.5" y="0.5" width="35" height="35" rx="15.5" stroke="#D42328"></rect>
                                    <path
                                        d="M15.139 26.6404H18.7769V19.3556H22.0547L22.4148 15.7356H18.7769V13.9077C18.7769 13.4054 19.1841 12.9982 19.6864 12.9982H22.4148V9.36035H19.6864C17.1749 9.36035 15.139 11.3963 15.139 13.9077V15.7356H13.32L12.96 19.3556H15.139V26.6404Z"
                                        fill="#D42328"></path>
                                </svg>
                            </a>
                            <a href="<?php if (isset($thong_tin_ket_noi['duong_dan_instagram'])) {
                                echo $thong_tin_ket_noi['duong_dan_instagram'];
                            } ?>" target="_blank" class="profile-card__social-link">
                                <svg width="37" height="36" viewBox="0 0 37 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="0.700195" y="0.5" width="35" height="35" rx="15.5" stroke="#D42328" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M15.4648 15.1001H18.405V16.5647C18.8286 15.7224 19.9147 14.9656 21.5464 14.9656C24.6742 14.9656 25.4168 16.6423 25.4168 19.7187V25.4163H22.2502V20.4193C22.2502 18.6674 21.8266 17.6794 20.7484 17.6794C19.2529 17.6794 18.6315 18.7442 18.6315 20.4186V25.4163H15.4648V15.1001ZM10.0347 25.2818H13.2014V14.9656H10.0347V25.2818ZM13.655 11.6018C13.6552 11.8672 13.6025 12.13 13.5002 12.3749C13.3978 12.6198 13.2478 12.8419 13.0589 13.0283C12.8694 13.2169 12.6446 13.3662 12.3974 13.4678C12.1502 13.5694 11.8854 13.6213 11.6181 13.6205C11.0794 13.6193 10.5627 13.407 10.1788 13.0291C9.99065 12.842 9.84121 12.6196 9.73906 12.3747C9.6369 12.1298 9.58404 11.8671 9.5835 11.6018C9.5835 11.0658 9.79725 10.5528 10.1796 10.1744C10.5626 9.79508 11.0799 9.58251 11.6189 9.58301C12.1588 9.58301 12.6765 9.79597 13.0589 10.1744C13.4413 10.5528 13.655 11.0658 13.655 11.6018Z"
                                        fill="#D42328" />
                                </svg>
                            </a>
                            <a href="<?php if (isset($thong_tin_ket_noi['duong_dan_youtube'])) {
                                echo $thong_tin_ket_noi['duong_dan_youtube'];
                            } ?>" target="_blank" class="profile-card__social-link">
                                <svg width="37" height="36" viewBox="0 0 37 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="1.18018" y="0.5" width="35" height="35" rx="15.5" stroke="#D42328"></rect>
                                    <path
                                        d="M28.4561 17.9379C28.4561 17.8891 28.4561 17.8337 28.4538 17.7695C28.4516 17.59 28.4472 17.3883 28.4428 17.1733C28.425 16.5551 28.394 15.939 28.3452 15.3584C28.2788 14.5584 28.1813 13.8913 28.0483 13.3905C27.908 12.8678 27.6329 12.3912 27.2507 12.0081C26.8684 11.6251 26.3923 11.3491 25.8699 11.2077C25.2428 11.0393 24.0151 10.9351 22.2865 10.8708C21.4644 10.8398 20.5846 10.8199 19.7048 10.8088C19.3968 10.8044 19.1109 10.8021 18.8538 10.7999H18.2023C17.9452 10.8021 17.6594 10.8044 17.3513 10.8088C16.4716 10.8199 15.5918 10.8398 14.7696 10.8708C13.0411 10.9373 11.8112 11.0415 11.1862 11.2077C10.6637 11.3487 10.1874 11.6246 9.80507 12.0077C9.42274 12.3908 9.14782 12.8677 9.00785 13.3905C8.87267 13.8913 8.77738 14.5584 8.7109 15.3584C8.66215 15.939 8.63112 16.5551 8.61339 17.1733C8.60675 17.3883 8.60453 17.59 8.60231 17.7695C8.60231 17.8337 8.6001 17.8891 8.6001 17.9379V18.062C8.6001 18.1107 8.6001 18.1661 8.60231 18.2304C8.60453 18.4099 8.60896 18.6116 8.61339 18.8265C8.63112 19.4448 8.66215 20.0609 8.7109 20.6415C8.77738 21.4415 8.87489 22.1085 9.00785 22.6093C9.29151 23.6708 10.1248 24.5085 11.1862 24.7922C11.8112 24.9606 13.0411 25.0647 14.7696 25.129C15.5918 25.16 16.4716 25.18 17.3513 25.1911C17.6594 25.1955 17.9452 25.1977 18.2023 25.1999H18.8538C19.1109 25.1977 19.3968 25.1955 19.7048 25.1911C20.5846 25.18 21.4644 25.16 22.2865 25.129C24.0151 25.0625 25.245 24.9584 25.8699 24.7922C26.9314 24.5085 27.7646 23.6731 28.0483 22.6093C28.1835 22.1085 28.2788 21.4415 28.3452 20.6415C28.394 20.0609 28.425 19.4448 28.4428 18.8265C28.4494 18.6116 28.4516 18.4099 28.4538 18.2304C28.4538 18.1661 28.4561 18.1107 28.4561 18.062V17.9379ZM26.8605 18.0531C26.8605 18.0996 26.8605 18.1506 26.8583 18.2105C26.8561 18.3833 26.8516 18.5739 26.8472 18.78C26.8317 19.3695 26.8007 19.9589 26.7541 20.5063C26.6943 21.2199 26.6101 21.8049 26.5059 22.1972C26.3685 22.7091 25.9652 23.1146 25.4555 23.2498C24.9901 23.3739 23.8178 23.4736 22.2245 23.5334C21.4178 23.5645 20.5491 23.5844 19.6826 23.5955C19.379 23.5999 19.0976 23.6021 18.845 23.6021H18.2112L17.3735 23.5955C16.507 23.5844 15.6405 23.5645 14.8317 23.5334C13.2383 23.4714 12.0638 23.3739 11.6007 23.2498C11.091 23.1124 10.6876 22.7091 10.5502 22.1972C10.4461 21.8049 10.3619 21.2199 10.302 20.5063C10.2555 19.9589 10.2267 19.3695 10.209 18.78C10.2023 18.5739 10.2001 18.3811 10.1979 18.2105C10.1979 18.1506 10.1957 18.0974 10.1957 18.0531V17.9467C10.1957 17.9002 10.1957 17.8492 10.1979 17.7894C10.2001 17.6165 10.2045 17.426 10.209 17.2199C10.2245 16.6304 10.2555 16.0409 10.302 15.4936C10.3619 14.78 10.4461 14.1949 10.5502 13.8027C10.6876 13.2908 11.091 12.8852 11.6007 12.7501C12.066 12.626 13.2383 12.5262 14.8317 12.4664C15.6383 12.4354 16.507 12.4154 17.3735 12.4044C17.6771 12.3999 17.9585 12.3977 18.2112 12.3977H18.845L19.6826 12.4044C20.5491 12.4154 21.4156 12.4354 22.2245 12.4664C23.8178 12.5285 24.9923 12.626 25.4555 12.7501C25.9652 12.8875 26.3685 13.2908 26.5059 13.8027C26.6101 14.1949 26.6943 14.78 26.7541 15.4936C26.8007 16.0409 26.8295 16.6304 26.8472 17.2199C26.8538 17.426 26.8561 17.6188 26.8583 17.7894C26.8583 17.8492 26.8605 17.9024 26.8605 17.9467V18.0531ZM16.5558 20.9695L21.6971 17.9778L16.5558 15.0304V20.9695Z"
                                        fill="#D42328"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <?php if (isset($thong_tin_ket_noi['mo_ta'])): ?>
                    <p class="profile-card__quote">
                        <?php echo $thong_tin_ket_noi['mo_ta']; ?>
                    <?php endif; ?>
                </p>
            </div>
            <?php
        }
    }
}

