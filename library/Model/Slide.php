<?php
    /**
     *  @package fusesliders
     *  @version 1.0
     *
     *  This model is set up for a slider.
     */
    
    namespace Fuse\Plugin\Sliders\Model;
    
    use DateTime;
    use Fuse\Plugin\Sliders\Traits\SliderTemplate;
    
    
    class Slide {
        
        use SliderTemplate;
        
        
        
        
        
        /**
         *  @var WP_Post The slide post object.
         */
        public $slide;
        
        
        
        
        /*8
         *  Object constructor.
         *
         *  @param WP_Post|int $slide The slide post object or ID.
         */
        public function __construct ($slide) {
            if (is_numeric ($slide)) {
                $slide = get_post ($slide);
            } // if ()
            
            $this->slide = $slide;
        } // __construct ()
        
        
        
        
        /**
         *  Is this slide active for the current time?
         *
         *  return bool True if active or false if not active.
         */
        public function isActive () {
            $active = false;
            
            $now = new DateTime (current_time ('mysql'));
            
            $start_time = $this->getStartTime ();
            $end_time = $this->getEndTime ();
            
            if (
                (
                    is_null ($start_time) && is_null ($end_time)
                )
                ||
                (
                    is_null ($start_time) && $end_time >= $now
                )
                ||
                (
                    $start_time <= $now && is_null ($end_time)
                )
                ||
                (
                    $start_time <= $now && $end_time >= $now
                )
            ) {
                $active = true;
            } // if ()
            
            return $active;
        } // isActive ()
        
        
        
        
        /**
         *  Get the starting time for this slide.
         *
         *  @return DateTime|NULL Returns a DateTime object or NULL if no starting time is set.
         */
        public function getStartTime () {
            return $this->getTime ('start');
        } // getStartTime ()
        
        /**
         *  Get the ending time for this slide.
         *
         *  @return DateTime|NULL Returns a DateTime object or NULL if no ending time is set.
         */
        public function getEndTime () {
            return $this->getTime ('end');
        } // getEndTime ()
        
        /**
         *  Get the requested time for this slide.
         *
         *  @param string $type This can be either 'start' or 'end'.
         *
         *  @return DateTime|NULL Returns a DateTime object or NULL if no starting time is set.
         */
        public function getTime ($type) {
            $time = NULL;
            
            if (get_post_meta ($this->slide->ID, 'fuse_slider_slide_set_'.$type, true) == 'set') {
                $time = new DateTime (get_post_meta ($this->slide->ID, 'fuse_sliders_slide_'.$type, true));
            } // if ()
            
            return $time;
        } // getTime ()
        
    } // class Slide