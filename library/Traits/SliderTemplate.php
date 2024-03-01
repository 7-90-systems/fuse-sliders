<?php
    /**
     *  Set up the slider template trait.
     */
    
    namespace Fuse\Plugin\Sliders\Traits;
    
    
    trait SliderTemplate {
        
        /**
         *  Get the template file for the reqested file. Please leave the .php extension off the file name.
         *
         *  @input $template_name the name of the template file without the .php extension.
         *
         *  @return string Returns the template file URI.
         */
        public function getTemplateFileUri ($template_name) {
            $template_uri = FUSE_PLUGIN_SLIDERS_BASE_URI.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.$template_name.'.php';
            
            // Check for PARENT/MAIN theme
            $theme_uri = get_template_directory_uri ().DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'fuse-sliders'.DIRECTORY_SEPARATOR.$template_name.'.php';
            
            if (file_exists ($theme_uri)) {
                $template_uri = $theme_uri;
            } // if ()
            
            // Check for CHILD THEME
            if (is_child_theme ()) {
                $theme_uri = get_stylesheet_directory_uri ().DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'fuse-sliders'.DIRECTORY_SEPARATOR.$template_name.'.php';
                
                if (file_exists ($theme_uri)) {
                    $template_uri = $theme_uri;
                } // if ()
            } // if ()
            
            return $template_uri;
        } // getTemplateFileUri ()
        
        
        
        
        /**
         *  Render the HTML code for this slider.
         *
         *  @param bool $output True to output or false to return.
         *
         *  @return string|NULL Returns the HTM code of NULL if output.
         */
        public function render ($output = true) {
            $html = $this->__toString ();
            
            if ($output === false) {
                return $html;
            } // if ()
            else {
                echo $html;
            } // else
        } // render 
        
        /**
         *  Output the sliders HTML.
         *
         *  return string The sliders HTML code.
         */
        public function __toString () {
            ob_start ();
            
            if (is_a ($this, '\Fuse\Plugin\Sliders\Model\Slide')) {
                $use_template = true;
            
                if (get_post_meta ($this->slide->ID, 'fuse_sliders_content_type', true) == 'content') {
                    return apply_filters ('the_content', $this->slide->post_content);
                } // if ()
            
                $template = 'slide';
            } // if ()
            else {
                $template = 'slider';
            } // else
            
            $object = $this;
            include ($this->getTemplateFileUri ($template));
            
            $html = ob_get_contents ();
            ob_end_clean ();
            
            return $html;
        } // __toString ()
        
    } // trait SliderTemplate