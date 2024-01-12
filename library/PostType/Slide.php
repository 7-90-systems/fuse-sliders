<?php
    /**
     *  @package fusesliders
     *  @version 1.0
     *
     *  This class sets up our individual slides post type.
     */
    
    namespace Fuse\Plugin\Sliders\PostType;
    
    use Fuse\PostType;
    
    
    class Slide extends PostType {
        
        /**
         *  Object constructor.
         */
        public function __construct () {
            $this->_parent_post_type = 'fuse_slider';
            
            parent::__construct ('fuse_slide', __ ('Slide', 'fusesliders'), __ ('Slides', 'fusesliders'), array (
                'public' => false,
                'publicly_queryable' => false,
                'rewrite' => false,
                'show_in_rest' => true,
                'show_in_menu' => 'edit.php?post_type=fuse_slider',
                'supports' => array (
                    'title',
                    'editor',
                    'thumbnail',
                    'page-attributes'
                )
            ));
        } // __construct ()
        
        
        
        
        /**
         *  Set up our metaboxes.
         */
        public function addMetaBoxes () {
            add_meta_box ('fuse_sliders_slide_dates_meta', __ ('Start and End Times', 'fusesliders'), array ($this, 'dateMeta'), $this->getSlug (), 'normal', 'high');
        } // addMetaBoxes ()
        
        /**
         *  Set up the dates meta box.
         */
        public function dateMeta ($post) {
            $times = array (
                'start' => __ ('Start', 'fusesliders'),
                'end' => __ ('End', 'fusesliders')
            );
            
            ?>
                <script type="text/javascript">
                    jQuery (document).ready (function () {
                        jQuery ('.fuse-sliders-slide-set-time-field').change (function () {
                            var container = jQuery (this).closest ('tr').find ('div.fuse-sliders-slide-set-time');
                            
                            if (jQuery (this).prop ('checked') === true) {
                                container.show ();
                            } // if ()
                            else {
                                container.hide ();
                            } // else
                        });
                    });
                </script>
                <table class="form-table">
                    
                    <?php foreach ($times as $key => $label): ?>
                        <?php
                            $set = get_post_meta ($post->ID, 'fuse_slider_slide_set_'.$key, true);
                            $time = get_post_meta ($post->ID, 'fuse_sliders_slide_'.$key, true);
                        ?>
                    
                        <tr>
                            <th><?php printf (__ ('%s time', 'fusesliders'), $label); ?></th>
                            <td>
                                <label>
                                    <input type="checkbox" name="fuse_slider_slide_set_<?php esc_attr_e ($key); ?>" value="set" class="fuse-sliders-slide-set-time-field"<?php checked ($set, 'set'); ?> />
                                    <?php printf (__ ('Set %s time', 'fusesliders'), strtolower ($label)); ?>
                                </label>
                                <div class="fuse-sliders-slide-set-time"<?php if ($set != 'set') echo ' style="display: none;"'; ?>>
                                    <p><input type="datetime-local" name="fuse_sliders_slide_<?php esc_attr_e ($key); ?>" value="<?php esc_attr_e ($time); ?>" /></p>
                                </div>
                            </td>
                        </tr>
                    
                    <?php endforeach; ?>
                    
                </table>
                <input type="hidden" name="fuse-slider-slide-time-update" value="update" />
            <?php
        } // dateMeta ()
        
        
        
        
        /**
         *  Save the posts values.
         */
        public function savePost ($post_id, $post) {
            // Dates
            if (array_key_exists ('fuse-slider-slide-time-update', $_POST)) {
                $times = array (
                    'start',
                    'end'
                );
                
                foreach ($times as $key) {
                    $set = '';
                    $time = '';
                    
                    if (array_key_exists ('fuse_slider_slide_set_'.$key, $_POST) && $_POST ['fuse_slider_slide_set_'.$key] == 'set') {
                        $set = 'set';
                        // Make sure that we convert dates to MySQL format so we can use the database to search easily
                        $time = date ('Y-m-d H:i:s', strtotime ($_POST ['fuse_sliders_slide_'.$key]));
                    } // if ()
                    
                    update_post_meta ($post_id, 'fuse_slider_slide_set_'.$key, $set);
                    update_post_meta ($post_id, 'fuse_sliders_slide_'.$key, $time);
                } // foreach ()
            } // if ()
        } // savePost ()
        
    } // class Slide