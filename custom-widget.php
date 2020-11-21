<?php
add_action( 'widgets_init', 'srecent_post' );
function srecent_post() {
	register_widget( 'Srecent_Post' );
}

class Srecent_Post extends WP_Widget {

	function __construct() {
	parent::__construct('Srecent_Post',__('ADS CODE', 'wpb_widget_domain'), 
// Widget description
		array( 'description' => __( 'This widget based on ADS Management', 'wpb_widget_domain' ), ) 
		
		);
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$adscode = $instance['adscode'];

		echo $before_widget;

		// Display the widget title 
		//if ( $title )
			//echo $before_title . $title . $after_title;

		//Display the name 
		echo htmlspecialchars_decode($adscode);

		
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML 
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['adscode'] = htmlspecialchars( $new_instance['adscode'] );

		return $instance;
	}

	
	function form( $instance ) {

		//Set up some default widget settings.
		$defaults = array( 'title' => __('Advertisement Title', 'modernfrock'));
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'modernfrock'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;"  readonly="" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'adscode' ); ?>"><?php _e('Script Code:', 'modernfrock'); ?></label>
			<textarea name="<?php echo $this->get_field_name( 'adscode' ); ?>" id="<?php echo $this->get_field_id( 'adscode' ); ?>" style="width:100%; height:200px;"><?php echo $instance['adscode']; ?></textarea>
		</p>

	<?php
	}
}
