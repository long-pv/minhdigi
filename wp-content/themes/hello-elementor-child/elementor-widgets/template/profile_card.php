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
                            Kết nối với mình qua
                        </div>
                        <div class="profile-card__social-links">
                            <a href="<?php if (isset($thong_tin_ket_noi['duong_dan_facebook'])) {
                                echo $thong_tin_ket_noi['duong_dan_facebook'];
                            } ?>" target="_blank" class="profile-card__social-link">
                                <svg width="11" height="18" viewBox="0 0 11 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3.13896 17.6404H6.7769V10.3556H10.0547L10.4148 6.73555H6.7769V4.90772C6.7769 4.40544 7.18407 3.99825 7.68637 3.99825H10.4148V0.360352H7.68637C5.17486 0.360352 3.13896 2.39628 3.13896 4.90772V6.73555H1.32001L0.959961 10.3556H3.13896V17.6404Z"
                                        fill="#D42328" />
                                </svg>
                            </a>
                            <a href="<?php if (isset($thong_tin_ket_noi['duong_dan_instagram'])) {
                                echo $thong_tin_ket_noi['duong_dan_instagram'];
                            } ?>" target="_blank" class="profile-card__social-link">
                                <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.46479 7.10013H10.405V8.56472C10.8286 7.72238 11.9147 6.96555 13.5464 6.96555C16.6742 6.96555 17.4168 8.6423 17.4168 11.7187V17.4163H14.2502V12.4193C14.2502 10.6674 13.8266 9.67938 12.7484 9.67938C11.2529 9.67938 10.6315 10.7442 10.6315 12.4186V17.4163H7.46479V7.10013ZM2.03475 17.2818H5.20141V6.96555H2.03475V17.2818ZM5.65504 3.60176C5.65516 3.86718 5.60252 4.12999 5.50018 4.37489C5.39784 4.61979 5.24785 4.84191 5.05891 5.02834C4.86942 5.21685 4.64464 5.36618 4.39741 5.46778C4.15019 5.56939 3.88537 5.62129 3.61808 5.62051C3.07943 5.6193 2.56272 5.40699 2.17883 5.02913C1.99065 4.84202 1.84121 4.61964 1.73906 4.37472C1.6369 4.12979 1.58404 3.86713 1.5835 3.60176C1.5835 3.0658 1.79725 2.5528 2.17962 2.17438C2.56255 1.79508 3.07989 1.58251 3.61887 1.58301C4.15879 1.58301 4.67654 1.79597 5.05891 2.17438C5.44129 2.5528 5.65504 3.0658 5.65504 3.60176Z"
                                        fill="#D42328" />
                                </svg>
                            </a>
                            <a href="<?php if (isset($thong_tin_ket_noi['duong_dan_youtube'])) {
                                echo $thong_tin_ket_noi['duong_dan_youtube'];
                            } ?>" target="_blank" class="profile-card__social-link">
                                <svg width="21" height="16" viewBox="0 0 21 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20.4561 7.93775C20.4561 7.889 20.4561 7.8336 20.4538 7.76933C20.4516 7.58983 20.4472 7.38817 20.4428 7.17321C20.425 6.55493 20.394 5.93886 20.3452 5.35825C20.2788 4.55825 20.1813 3.89122 20.0483 3.39039C19.908 2.86773 19.6329 2.39105 19.2507 2.008C18.8684 1.62494 18.3923 1.34894 17.8699 1.20756C17.2428 1.03914 16.0151 0.934985 14.2865 0.870719C13.4644 0.839694 12.5846 0.819749 11.7048 0.808669C11.3968 0.804237 11.1109 0.802021 10.8538 0.799805H10.2023C9.94525 0.802021 9.65938 0.804237 9.35134 0.808669C8.47157 0.819749 7.59179 0.839694 6.76963 0.870719C5.04109 0.937201 3.81118 1.04136 3.18625 1.20756C2.6637 1.34859 2.1874 1.62448 1.80507 2.00759C1.42274 2.39069 1.14782 2.86755 1.00785 3.39039C0.872674 3.89122 0.777383 4.55825 0.710901 5.35825C0.662148 5.93886 0.631123 6.55493 0.613394 7.17321C0.606746 7.38817 0.60453 7.58983 0.602314 7.76933C0.602314 7.8336 0.600098 7.889 0.600098 7.93775V8.06185C0.600098 8.11061 0.600098 8.16601 0.602314 8.23028C0.60453 8.40978 0.608962 8.61144 0.613394 8.8264C0.631123 9.44468 0.662148 10.0607 0.710901 10.6414C0.777383 11.4414 0.87489 12.1084 1.00785 12.6092C1.29151 13.6707 2.12475 14.5084 3.18625 14.792C3.81118 14.9605 5.04109 15.0646 6.76963 15.1289C7.59179 15.1599 8.47157 15.1799 9.35134 15.1909C9.65938 15.1954 9.94525 15.1976 10.2023 15.1998H10.8538C11.1109 15.1976 11.3968 15.1954 11.7048 15.1909C12.5846 15.1799 13.4644 15.1599 14.2865 15.1289C16.0151 15.0624 17.245 14.9583 17.8699 14.792C18.9314 14.5084 19.7646 13.6729 20.0483 12.6092C20.1835 12.1084 20.2788 11.4414 20.3452 10.6414C20.394 10.0607 20.425 9.44468 20.4428 8.8264C20.4494 8.61144 20.4516 8.40978 20.4538 8.23028C20.4538 8.16601 20.4561 8.11061 20.4561 8.06185V7.93775ZM18.8605 8.05299C18.8605 8.09953 18.8605 8.1505 18.8583 8.21033C18.8561 8.38318 18.8516 8.57377 18.8472 8.77986C18.8317 9.36933 18.8007 9.95881 18.7541 10.5062C18.6943 11.2197 18.6101 11.8048 18.5059 12.197C18.3685 12.7089 17.9652 13.1145 17.4555 13.2497C16.9901 13.3738 15.8178 13.4735 14.2245 13.5333C13.4178 13.5643 12.5491 13.5843 11.6826 13.5954C11.379 13.5998 11.0976 13.602 10.845 13.602H10.2112L9.3735 13.5954C8.50702 13.5843 7.64054 13.5643 6.83168 13.5333C5.23833 13.4713 4.06381 13.3738 3.60065 13.2497C3.09096 13.1123 2.68763 12.7089 2.55024 12.197C2.44608 11.8048 2.36187 11.2197 2.30204 10.5062C2.2555 9.95881 2.22669 9.36933 2.20896 8.77986C2.20231 8.57377 2.2001 8.38097 2.19788 8.21033C2.19788 8.1505 2.19567 8.09731 2.19567 8.05299V7.94662C2.19567 7.90008 2.19567 7.84911 2.19788 7.78928C2.2001 7.61643 2.20453 7.42584 2.20896 7.21975C2.22447 6.63028 2.2555 6.0408 2.30204 5.49343C2.36187 4.77986 2.44608 4.19482 2.55024 3.80257C2.68763 3.29066 3.09096 2.88512 3.60065 2.74994C4.06603 2.62584 5.23833 2.52612 6.83168 2.46629C7.63832 2.43526 8.50702 2.41532 9.3735 2.40424C9.67711 2.3998 9.95855 2.39759 10.2112 2.39759H10.845L11.6826 2.40424C12.5491 2.41532 13.4156 2.43526 14.2245 2.46629C15.8178 2.52834 16.9923 2.62584 17.4555 2.74994C17.9652 2.88734 18.3685 3.29066 18.5059 3.80257C18.6101 4.19482 18.6943 4.77986 18.7541 5.49343C18.8007 6.0408 18.8295 6.63028 18.8472 7.21975C18.8538 7.42584 18.8561 7.61864 18.8583 7.78928C18.8583 7.84911 18.8605 7.9023 18.8605 7.94662V8.05299ZM8.55578 10.9693L13.6971 7.97764L8.55578 5.03028V10.9693Z"
                                        fill="#D42328" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="profile-card__quote">
                    <?php if (isset($thong_tin_ket_noi['mo_ta'])) {
                        echo $thong_tin_ket_noi['mo_ta'];
                    } ?>
                </div>
            </div>
            <?php
        }
    }
}

