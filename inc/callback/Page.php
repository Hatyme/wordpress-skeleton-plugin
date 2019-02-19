<?php
    /**
     * Created by PhpStorm.
     * User: Philipp
     * Date: 19.02.2019
     * Time: 11:46
     */
    
    namespace Inc\Callback;
    
    
    use Inc\Plugin;

    class Page
    {
        public static function __callStatic($name, $arguments)
        {
            if (is_file( Plugin::get( 'plugin_dir' ) . '/templates/admin/' .  $name .'.php'))
            {
                return require Plugin::get( 'plugin_dir' ) . '/templates/admin/' . $name . '.php';
            }
        }
    }