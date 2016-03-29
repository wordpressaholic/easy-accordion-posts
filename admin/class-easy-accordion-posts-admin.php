<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://kartik.webfixfast.com/
 * @since      1.0.0
 *
 * @package    Easy_Accordion_Posts
 * @subpackage Easy_Accordion_Posts/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Easy_Accordion_Posts
 * @subpackage Easy_Accordion_Posts/admin
 * @author     WordPressaHolic <wordpressaholic@gmail.com>
 */
class Easy_Accordion_Posts_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'font-awesome', plugin_dir_url( __FILE__ ) . 'css/font-awesome/css/font-awesome.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700|Montserrat:700', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/easy-accordion-posts-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/easy-accordion-posts-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'angular', plugin_dir_url( __FILE__ ) . 'js/angular.js', array(), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'-angular-app', plugin_dir_url( __FILE__ ) . 'js/app.js', array(), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'-angular-directive-starter-notes', plugin_dir_url( __FILE__ ) . 'js/directives/starter-notes.js', array(), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'-angular-directive-cell', plugin_dir_url( __FILE__ ) . 'js/directives/cell.js', array(), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'-angular-directive-add-cell', plugin_dir_url( __FILE__ ) . 'js/directives/add-cell.js', array(), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'-angular-directive-database-table', plugin_dir_url( __FILE__ ) . 'js/directives/database-table.js', array(), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'-angular-directive-resp', plugin_dir_url( __FILE__ ) . 'js/directives/resp.js', array(), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'-angular-directive-warning', plugin_dir_url( __FILE__ ) . 'js/directives/warning.js', array(), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'-examples', plugin_dir_url( __FILE__ ) . 'js/examples.js', array(), $this->version, false );

	}

	/**
	 * Print vars needed by the scripts.
	 *
	 * @since    1.0.0
	 */
	public function print_scripts() {

	 	?>
		<script type="text/javascript">
			if(!eap_data) var eap_data = {};
			eap_data.templates = {
				'starter-notes' : '<?php echo plugin_dir_url( __FILE__ ) . 'partials/angular-templates/starter-notes.php' ?>',
				'cell' : '<?php echo plugin_dir_url( __FILE__ ) . 'partials/angular-templates/cell.php' ?>',
				'add-cell' : '<?php echo plugin_dir_url( __FILE__ ) . 'partials/angular-templates/add-cell.php' ?>',
				'database-table' : '<?php echo plugin_dir_url( __FILE__ ) . 'partials/angular-templates/database-table.php' ?>',
				'resp' : '<?php echo plugin_dir_url( __FILE__ ) . 'partials/angular-templates/resp.php' ?>',
				'warning' : '<?php echo plugin_dir_url( __FILE__ ) . 'partials/angular-templates/warning.php' ?>',
			}

			eap_data.ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
			eap_data.nonce = '<?php echo wp_create_nonce("eap"); ?>';
		</script>

		<?php
			// collect database
			$posts_database = array( 'post_type'=>array() );
			$args = array();
			$output = 'objects';
			$operator = 'and';
			$post_types = get_post_types( $args, $output, $operator );
			$restricted = array('page', 'attachment', 'revision', 'nav_menu_item', 'post_format');

			foreach($post_types as $post_type_name => $post_type_obj){
				if( in_array($post_type_name, $restricted) ) continue;
				$posts_database['post_type'][$post_type_name] = array( 'label'=> $post_type_obj->label, 'taxonomy'=> array() );

				$args = array('object_type'=>array($post_type_name));
				$taxonomies = get_taxonomies($args, 'objects');
				foreach($taxonomies as $taxonomy_name => $taxonomy_obj){
					if( in_array($taxonomy_name, $restricted) ) continue;
					$posts_database['post_type'][$post_type_name]['taxonomy'][$taxonomy_name] = array( 'label'=> $taxonomy_obj->label, 'terms'=> array() );

					$args = array();
					$terms = get_terms($taxonomy_name, $args);
					foreach($terms as $term_obj){
						$posts_database['post_type'][$post_type_name]['taxonomy'][$taxonomy_name]['terms'][$term_obj->term_id] = array( 'label'=> $term_obj->name );
					}

				}

			}
		?>
			<script type="text/javascript">
				if(!eap_data) var eap_data = {};
				eap_data.database = <?php echo json_encode($posts_database); ?>
			</script>
		<?php

	}

	/**
	 * Register the menu page
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function register_menu_page() {

		$hook_suffix = add_menu_page(
        __( 'Easy Acc. Posts', $this->plugin_name ), // page title
        'Easy Acc. Posts', // menu title
        'manage_options', // capability
        'easy-accordion-posts/admin/partials/easy-accordion-posts-admin-display.php', // menu slug
        '', // callback
        'dashicons-editor-justify', // icon url eg: plugins_url( 'myplugin/images/icon.png' )
        6 // position
    );

	}

	/**
	 * Ajax callback to import demo data
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function import_demo_data() {

		// create cat if its not available
		$cat_obj = get_category_by_slug( 'super-heroes' );
		if( ! $cat_obj ){
			$cat_id = wp_create_category( 'Super Heroes' );
		}else{
			$cat_id = $cat_obj->term_id;
		}

		$attach_id = false;

		$count = 0;

		$date =  date('Y-m-d H:i:s');
		$date = substr($date, 0, -2);
		$date = $date . '1';

		while( $count < 5 ){
			$my_post = array(
			  'post_title'    => 'Super Lorem '. ($count + 1),
			  // 'post_title'    => 'Super Lorem '. $count + 1,
				'post_date' => $date . $count,
			  'post_content'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
			  'post_status'   => 'publish',
			  'post_category'   => array($cat_id),
				'meta_input' => array(
					'eap-super-power'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
					'eap-weakness'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
					'eap-origin-story'=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
					'eap-lorem'=> '$300',
					'eap-ipsum'=> '50',
					'eap-dolor'=> 'A+',
				)
			);

			$post_id = wp_insert_post( $my_post );
			$attach_id = $this->attach_featured_image( plugins_url( 'easy-accordion-posts/public/images/demo-img.jpg' ), $post_id, $attach_id );
			$count++;
		}
		wp_die( );

	}

	/**
	 * Utility function to assign featured image to demo posts
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	function attach_featured_image( $image_url, $post_id, $attach_id= false ){
			if( ! $attach_id ){
		    $upload_dir = wp_upload_dir();
		    $image_data = file_get_contents($image_url);
		    $filename = basename($image_url);
		    if(wp_mkdir_p($upload_dir['path']))     $file = $upload_dir['path'] . '/' . $filename;
		    else                                    $file = $upload_dir['basedir'] . '/' . $filename;
		    file_put_contents($file, $image_data);

		    $wp_filetype = wp_check_filetype($filename, null );
		    $attachment = array(
		        'post_mime_type' => $wp_filetype['type'],
		        'post_title' => sanitize_file_name($filename),
		        'post_content' => '',
		        'post_status' => 'inherit'
		    );
				$attach_id = wp_insert_attachment( $attachment, $file, $post_id );
				require_once(ABSPATH . 'wp-admin/includes/image.php');
				$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
				$res1= wp_update_attachment_metadata( $attach_id, $attach_data );
			}
	    $res2= set_post_thumbnail( $post_id, $attach_id );
			return $attach_id;
	}

}
