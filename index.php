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

            <!-- Side Visual -->
            <aside class="side-visual">
            </aside>

            <!-- section-01 - Welcome -->

            <section id="home-welcome">
                <div class="welcome-content boxed">
                    <h1 style="display: none;">Zakaria Elk | UI Designer & Frontend Developer</h1>

                    <div class="welcome-statement">
                        <div class="dynamic-welcome"><span></span></div>
                        <div class="static-welcome"><span>welcome to my web design portfolio</span></div>
                        <a href="#home-work" class="discover scroll">
                            to work.
                        </a>

                    </div>

                </div>
            </section>


            <!-- section-02 - Work -->

            <?php if (have_posts()): while (have_posts()): the_post();?>

		            <section id="home-work">
		                <div class="boxed">

						                    <?php
        $args = array(
            'orderby' => 'date',
            'post_type' => 'post',
            'posts_per_page' => -1,
        );

        $the_query = new WP_Query($args);

        if ($the_query->have_posts()):

            $_SESSION['postCount'] = 1;

            while ($the_query->have_posts()): $the_query->the_post();

                get_template_part('/template-parts/content', get_post_format());

                $_SESSION['postCount']++;

            endwhile;

        endif;

        wp_reset_postdata();

        ?>


						                </div>
						            </section>

						<?php endwhile;?>
			<?php endif;?>



<!-- PAGE CONTENT ENDS -->


<!-- FOOTER -->

	<?php get_footer();?>
