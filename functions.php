<?php 

define( 'API_PA', 'api.adventistas.org' );
define( 'API_7CAST', 'api.adv.st' );
define( 'API_F7P', 'api.feliz7play.com' );

if(file_exists($composer = __DIR__. '/vendor/autoload.php'))
	require_once $composer;

add_action( 'init', 'wp_rest_headless_boot_plugin', 9 );

add_filter( 'wp_headless_rest__disable_front_end', '__return_false' );

require_once (dirname(__FILE__) . '/classes/controllers/PA_Theme_Helpers.class.php');
require_once (dirname(__FILE__) . '/classes/controllers/PA_ACF_Helpers.class.php');
require_once (dirname(__FILE__) . '/classes/controllers/PA_ACF_Site-settings.class.php');
require_once (dirname(__FILE__) . '/classes/controllers/PA_Menu_Walker.class.php');
require_once (dirname(__FILE__) . '/classes/controllers/PA_Menu_Mobile.class.php');
require_once (dirname(__FILE__) . '/classes/controllers/PA_Image_Check.php');
require_once (dirname(__FILE__) . '/classes/controllers/PA_Image_Thumbs.class.php');
require_once (dirname(__FILE__) . '/classes/controllers/PA_Register_Sidebars.class.php');
require_once (dirname(__FILE__) . '/classes/controllers/PA_Header_Title.class.php');
require_once (dirname(__FILE__) . '/classes/controllers/PA_Sedes_Infos.php');
require_once (dirname(__FILE__) . '/Fields/TaxonomyTerms.php');
// CORE INSTALL
require_once (dirname(__FILE__) . '/core/PA_Theme_Sedes_Install.php');

$Blocks = new Blocks\Blocks;

function pa_wp_custom_menus() {
	register_nav_menu('pa-menu-default', __( 'PA - Menu - Default', 'iasd' ));
}
add_action( 'init', 'pa_wp_custom_menus' );


if(file_exists(get_stylesheet_directory() . '/classes/PA_Directives.php'))
  require_once(get_stylesheet_directory() . '/classes/PA_Directives.php');

/**
* Modify category query
*/
add_action('pre_get_posts', function($query) {
  if(is_admin() || !is_tax() || !$query->is_main_query())
    return $query;

  global $queryFeatured;
  $object = get_queried_object();
  
  $queryFeatured = new WP_Query(
    array(
      'posts_per_page' => 1,
      'post_status'	   => 'publish',
      'post__in'       => get_option('sticky_posts'),
      'tax_query'      => array(
        array(
          'taxonomy' => $object->taxonomy,
          'terms'    => array($object->term_id),
        ),
      ),
    )
  );

  if(empty($queryFeatured->found_posts)):
    $queryFeatured = new WP_Query(
      array(
        'posts_per_page' 	   => 1,
        'post_status'	 	   => 'publish',
        'ignore_sticky_posts ' => true,
        'tax_query'            => array(
          array(
            'taxonomy' => $object->taxonomy,
            'terms'    => array($object->term_id),
          ),
        ),
      )
    );
  endif;

  $query->set('posts_per_page', 15);
  $query->set('ignore_sticky_posts', true);
  $query->set('post__not_in', !empty($queryFeatured->found_posts) ? array($queryFeatured->posts[0]->ID) : null);

  return $query;
});
