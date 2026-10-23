<?php get_header(); ?>
<?php get_sidebars(); ?>
			<div id="content" class="span-13">
            	<div class="content-box clearfix">
					<?php if (have_posts()) : ?>
                    	<p class="my_path"><?php /* If this is a category archive */ if (is_category()) { ?></a> 
		<span class="my_path_sp"><?php single_cat_title(); ?></span>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		Метки записей &#8216;<span class="my_path_sp"><?php single_tag_title(); ?></span>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		Архив <span class="my_path_sp"><?php the_time('jS F Y'); ?></span>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		Архив <span class="my_path_sp"><?php the_time('F, Y'); ?></span>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		Архив <span class="my_path_sp"><?php the_time('Y'); ?></span>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		Архив автора
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		Архив сайта
 	  <?php } ?></p>
						<?php while (have_posts()) : the_post(); ?>
                        	<?php if ( version_compare( $wp_version, '2.7', '>=' ) ) { ?>
								<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<?php } else { ?>
								<div id="post-<?php the_ID(); ?>" class="post post-<?php the_ID(); ?>">
							<?php } ?>
							<h2 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
							<div class="postmetadata"><?php if (current_user_can('edit_post', $post->ID)) ?></span></div>	
							<div class="entry clearfix">
                            	<?php include(TEMPLATEPATH . '/thumbnail.php'); ?>
                                <?php the_excerpt() ?>
							</div>
							<div class="postmetadata"><?php if(get_the_tags()) ?></div>
						</div>	
				
				<?php endwhile; ?>
                <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
					<div class="wp-pagenavi">
					<div class="alignleft"><?php next_posts_link('&laquo; Старые записи') ?></div>
					<div class="alignright"><?php previous_posts_link('Новые записи &raquo;') ?></div>
					</div>
				<?php } ?>
                <?php else : ?>
					<div class="notfound"><p>Записи не найдены!</p><p>Попробуйте еще раз поискать.</p></div>
				<?php endif; ?>
                </div>
			</div>
<?php get_footer(); ?>
