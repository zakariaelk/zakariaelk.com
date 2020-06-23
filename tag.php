<!-- HEADER -->

<?php

/*
Template Name: Frontpage
Author: Zakaria El Khachia
 */

get_header();

$cover_size = 'full';
$cover_id = get_post_thumbnail_id();

?>


<!-- Tag Results -->

<section id="work-list">
    <div class="boxed">

            <?php 
            
            if (have_posts()): 

                while (have_posts()): the_post();

                    $_SESSION['postCount'] = 1;

                    get_template_part('/template-parts/content', get_post_format());

                    $_SESSION['postCount']++;

                endwhile;

            endif;

            wp_reset_postdata();
             
            ?>
            
    </div>
</section>            

<!-- Tag Results End -->


<!-- FOOTER -->

	<?php get_footer();?>
