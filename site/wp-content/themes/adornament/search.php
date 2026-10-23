<?php get_header(); ?>
<?php get_sidebars(); ?>
			<div id="content" class="span-13">
            	<div class="content-box clearfix">
					<?php if (have_posts()) : ?>
                    	<p class="my_path"><a href="<?php echo get_option('home'); ?>/" title="Главная"><?php bloginfo('name'); ?></a> &raquo; <?php _e('Результаты поиска для ','magazine themes'); echo '&quot;<span class=my_path_sp>'.$s.'</span>&quot;'; ?></p>
						<?php while (have_posts()) : the_post(); ?>
						<?php if ( version_compare( $wp_version, '2.7', '>=' ) ) { ?>
								<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<?php } else { ?>
								<div id="post-<?php the_ID(); ?>" class="post post-<?php the_ID(); ?>">
							<?php } ?>
							<h2 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
							<div class="postmetadata"><span class="post_date ico"><?php the_time('jS F Y') ?></span>, <span class="post_author ico"><?php the_author() ?></span><?php if (current_user_can('edit_post', $post->ID)) { ?>, <span class="post_edit ico"><?php edit_post_link('Изменить', '', ''); } ?></span></div>
							<div class="entry clearfix">
                            	<?php include(TEMPLATEPATH . '/thumbnail.php'); ?>
                                <?php the_excerpt() ?>
							</div>
							<p class="more_content"><a href="<?php the_permalink(); ?>"><strong>Читать дальше &raquo;</strong></a></p>
						</div>
				
				<?php endwhile; ?>
                <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { ?>
					<div class="wp-pagenavi">
					<div class="alignleft"><?php next_posts_link('&laquo; Старые записи') ?></div>
					<div class="alignright"><?php previous_posts_link('Новые записи &raquo;') ?></div>
					</div>
				<?php } ?>
                <?php else : ?>
					<div class="notfound"><p>Записи не найдены!</p><p>Попробуйте еще раз.</p></div>
				<?php endif; ?>
                </div>
			</div>
<?php get_footer(); ?>
