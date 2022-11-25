
<div class="hcf_box">
    <style scoped>
        .hcf_box{
            display: grid;
            grid-template-columns: max-content 1fr;
            grid-row-gap: 10px;
            grid-column-gap: 20px;
        }
        .hcf_field{
            display: contents;
        }
    </style>
    <p class="meta-options hcf_field">
        <label for="hcf_author">Author</label>
        <input id="hcf_author"
            type="text"
            name="hcf_author"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_author', true ) ); ?>">
    </p>
    <p class="meta-options hcf_field">
        <label for="hcf_published_date">Published Date</label>
        <input id="hcf_published_date"
            type="date"
            name="hcf_published_date"
           value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_published_date', true ) ); ?>">
    </p>
    <p class="meta-options hcf_field">
        <label for="hcf_price">Price</label>
        <input id="hcf_price"
            type="number"
            name="hcf_price"
            value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'hcf_price', true ) ); ?>">
    </p>
</div>
<?php
// function search_shortcode(){

// $search='
// <form method="post">
// <label for="site-search">Search the site:</label>
// <input type="text" id="search" name="search">
// <select name="cntry" id="cntry">
//     <option value="0">Pakistan</option>
//     <option value="1">India</option>
//     <option value="2">China</option>
//     <option value="3">Afganistan</option>
// </select>
// <input type="submit" id="submit" name="submit" value="submit"></form>'
// ;
// return $search;

// }
// add_shortcode('search', 'search_shortcode');
