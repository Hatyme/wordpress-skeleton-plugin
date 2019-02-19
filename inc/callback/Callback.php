<?php
    
    namespace Inc\Callback;
    
    
    class Callback
    {
        public static function input_field( array $args): void
        {
            $option_name = $args['name'];
            $option_value = get_option( $option_name );
            echo '<div class="wrap">';
            echo "<input type='text' id='$option_name' name='$option_name' value='$option_value' class='' />";
            echo "</div>";
    
        }
        
        public static function select_field( string $option_name, array $choices ): void
        {
        
        }
        
        
    }