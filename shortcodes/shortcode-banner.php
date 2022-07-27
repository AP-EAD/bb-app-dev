<?php

add_shortcode('banner', function () {
    ob_start();
    $args = array(
        'post_type' => 'banner',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby'=> 'date',
        'order' => 'DESC'        
    );

    $query = new WP_Query($args);
    if ($query->have_posts()) {

?>           


<div id="bannerHome" uk-slideshow="animation: fade; autoplay: true">

    <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1">

        <ul class="uk-slideshow-items">


        <?php
        while ($query->have_posts()) {
            $query->the_post();
            //$link = (get_field('link')) ? get_field('link') : '';
            //$destinoLink = get_field('destino_link');
        ?>

         <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>


            <li>
                <a href="<?php the_field('url'); ?>" 
         <?php if (get_field('abrir_em_outra_aba') == 'Sim') { ?>
            target="_blank"
         <?php } elseif (get_field('abrir_em_outra_aba') == 'Nao') { ?>
            target="_self"
         <?php } ?>
                    >
                    <div style="background: url('<?php echo $image[0]; ?>')" class="bannerThumb"></div>
                </a>
            </li>
        <?php
        }
        wp_reset_postdata();
        ?>             

            
        </ul>

        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>

    </div>

    <ul class="uk-slideshow-nav uk-dotnav uk-flex-center uk-margin"></ul>

</div>















<?php
    }
    return ob_get_clean();
});
