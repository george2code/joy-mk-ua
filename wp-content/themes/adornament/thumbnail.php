<?php if ( version_compare( $wp_version, '2.9', '>=' ) ) {
  if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) { the_post_thumbnail(array(150,150), array("class" => "alignleft post_thumbnail_details")); }
  } else {
  if ( get_post_meta($post->ID, 'featured', true) ) { $image = get_post_meta($post->ID, 'featured', true); echo "<img class=\"alignleft post_thumbnail_details\" width=\"150\" src=" . $image . " />"; }
  }
?>