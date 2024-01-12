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
            
            // Set up our blocks!
            add_action ('enqueue_block_editor_assets', array ($this, 'addBlocks'));
        } // _init ()
        
        
        
        
        /**
         *  Load our blocks
         */
        public function addBlocks () {
            wp_enqueue_script ('fuse-sliders-slide-block', FUSE_PLUGIN_SLIDERS_BASE_URL.'/blocks/slider/block.js', array ('wp-blocks','wp-editor'), true);
        } // addBlocks ()
        
    } // class Setup