<?php
    /**
     *  @package fusesliders
     *  @version 1.0
     *
     *  This class sets up our slider post type.
     */
    
    namespace Fuse\Plugin\Sliders\PostType;
    
    use Fuse\PostType;
    
    
    class Slider extends PostType {
        
        /**
         *  @var array The settings that we make available in the options panel. This is not the full list of settings available so check the Slick Slider documentation for a complete list.
         */
        protected $_settings;
        
        
        
        
        /**
         *  Object constructor.
         */
        public function __construct () {
            parent::__construct ('fuse_slider', __ ('Slider', 'fusesliders'), __ ('Sliders', 'fusesliders'), array (
                'public' => false,
                'publicly_queryable' => false,
                'rewrite' => false,
                'show_in_rest' => false,
                'menu_icon' => 'dashicons-images-alt2',
                'supports' => array (
                    'title'
                )
            ));
            
            $this->_settings = array (
                'autoplay' => array (
                    'label' => __ ('Autoplay', 'fusesliders'),
                    'default' => true
                ),
                'autoplaySpeed' => array (
                    'label' => __ ('Autoplay Speed', 'fusesliders'),
                    'default' => 3000
                ),
                'speed' => array (
                    'label' => __ ('Slide/fade animation speed', 'fusesliders'),
                    'default' => 300
                ),
                'arrows' => array (
                    'label' => __ ('Navigation Arrows', 'fusesliders'),
                    'default' => true
                ),
                'dots' => array (
                    'label' => __ ('Navigation Dots', 'fusesliders'),
                    'default' => false
                ),
                'fade' => array (
                    'label' => __ ('Fade', 'fusesliders'),
                    'default' => false
                ),
                'infinite' => array (
                    'label' => __ ('Infiniate Looping', 'fusesliders'),
                    'default' => true
                ),
                'pauseOnFocus' => array (
                    'label' => __ ('Pause autoplay on focus', 'fusesliders'),
                    'default' => true
                ),
                'pauseOnHover' => array (
                    'label' => __ ('Pause autplay on hover', 'fusesliders'),
                    'default' => true
                ),
                'pauseOnDotsHover' => array (
                    'label' => __ ('Pause autoplay on dots hover', 'fusesliders'),
                    'default' => false
                ),
                'slidesToShow' => array (
                    'label' => __ ('Number of slides to show', 'fusesliders'),
                    'default' => 1
                ),
                'slidestoScroll' => array (
                    'label' => __ ('Number of slides to scroll', 'fusesliders'),
                    'default' => 1
                ),
                'centerMode' => array (
                    'label' => __ ('Centre Mode when using odd numbered slides to show counts', 'fusesliders'),
                    'default' => false
                ),
                'vertical' => array (
                    'label' => __ ('Vertical slide mode', 'fusesliders'),
                    'default' => false
                )
            );
        } // __construct ()
        
        
        
        
        /**
         *  Set up our meta boxes.
         */
        public function addMetaBoxes () {
            add_meta_box ('fuse_sliders_slider_options', __ ('Slider Options', 'fusesliders'), array ($this, 'optionsMeta'), $this->getSlug (), 'normal', 'low');
        } // addMetaBoxes ()
        
        /**
         *  Set up the options meta box.
         */
        public function optionsMeta ($post) {
            ?>
                <table class="form-table">
                    
                    <?php foreach ($this->_settings as $key => $setting): ?>
                        <?php
                            $value = get_post_meta ($post->ID, 'fuse_slider_slide_'.$key, true);
                        ?>
                    
                        <tr>
                            <th><?php echo $setting ['label']; ?></th>
                            <td>
                                <?php
                                    if (is_bool ($setting ['default'])) {
                                        $setting ['default'] = $setting ['default'] === true ? 'yes' : 'no';
                                        
                                        $this->_toggleField ($key, $setting, $value);
                                    } // if ()
                                    elseif (is_int ($setting ['default'])) {
                                        $this->_numberField ($key, $setting, $value);
                                    } // elseif ()
                                    else {
                                        $this->_stringField ($key, $setting, $value);
                                    } // else
                                ?>
                            </td>
                        </tr>
                    
                    <?php endforeach; ?>
                    
                </table>
            <?php
        } // optionsMeta ()
        
        
        
        
        /**
         *  Save the posts values.
         */
        public function savePost ($post_id, $post) {
            // Settings
            foreach ($this->_settings as $key => $setting) {
                if (array_key_exists ('fuse_slider_slide_'.$key, $_POST)) {
                    $value = $_POST ['fuse_slider_slide_'.$key];
                    
                    update_post_meta ($post_id, 'fuse_slider_slide_'.$key, $value);
                } // if ()
            } // foreach ()
        } // savePost ()
        
        
        
        
        /**
         *  Set up a string field
         */
        protected function _stringField ($name, $setting, $value) {
            ?>
                <input type="text" name="fuse_slider_slide_<?php esc_attr_e ($name) ?>" value="<?php esc_attr_e ($value); ?>" class="regular-text" />
            <?php
        } // _stringField ()
        
        /**
         *  Set up a number field
         */
        protected function _numberField ($name, $setting, $value) {
            if (empty ($value) && $value != 0) {
                $value = $setting ['default'];
            } // if ()
            ?>
                <input type="number" name="fuse_slider_slide_<?php esc_attr_e ($name) ?>" value="<?php echo intval ($value); ?>" step="1" class="small-text" />
            <?php
        } // _numberField ()
        
        /**
         *  Show a toggle field.
         */
        protected function _toggleField ($name, $setting, $value) {
            if (empty ($value)) {
                $value = $setting ['default'];
            } // if ()
            
            if ($value != 'yes') {
                $value = 'no';
            } // if ()
            ?>
                <select name="fuse_slider_slide_<?php esc_attr_e ($name) ?>">
                    <option value="yes"<?php selected ($value, 'yes'); ?>><?php _e ('Yes', 'fusesliders'); ?></option>
                    <option value="no"<?php selected ($value, 'no'); ?>><?php _e ('No', 'fusesliders'); ?></option>
                </select>
            <?php
        } // _togglefield ()
        
    } // class Slider