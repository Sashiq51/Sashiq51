<?php
 get_header();
$args = array(
  'post_type' => 'listing ',
  'post_status' => 'publish',
  'posts_per_page' => 4,
  'orderby' => 'title',
  'order' => 'DSC',
);
 
// The Query
$the_query = new WP_Query( $args );

   
$post_id = get_the_ID();
  $url = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'large', true );
 
      
  ?>
  <h3><?php  echo get_the_title();
       echo "<br> ";
    ?></h3>
  <img src="<?php echo $url[0]; ?>" width="<?php echo $url[1]; ?>" height="<?php echo $url[2]; ?>" />
     
     <?php
    echo "<br> ";
       echo  get_the_content();
    ?>

  <ul>
  <li><strong>Author: </strong><?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_author', true ) ); ?></li>
  <li><strong>Published Date: </strong><?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_published_date', true ) ); ?></li>
  <li><strong>Price: </strong><?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_price', true ) ); ?></li>
</ul>

  <?php get_footer(); ?>