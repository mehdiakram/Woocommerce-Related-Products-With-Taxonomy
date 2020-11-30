<?php

// fetch taxonomy terms for current product
$productterms = get_the_terms( get_the_ID(), 'product_cat'  );
if( $productterms ) {            
    $producttermnames[] = 0;                    
    foreach( $productterms as $productterm ) {         
        $producttermnames[] = $productterm->name;  
    }
     
                 
    // set up the query arguments
    $args = array (
        'post_type' => 'product',
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $producttermnames,
            ),
        ),
    );
     
    // run the query
    $query = new WP_Query( $args ); 
    if( $query->have_posts() ) { ?>
        <section class="product-related-posts">
        <?php echo '<h2>Related Posts</h2>'; ?>
            <ul class="product-posts">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li> 
                <?php endwhile; ?> 
                <?php wp_reset_postdata(); ?>
            </ul>   
        </section> 
    <?php }
}
         
