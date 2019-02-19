<?php
    
    namespace Inc\Service;
    
    use Inc\Callback\Callback;
    use Inc\Callback\Page;
    use Inc\Plugin;
    
    class Settings
    {
        public $option_pages;
        public $admin_pages;
        public $sub_pages;
        
        public $settings;
        
        public function __construct()
        {
            $this->option_pages = [
                [
                    'page_title' => 'Test Page title',
                    'menu_title' => 'Test Option page',
                    'capability' => 'manage_options',
                    'menu_slug'  => 'test-123'
                ]
            ];
            
            $this->admin_pages = [
                [
                    'page_title' => '123 Testpage',
                    'menu_title' => 'Test 123 Page',
                    'capability' => 'manage_options',
                    'menu_slug'  => 'test-123-page',
                    'icon_url'   => '',
                    'position'   => 90
                ]
            ];
            
            $this->sub_pages = [
                [
                    'parent_slug' => 'test-123-page',
                    'page_title'  => 'subpage-123',
                    'menu_title'  => '123 Subpage Test',
                    'capability'  => 'manage_options',
                    'menu_slug'   => 'subpage-123',
                ]
            ];
            
            $this->settings = [
                [
                    'id'       => 'test_page_settings',
                    'title'    => 'Example settings section in reading',
                    'page'     => 'test-page',
                    'settings' => [
                        'testvalue'      => 'test title',
                        'customer_email' => 'Customer Email Address',
                        'customer_phone' => 'telefon Nummer',
                        'test123'        => 'test title',
                    ]
                ],
            ];
        }
        
        
        public function register(): void
        {
            add_action(
                'admin_menu',
                array(
                    $this,
                    'admin_menu'
                ) );
            
            add_action(
                'admin_init',
                array(
                    $this,
                    'register_settings'
                ) );
        }
        
        public function register_settings(): void
        {
            //register all defined sections and its according settings
            foreach ( $this->settings as $section )
            {
                add_settings_section(
                    $section['id'],
                    $section['title'],
                    array(
                        Page::class,
                        'settings_section'
                    ),
                    $section['page'] );
                
                foreach ( $section['settings'] as $setting_id => $setting_title )
                {
                    register_setting(
                        $section['page'],
                        $setting_id );
                    
                    add_settings_field(
                        $setting_id,
                        $setting_title,
                        array(
                            Callback::class,
                            'input_field'
                        ),
                        $section['page'],
                        $section['id'],
                        [
                            'name' => $setting_id,
                        ] );
                }
            }
        }
        
        public function admin_menu(): void
        {
            foreach ( $this->option_pages as $option_page )
            {
                add_options_page(
                    $option_page['page_title'],
                    $option_page['menu_title'],
                    $option_page['capability'],
                    $option_page['menu_slug'],
                    array(
                        Page::class,
                        'settings'
                    ) );
            }
            
            foreach ( $this->admin_pages as $admin_page )
            {
                add_menu_page(
                    $admin_page['page_title'],
                    $admin_page['menu_title'],
                    $admin_page['capability'],
                    $admin_page['menu_slug'],
                    array(
                        Page::class,
                        'settings'
                    ),
                    $admin_page['icon_url'],
                    $admin_page['position'] );
            }
            
            foreach ( $this->sub_pages as $sub_page )
            {
                add_submenu_page(
                    $sub_page['parent_slug'],
                    $sub_page['page_title'],
                    $sub_page['menu_title'],
                    $sub_page['capability'],
                    $sub_page['menu_slug'],
                    array(
                        Page::class,
                        'settings'
                    ) );
            }
        }
    }