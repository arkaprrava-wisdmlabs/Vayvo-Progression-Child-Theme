<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package pro
 */
?>


<div id="video-post-container">
	<h1 class="video-page-title"><?php the_title(); ?></h1>

	<ul id="video-post-meta-list">
		
		<?php if (get_theme_mod( 'progression_studios_media_grenre_sidebar', 'true') == 'true') : ?>
		<?php 
			$terms = get_the_terms( $post->ID , 'video-genres' ); 
			if ( !empty( $terms ) ) :
				echo '<li id="video-post-meta-cat"><ul>';
			foreach ( $terms as $term ) {
				$term_link = get_term_link( $term, 'video-genres' );
				if( is_wp_error( $term_link ) )
					continue;
				echo '<li><a href="' . $term_link . '">' . $term->name . '</a></li>';
			} 
			echo '</ul></li>';
		endif;
		?>
		<?php endif; ?>
		

		
		<?php if (get_theme_mod( 'progression_studios_media_releases_date_sidebar', 'true') == 'true') : ?>
		<?php if( get_post_meta($post->ID, 'progression_studios_release_date', true) ): ?>
			<li id="video-post-meta-year"><?php 
					$video_release_date = get_post_meta($post->ID, 'progression_studios_release_date', true);
					echo esc_attr(date_i18n('Y',strtotime($video_release_date) )); ?></li>
		<?php endif; ?>
		<?php endif; ?>
		
		<?php if( get_post_meta($post->ID, 'progression_studios_film_rating', true)): ?>
			<li id="video-post-meta-rating"><span><?php echo esc_attr( get_post_meta($post->ID, 'progression_studios_film_rating', true)); ?></span></li>
		<?php endif; ?>
	</ul>
	<div class="clearfix-pro"></div>
	
	
	<div id="video-post-buttons-container">
		
		<?php if( get_post_meta($post->ID, 'arm_is_paid_post', true) && !current_user_can('administrator') || post_password_required( get_the_ID() ) ): ?>
		
			<?php if( is_user_logged_in() ): ?>
		
				<?php 
					$plan_id = progression_arm_get_plan_from_post_id( $post->ID );
			        $current_user_id = get_current_user_id();
			        $arm_user_plan = get_user_meta($current_user_id, 'arm_user_plan_ids', true);
			        $arm_user_plan = !empty($arm_user_plan) ? $arm_user_plan : array();
			        if(!empty($arm_user_plan)){
			            if(in_array($plan_id, $arm_user_plan)) {
				?>
		
					<?php if( get_post_meta($post->ID, 'progression_studios_video_post', true) || get_post_meta($post->ID, 'progression_studios_youtube_video', true) || get_post_meta($post->ID, 'progression_studios_vimeo_video', true) ): ?><a href="#Video-Vayvo-Single" id="video-post-play-text-btn" class="afterglow"><i class="fa fa-play-circle" aria-hidden="true"></i><?php esc_html_e( 'Play', 'vayvo-progression' ); ?></a><?php endif; ?>
					
					
				<?php }  } ?>
		
			<?php endif; ?>
		
		<?php else: ?>
		
			<?php if( get_post_meta($post->ID, 'progression_studios_video_post', true) || get_post_meta($post->ID, 'progression_studios_youtube_video', true) || get_post_meta($post->ID, 'progression_studios_vimeo_video', true) ): ?><a href="#Video-Vayvo-Single" id="video-post-play-text-btn" class="afterglow"><i class="fa fa-play-circle" aria-hidden="true"></i><?php esc_html_e( 'Play', 'vayvo-progression' ); ?></a><?php endif; ?>
			
		
		<?php endif; ?>
		
			<div id="commentbtnwrap"><a href="#comments" id="video-post-play-text-btn" ><i class="fa fa-comment" aria-hidden="false"></i><?php esc_html_e( 'Comment', 'vayvo-progression' ); ?></a></div>
		
		<?php progression_the_wishlist_button() ?>
		<?php if (function_exists( 'progression_studios_elements_social_sharing') && get_theme_mod( 'progression_studios_blog_post_sharing', 'on') == 'on' )  : ?>
			<div id="video-social-sharing-button"><i class="fa fa-share" aria-hidden="true"></i><?php esc_html_e( 'Share', 'vayvo-progression' ); ?></div>
		<?php endif; ?>
	<div class="clearfix-pro"></div>
	</div><!-- close #video-post-buttons-container -->
	
	<div id="vayvo-video-post-content">
		<?php the_content(); ?>
	</div><!-- #vayvo-video-post-content -->
	

	
	<?php wp_reset_postdata();?>
	<?php if (get_theme_mod( 'progression_studios_media_lead_cast', 'true') == 'true') : ?>
		<?php get_template_part( 'template-parts/cast', 'posts' ); ?>
	<?php endif; ?>
	
	
	<?php if (get_theme_mod( 'progression_studios_seasons_deprecation', 'default') == 'default') : ?>
	
		<?php if( get_post_meta($post->ID, 'arm_is_paid_post', true) && !current_user_can('administrator') || post_password_required( get_the_ID() )  ): ?>
		
			<?php if( is_user_logged_in() && class_exists( 'ARM_access_rules' ) ): ?>
		
				<?php  $plan_id = progression_arm_get_plan_from_post_id( $post->ID ); $current_user_id = get_current_user_id(); $arm_user_plan = get_user_meta($current_user_id, 'arm_user_plan_ids', true); $arm_user_plan = !empty($arm_user_plan) ? $arm_user_plan : array();  if(!empty($arm_user_plan)){  if(in_array($plan_id, $arm_user_plan)) { ?>
		
					<?php get_template_part( 'template-parts/single/seasons', 'episodes' ); ?>
				
				<?php }  } ?>
		
			<?php endif; ?>
		
		<?php else: ?>
		
			<?php get_template_part( 'template-parts/single/seasons', 'episodes' ); ?>
		
		<?php endif; ?>
	
	

	
		<?php if (get_theme_mod( 'progression_studios_media_more_like_this', 'true') == 'true') : ?>
		<?php $entries = get_post_meta( get_the_ID(), 'progression_studios_display_season_new', true ); ?>
		<?php if( $entries == '' ) : ?> 
			<?php get_template_part( 'template-parts/related', 'videos' ); ?>
		<?php endif; ?>
		<?php endif; ?>
	
	<?php else: ?>
		
		
		<?php if( get_post_meta($post->ID, 'arm_is_paid_post', true) && !current_user_can('administrator') || post_password_required( get_the_ID() ) ): ?>
		
			<?php if( is_user_logged_in() ): ?>
		
				<?php 
					$plan_id = progression_arm_get_plan_from_post_id( $post->ID );
			        $current_user_id = get_current_user_id();
			        $arm_user_plan = get_user_meta($current_user_id, 'arm_user_plan_ids', true);
			        $arm_user_plan = !empty($arm_user_plan) ? $arm_user_plan : array();
			        if(!empty($arm_user_plan)){
			            if(in_array($plan_id, $arm_user_plan)) {
				?>
		
					<?php if(get_post_meta($post->ID, 'progression_studios_season_title', true)): ?>
						<?php get_template_part( 'template-parts/season', 'episodes' ); ?>		
					<?php endif; ?>
				
				<?php }  } ?>
		
			<?php endif; ?>
		
		<?php else: ?>
		
			<?php if(get_post_meta($post->ID, 'progression_studios_season_title', true)): ?>
				<?php get_template_part( 'template-parts/season', 'episodes' ); ?>		
			<?php endif; ?>
		
		<?php endif; ?>
	
	
		
		<?php if (get_theme_mod( 'progression_studios_media_more_like_this', 'true') == 'true' && !get_post_meta($post->ID, 'progression_studios_season_title', true)) : ?>
			<?php get_template_part( 'template-parts/related', 'videos' ); ?>
		<?php endif; ?>
		
		
	<?php endif; ?><!-- close seasons -->
	


