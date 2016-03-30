<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://kartik.webfixfast.com/
 * @since      1.0.0
 *
 * @package    Easy_Accordion_Posts
 * @subpackage Easy_Accordion_Posts/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Easy_Accordion_Posts
 * @subpackage Easy_Accordion_Posts/public
 * @author     WordPressaHolic <wordpressaholic@gmail.com>
 */
class Easy_Accordion_Posts_Public {

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
	 * The count of the total numbe of eap shortcodes on the page.
	 * Used to provide temporary classes to the grids
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $count    The total count of shortcodes on page.
	 */
	private $count;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->count = 0;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Easy_Accordion_Posts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Easy_Accordion_Posts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/easy-accordion-posts-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Easy_Accordion_Posts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Easy_Accordion_Posts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/easy-accordion-posts-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the [eap] shortcode for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function shortcode( $atts, $content = null ) {

		if( empty( $content ) ) return; // empty shortcode
		$content = html_entity_decode( $content );
		$content = str_replace(array('”', '“', '″'), '"', $content);
		$args = json_decode( $content, true );
		$atts = shortcode_atts( array(
		    'query' => false,
		), $atts );

		if( $atts[ 'query' ] ){
			$atts[ 'query' ] = ltrim( $atts[ 'query' ], "$" );
			foreach( $GLOBALS as $var_name => $value ){
				if ($var_name === $atts[ 'query' ]) {
					$query_args = $value;
				}
			}
		}

		// build query args
		if( empty( $query_args ) ){
			$query_args = array(
				'posts_per_page' => ! empty( $args['query']['posts_per_page'] ) ? $args['query']['posts_per_page'] : 10,
				'post_type' => array(),
				'tax_query' => array(
					'relation' => 'AND',
				),
			);
			if( ! empty( $args['database']['post_type'] ) ){
				foreach($args['database']['post_type'] as $post_type_name => $post_type_obj){
					$query_args['post_type'][] = $post_type_name;
					foreach($post_type_obj['taxonomy'] as $taxonomy_name => $taxonomy_obj){
						$tax_arr = array(
							'taxonomy' => $taxonomy_name,
							'field'    => 'term_id',
							'terms'    => array(),
						);
						foreach($taxonomy_obj['terms'] as $term_id => $term_obj){
							$tax_arr['terms'][] = $term_id;
						}
						$query_args['tax_query'][] = $tax_arr;
					}
				}
			} else {
				unset($query_args[ 'post_type' ]);
				unset($query_args[ 'tax_query' ]);
			}
		}

		// perform query loop
		$query = new WP_Query( $query_args );
		global $post;
		ob_start( );
		$class = 'eap_temp_' . ++$this->count;
		?>
		<style>
			.<?php echo $class ?> .eap_col{
				width: <?php echo 100/$args['resp'][ 'flex' ][0] ?>%;
			}

			@media (max-width:920px){
				.<?php echo $class ?> .eap_col{
					width: <?php echo 100/$args['resp'][ 'flex' ][1] ?>%;
				}
			}

			@media (max-width:720px){
				.<?php echo $class ?> .eap_col{
					width: <?php echo 100/$args['resp'][ 'flex' ][2] ?>%;
				}
			}
		</style>
		<?php
		if( $query->have_posts( ) ){
			echo '<div class="eap_grid '. $class .'">';
			while( $query->have_posts( ) ){
				$query->the_post( );

				echo '<div class="eap_col">';
					echo '<div class="eap_acc">';
					foreach( $args['cells'] as $cell ){
						$empty_indicator_class = '';
						if( $cell['type'] === 'Regular' ){
							if( empty( $cell['title'] ) ) $empty_indicator_class .= ' eap_no_title ';
							if( empty( $cell['content'] ) ) $empty_indicator_class .= ' eap_no_content ';
						}
						$pre_open_class = '';
						if( $cell['type'] === 'Regular' ){
							if( ! empty( $cell['pre_open'] ) ) $pre_open_class .= ' eap_open ';
						}
						echo '<div class="eap_cell '. $empty_indicator_class . $pre_open_class .'">';
						switch ($cell['type']){
							case 'Regular':
								// process tags
								$tags = array( 'post_title', 'excerpt', 'content', 'featured_image', 'link', 'custom_field' );

								//-- cell title element
								if( ! empty( $cell['title'] ) ){
									foreach( $tags as $tag ){
										$cell['title'] = preg_replace_callback( '/(\(\(\s*'. $tag .'[^\)\)]+\)\))/', array( $this, 'replace_callback_' . $tag ), $cell['title'] );
									}
									echo '<div class="eap_title">' . $cell['title'] . '</div>';
								}

								//-- cell content element
								if( ! empty( $cell['content'] ) ){
									foreach( $tags as $tag ){
										$cell['content'] = preg_replace_callback( '/(\(\(\s*'. $tag .'[^\)\)]*\)\))/', array( $this, 'replace_callback_' . $tag ), $cell['content']);
									}
									echo '<div class="eap_content" style="'. ( $pre_open_class ? " display: block; " : "" ) .'">' . $cell['content'] . '</div>';
								}
								break;

							case 'Featured Image':
								the_post_thumbnail( $cell['image'] );
								break;

							case 'Template':
								echo "Template";
								break;
						}
						echo '</div>';
					}
					echo '</div>';
				echo '</div>';

			}
		}
		echo '</div>';
		wp_reset_postdata( );

		return ob_get_clean( );
	}

