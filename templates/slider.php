<?php
    /**
     *  @package fusesliders
     *  @version 1.0
     *
     *  This template displays our slider. You can over-ride this template by copying it to a new directory in your themes files.
     *
     *  This should be placed at /theme-folder/templates/fuse-slider/
     */
    
    $id = uniqid ('fuse-slider-');
?>
<div id="<?php esc_attr_e ($id); ?>" class="fuse-sliders-container-block">
    <div class="fuse-sliders-slide-container">
        
        <?php
            foreach ($object->getSlides () as $slide) {
                echo $slide;
            } // foreach ()
        ?>
        
    </div>
</div>
<script type="text/javascript">
    jQuery (document).ready (function () {
        jQuery ('#<?php esc_attr_e ($id); ?> > .fuse-sliders-slide-container').slick ({
            autoplay: <?php echo $object->getSetting ('autoplay'); ?>,
            autoplaySpeed: <?php echo $object->getSetting ('autoplaySpeed'); ?>,
            speed: <?php echo $object->getSetting ('speed'); ?>,
            arrows: <?php echo $object->getSetting ('arrows'); ?>,
            dots: <?php echo $object->getSetting ('dots'); ?>,
            fade: <?php echo $object->getSetting ('fade'); ?>,
            infinite: <?php echo $object->getSetting ('infinite'); ?>,
            pauseOnFocus: <?php echo $object->getSetting ('pauseOnFocus'); ?>,
            pauseOnHover: <?php echo $object->getSetting ('pauseOnHover'); ?>,
            pauseOnDotsHover: <?php echo $object->getSetting ('pauseOnDotsHover'); ?>,
            slidesToShow: <?php echo $object->getSetting ('slidesToShow'); ?>,
            slidestoScroll: <?php echo $object->getSetting ('slidestoScroll'); ?>,
            centerMode: <?php echo $object->getSetting ('centerMode'); ?>,
            vertical: <?php echo $object->getSetting ('vertical'); ?>
        });
    });
</script>