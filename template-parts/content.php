<?php
/**
 * Template part for displaying posts
 *
 * @package WordPress
 * @subpackage daga
 */

// session_start();
$firstCoverID = get_field("project_cover_1");
$secondCoverID = get_field("project_cover_2");
?>

                <div class="project-container">
                    <a href="<?php the_permalink(); ?>" class="item">

                        <img class="img-1" src="<?php echo wp_get_attachment_image_url( $firstCoverID, 'large' ) ?>"/>   
                        <img class="img-2" src="<?php echo wp_get_attachment_image_url( $secondCoverID, 'large' ) ?>"/>   
                        
                        <h3 class="project-title"><?php the_title(); ?></h3>
                        <div class="project-desc"><?php the_title(); ?></div>
                        <div class="project-more">more</div>
                        <!-- <div class="project-date"><?php the_field('project_date') ?></div> -->
                    </a>
                </div>

