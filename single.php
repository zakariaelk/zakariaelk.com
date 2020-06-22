<!-- HEADER -->

<?php

/*
Author: Zakaria El Khachia
Client: Zakariaelk.com
 */

get_header();

$secondCoverID = get_field("project_cover_2");

?>

<!-- PAGE CONTENT BEGINS -->

<?php if (have_posts()): while (have_posts()): the_post();?>


						    <!-- section-01 - Project Banner -->

						    <section id="project-hero">
						        <div class="hero-content boxed">
						            <div class="container-l">
						                <div class="col-4 banner-txt">
						                    <h1><?php the_field("project_headline");?></h1>
						                    <p class="desc">
						                        <?php the_field("project_intro");?>
						                    </p>
						                    <a href="#project-info" class="discover scroll">
						                        more info
						                    </a>
						                </div>
						                <div class="col-8 banner-visual">
						                    <img src="<?php echo wp_get_attachment_image_url($secondCoverID, 'full') ?>" alt="Zakaria Elk | <?php the_title();?>">
						                </div>
						            </div>
						        </div>
						    </section>

						    <?php the_field('');?>

						    <!-- section-02 - Project Info -->

						    <section id="project-info">
						        <div class="info-content boxed">
						            <div class="container-l">
						                <div class="col-4 info-title">
						                    <h2>context</h2>
						                </div>
						                <div class="col-8 info-details">
						                    <div class="info-intro">
						                        <?php the_field('project_description');?>
						                    </div>

						                    <div class="info-list-container">
						                        <div class="info-list">
						                            <span class="list-title">what i did</span>
						                            <div class="list-details">
						                                <?php the_field('project_services');?>
						                            </div>
						                        </div>


						                        <div class="info-list">
						                            <span class="list-title">year</span>
						                            <div class="list-details">
						                                <?php the_field('project_date');?>
						                            </div>
						                        </div>

						                        <div class="info-list">
						                            <span class="list-title">take a look</span>
						                            <div class="list-details site-link">
						                                <a href="http://<?php the_field('project_link');?>" target="_blank"><?php the_field('project_link');?></a></li>
						                            </div>

						                            <div class="site-link-note">
						                                <?php
        if (get_field("project_link_note")) {
            echo the_field("project_link_note");
        }
        ?>
						                            </div>
						                        </div>
						                    </div>
						                </div>
						            </div>
						        </div>
						    </section>


						    <!-- section-03 - Project Visuals -->

						    <section id="project-visuals">
						        <div class="visual-content boxed">

						            <?php

        if (have_rows('project_visuals')):

            while (have_rows('project_visuals')): the_row();

                $image_id = get_sub_field('visual');
                ?>

												            <figure class="visual-figure">
												                 <img src="<?php echo wp_get_attachment_image_url($image_id, 'full') ?>"/>
												            </figure>

												            <?php

            endwhile;

        endif;
        ?>



						        </div>
						    </section>

						        <?php

        $prev_post = get_previous_post();

        if (empty($prev_post)) {
            $prev_post = get_next_post();
            ?>

						                <a class="next-post-nav" href="<?php echo get_site_url(); ?>">
						                    <div class="next-link" data-label="more work">back to</div>
						                    <div class="next-label" data-label="see here">work</div>
						                </a>

						        <?php
        } else {
            $prev_post = get_previous_post();
            ?>

						            <a class="next-post-nav" href="<?php echo get_permalink($prev_post->ID); ?>">
						                <span class="next-link" data-label="next project">up next</span>
						                <span class="next-label" data-label="<?php echo apply_filters('the_title', $prev_post->post_title); ?>"><?php echo apply_filters('the_title', $prev_post->post_title); ?></span>
						            </a>

						        <?php

        }

        ?>


						<?php endwhile;?>
			<?php endif;?>

<!-- PAGE CONTENT ENDS -->


<!-- FOOTER -->

	<?php get_footer();?>

<!-- FOOTER End -->