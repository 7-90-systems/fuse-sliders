<?php
    /**
     *  This is the slider shortcode class.
     */
    
    namespace Fuse\Plugin\Sliders\Shortcode;
    
    use Fuse\Plugin\Sliders\Model;
    
    
    class Slider {
        
        /**
         *  Object constructor.
         */
        public function __construct () {
            add_shortcode ('fuse_slider', array ($this, 'fuseSlider'));
        } // __construct ()
        
        
        
        
        /**
         *  Set up our shortcode handler.
         *
         *  @param array $args The attributes.
         *  @param string $content The content.
         *
         *  return NULL
         */
        public function fuseSlider ($args = array (), $content = '') {
            wp_enqueue_script ('slick');
            wp_enqueue_style ('slick');
            
            wp_enqueue_style ('fuse-sliders-public');
            
            $args = shortcode_atts (array (
                'id' => 0
            ), $args);
            
            $html = '';
            
            $slider = NULL;
            
            if ($args ['id'] > 0) {
                $slider = get_post ($args ['id']);
                
                if (!$slider || $slider->post_type != 'fuse_slider') {
                    $slider = NULL;
                } // if ()
            } // if ()
            
            if ($slider) {
                $slider_model = new Model\Slider ($slider);
                
                $html = $slider_model->render (false);
            } // if ()
            
            return $html;
        } // fuseSlider ()
        
    } // class Slider