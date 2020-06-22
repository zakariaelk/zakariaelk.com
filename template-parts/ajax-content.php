<?php
/**
 * Template part for displaying posts
 *
 * @package WordPress
 * @subpackage daga
 */

session_start();

$image_id = get_post_thumbnail_id();

?>

<?php 

if($_SESSION['postCount'] % 2 != 0) {
    $postDirection = "r-side";
?>

<a href="<?php the_permalink(); ?>" class="project-item <?php echo $postDirection; ?>">
    <div class="project-visual">
        <div class="mask">
            <img src="<?php echo wp_get_attachment_image_url( $image_id, 'large' ) ?>"/>
        </div>        
    </div>
    <div class="project-txt">
        <div class="project-txt-content">
            <div class="title"><?php the_title() ;?></div>
            <div class="category"><?php the_field('project_category'); ?></div>
            <div class="desc"><?php the_excerpt(); ?></div>
            <div class="more-link">
                open
            </div>                                      
        </div>
    </div>
</a>


<?php 

} else {

    $postDirection = "l-side";

?>    

<a href="<?php the_permalink(); ?>" class="project-item <?php echo $postDirection; ?>">
    <div class="project-txt">
        <div class="project-txt-content">
            <div class="title"><?php the_title() ;?></div>
            <div class="category"><?php the_field('project_category'); ?></div>
            <div class="desc"><?php the_excerpt(); ?></div>
            <div class="more-link">
                open
            </div>                                      
        </div>
    </div>
    <div class="project-visual">
        <div class="mask">
            <img src="<?php echo wp_get_attachment_image_url( $image_id, 'large' ) ?>"/>
        </div>        
    </div>
</a>

<?php         
    }
?>

<!-- Post <?php echo $_SESSION['postCount']; ?> -->

