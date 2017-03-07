	<?php
		
		$options = get_option( 'hometask_theme_options' );
		$current_layout = $options['theme_layout'];
		$feature_widget_area_layouts = array( 'content-sidebar-sidebar', 'sidebar-sidebar-content' );
		
		if ( 'no-sidebar' == $current_layout )
			return;

		if ( in_array( $current_layout, $feature_widget_area_layouts ) ) :
	?>
	<div id="main-sidebars">

		<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>

		<div id="feature" class="widget-area" role="complementary">
			<ul class="xoxo sidebar-list">
				<?php dynamic_sidebar( 'sidebar-3' ); ?>
			</ul>
		</div><!-- #feature.widget-area -->

		<?php endif; // ends the check for the current layout that determines the availability of the feature widget area ?>

		<?php endif; // ends the check for the current layout that determines the #main-sidebars markup ?>

		<div id="sidebar" class="widget-area" role="complementary">
			<ul class="xoxo sidebar-list">

<?php
	
	if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

			<li class="widget widget_search">
				<h3 class="widget-title"><?php _e( 'Поиск', 'hometask' ); ?></h3>
				<?php get_search_form(); ?>
			</li>

			<li class="widget widget_recent_entries">
				<h3 class="widget-title"><?php _e( 'Новое на сайте', 'hometask' ); ?></h3>
				<ul>
					<?php
					$recent_entries = new WP_Query();
					$recent_entries->query( 'order=DESC&posts_per_page=10' );

					while ($recent_entries->have_posts()) : $recent_entries->the_post();
						?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
						<?php
					endwhile;
					?>
				</ul>
			</li>

			<li class="widget widget_links">
				<h3 class="widget-title"><?php _e( 'Ссылки', 'hometask' ); ?></h3>
				<ul>
					<?php wp_list_bookmarks(); ?>
				</ul>
			</li>

		<?php endif; // end primary widget area ?>
			</ul>
		</div><!-- #sidebar .widget-area -->

		<?php
			
			$secondary_widget_area_layouts = array( 'content-sidebar-sidebar', 'sidebar-sidebar-content', 'sidebar-content-sidebar' );
			if ( in_array( $current_layout, $secondary_widget_area_layouts ) ) :
		?>
		<div id="secondary-sidebar" class="widget-area" role="complementary">
			<ul class="xoxo sidebar-list">
			<?php // A second sidebar for widgets. hometask uses the secondary widget area for three column layouts.
			if ( ! dynamic_sidebar( 'sidebar-2' ) ) : ?>

				<li class="widget widget_meta">
					<h3 class="widget-title"><?php _e( 'Прочее', 'hometask' ); ?></h3>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</li>

			<?php endif; ?>
			</ul>
		</div><!-- #secondary-sidebar .widget-area -->
		<?php endif; // ends the check for the current layout that determins if the third column is visible ?>

	<?php
		
		if ( in_array( $current_layout, $feature_widget_area_layouts ) )
			echo '</div><!-- #main-sidebars -->';
	?>
