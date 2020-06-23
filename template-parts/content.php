<?php
/**
 * Template part for displaying posts
 *
 * @package WordPress
 * @subpackage daga
 */

// session_start();
$firstCoverID = get_field('project_cover_1');
$secondCoverID = get_field('project_cover_2');

$postDirection = "";

if ($_SESSION['postCount'] % 2 == 0) {$postDirection = "inverted";}
?>

<div class='project-container <?php echo $postDirection; ?>'>
    <figure class='project-visual'>
        <a href='<?php the_permalink();?>'>
            <img class='img-1' src="<?php echo wp_get_attachment_image_url($firstCoverID, 'large') ?>"/>
            <img class='img-2' src="<?php echo wp_get_attachment_image_url($secondCoverID, 'large') ?>"/>
        </a>
    </figure>

    <div class='project-text'>
        <h3 class='project-title'><a href='<?php the_permalink();?>'><?php the_title();?></a></h3>        
        <div class="project-tags"><?php the_tags('#', ', #', '');?></div>
        <p class="desc"><?php the_field("project_intro");?></p>
        <a class='project-action' href='<?php the_permalink();?>'>learn more</a>
        
    </div>
</div>

