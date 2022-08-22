<?php 
$restly_left_header_group = restly_options('restly_top_left_header_group');
$restly_top_hopen_time = restly_options('restly_top_hopen_time');
$restly_header_top_right_socials = restly_options('restly_header_top_right_socials');
$restly_show_top_header = restly_options('restly_show_top_header');
$restly_show_cta = restly_options('restly_show_cta');
$restly_enable_sticky_menu = restly_options('restly_enable_sticky_menu');
if($restly_enable_sticky_menu == true ){
	$sticky = 'sticky-header';
}else{
	$sticky = 'no-sticky';
}

if(is_page() || is_singular('post') || is_singular('restly_portfolio') || is_singular('restly_team') || is_singular('restly_job') && get_post_meta(get_the_ID(), 'restly_metabox', true)) {
	$restlyMeta = get_post_meta(get_the_ID(), 'restly_metabox', true);
} else {
	$restlyMeta = array();
}
?>
<header id="masthead" class="site-header header-one">
	<?php if($restly_show_top_header == true ) : ?>
	<div class="header-top">
		<div class="header-top-fluid">
			<div class="row align-items-center">
				<?php if(!empty($restly_left_header_group)) : ?>
				<div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-8 top-header-left">
					<ul>
						<?php foreach($restly_left_header_group as $restly_hltop) : ?>
						<li><span><?php echo esc_html($restly_hltop['restly_left_topH_label']); ?></span><?php echo wp_kses($restly_hltop['restly_left_topH_dec'],'restly_allowed_html'); ?></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php endif; ?>
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 top-header-right">
					<?php if(!empty($restly_top_hopen_time)) : ?>
					<div class="office-time">
						<i class="<?php echo esc_attr($restly_top_hopen_time['restly_top_hopen_icon']); ?>"></i><span><?php echo esc_html($restly_top_hopen_time['restly_top_hopen_text']); ?></span>
					</div>
					<?php endif; ?>
					<?php if(!empty($restly_header_top_right_socials)) : ?>
					<div class="social-icons">
						<ul>
						<?php foreach($restly_header_top_right_socials as $restly_top_social) : ?>
							<li><a <?php if($restly_top_social['restly_top_hsocial_newtab'] == true ) : ?> target="_blank" <?php endif; ?> href="<?php echo esc_url($restly_top_social['restly_top_hsocial_link']); ?>"><i class="<?php echo esc_attr($restly_top_social['restly_top_hsocial_icon']); ?>"></i></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<div class="main-header header-fluid">
		<nav class="navbar navbar-expand-lg navbar-light main-navigation" id="<?php echo esc_attr($sticky); ?>">
			<div class="logo-area logobg">
				<div class="site-branding">
					<?php
					if(!empty(is_array($restlyMeta) && array_key_exists('restly_meta_select_logo', $restlyMeta)) && $restlyMeta['restly_meta_select_logo'] == true && !empty($restlyMeta['restly_meta_logo']['url'])){
						?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<img src="<?php echo esc_url($restlyMeta['restly_meta_logo']['url']); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>">
						</a>
						<?php 
					}elseif(has_custom_logo()){
						the_custom_logo();
					}else{
						$restly_ShowLogo = restly_options('restly_show_hlogo1');
						$restly_logo = restly_options('restly_logo1');
						if( $restly_ShowLogo == true && !empty($restly_logo['url'])){
							$restly_logoUrl = $restly_logo['url'];?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<img src="<?php echo esc_url($restly_logoUrl); ?>" alt="<?php esc_attr(bloginfo( 'name' )); ?>">
							</a>
						<?php }else{ ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php }
					}
					?>
				</div><!-- .site-branding -->
			</div>
			<div class="navbar-collapse nav-menu stellarnav">
				<?php
				if (!empty(is_array($restlyMeta) && array_key_exists('restly_meta_select_menu', $restlyMeta) &&  $restlyMeta['restly_meta_enable_header_menu'] == true) ) {
					$selectedmenu = $restlyMeta['restly_meta_select_menu'];
				}else{
					$selectedmenu = '';
				}
				wp_nav_menu(
					array(
						'container' 		=> false,
						'theme_location' 	=> 'mainmenu',
						'menu' 				=> $selectedmenu,
						'menu_id'        	=> 'mainmenu',
						'menu_class'		=>'ms-auto me-5 mb-lg-0',
						'echo'              => true,
                        'fallback_cb'       => 'restly_Nav_Walker::fallback',
                        'walker'            => new restly_Nav_Walker
					)
				);
				?>
				<?php if($restly_show_cta == true ){
					get_template_part('inc/header/cta','button'); 
				} ?>
			</div>
		</nav>
	</div>
</header><!-- #masthead -->