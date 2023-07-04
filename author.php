<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package pro
 */

get_header(); ?>
<?php 
$userdata = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); 
?>

	
		<div id="content-pro" class="site-content">
			<div class="width-container-pro">
				
				
				<div id="vayvo-progression-author-sidebar">
					<div id="content-sidebar-info">
			
						<div id="avatar-sidebar-large-profile" style="background-image:url('<?php if($userdata->avatar): ?><?php echo esc_url($userdata->avatar);  ?><?php else: ?><?php echo get_avatar_url( $userdata->user_email, 200 ); ?><?php endif; ?>')"></div>
						<div id="profile-sidebar-gradient"></div>
						<?php if(get_query_var('author_name')) : $curauth = get_user_by('slug', get_query_var('author_name')); else : $curauth = get_userdata(get_query_var('author')); endif;
							if( $curauth->ID == $user_ID) : ?>
						<?php if(function_exists('arm_check_for_wp_rename')  ): 
							global $arm_global_settings;
							$global_settings = $arm_global_settings->global_settings;
						?>
						<a href="<?php echo esc_url( $arm_global_settings->arm_get_permalink('', $global_settings['edit_profile_page_id']) ); ?>" class="edit-profile-sidebar"><?php esc_html_e( 'Edit', 'vayvo-progression' ); ?></a>
						<?php endif; ?>
						<?php endif; ?>
					</div><!-- close .content-sidebar-info -->
					
					
					<div id="vayvo-profile-sidebar-name">
						<h5><?php if($userdata->first_name): ?>
									<?php echo esc_attr($userdata->first_name); ?> <?php echo esc_attr($userdata->last_name); ?>
								<?php else: ?>
									<?php echo esc_attr($userdata->display_name); ?>
								<?php endif; ?></h5>
						<?php if($userdata->country): ?><h6><?php echo esc_attr($userdata->country); ?></h6><?php endif; ?></h5>
				
							<?php if(function_exists('arm_check_for_wp_rename')  ): ?>
							<?php
							$socialProfileFields = $arm_member_forms->arm_social_profile_field_types();
				         if ($arm_social_feature->isSocialFeature) {
				             if (!empty($socialProfileFields) ) {
								?>	 
									<ul class="profile-social-media-sidebar-icons">
				 
								<?php	 
				            foreach ($socialProfileFields as $spfKey => $spfLabel) {
				                $spfMetaKey = 'arm_social_field_'.$spfKey;
				                $spfMetaValue = get_user_meta($userdata->ID, $spfMetaKey, true);
									 $skey_field = get_user_meta($userdata->ID,$spfMetaKey,true);
								?>
			
						  			 <?php if(!empty($spfMetaValue)): ?>
						  				 <li><a target="_blank" href="<?php echo esc_attr($skey_field);?>"><i class="fa fa-<?php if($spfKey == "googleplush"): ?>google-plus<?php else: ?><?php echo esc_attr($spfKey);?><?php endif; ?>"></i></a></li>
						  				<?php endif; ?>
							<?php } ?>
				 					</ul>
								 <?php
				           }
							}
							?>
							<?php endif; ?>
				
					</div>
					
					
					<?php
			
					$wishlist_videos_loop = new WP_Query( apply_filters( 'widprogression_wishlist_videos_user_videos', array(
						'posts_per_page'      => 99999,
						'post_status'         => 'publish',
						'ignore_sticky_posts' => true,
						'wishlist_videos'    => $userdata->ID,
						'post_type'           => 'video_skrn'
					) ) );
		
		
					?>

					<?php
					$reiew_count_args = array(
					    'user_id' => $userdata->ID, // comments by this user only
					    'status' => 'approve',
					    'post_status' => 'publish',
					    'post_type' => 'video_skrn'
					);
		
					?>
		
					<?php if (get_theme_mod( 'progression_studios_profile_page_user_stats', 'true') == 'true') : ?>
					<div class="content-sidebar-section">
						<h3 class="content-sidebar-sub-header"><?php esc_html_e( 'User Stats', 'vayvo-progression' ); ?></h3>
						<ul id="profile-watched-stats">
							<li><span><?php echo esc_attr($wishlist_videos_loop->post_count); ?></span> <?php esc_html_e( 'Watchlist', 'vayvo-progression' ); ?></li>
							<li><span><?php echo skrn_custom_count_post_by_author($reiew_count_args); ?></span> <?php esc_html_e( 'Reviews', 'vayvo-progression' ); ?></li>
						</ul>
					</div><!-- close .content-sidebar-section -->
					<?php endif; ?>
					
		
					<?php if(function_exists('arm_check_for_wp_rename')  ): 
					$date_format = $arm_global_settings->arm_get_wp_date_format();
					?>

						<?php if (get_theme_mod( 'progression_studios_profile_page_member_since', 'true') == 'true') : ?>
						<div class="content-sidebar-section">
							<h3 class="content-sidebar-sub-header"><?php esc_html_e( 'Member Since', 'vayvo-progression' ); ?></h3>
							<div class="content-sidebar-simple-text">
								<?php echo date_i18n($date_format, strtotime($userdata->user_registered));?>
							</div>
						</div><!-- close .content-sidebar-section -->
						<?php endif; ?>
			
						<?php if (get_theme_mod( 'progression_studios_profile_page_biography', 'true') == 'true') : ?>
						<?php if($userdata->description): ?>
						<div class="content-sidebar-section">
							<h3 class="content-sidebar-sub-header"><?php esc_html_e( 'Biography', 'vayvo-progression' ); ?></h3>
							<div class="content-sidebar-biography-text">
								<?php echo esc_attr($userdata->description); ?>
							</div>
						</div><!-- close .content-sidebar-section -->
						<?php endif; ?>
						<?php endif; ?>
			
					<?php endif; ?><!-- end ARMember Actionvation Check -->
					
					
				</div><!-- close #vayvo-progression-author-content-sidebar -->
				
				
				<div id="vayvo-progression-author-content-container">
					
					
					<ul id="dashboard-sub-menu">
						<li class="current"><a href="<?php echo get_author_posts_url($userdata->ID); ?>"><?php esc_html_e( 'Watchlist', 'vayvo-progression' ); ?></a></li>
						<?php if (get_theme_mod( 'progression_studios_profile_page_reviews', 'true') == 'true') : ?><li><a href="<?php echo get_author_posts_url($userdata->ID); ?>?reviews"><?php esc_html_e( 'Comments', 'vayvo-progression' ); ?></a></li><?php endif; ?>
					</ul><!-- close #dashboard-sub-menu -->
					
					<div id="vayvo-progression-watchlist-div-container">
			
						<?php
						if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {   $paged = get_query_var('page'); } else {  $paged = 1; }

						$args = array(
							'paged' => $paged,
							'post_status'         => 'publish',
							'wishlist_videos'    => $userdata->ID,
							'post_type'           => 'video_skrn',
							'posts_per_page'=> '90',
						); 
						$blogloop = new WP_Query( $args ); 
						if ($blogloop->have_posts()) : ?>
			
						
							<div class="progression-masonry-margins" style="margin-top:-<?php echo esc_attr(get_theme_mod('progression_studios_author_index_gap', '10')); ?>px; margin-left:-<?php echo esc_attr(get_theme_mod('progression_studios_author_index_gap', '10')); ?>px; margin-right:-<?php echo esc_attr(get_theme_mod('progression_studios_author_index_gap', '10')); ?>px;">
								<div class="progression-studios-video-index-list">
									<?php
									while ( $blogloop->have_posts() ) : $blogloop->the_post();
									?>
							
										<div class="progression-masonry-item progression-masonry-col-<?php echo esc_attr(get_theme_mod( 'progression_studios_author_columns', '2')); ?>">
											<div class="progression-masonry-padding-blog" style="padding:<?php echo esc_attr(get_theme_mod('progression_studios_author_index_gap', '10')); ?>px;">
												<div class="progression-studios-isotope-animation">
													<?php get_template_part( 'template-parts/content', 'skrn_video'); ?>
												</div><!-- close .studios-isotope-animation -->
											</div><!-- close .progression-masonry-padding-blog -->
										</div><!-- cl ose .progression-masonry-item -->
									<?php endwhile; ?>
								</div><!-- close .progression-blog-index-masonry -->
							</div><!-- close .progression-masonry-margins -->
				
							<div class="clearfix-pro"></div>

							<?php wp_reset_postdata();?>
					
						<?php else: ?>
							<h3 class="progresison-studios-no-author-posts-list"><?php esc_html_e( 'No videos in watchlist', 'vayvo-progression' ); ?></h3>
						<?php endif; ?>
					</div><!-- close #vayvo-progression-watchlist-div-container -->
					
					
					
					<div id="vayvo-progression-reviews-div-container">
						
						<?php
						$comments_query = new WP_Comment_Query;
						$comments = $comments_query->query( $reiew_count_args );

						// Comment Loop
						if ( $comments ) : ?>
							<ul class="fullscreen-reviews-pro">
								<?php foreach ( $comments as $comment ): ?>
								  	<li>
								 		<div class="progression-studios-sidebar-review-container">
								 			<?php $rating_formatted_edit = get_comment_meta( get_comment_ID(), 'rating', true );?>
		
								 			<!--div id="sidebar-review-number"><?php echo number_format((float)$rating_formatted_edit, 0, '.', '');	?></div-->
								 			<div id="sidebar-review-rating-container">
								 				<div class="average-rating-video-post">
								 					<div class="average-rating-video-empty">
								 						<span class="dashicons dashicons-star-empty"></span><span class="dashicons dashicons-star-empty"></span><span class="dashicons dashicons-star-empty"></span><span class="dashicons dashicons-star-empty"></span><span class="dashicons dashicons-star-empty"></span>
								 					</div>
								 					<div class="average-rating-overflow-width" style="width:<?php echo (esc_attr($rating_formatted_edit) / 5 * 100) ;	?>%;">
								 						<div class="average-rating-video-filled">
								 							<span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span>
								 						<div class="clearfix-pro"></div>
								 						</div><!-- close .average-rating-video-filled -->
								 					</div><!-- close .average-rating-overflow-width -->
								 				</div>
								 			</div>
			
			
								 	 		<h5 id="sidebar-review-author"><a href="<?php echo esc_url( get_permalink($comment->comment_post_ID) ) ; ?>"><?php echo esc_html(get_the_title($comment->comment_post_ID)) ; ?></a></h5>
								 	 		<h6 id="sidebar-review-date"><?php esc_html_e( 'Reviewed on:', 'vayvo-progression' ); ?> <?php echo esc_html( get_comment_date( get_option('date_format'), $comment->comment_ID ) ); ?></h6>
		
								 			<?php 
								 			$spoiler = get_comment_meta( $comment->comment_ID, 'spoiler', true );
								 			if ( $spoiler == 'on' || $spoiler == '1'  ) : ?><div class="spoiler-review"><?php esc_html_e( 'Contains Spoiler', 'vayvo-progression' ); ?></div><?php endif; ?>
		
								 			<?php
								 				$comment_text_count = strip_tags( get_comment_text() );
								 				$comment_text_number = explode(' ', $comment_text_count);
								 			?>
		
		
											<div class="sidebar-comment-exerpt"><?php echo strip_tags($comment->comment_content); ?></p></div>
								 	 		
		
	 		
								 		</div><!-- close .progression-studios-sidebar-review-container -->
								  	</li>
									
		
								<?php endforeach; ?>
							</ul>
					
							<?php else: ?>
						
								<h3 class="progresison-studios-no-author-posts-list"><?php echo esc_html_e( 'No reviewed videos', 'vayvo-progression' ) ?></h3>
					
						<?php endif; ?>
	
					</div><!-- close #vayvo-progression-reviews-div-container -->
					
					

					<?php
			
					//$all_meta_for_user = get_user_meta( 1 );
					//print_r( $all_meta_for_user );
			
					?>
			
			
					
					
					
					
					<div class="clearfix-pro"></div>
				</div><!-- close #vayvo-progression-author-content-container -->
				
				
			<div class="clearfix-pro"></div>
			</div><!-- close .width-container-pro -->
		</div><!-- #content-pro -->
<?php get_footer(); ?>