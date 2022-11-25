
<?php
get_header();
// */ Template Name: custom-posts */
?>
<?php
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array(
    'post_type' => 'listing ',
    'post_status' => 'publish',
        'posts_per_page' => 4,
                'paged'  => $paged,
            'date_query' => array(
                array(            // Prints the day, date, month, year, time, AM or PM
                    'before' => date("l jS  F Y") ,
                    
                )
            ),
        );
        
    $loop = new WP_Query($args);
 
if($loop->have_posts()):
    while($loop->have_posts()):
        $loop->the_post();
     
        the_post_thumbnail('thumbnail');
      
        ?>
          
        <a href="<?php echo get_permalink(); ?>"><h5><?php echo get_the_title();?></a></h5>
      <?php  
          echo "<br>";
        echo  get_the_excerpt();
        echo "<br>";
    
      ?>

      <!-- Custom Fields --> 

      <ul>
          <li><strong>Author: </strong><?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_author', true ) ); ?></li>
          <li><strong>Published Date: </strong><?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_published_date', true ) ); ?></li>
          <li><strong>Price: </strong><?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_price', true ) ); ?></li>
      </ul>
      </div>
      <?php  
    endwhile;
endif?>

<!-- Pagination -->

<?php

echo paginate_links( array(
	'base' => get_pagenum_link(1) . '%_%',
    'format' => '/page/%#%', //for replacing the page number
    'type' => 'row', //format of the returned value
    'total' => $loop->max_num_pages,
	
) );
?>

<?php
 
get_footer();
?>