<?php
    /**
     * Created by PhpStorm.
     * User: Philipp
     * Date: 18.02.2019
     * Time: 12:57
     */
    
    namespace Inc;
    
    
    class Plugin
    {
        protected static $registry = [];
    
    
        public static function setup()
        {
            self::register_hooks();
            
            self::bind('web_plugin_dir', '/wp-content/plugins/hatyme-plugin' );
            self::bind('plugin_dir', dirname(__FILE__, 2));
            
        }
        
        public static function register_hooks()
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
        
        public static function activate()
        {
            flush_rewrite_rules();
        }
        
        public static function deactivate()
        {
            flush_rewrite_rules();
        }
    
        public static function register_services()
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
    
        public static function get_services()
        {
            return [
                Service\Settings::class,
                Service\Enqueue::class,
            ];
        }
    
    
        /**
         * Bind a new key/value into the container.
         *
         * @param  string $key
         * @param  mixed $value
         */
        public static function bind( $key, $value )
        {
            static::$registry[ $key ] = $value;
        }
    
        /**
         * Retrieve a value from the registry.
         *
         * @param  string $key
         *
         * @return mixed
         * @throws Exception
         */
        public static function get( $key )
        {
            if ( ! array_key_exists( $key, static::$registry ) )
            {
                throw new Exception( "No {$key} is bound in the container." );
            }
        
            return static::$registry[ $key ];
        }
    }