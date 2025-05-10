<?php
/**
 * Template Name: Chăm Sóc
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
<div class="support_page">

	<!-- Banner Start -->
	<?php
	$banner_data = get_field('banner') ?? '';

	$banner_title = isset($banner_data['title']) ? $banner_data['title'] : '';
	$banner_description = isset($banner_data['description']) ? $banner_data['description'] : '';
	$banner_list_content = isset($banner_data['list_content']) ? $banner_data['list_content'] : [];
	$banner_button = isset($banner_data['button']) ? $banner_data['button'] : [];
	$banner_image = isset($banner_data['image']) ? $banner_data['image'] : null;
	?>

	<section class="section__space">
		<div class="support_banner">
			<div class="container">
				<div class="row banner__inner">
					<div class="col-lg-6">
						<!-- Title -->
						<?php if (!empty($banner_title)): ?>
							<h2 class="banner__title"><?php echo esc_html($banner_title); ?></h2>
						<?php endif; ?>

						<!-- Description -->
						<?php if (!empty($banner_description)): ?>
							<div class="banner__desc"><?php echo esc_html($banner_description); ?></div>
						<?php endif; ?>

						<!-- List -->
						<?php if (!empty($banner_list_content) && is_array($banner_list_content)): ?>
							<ul class="banner__list">
								<?php foreach ($banner_list_content as $item):
									$banner_item_icon = isset($item['icon']) ? $item['icon'] : '';
									$banner_item_text = isset($item['content']) ? $item['content'] : '';
									?>
									<li class="list__item">
										<?php if (!empty($banner_item_icon)): ?>
											<img class="list__icon" src="<?php echo esc_url($banner_item_icon); ?>"
												alt="<?php echo esc_attr($banner_item_icon['alt'] ?? ''); ?>">
										<?php endif; ?>
										<?php if (!empty($banner_item_text)): ?>
											<span class="list__desc"><?php echo esc_html($banner_item_text); ?></span>
										<?php endif; ?>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>

						<!-- Button -->
						<?php if (!empty($banner_button['url']) && !empty($banner_button['title'])): ?>
							<a href="<?php echo esc_url($banner_button['url']); ?>"
								class="banner__button banner__button--text" <?php echo (isset($banner_button['target']) && $banner_button['target'] === '_blank') ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
								<?php echo esc_html($banner_button['title']); ?>
							</a>
						<?php endif; ?>
					</div>

					<div class="col-lg-6">
						<?php if (!empty($banner_image)): ?>
							<div class="banner__wrapper">
								<img class="banner__img" src="<?php echo esc_url($banner_image); ?>"
									alt="<?php echo esc_attr($banner_image['alt'] ?? ''); ?>">
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

	<!-- Problem Start -->
	<?php
	$problem_data = get_field('problem') ?? '';

	// Kiểm tra và gán dữ liệu
	$problem_icon = isset($problem_data['icon']) ? $problem_data['icon'] : null;
	$problem_title = isset($problem_data['title']) ? $problem_data['title'] : '';
	$problem_description = isset($problem_data['content']) ? $problem_data['content'] : '';
	$problem_list = isset($problem_data['list_content']) ? $problem_data['list_content'] : [];
	$problem_button = isset($problem_data['button']) ? $problem_data['button'] : [];
	$problem_image = isset($problem_data['image']) ? $problem_data['image'] : null;
	?>

	<section class="section__space">
		<div class="support_problem">
			<div class="container">
				<div class="row problem__row">
					<div class="col-lg-6">
						<?php if (!empty($problem_title)): ?>
							<div class="problem__title">
								<div class="title__content">
									<?php if (!empty($problem_icon['url'])): ?>
										<img src="<?php echo esc_url($problem_icon['url']); ?>"
											alt="<?php echo esc_attr($problem_icon['alt'] ?? ''); ?>" class="title__icon" />
									<?php endif; ?>
									<h2 class="title__text">
										<?php echo esc_html($problem_title); ?>
									</h2>
								</div>
							</div>
						<?php endif; ?>

						<!-- Description -->
						<?php if (!empty($problem_description)): ?>
							<div class="problem__desc"><?php echo wp_kses_post($problem_description); ?></div>
						<?php endif; ?>

						<!-- List -->
						<?php if (!empty($problem_list) && is_array($problem_list)): ?>
							<ul class="problem__list">
								<?php foreach ($problem_list as $problem_item):
									$problem_item_icon = isset($problem_item['icon']) ? $problem_item['icon'] : '';
									$problem_item_text = isset($problem_item['content']) ? $problem_item['content'] : '';
									?>
									<li class="list__item">
										<?php if (!empty($problem_item_icon)): ?>
											<img class="list__icon" src="<?php echo esc_url($problem_item_icon); ?>"
												alt="<?php echo esc_attr($problem_item_icon['alt'] ?? ''); ?>">
										<?php endif; ?>
										<?php if (!empty($problem_item_text)): ?>
											<span class="list__desc"><?php echo esc_html($problem_item_text); ?></span>
										<?php endif; ?>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>

						<?php if (!empty($problem_button['url']) && !empty($problem_button['title'])): ?>
							<a href="<?php echo esc_url($problem_button['url']); ?>"
								class="problem__button problem__button--text">
								<?php echo esc_html($problem_button['title']); ?>
							</a>
						<?php endif; ?>
					</div>

					<div class="col-lg-6">
						<?php if (!empty($problem_image['url'])): ?>
							<div class="problem__wrapper">
								<img class="problem__img" src="<?php echo esc_url($problem_image['url']); ?>"
									alt="<?php echo esc_attr($problem_image['alt'] ?? ''); ?>">
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Problem End -->


	<!-- Service Start -->
	<?php
	$service_data = get_field('service') ?? '';

	// Kiểm tra và gán dữ liệu
	$service_title = isset($service_data['title']) ? $service_data['title'] : '';
	$service_icon = isset($service_data['icon']) ? $service_data['icon'] : '';
	$service_customers = isset($service_data['customer']) && is_array($service_data['customer']) ? $service_data['customer'] : [];
	?>

	<section class="section__space">
		<div class="support_service">
			<div class="container">
				<?php if (!empty($service_title)): ?>
					<div class="service__title">
						<div class="title__content">
							<?php if (!empty($service_icon['url'])): ?>
								<img src="<?php echo esc_url($service_icon['url']); ?>"
									alt="<?php echo esc_attr($service_icon['alt'] ?? ''); ?>" class="title__icon" />
							<?php endif; ?>
							<h2 class="title__text">
								<?php echo esc_html($service_title); ?>
							</h2>
						</div>
					</div>
				<?php endif; ?>

				<?php if (!empty($service_customers)): ?>
					<div class="row">
						<?php foreach ($service_customers as $service_item): ?>
							<?php
							$customer_image = isset($service_item['image']) ? $service_item['image'] : [];
							$customer_position = isset($service_item['position']) ? $service_item['position'] : '';
							$customer_content = isset($service_item['content']) ? $service_item['content'] : '';
							?>
							<div class="col-12 col-md-6 col-lg-3">
								<div class="audience">
									<?php if (!empty($customer_image) && is_array($customer_image)): ?>
										<div class="audience__img">
											<img src="<?php echo esc_url($customer_image['url']); ?>"
												alt="<?php echo esc_attr($customer_image['alt'] ?? ''); ?>">
										</div>
									<?php endif; ?>

									<?php if (!empty($customer_position)): ?>
										<div class="audience__position">
											<?php echo esc_html($customer_position); ?>
										</div>
									<?php endif; ?>

									<?php if (!empty($customer_content)): ?>
										<div class="audience__list">
											<?php echo wp_kses_post($customer_content); ?>
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
	<!-- Service End -->

	<!-- User Start -->
	<?php
	$users_data = get_field('users') ?? [];

	// Gán dữ liệu sau khi kiểm tra tồn tại
	$title_users = !empty($users_data['title']) ? $users_data['title'] : '';
	$image_users = !empty($users_data['image']) && is_array($users_data['image']) ? $users_data['image'] : [];
	$list_users = !empty($users_data['content']) && is_array($users_data['content']) ? $users_data['content'] : [];
	$button_users = isset($users_data['button']) ? $users_data['button'] : [];
	?>

	<section class="section__space">
		<div class="support_users">
			<div class="container">
				<!-- Title -->
				<?php if (!empty($title_users)): ?>
					<h2 class="users__title col-lg-6">
						<?php echo esc_html($title_users); ?>
					</h2>
				<?php endif; ?>

				<!-- Image -->
				<?php if (!empty($image_users['url'])): ?>
					<img src="<?php echo esc_url($image_users['url']); ?>"
						alt="<?php echo esc_attr($image_users['alt'] ?? 'Icon'); ?>" class="title__icon" />
				<?php endif; ?>

				<?php if (!empty($list_users)): ?>
					<div class="users__content">
						<div class="row">
							<?php foreach ($list_users as $user): ?>
								<?php
								$user_title = $user['title'] ?? '';
								$user_content = $user['content'] ?? '';
								?>
								<div class="col-lg-4">
									<div class="audience">
										<?php if (!empty($user_title)): ?>
											<h4 class="audience__title">
												<?php echo esc_html($user_title); ?>
											</h4>
										<?php endif; ?>

										<?php if (!empty($user_content)): ?>
											<div class="audience__content">
												<?php echo wp_kses_post($user_content); ?>
											</div>
										<?php endif; ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
					<!--  -->
					<?php if (!empty($button_users['url']) && !empty($button_users['title'])): ?>
						<div class="button__inner">
							<a href="<?php echo esc_url($button_users['url']); ?>" class="users__button users__button--text">
								<?php echo esc_html($button_users['title']); ?>
							</a>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<!-- User End -->

	<!-- Price Service Start -->
	<?php
	$price_service = get_field('price_service') ?? [];

	$icon_price = isset($price_service['image']) && is_array($price_service['image']) ? $price_service['image'] : null;
	$title_price = !empty($price_service['title']) ? $price_service['title'] : '';
	$list_packages = isset($price_service['content']) && is_array($price_service['content']) ? $price_service['content'] : [];
	$button_price = isset($price_service['button']) ? $price_service['button'] : [];
	?>

	<section class="section__space">
		<div class="support_price">
			<div class="container">
				<div class="price_service__inner">
					<?php if (!empty($icon_price)): ?>
						<img src="<?php echo esc_url($icon_price['url'] ?? ''); ?>"
							alt="<?php echo esc_attr($icon_price['alt'] ?? 'Icon'); ?>" class="price_service__icon">
					<?php endif; ?>

					<?php if (!empty($title_price)): ?>
						<h2 class="price_service__title">
							<?php echo esc_html($title_price); ?>
						</h2>
					<?php endif; ?>
				</div>

				<div class="price_service__content">
					<div class="row">
						<?php foreach ($list_packages as $index => $item): ?>
							<?php
							$number = str_pad($index + 1, 2, '0', STR_PAD_LEFT);
							$image_package = isset($item['icon']) && is_array($item['icon']) ? $item['icon'] : null;
							$title_package = $item['title'] ?? '';
							$content_package = $item['content'] ?? '';
							?>
							<div class="col-lg-4">
								<!-- Packages -->
								<div class="price_card">
									<div class="price_card__heading">
										<div class="price_card__number">
											<?php echo esc_html($number); ?>
										</div>

										<?php if (!empty($title_package)): ?>
											<h3 class="price_card__title">
												<?php if (!empty($image_package)): ?>
													<img src="<?php echo esc_url($image_package['url']); ?>"
														class="price_card__icon"
														alt="<?php echo esc_attr($image_package['alt'] ?? 'Ảnh minh họa'); ?>" />
												<?php endif; ?>
												<?php echo esc_html($title_package); ?>
											</h3>
										<?php endif; ?>
									</div>
									<?php if (!empty($content_package)): ?>
										<div class="price_card__content">
											<?php echo wp_kses_post($content_package); ?>
										</div>
									<?php endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

				<!--  -->
				<?php if (!empty($button_price['url']) && !empty($button_price['title'])): ?>
					<div class="button__inner">
						<a href="<?php echo esc_url($button_price['url']); ?>" class="users__button users__button--text">
							<?php echo esc_html($button_price['title']); ?>
						</a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<!-- Price Service End -->

	<!-- Workflow Start -->
	<?php
	// Lấy dữ liệu từ ACF field 'project'
	$workflow_data = get_field('workflow') ?? [];
	//
	$title_workflow = !empty($workflow_data['title']) ? $workflow_data['title'] : '';
	$image_workflow = isset($workflow_data['image']) && is_array($workflow_data['image']) ? $workflow_data['image'] : null;
	?>

	<section class="section__space">
		<div class="container">
			<div class="support_workflow">
				<?php if (!empty($title_workflow)): ?>
					<h2 class="workflow__title text-center"><?php echo $title_workflow; ?> </h2>
				<?php endif; ?>
				<!--  -->
				<?php if (!empty($image_workflow)): ?>
					<div class="workflow__wrapper">
						<img src="<?php echo esc_url($image_workflow['url']); ?>"
							alt="<?php echo esc_attr($image_workflow['alt'] ?? 'Ảnh quy trình'); ?>"
							class="workflow__image" />
					</div>
				<?php endif; ?>

			</div>
		</div>
	</section>
	<!-- Workflow End -->

	<!-- FAQs Start -->
	<?php
	$faqs_data = get_field('faqs') ?? [];

	$title_faqs = !empty($faqs_data['title']) ? $faqs_data['title'] : '';
	$list_faqs = isset($faqs_data['faqs']) && is_array($faqs_data['faqs']) ? $faqs_data['faqs'] : [];
	?>

	<section class="section__space">
		<div class="support_faqs">
			<div class="container">
				<!-- Title -->
				<?php if (!empty($title_faqs)): ?>
					<h2 class="faqs__title text-center"><?php echo esc_html($title_faqs); ?></h2>
				<?php endif; ?>

				<?php if (!empty($list_faqs)): ?>
					<div class="accordion" id="accordionExample">
						<?php foreach ($list_faqs as $index => $faq):
							$question = $faq['title'] ?? '';
							$answer = $faq['content'] ?? '';
							if (empty($question) || empty($answer))
								continue;

							$id = 'faqItem' . $index;
							$is_first = ($index === 0);
							?>
							<div class="accordion-item">
								<h2 class="accordion-header" id="heading-<?php echo esc_attr($id); ?>">
									<button class="accordion-button <?php echo $is_first ? '' : 'collapsed'; ?>" type="button"
										data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo esc_attr($id); ?>"
										aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>"
										aria-controls="collapse-<?php echo esc_attr($id); ?>">
										<?php echo esc_html($question); ?>
									</button>
								</h2>
								<div id="collapse-<?php echo esc_attr($id); ?>"
									class="accordion-collapse collapse <?php echo $is_first ? 'show' : ''; ?>"
									aria-labelledby="heading-<?php echo esc_attr($id); ?>" data-bs-parent="#accordionExample">
									<div class="accordion-body editor">
										<?php echo wp_kses_post($answer); ?>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<!-- FAQs End -->

	<!-- Customers Start -->
	<?php
	$customers_data = get_field('customers') ?? [];
	//
	$title_customers = !empty($customers_data['title']) ? $customers_data['title'] : '';
	$list_customers = isset($customers_data['customers']) && is_array($customers_data['customers']) ? $customers_data['customers'] : [];
	?>

	<section class="section__space">
		<div class="support_customers">
			<div class="container">
				<?php if (!empty($title_customers)): ?>
					<h2 class="customers__title text-center"><?php echo esc_html($title_customers); ?></h2>
				<?php endif; ?>

				<?php if (!empty($list_customers)): ?>
					<div class="customers__grid d-flex flex-wrap">
						<?php foreach ($list_customers as $customer):
							$image = $customer['image'] ?? null;
							if (empty($image) || empty($image['url']))
								continue;
							?>
							<div class="customers__item">
								<img class="customers__logo img-fluid" src="<?php echo esc_url($image['url']); ?>"
									alt="<?php echo esc_attr($image['alt'] ?? 'Logo khách hàng'); ?>">
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<!-- Customers End -->

	<!-- Contact Form -->
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
	<!--  -->

	<!-- Footer Start -->
	<?php
	$footer_setting = get_field('footer_setting') ?? [];
	//
	$logo_footer = isset($footer_setting['logo']) ? $footer_setting['logo'] : [];
	$title_1_footer = !empty($footer_setting['title_1']) ? $footer_setting['title_1'] : '';
	$infos_footer = isset($footer_setting['list_info']) && is_array($footer_setting['list_info']) ? $footer_setting['list_info'] : [];
	$title_2_footer = !empty($footer_setting['title_2']) ? $footer_setting['title_2'] : '';
	$services_footer = isset($footer_setting['list_service']) && is_array($footer_setting['list_service']) ? $footer_setting['list_service'] : [];
	$image_footer = isset($footer_setting['image']) ? $footer_setting['image'] : [];
	$copyright_footer = !empty($footer_setting['copyright']) ? $footer_setting['copyright'] : '';
	?>

	<footer class="support_footer">
		<div class="container">
			<!-- Logo -->
			<?php if (!empty($logo_footer['url'])): ?>
				<div class="footer__logo">
					<a class="footer__link" href="<?php echo esc_url(home_url('/')); ?>">
						<img src="<?php echo esc_url($logo_footer['url']); ?>"
							alt="<?php echo esc_attr($logo_footer['alt'] ?? 'Logo'); ?>" class="footer__img">
					</a>
				</div>
			<?php endif; ?>

			<div class="row">
				<!-- Contact -->
				<div class="col-lg-6 mb-4 mb-lg-0">
					<?php if (!empty($title_1_footer)): ?>
						<h5 class="footer__heading"><?php echo esc_html($title_1_footer); ?></h5>
					<?php endif; ?>
					<ul class="infos__list">
						<?php if ($infos_footer && is_array($infos_footer)): ?>
							<?php foreach ($infos_footer as $infos_item):
								$infos_item_icon = isset($infos_item['icon']) ? $infos_item['icon'] : [];
								$infos_item_text = isset($infos_item['title']) ? $infos_item['title'] : '';
								?>
								<li class="list__item">
									<?php if (!empty($infos_item_icon)): ?>
										<img class="list__icon" src="<?php echo esc_url($infos_item_icon['link']); ?>"
											alt="<?php echo esc_attr($infos_item_icon['alt'] ?? ''); ?>">
									<?php endif; ?>
									<?php if (!empty($infos_item_text)): ?>
										<span class="list__desc"><?php echo esc_html($infos_item_text); ?></span>
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						<?php endif; ?>
					</ul>
				</div>

				<!-- ── Customer Service ─────────────────────────── -->
				<div class="col-lg-6">
					<?php if (!empty($title_2_footer)): ?>
						<h5 class="footer__heading"><?php echo esc_html($title_2_footer); ?></h5>
					<?php endif; ?>

					<?php if (!empty($services_footer)): ?>
						<div class="row">
							<?php foreach ($services_footer as $service):
								$icon = $service['icon'] ?? '';
								$text = $service['title'] ?? '';
								$link = $service['link'] ?? '#';
								?>
								<div class="col-lg-6 mb-3">
									<div class="footer__service">
										<?php if (!empty($icon['url'])): ?>
											<img class="service__icon" src="<?php echo esc_url($icon['url']); ?>"
												alt="<?php echo esc_attr($icon['alt'] ?? ''); ?>" width="20" height="20">
										<?php endif; ?>
										<a class="service__link"
											href="<?php echo esc_url($link); ?>"><?php echo esc_html($text); ?></a>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<?php if (!empty($image_footer['url'])): ?>
						<img src="<?php echo esc_url($image_footer['url']); ?>"
							alt="<?php echo esc_attr($image_footer['alt'] ?? 'Payments'); ?>"
							class="img-fluid footer__payments">
					<?php endif; ?>
				</div>
			</div>

			<div class="footer__copyright">
				<?php if (!empty($copyright_footer)): ?>
					<div class="copyright__wrapper d-flex align-items-center justify-content-center">
						<div class="col-8">
							<?php echo esc_html($copyright_footer); ?>
						</div>
					</div>
				<?php endif; ?>
			</div>

		</div>
	</footer>
	<!-- Footer End -->
</div>
<?php
get_footer();
