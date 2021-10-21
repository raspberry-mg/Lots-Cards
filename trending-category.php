<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Trending_Category
 *
 * @wordpress-plugin
 * Plugin Name:       Trending Category
 * Plugin URI:        http://example.com/plugin-name-uri/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Marharyta
 * Author URI:        https://github.com/raspberry-mg
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       trending-category
 * Domain Path:       /languages
 */


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TRENDING_CATEGORY_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-trending-category-activator.php
 */
function activate_plugin_name() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-trending-category-activator.php';
	Trending_Category_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-trending-category-deactivator.php
 */
function deactivate_plugin_name() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-trending-category-deactivator.php';
	Trending_Category_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_trending-category' );
register_deactivation_hook( __FILE__, 'deactivate_trending-category' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-trending-category.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_plugin_name() {

	$plugin = new Trending_Category();
	$plugin->run();

}
run_plugin_name();

/**
 * Register Custom Taxonomy
 * Lots
 */
// хук для регистрации
add_action( 'init', 'create_taxonomy' );
function create_taxonomy(){

	register_taxonomy( 'My_custom_taxonomy', [ 'custom_lot_card' ], [
		'label'                 => 'name',
		'labels'                => [
			'name'              => 'Lots',
			'singular_name'     => 'Lot',
			'search_items'      => 'Search Lots',
			'all_items'         => 'All Lots',
			'view_item '        => 'View Lot',
			'edit_item'         => 'Edit Lot',
			'update_item'       => 'Update Lot',
			'add_new_item'      => 'Add New Lot',
			'new_item_name'     => 'New Lot Name',
			'menu_name'         => 'Lots',
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		'publicly_queryable'    => null, // равен аргументу public
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => false, // равен аргументу public
		'show_in_menu'          => true, // равен аргументу show_ui
		'show_tagcloud'         => true, // равен аргументу show_ui
		'show_in_quick_edit'    => null, // равен аргументу show_ui
		'hierarchical'          => false,

		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
		'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
		'show_in_rest'          => null, // добавить в REST API
		'rest_base'             => null, // $taxonomy
		// '_builtin'              => false,
		//'update_count_callback' => '_update_post_term_count',
	] );
}

add_action( 'init', 'custom_lot_card' );
/**
 * Register a Custom post type
 * Lots Cards
 */
function custom_lot_card() {
	$labels = array(
		'name'               => _x( 'Lots Cards', 'post type general name'),
		'singular_name'      => _x( 'Lot Card', 'post type singular name'),
		'taxonomies'         => _x( 'lots', 'taxonomies'),
		'menu_name'          => _x( 'Lots Cards', 'admin menu'),
		'name_admin_bar'     => _x( 'Lot Card', 'add new on admin bar'),
		'add_new'            => _x( 'Add New', 'Lot Card'),
		'add_new_item'       => __( 'Name'),
		'new_item'           => __( 'New Lot Card'),
		'edit_item'          => __( 'Edit Lot Card'),
		'view_item'          => __( 'View Lot Card'),
		'all_items'          => __( 'All Lots Cards'),
		'featured_image'     => __( 'Featured Image', 'text_domain' ),
		'search_items'       => __( 'Search Lot Card'),
		'parent_item_colon'  => __( 'Parent Lot Card:'),
		'not_found'          => __( 'No Lot Card found.'),
		'not_found_in_trash' => __( 'No Lot Card found in Trash.'),
	);

	$args = array(
		'labels'             => $labels,
		'menu_icon'	     => 'dashicons-superhero-alt',
		'description'        => __( 'Description.'),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => null,
		'supports'           => array('title','editor','thumbnail')
	);

	register_post_type( 'custom_lot_card', $args );
}
