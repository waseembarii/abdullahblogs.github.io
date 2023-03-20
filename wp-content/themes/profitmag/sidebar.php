<?php
/**
 * The right sidebar containing the main widget area.
 *
 * @package ProfitMag
 */
?>
<?php
$profitmag_settings = profit_get_theme_options();
if( is_home() || is_front_page() ) {
    $show_sidebar = 1;
}else {
    if( isset( $profitmag_settings['profitmag_sidebar_layout_setting']) && ($profitmag_settings['profitmag_sidebar_layout_setting'] == 'right_sidebar') || ($profitmag_settings['profitmag_sidebar_layout_setting'] == 'both_sidebar') ) {
        $show_sidebar = 1;
    }else {
        $show_sidebar = 0;
    }
}
?>
<?php 
if( $show_sidebar ): ?>


<?php if( is_active_sidebar( 'right-sidebar-top' ) || 
    !empty( $profitmag_settings['profitmag_rightsidebar_top_setting'])  || 
    !empty( $profitmag_settings['profitmag_right_mid_ads_setting']) || 
    !empty( $profitmag_settings['profitmag_right_gallery_setting'] )  || 
    !empty( $profitmag_settings['profitmag_rightsidebar_bottom_setting'] ) || 
    is_active_sidebar( 'right-sidebar-middle' )|| 
    !empty( $profitmag_settings['profitmag_right_bottom_ads_setting'] ) || 
    !empty( $profitmag_settings['profitmag_right_bottom_ads_two_setting'] )   ) : ?>
    <div id="secondary-right" class="widget-area secondary-sidebar f-right clearfix" role="complementary">
        <?php if( is_active_sidebar( 'right-sidebar-top' ) ) : ?>
            <div id="sidebar-section-top" class="widget-area sidebar clearfix">
               <?php   dynamic_sidebar( 'right-sidebar-top' ); ?>
           </div>
       <?php endif; ?>
       
       <?php   if( !empty( $profitmag_settings['profitmag_rightsidebar_top_setting'] ) && $profitmag_settings['profitmag_rightsidebar_top_setting']>0 ): ?>
        <div id="sidebar-section-cat-one" class="widget-area sidebar clearfix">
            <div class="widget">
                <?php
                $sidebar_cat = $profitmag_settings['profitmag_rightsidebar_top_setting'];
                $no_of_posts = $profitmag_settings['profitmag_post_one_num_setting'];
                $side_query1 = new WP_Query( 'cat='.absint($sidebar_cat).'&posts_per_page='.absint($no_of_posts));
                if($side_query1->have_posts()):
                    $cat_name = get_cat_name( $sidebar_cat );
                    $cat_link = get_category_link( $sidebar_cat );
                    $skip_flag = 1;
                    ?>
                    <h2 class="block-title"><span class="bordertitle-red"></span><?php echo  esc_html($cat_name); ?></h2>
                    <?php
                    while( $side_query1->have_posts() ): $side_query1->the_post();
                        ?>
                        <div class="featured-post-sidebar">

                            <?php if( $skip_flag == 1 ): ?>
                                <figure class="post-thumb clearfix">
                                    <?php
                                    if( has_post_thumbnail() ):
                                        $post_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'sidebar-medium' );
                                        ?>
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><img src="<?php echo esc_url( $post_thumb[0] ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" /></a>
                                    <?php
                                    endif;
                                    ?>
                                </figure>
                            <?php endif; ?>

                            <div class="post-desc">
                                <div class="post-date"><i class="fa fa-calendar"></i><?php echo esc_html(get_the_date( 'F d, Y')) ; ?></div>
                                <h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_title(); ?></a></h3>
                                <?php if( $skip_flag == 1 ): ?>
                                    <p class="side-excerpt"><?php profitmag_sidebar_excerpt(get_the_excerpt()); ?></p>
                                    <?php $skip_flag = 0; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    ?>
                    <div class="view-all-link"><a href="<?php echo esc_url( $cat_link ); ?>" title="<?php echo esc_attr__( 'View All', 'profitmag')?>"><?php esc_html_e( 'View All', 'profitmag' ); ?></a></div>
                <?php
                endif;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    <?php   endif; ?>
    
    
    <?php if( !empty( $profitmag_settings['profitmag_right_mid_ads_setting'] ) && $profitmag_settings['profitmag_right_mid_ads_setting'] != '' ): ?>
        <div id="sidebar-section-mid-ads" class="widget-area sidebar clearfix">
            <?php echo wp_specialchars_decode($profitmag_settings['profitmag_right_mid_ads_setting'], '"'); ?>
        </div>
    <?php endif; ?>
    
    <?php if( !empty( $profitmag_settings['profitmag_right_gallery_setting'] ) ): ?>
        <div id="sidebar-section-side-gallery" class="widget-area sidebar clearfix">
            <div class="widget">
                <h2 class="block-title"><span class="bordertitle-red"></span><?php esc_html_e( 'Photo Gallery', 'profitmag' ); ?></h2>
                <div class="photogallery-wrap clearfix">
                    <?php

                    $rt_gallery        = $profitmag_settings['profitmag_right_gallery_setting'];

                    $rt_gallery        = explode("=", $rt_gallery);

                    $rt_gallery_ids    = explode('"', $rt_gallery['1']);

                    $rt_gallery_id     = explode(',', $rt_gallery_ids['1']);

                    foreach( $rt_gallery_id as $image ):

                        $img_url = wp_get_attachment_image_src($image,'sidebar-gallery');
                        $img_url_full = wp_get_attachment_image_src( $image, 'full' );
                        ?>
                        <a class="nivolight" data-lightbox-gallery="grp" href="<?php echo esc_url( $img_url_full[0] );?>"><img src="<?php echo esc_url( $img_url[0] ); ?>" alt="<?php echo esc_attr__( 'Gallery', 'profitmag')?>" /></a>
                    <?php
                    endforeach;?>
                </div>
            </div>

        </div>
        
    <?php endif; ?>
    
    
    <?php   if( !empty( $profitmag_settings['profitmag_rightsidebar_bottom_setting'] ) && $profitmag_settings['profitmag_rightsidebar_bottom_setting']>0 ): ?>
        <div id="sidebar-section-cat-two" class="widget-area sidebar clearfix">
            <div class="widget">
                <?php
                $sidebar_cat = $profitmag_settings['profitmag_rightsidebar_bottom_setting'];
                $no_of_posts = $profitmag_settings['profitmag_post_two_num_setting'];
                $side_query1 = new WP_Query( 'cat='.absint($sidebar_cat).'&posts_per_page='.absint($no_of_posts));
                if($side_query1->have_posts()):
                    $cat_name = get_cat_name( $sidebar_cat );
                    $cat_link = get_category_link( $sidebar_cat );
                    $skip_flag = 1;
                    ?>
                    <h2 class="block-title"><span class="bordertitle-red"></span><?php echo esc_html($cat_name); ?></h2>
                    <?php
                    while( $side_query1->have_posts() ): $side_query1->the_post();
                        ?>
                        <div class="featured-post-sidebar clearfix">

                            <?php if( $skip_flag == 1 ): ?>
                                <figure class="post-thumb clearfix">
                                    <?php
                                    if( has_post_thumbnail() ):
                                        $post_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'sidebar-medium' );
                                        ?>
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><img src="<?php echo esc_url( $post_thumb[0] ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" /></a>
                                    <?php
                                    endif;
                                    ?>
                                </figure>
                            <?php endif; ?>

                            <div class="post-desc">
                                <div class="post-date"><i class="fa fa-calendar"></i><?php echo esc_html(get_the_date( 'F d, Y')) ; ?></div>
                                <h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_title(); ?></a></h3>
                                <?php if( $skip_flag == 1 ): ?>
                                    <p class="side-excerpt"><?php profitmag_sidebar_excerpt(get_the_excerpt()); ?></p>
                                    <?php $skip_flag = 0; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    ?>
                    <div class="view-all-link"><a href="<?php echo esc_url( $cat_link ); ?>" title="<?php echo esc_attr__( 'View All', 'profitmag')?>"><?php esc_html_e( 'View All', 'profitmag' ); ?></a></div>
                <?php
                endif;
                wp_reset_postdata();
                ?>
            </div>

        </div>
    <?php   endif; ?>
    
    <?php if( is_active_sidebar( 'right-sidebar-middle' ) ) : ?>
        <div id="sidebar-section-side-mid" class="widget-area sidebar clearfix">
           <?php   dynamic_sidebar( 'right-sidebar-middle' ); ?>
       </div>
   <?php endif; ?>
   
   
   
   <?php if( !empty( $profitmag_settings['profitmag_right_bottom_ads_setting'] ) && $profitmag_settings['profitmag_right_bottom_ads_setting'] != '' ): ?>
    <div id="sidebar-section-ads-one" class="widget-area sidebar clearfix">
        <?php echo wp_specialchars_decode($profitmag_settings['profitmag_right_bottom_ads_setting'], '"'); ?>
    </div>
<?php endif; ?>

<?php if( !empty( $profitmag_settings['profitmag_right_bottom_ads_two_setting'] ) && $profitmag_settings['profitmag_right_bottom_ads_two_setting'] != '' ): ?>
    <div id="sidebar-section-ads-two" class="widget-area sidebar clearfix">
        <?php echo wp_specialchars_decode($profitmag_settings['profitmag_right_bottom_ads_two_setting'], '"'); ?>
    </div>
<?php endif; ?>

</div>      

<?php endif; ?>

<?php endif; ?>