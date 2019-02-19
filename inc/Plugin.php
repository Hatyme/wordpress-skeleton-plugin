<?php
    
    namespace Inc;
    
    /*
     * Plugin class used to register and run every services
     * */
    
    class Plugin extends App
    {
        public static function get_services(): array
        {
            return [
                Service\Settings::class,
                Service\Enqueue::class,
            ];
        }
        
        public static function setup(): void
        {
            self::register_hooks();
            self::bind('web_plugin_dir', '/wp-content/plugins/hatyme-plugin' );
            self::bind('plugin_dir', dirname(__FILE__, 2));
        }
        
        public static function register_hooks(): void
        {
            register_activation_hook( __FILE__, array(
                self::class,
                'activate'
            ) );
            register_deactivation_hook( __FILE__, array(
                self::class,
                'deactivate'
            ) );
        }
        
        public static function activate(): void
        {
            flush_rewrite_rules();
        }
        
        public static function deactivate(): void
        {
            flush_rewrite_rules();
        }
    
        public static function register_services(): void
        {
            foreach (self::get_services() as $service)
            {
                $service_instance = new $service();
                
                if ( method_exists( $service_instance, 'register') )
                {
                    $service_instance->register();
                }
            }
        }
    

    }