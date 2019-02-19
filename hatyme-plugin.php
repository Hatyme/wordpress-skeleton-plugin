<?php
    /**
     * @package  HatymePlugin
     */
    /*
    Plugin Name: Hatyme Plugin
    Description: Test Site for Plugin Developement.
    Version: 1.0.0
    Author: Richard "Hatyme" Viehrig
    Author URI: http://merchandisee.de
    License: GPLv2 or later
    Text Domain: hatyme-plugin
    */
    
    
    if ( file_exists( __DIR__ . '/vendor/autoload.php' ) )
    {
        require_once __DIR__ . '/vendor/autoload.php';
    }
    
    use Inc\Plugin;
    
    Plugin::setup();
    Plugin::register_services();
    