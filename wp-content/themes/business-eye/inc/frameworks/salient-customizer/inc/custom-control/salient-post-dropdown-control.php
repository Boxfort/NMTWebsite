<?php
if ( class_exists( 'WP_Customize_Control' ) && !class_exists( 'Salient_Customizer_Post_Dropdown_Control' )){

    /**
     * Custom Control for post dropdown
     * @since 1.0.0
     *
     */
    class Salient_Customizer_Post_Dropdown_Control extends WP_Customize_Control {
        /**
         * Declare the control type.
         *
         * @access public
         * @var string
         */
        public $type = 'post_dropdown';

        /**
         * Function to  render the content on the theme customizer page
         *
         * @access public
         * @since 1.0.0
         *
         * @param null
         * @return void
         *
         */
        public function render_content() {
            $post_args = array(
                'posts_per_page'   => -1,
            );
            $salient_posts = get_posts( $post_args );
            if( !empty ( $salient_posts ) ) {
                ?>
                <label>
                    <span class="customize-control-title">
                        <?php echo esc_html( $this->label ); ?>
                    </span>
                    <select <?php $this->link(); ?>>
                        <?php
                        $default_value = $this->value();
                        if( -1 == $default_value || empty( $default_value ) ){
                            $default_selected = 1;
                        }
                        else{
                            $default_selected = 0;
                        }
                        printf('<option value="-1" %s>%s</option>',selected($default_selected, 1, false),esc_html__('Select','business-eye'));
                        foreach ( $salient_posts as $salient_post ) {
                            printf('<option value="%s" %s>%s</option>', $salient_post->ID, selected($this->value(), $salient_post->ID, false), $salient_post->post_title);
                        }
                        ?>
                    </select>
                </label>
                <?php
            }
        }
    }
}