<?php
    /**
     *  This is our slide template.
     */
?>
<div class="fuse-sliders-slide-container">
    
    <div class="fuse-sliders-slide-background" style="background-image: url('<?php echo esc_url (fuse_get_feature_image ($object->slide->ID)); ?>')"></div>

    <div class="fuse-sliders-side-content">
        <div class="wrap">
            <?php
                echo apply_filters ('the_content', $object->slide->post_content);
            ?>
        </div>
    </div>
    
</div>