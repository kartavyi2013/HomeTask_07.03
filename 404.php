<?php


get_header(); ?>

	<div id="content-container">
		<div id="content" role="main">

			<div id="post-0" class="post error404 not-found">
				<h1 class="entry-title"><?php _e( 'Не найдено', 'hometask' ); ?></h1>
				<div class="entry entry-content">
					<p><?php _e( 'К сожалению, по вашему запросу ничего не найдено.', 'hometask' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</div><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #container -->
	<script type="text/javascript">

		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php get_footer(); ?>