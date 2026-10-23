<?php
/**
 * @package WordPress
 * @subpackage Classic_Theme
 */
?>
</div>
</div>
<!-- begin footer -->
		<div id="footer" class="clearfix">
        	<div id="footerside" class="clearfix">
              <ul>
              	
              </ul>
            </div>
			<div class="credit">
				Copyright &copy; <?php echo date('Y'); ?> <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>. Все права защищены.
				
			</div>
			<?php 
            if(wpthemes_options('footer_code') != '') {
            echo wpthemes_options("footer_code")  . "\n"; 
            }
            ?>
            <?php wp_footer(); ?>
		</div>
</div>
</div>
</div>
</div>
</body>
</html>