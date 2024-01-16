<?php
    /**
     *  @package fusesliders
     *  @version 1.0
     *
     *  This class sets up our plugin.
     *
     *  The Fuse Sliders system works with Slick Slider, so this will be enqueued as required.
     */
    
    namespace Fuse\Plugin\Sliders;
    
    use Fuse\Traits\Singleton;
    
    
    class Setup {
        
        use Singleton;
        
        
        
        
        /**
         *  Initialise the plugin.
         */
        protected function _init () {
            // Set up our post types.
            $posttype_slider = new PostType\Slider ();
            $posttype_slide = new PostType\Slide ();
            
            // Add our shortcodes
            $shortcode_slider = new Shortcode\Slider ();
            
            // Register our scripts and styles.
            add_action ('wp_enqueue_scripts', array ($this, 'registerScripts'), 6);
        } // _init ()
        
        
        
        
        /**
         *  Register our scripts and styles.
         */
        public function registerScripts () {
            wp_register_style ('fuse-sliders-public', FUSE_PLUGIN_SLIDERS_BASE_URL.'/assets/css/public.css');
        } // registerScripts ()
        
    } // class Setup