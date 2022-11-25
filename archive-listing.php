<?php
get_header();
?>

<?php

$args = array(
  'post_type' => 'listing ',
  'post_status' => 'publish',
	'date_query' => array(
		array(
			'before_year'  => 2022,
			'before_month' => 11,
			'before_day'   => 14,
		),
	),
);
    $loop = new WP_Query( $args );

    while ( $loop->have_posts() ) : $loop->the_post();
    $post_id = get_the_ID();

    $url = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'medium', true );
    ?>
    <?php   echo "<br><br>";?>
         <img src="<?php echo $url[0]; ?>" width="<?php echo $url[1]; ?>" height="<?php echo $url[2]; ?>" />
         <?php   echo "<br>";?>
         <a href="<?php echo get_permalink(); ?>"><h4><b><?php echo get_the_title();?></b></h4></a>
    <?php
            
        echo  get_the_content();
      echo "<br>"; ?>
      <ul>
         <li><strong>Author: </strong><?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_author', true ) ); ?></li>
         <li><strong>Published Date: </strong><?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_published_date', true ) ); ?></li>
         <li><strong>Price: </strong><?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_price', true ) ); ?></li>
       </ul>
       <?php
  endwhile; ?>


<?php
get_footer();
?>