  // replaces post_title
  function replace_callback_post_title( $matches ){
    $defaults = array(
      'max_length'=> '85',
      'append'=> '...',
    );
    $title_args = $this->args_splitter( $matches[0], $defaults );
		$post_title = get_the_title( );

		// max length
		$post_title_exploded = str_split( $post_title );
		if( count( $post_title_exploded ) > (int)$title_args[ 'max_length' ] ){
			$post_title = substr( $post_title, 0, (int)$title_args[ 'max_length' ] );
			// append
			if( ! empty( $title_args[ 'append' ] ) ){
				$post_title .= $title_args[ 'append' ];
			}
		}
    return $post_title;
  }

  // replaces excerpt
  function replace_callback_excerpt( $matches ){
    $defaults = array(
      'max_length'=> '200',
      'append'=> '...',
    );
    $excerpt_args = $this->args_splitter( $matches[0], $defaults );
		$excerpt = get_the_excerpt( );

		// max length
		$excerpt_exploded = str_split( $excerpt );
		if( count( $excerpt_exploded ) > ( int )$excerpt_args[ 'max_length' ] ){
			$excerpt = substr( $excerpt, 0, ( int )$excerpt_args[ 'max_length' ] );
			// append
			if( ! empty( $excerpt_args[ 'append' ] ) ){
				$excerpt .= $excerpt_args[ 'append' ];
			}
		}
    return $excerpt;

  }

	// replaces excerpt
  function replace_callback_content( $matches ){
    $defaults = array(
      'max_length'=> '5000',
      'append'=> '...',
			'strip_tags'=> false
    );
    $content_args = $this->args_splitter( $matches[0], $defaults );
		$content = get_the_content( );

		if($content_args['strip_tags'] !== false)
			$content = wp_strip_all_tags( $content );

		// max length
		$content_exploded = str_split( $content );
		if( count( $content_exploded ) > ( int )$content_args[ 'max_length' ] ){
			$content = substr( $content, 0, ( int )$content_args[ 'max_length' ] );
			// append
			if( ! empty( $content_args[ 'append' ] ) ){
				$content .= $content_args[ 'append' ];
			}
		}
    return $content;

  }

	// replaces link
  function replace_callback_featured_image( $matches ){
    $defaults = array(
      'size'=> 'Medium',
    );
    $link_args = $this->args_splitter( $matches[0], $defaults );
    return get_the_post_thumbnail();
  }

  // replaces link
  function replace_callback_link( $matches ){
    $defaults = array(
      'text'=> 'read more',
    );
    $link_args = $this->args_splitter( $matches[0], $defaults );
    return '<a href="'. get_the_permalink() .'">'. $link_args['text'] .'</a>';
  }

	// replaces custom_field
  function replace_callback_custom_field( $matches ){
    $defaults = array(
      'max_length'=> '25',
      'append'=> '...',
			'key'=> ''
    );
    $meta_args = $this->args_splitter( $matches[ 0 ], $defaults );
		global $post;
		$meta_val = get_post_meta( $post->ID, trim($meta_args[ 'key' ]), true );

		// max length
		$meta_val_exploded = str_split( $meta_val );
		if( count( $meta_val_exploded ) > ( int )$meta_args[ 'max_length' ] ){
			$meta_val = substr( $meta_val, 0, ( int )$meta_args[ 'max_length' ] );
			// append
			if( ! empty( $meta_args[ 'append' ] ) ){
				$meta_val .= $meta_args[ 'append' ];
			}
		}
    return $meta_val;
  }

  // splits the arguments assigned to tags
  function args_splitter($string, $defaults){
    foreach( $defaults as $key=> &$val ){
      $matches = array( );
      $pattern = '/\|\s*'. $key .'\s*:([^\||^\)]+)\s*/';
      preg_match( $pattern, $string, $matches );
      if( ! empty( $matches ) ){
        $val = $matches[1];
      }
    }
    return $defaults;
  }

}
