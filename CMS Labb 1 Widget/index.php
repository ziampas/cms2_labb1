<?php
/**
 * Plugin Name: CMS Labb 1 Widget
 * Plugin URI: http://localhost/cms2
 * Description: For school
 * Version: 1.0
 * Author: Kristian Ziampas Olausson
 * Author URI: http://www.mywebsite.com
 */
 
/**
 * Adds Youtube_widget widget.
 */
class youtube_widget extends WP_Widget {
 
    /**
     * Registrerar min widget.
     */
    public function __construct() {
        parent::__construct(
            'youtube_widget', // Base ID
            'youtube_widget', // Name
            array( 'description' => __( 'Youtube Widget', 'customtheme' ), ) // Args
        );
    }
 
    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );
 
        echo $before_widget;
        if ( ! empty( $title ) ) {
            echo $before_title . $title . $after_title;
        }
        echo __( 
			'<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$instance['video'].'?controls=1&autoplay=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
			 'customtheme' );
        echo $after_widget;
    }
 
    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'customtheme' );
		}
    
		$video = ! empty( $instance['video'] ) ? $instance['video'] : esc_html__( '83PaFAAxYe0', 'customtheme' ); 

        ?>
        <!-- HTML som ritas ut på backend-sidan -->
        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
         </p>
        <p>
            <label for="<?php echo $this->get_field_name( 'video' ); ?>"><?php _e( 'Youtube ID:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'video' ); ?>" name="<?php echo $this->get_field_name( 'video' ); ?>" type="text" value="<?php echo esc_attr( $video ); ?>" />
         </p>
    <?php
    }
 
    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['video'] = ( !empty( $new_instance['video'] ) ) ? strip_tags( $new_instance['video'] ) : '83PaFAAxYe0';
 
        return $instance;
    }
 
}
 
?>