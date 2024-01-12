<?php
    /**
     *  @package fusesliders
     *  @version 1.0
     *
     *  This model is set up for a slider.
     */
    
    namespace Fuse\Plugin\Sliders\Model;
    
    
    class Slider {
        
        /**
         *  @var WP_Post The slider post object.
         */
        protected $_slider;
        
        
        
        
        /*8
         *  Object constructor.
         *
         *  @param WP_Post|int $slider The slider post object or ID.
         */
        public function __construct ($slider) {
            if (is_numeric ($slider)) {
                $slider = get_post ($slider);
            } // if ()
            
            $this->_slider = $slider;
        } // __construct ()
        
        
        
        
        /**
         *  Get the slides set for this slider.
         *
         *  @param bool $active_only True to get only active slides or false to return all slides. Defaults to true.
         *
         *  @return array An array of slide objects.
         */
        public function getSlides ($active_only = true) {
            global $wpdb;
            
            $now = current_time ('mysql');
            
            $query = $wpdb->prepare ("SELECT
                s.ID AS ID
            FROM ".$wpdb->posts." AS s
            WHERE s.post_type = 'fuse_slide'
                AND post_status = 'publish'
                AND post_date <= %s
                AND post_parent = %d
            ORDER BY s.menu_order ASC, s.post_title ASC", $now, $this->_slider->ID);
            
            $slides = array ();

            foreach ($wpdb->get_results ($query) as $row) {
                $slide = get_post ($row->ID);
                
                if ($slide->isActive ()) {
                    $slides [] = $slide;
                } // if ()
            } // foreach ()
            
            return $slides;
        } // getSlides ()
        
    } // class Slider ()