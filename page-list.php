
<?php
get_header();
// */ Template Name: page-list */
    $args = array(
        'post_type' => 'listing',
        'post_status' => 'publish',
        'posts_per_page' => 4,
        'orderby' => 'title',
        'order' => 'DSC',
    );

    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail' );


    $loop = new WP_Query( $args );

    while ( $loop->have_posts() ) : $loop->the_post();

    ?>
        <a href="<?php echo get_permalink(); ?>"><?php echo get_the_title();?></a>
      <?php
        echo "<br><br>";
        echo  get_the_excerpt();
      echo "<br><br>";
    endwhile;
    wp_reset_postdata();?>
    <div id="gridcontainer">
   <?php
$counter = 1; //start counter
  
$grids = 2; //Grids per row
  
global $query_string; //Need this to make pagination work
  
  
/*Setting up our custom query (In here we are setting it to show 12 posts per page and eliminate all sticky posts) */
query_posts($query_string . '&caller_get_posts=1&posts_per_page=12');
  
  
if(have_posts()) :  while(have_posts()) :  the_post(); 
?>
<?php
//Show the left hand side column
if($counter == 1) :
?>
            <div class="griditemleft">
                <div class="postimage">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo $featured_image; ?>></a>
                </div>
                <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            </div>
<?php
//Show the right hand side column
elseif($counter == $grids) :
?>
<div class="griditemright">
                <div class="postimage">
             
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo $featured_image; ?>></a>
                </div>
                <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            </div>
<div class="clear"></div>
<?php
$counter = 0;
endif;
?>
<?php
$counter++;
endwhile;
//Pagination can go here if you want it.
endif;
?>
</div>
<style>
  #gridcontainer{
     margin: 20px 0; 
     width: 100%; 
}
#gridcontainer h2 a{
     color: #77787a; 
     font-size: 13px;
}
#gridcontainer .griditemleft{
     float: left; 
     width: 278px; 
     margin: 0 40px 40px 0;
}
#gridcontainer .griditemright{
     float: left; 
     width: 278px;
}
#gridcontainer .postimage{
     margin: 0 0 10px 0;
}
</style>
    
    <div class="hcf_fields">
    <style scoped>
      .hcf_fields ul{
        display: grid;
        grid-template-columns: max-content 1fr;
        grid-column-gap:20px;
  
      }
      .hcf_fields li{
        display: content;
      }
  
    </style>
  <ul>
      <li><strong>Author: </strong><?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_author', true ) ); ?></li>
      <li><strong>Published Date: </strong><?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_published_date', true ) ); ?></li>
      <li><strong>Price: </strong><?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_price', true ) ); ?></li>
  </ul>
  </div>
  <?php
get_footer();
