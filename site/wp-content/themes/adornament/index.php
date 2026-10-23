<?php get_header(); ?>
<?php get_sidebars(); ?>
			<div id="content" class="span-13">
<?php if(is_home()) { include (TEMPLATEPATH . '/gallery.php'); } ?>
<?php if(is_home()) { include (TEMPLATEPATH . '/homepage_cat.php'); } ?>
				<div id="home_posts">
                <div class="article-title">Лента новостей</div>
                <div class="content-box-index clearfix">
				<?php
				if(wpthemes_options('featured_articles_enable') != '' && wpthemes_options('featured_articles_num') > 0) {
				?>
					<?php $paged = (get_query_var('paged')); ?>
					<?php query_posts("cat=" . wpthemes_options('featured_articles') . "&paged=" . $paged . "&showposts=" . wpthemes_options('featured_articles_num')); ?>
					<?php if (have_posts()) : ?>
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
							<div class="postmetadata"><span class="post_cat ico">Posted in <?php the_category(', ') ?></span><?php if(get_the_tags()) { ?>, <span class="post_tags ico"><?php  the_tags('Метки: ', ', '); } ?></span>, <span class="post_comments ico"><?php comments_popup_link('Нет комментариев &#187;', '<srong>1</strong> комментарий &#187;', '<strong>%</strong> коммент. &#187;'); ?></span></div> 
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
                <?php } ?>
			<?php wp_reset_query(); ?>
			</div>
            </div>
<?php get_footer(); ?>
