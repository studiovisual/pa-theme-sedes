<?php 
class WPDocs_New_Widget extends WP_Widget {
 
    function __construct() {
        parent::__construct( false, __( 'IASD - Widgets', 'pa_iasd' ) );
    }
 
    function widget( $args, $instance ) {

		$title = $instance['title'];
		$tamanho = $instance['widget-size'];
		require(get_template_directory() . '/components/widgets/'. $instance['widget-file']);
	}
 
    function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags($new_instance['title']);
		if(!count($new_instance))
			$new_instance = $old_instance;

		return $new_instance;
	}
 
    public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'text_domain' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<div>
			<p>
				<label for="<?php echo $this->get_field_id('widget-file'); ?>"><?php _e( 'Widget:', 'iasd'); ?></label>
				<select name="<?php echo $this->get_field_name('widget-file'); ?>" id="<?php echo $this->get_field_id('widget-file'); ?>" class="widefat" onchange="checkValue();">
					<option value="pa-app.php"<?php selected( $instance['widget-file'], 'pa-app.php' ); ?>>Widget - Apps</option>
					<option value="pa-carousel-feature.php"<?php selected( $instance['widget-file'], 'pa-carousel-feature.php' ); ?>>Widget - Carousel - Feature</option>
					<option value="pa-carousel-magazines.php"<?php selected( $instance['widget-file'], 'pa-carousel-magazines.php' ); ?>>Widget - Carousel - Magazines</option>
					<option value="pa-carousel-ministry.php"<?php selected( $instance['widget-file'], 'pa-carousel-ministry.php' ); ?>>Widget - Carousel - Ministry</option>
					<option value="pa-carousel-videos.php"<?php selected( $instance['widget-file'], 'pa-carousel-videos.php' ); ?>>Widget - Carousel - Videos</option>
					<option value="pa-list-buttons.php"<?php selected( $instance['widget-file'], 'pa-list-buttons.php' ); ?>>Widget - List - Buttons</option>
					<option value="pa-list-downloads.php"<?php selected( $instance['widget-file'], 'pa-list-downloads.php' ); ?>>Widget - List - Downloads</option>
					<option value="pa-list-news.php"<?php selected( $instance['widget-file'], 'pa-list-news.php' ); ?>>Widget - List - News</option>
					<option value="pa-list-posts.php"<?php selected( $instance['widget-file'], 'pa-list-posts.php' ); ?>>Widget - List - Posts</option>
					<option value="pa-list-videos.php"<?php selected( $instance['widget-file'], 'pa-list-videos.php' ); ?>>Widget - List - Videos</option>
				</select>
			</p>
		</div>
		<div id="widget-size">
			<p>
				<label for="<?php echo $this->get_field_id('widget-size'); ?>"><?php _e( 'Widget size:', 'iasd'); ?></label>
				<select name="<?php echo $this->get_field_name('widget-size'); ?>" id="<?php echo $this->get_field_id('widget-size'); ?>" class="widefat">
					<option value="1/3"<?php selected( $instance['widget-size'], '1/3' ); ?>>1/3</option>
					<option value="2/3"<?php selected( $instance['widget-size'], '2/3' ); ?>>2/3</option>
				</select>
			</p>
		</div>

		<script>
			function checkValue(){
				var e = document.getElementById('<?php echo $this->get_field_id('widget-file'); ?>');
				var value = e.options[e.selectedIndex].value;

				if (value == "pa-list-videos.php"){
					document.getElementById('widget-size').style.display = "block";
				} else {
					document.getElementById('widget-size').style.display = "none";
				}

				console.log('executou');
				console.log(e);
				console.log(value);
			}
		</script>
		<?php 
	}
}
 
add_action( 'widgets_init', 'wpdocs_register_widgets' );
function wpdocs_register_widgets() {
    register_widget( 'WPDocs_New_Widget' );
}