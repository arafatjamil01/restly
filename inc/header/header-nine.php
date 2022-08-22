<?php 
$restly_show_cta9 = restly_options('restly_show_cta9');
$restly_show_minicart9 = restly_options('restly_show_minicart9');
$restly_show_search9 = restly_options('restly_show_search9');
$restly_show_login9 = restly_options('restly_show_login9');
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
<header id="masthead" class="site-header header-nine">
	<div class="main-header" id="<?php echo esc_attr($sticky); ?>">
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-light main-navigation" id="site-navigation">
				<div class="logo-area">
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
							$restly_ShowLogo = restly_options('restly_show_hlogo9');
							$restly_logo = restly_options('restly_logo9');
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
							'menu' 				=> $selectedmenu,
							'theme_location' 	=> 'mainmenu',
							'menu_id'        	=> 'mainmenu',
							'menu_class'		=> 'navbar-nav m-auto',
							'echo'              => true,
                            'fallback_cb'       => 'restly_Nav_Walker::fallback',
                            'walker'            => new restly_Nav_Walker
						)
					);
					?>
					<?php 
					if($restly_show_search9 == true ){
						get_template_part('inc/header/search','button');
					}
					if ( class_exists( 'WooCommerce' ) && $restly_show_minicart9 == true ) {
							restly_woocommerce_header_cart();
					}
					if($restly_show_login9 == true) :
					$restly_show_login9_text = restly_options('restly_show_login9_text');
					$restly_clogin9_link = restly_options('restly_clogin9_link');
					?>
					<div class="button wallet">
						<a href="<?php echo esc_url($restly_clogin9_link['url']); ?>" target="<?php echo esc_attr($restly_clogin9_link['target']); ?>" title="<?php echo esc_attr($restly_clogin9_link['text']); ?>" class="theme-btns gradient-btn-one"><?php echo esc_html($restly_show_login9_text); ?></a>
					</div>
					<?php endif; ?>
				</div>
			</nav>
		</div>
	</div>
	<?php if($restly_show_search9 == true ){ ?>
    <div class="header-search-popup">
        <div class="header-search-overlay search-open"></div>
        <div class="header-search-popup-content">
            <form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <span class="screen-reader-text"><?php esc_html_e( 'Search here...', 'restly' ) ?></span>
                <input type="search" value="<?php echo esc_attr(get_search_query()) ?>" name="s" placeholder="<?php esc_attr_e( 'Search here... ', 'restly' ) ?>" title="<?php esc_attr_e( 'Search for:', 'restly' ) ?>">
                <button type="submit"><i class="bi bi-search"></i></button>
            </form>		
        </div>
    </div> 
	<?php } ?>
</header><!-- #masthead -->