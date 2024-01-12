<?php
    /**
     *  @package fusesliders
     *  @version 1.0
     *
     *  Plugin Name: Sliders for the Fuse CMS Framework
     *  Plugin URI: https://fusecms.org
     *  Description: Create sliders for your site and manage what slides show where and when.
     *  Author: 7-90 Systems
     *  Author URI: https://7-90.com.au
     *  Version: 1.0
     *  Requires at least: 6.4
     *  Requires PHP: 8.1
     *  Text Domain: fusesliders
     *  Fuse Update Server: http://fusecms.org
     */
    
    namespace Fuse\Plugin\Sliders;
    
    
    define ('FUSE_PLUGIN_SLIDERS_BASE_URI', __DIR__);
    define ('FUSE_PLUGIN_SLIDERS_BASE_URL', plugins_url ('', __FILE__));
    
    
    $fuse_sliders_setup = Setup::getInstance ();