<?php

declare(strict_types=1);

if (class_exists('WP_Customize_Control')) {
    /**
     * Class to create a custom multiselect dropdown control
     */
    class MultiselectCustomControl extends WP_Customize_Control
    {
        /**
         * Render the content on the theme customizer page
         */
        public $type = 'multiple-select';

        public function render_content() {

            if ( empty( $this->choices ) )
                return;
            ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <span class="description customize-control-description">
                    <?php echo $this->description; ?>
                </span>
                <select <?php $this->link(); ?> multiple="multiple" size="25">
                    <?php
                    foreach ( $this->choices as $value => $label ) {
                        $selected = ( in_array( $value, $this->value() ) ) ? selected( 1, 1, false ) : '';
                        echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
                    }
                    ?>
                </select>
            </label>
            <?php
        }
    }
}