</div><!-- close #video-post-container -->


<div id="video-post-sidebar">
	
	<?php if( get_post_meta($post->ID, 'progression_studios_poster_image', true) ): ?>
		<div class="content-sidebar-image noselect<?php if( get_post_meta($post->ID, 'progression_studios_video_embed', true) ): ?>  video-embedded-media-height-adjustment<?php endif; ?>">			
			<img src="<?php echo esc_url( get_post_meta($post->ID, 'progression_studios_poster_image', true)); ?>" alt="<?php the_title(); ?>">
		</div>
	<?php endif; ?>
	
	<?php if (get_theme_mod( 'progression_studios_media_releases_date_sidebar', 'true') == 'true') : ?>
	<?php if( get_post_meta($post->ID, 'progression_studios_release_date', true) ): ?>
	<div class="content-sidebar-section video-sidebar-section-release-date">
		<h4 class="content-sidebar-sub-header"><?php esc_html_e( 'Release Date', 'vayvo-progression' ); ?></h4>
		<div class="content-sidebar-short-description"><?php 
			$video_release_date = get_post_meta($post->ID, 'progression_studios_release_date', true);
			echo esc_attr(date_i18n(get_option('date_format'), strtotime($video_release_date) )); ?></div>
	</div><!-- close .content-sidebar-section -->
	<?php endif; ?>
	<?php endif; ?>
	
	
	
	<?php if (get_theme_mod( 'progression_studios_media_duration_sidebar', 'true') == 'true') : ?>
	<?php if( get_post_meta($post->ID, 'progression_studios_media_duration_meta', true) ): ?>
	<div class="content-sidebar-section video-sidebar-section-length">
		<h4 class="content-sidebar-sub-header"><?php esc_html_e( 'Duration', 'vayvo-progression' ); ?></h4>
		<div class="content-sidebar-short-description"><?php echo esc_attr( get_post_meta($post->ID, 'progression_studios_media_duration_meta', true)); ?></div>
	</div><!-- close .content-sidebar-section -->
	<?php endif; ?>
	<?php endif; ?>
	
	<?php if (get_theme_mod( 'progression_studios_media_director_sidebar', 'true') == 'true') : ?>
	<?php 
		$terms = get_the_terms( $post->ID , 'video-director' ); 
		if ( !empty( $terms ) ) :
			echo '<div class="content-sidebar-section video-sidebar-section-director"><h4 class="content-sidebar-sub-header">';
			echo  esc_html_e( 'Director', 'vayvo-progression');
			echo '</h4><ul class="video-director-meta-sidebar">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term, 'video-director' );
			if( is_wp_error( $term_link ) )
				continue;
			echo '<li><a href="' . $term_link . '">' . $term->name . '</a></li>';
		} 
		echo '</ul></div>';
	endif;
	?>
	<?php endif; ?>
	
	<?php if (get_theme_mod( 'progression_studios_media_recent_reviews_sidebar', 'true') == 'true') : ?>
	<?php if(  comments_open() || get_comments_number() ): ?>	
	<div id="video-post-recent-reviews-sidebar">
		<h3 class="content-sidebar-reviews-header"><?php esc_html_e( 'Recent Reviews', 'vayvo-progression' ); ?></h3>
		
		<?php  $comment_count_pro = get_comments_number(); if( $comment_count_pro >= 1  ): ?>
			<ul class="sidebar-reviews-pro">
				<?php
				//https://deluxeblogtips.com/display-comments-in-homepage/
				$comments = get_comments( array(
				    'post_id' => get_the_ID(),
				    'status' => 'approve',
				) );
				
		    	wp_list_comments( array(
					'per_page'          => '2',
					'callback' => 'progression_studios_review_sidebar',
					'type'     => 'comment',
				), $comments );

				?>
			</ul>
			<div id="all-reviews-button-progression"><?php echo esc_html_e( 'See All Reviews', 'vayvo-progression' ); ?></div>
			<?php else: ?>
				<div class="no-recent-reviews">

						
						<?php echo esc_html_e( 'No reviews of ', 'vayvo-progression' ); ?> <?php the_title(); ?>
				</div>
				<div id="all-reviews-button-progression"><?php echo esc_html_e( 'Leave First Review', 'vayvo-progression' ); ?></div>
			<?php endif; ?>
		
	</div><!-- close #video-post-recent-reviews-sidebar -->
	<?php endif; ?>
	<?php endif; ?>
	
	<div class="clearfix-pro"></div>
</div><!-- close #video-post-sidebar -->

<?php comments_template() ?>
