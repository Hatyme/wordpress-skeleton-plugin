<?php
   
    namespace Inc\Service;
    
    use Inc\Plugin;
    
    class Enqueue
    {
        private $global_scripts;
        private $admin_scripts;
        private $frontend_scripts;
        
        public function __construct()
        {
            $this->global_scripts = [
                [
                    'type'   => 'css',
                    'handle' => 'main_css',
                    'name'   => 'main.css'
                ],
                [
                    'type'   => 'js',
                    'handle' => 'main_js',
                    'name'   => 'main.js'
                ]
            ];
            
            $this->admin_scripts    = [];
            $this->frontend_scripts = [];
        }
        
        public function register()
        {
            add_action( 'admin_enqueue_scripts', array(
                $this,
                'enqueue_admin_scripts'
            ) );
            
            add_action( 'wp_enqueue_scripts', array(
                $this,
                'enqueue_scripts'
            ) );
        }
        
        
        public function enqueue_admin_scripts()
        {
            foreach ( $this->global_scripts as $global_script )
            {
                $this->enqueue( $global_script );
            }
            
            foreach ( $this->admin_scripts as $admin_script )
            {
                $this->enqueue( $admin_script );
            }
            
        }
        
        public function enqueue_scripts()
        {
            foreach ( $this->global_scripts as $global_script )
            {
                $this->enqueue( $global_script );
            }
            
            foreach ( $this->frontend_scripts as $frontend_script )
            {
                $this->enqueue( $frontend_script );
            }
        }
        
        public function enqueue( $script )
        {
            if ( $script['type'] === 'css' )
            {
                wp_enqueue_style( 'main', Plugin::get( 'web_plugin_dir' ) . '/assets/css/' . $script['name'] );
            }
            
            if ( $script['type'] === 'js' )
            {
                wp_enqueue_script( $script['handle'], Plugin::get( 'web_plugin_dir' ) . '/assets/js/' . $script['name'] );
            }
            
        }
    }