<?php 

$this_wptheme_name = "Adornament";
$theme_options_prefix = str_replace(' ', '_', strtolower($this_wptheme_name));


/* -------------------------------------------------
   Regster Multiple Sidebar
----------------------------------------------------*/
if (function_exists('register_sidebar'))
{
	register_sidebar(
		array(
			'name'          => 'Right Sidebar',
	        'before_widget' => '<li>',
    	    'after_widget'  => '</li>',
        	'before_title'  => '<h2>',
        	'after_title'   => '</h2>'
		)
	);
	register_sidebar(
		array(
			'name'          => 'Footer1',
	        'before_widget' => '<li>',
    	    'after_widget'  => '</li>',
        	'before_title'  => '<h2>',
        	'after_title'   => '</h2>'
		)
	);
	register_sidebar(
		array(
			'name'          => 'Footer2',
	        'before_widget' => '<li>',
    	    'after_widget'  => '</li>',
        	'before_title'  => '<h2>',
        	'after_title'   => '</h2>'
		)
	);
	register_sidebar(
		array(
			'name'          => 'Footer3',
	        'before_widget' => '<li>',
    	    'after_widget'  => '</li>',
        	'before_title'  => '<h2>',
        	'after_title'   => '</h2>'
		)
	);
}
?>
<?php
    if ( function_exists( 'register_nav_menus' ) ) {
    	register_nav_menus(
    		array(
    		  'menu_1' => 'Menu 1',
    		  'menu_2' => 'Menu 2'
    		)
    	);
    }
?>