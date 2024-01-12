<?php
    /**
     *  @package fusesliders
     *  @version 1.0
     *
     *  This template displays our slider. You can over-ride this tempplate by copying it to a new directoy in your themes files.
     *
     *  This should be placed at /theme-folder/templates/fuse-slider/
     */
    
    $id = uniqid ('fuse-slider-');
?>
<div id="<?php esc_attr_e ($id); ?>" class="fuse-sliders-container-block">
    <div class="fuse-sliders-slide-container">
        
        <?php
            // Show the slides here.
        ?>
        
    </div>
</div>