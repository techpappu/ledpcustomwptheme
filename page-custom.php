<?php get_header(); ?>
        <div class="page-title db">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <h2><?php wp_title(''); ?></h2>
                    </div><!-- end col -->
                    <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                        <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
                                <li class="breadcrumb-item active">pages</li>
                            <li class="breadcrumb-item active"><?php wp_title(''); ?></li>
                        </ol>
                    </div><!-- end col -->                    
                </div><!-- end row -->
            </div><!-- end container -->
        </div><!-- end page-title -->


        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <?php get_sidebar(); ?>
                    </div><!-- end col -->
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                            <div class="blog-custom-build">
                                <div class="row">
                                <?php
                                    $args = array(
                                        'post_type' => 'product',
                                        'posts_per_page' => 12
                                        );
                                    $myvar=0;
                                    $loop = new WP_Query( $args );
                                    if ( $loop->have_posts() ) {
                                    while ( $loop->have_posts() ) : $loop->the_post();
                                        $product = wc_get_product(get_the_ID() );
                                        $reguler_price=$product->get_regular_price();
                                        $sale_price= $product->get_sale_price();
                                        $myvar++;
                                        ?>
                                    <div class="col-md-4 col-sm-6 col-6 ourcustomgrid">
                                        <div class="card">
                                            <a href="<?php the_permalink(); ?>">
                                              <img src="<?php the_post_thumbnail_url(); ?>" class="card-img-top" alt="...">
                                              <?php if(!empty($sale_price)): ?>
                                              <span class="sale_price">Sale!</span>
                                              <span class="yousave2">
                                                <?php $per=$reguler_price-$sale_price; 
                                                    $per=(100/$reguler_price)*$per;
                                                    echo '-'.number_format($per,1).'%';
                                                ?>
                                                 
                                              </span>
                                          <?php endif; ?>
                                              <div class="card-body">
                                                <h5 class="card-title"><?php the_title(); ?></h5>
                                            </a>
                                            <p class="card-text"><?php echo $product->get_price_html(); ?></p>
                                            <?php echo do_shortcode( '[add_to_cart class="ourcart" style="" show_price="false" id="'.get_the_ID().'"]'); ?>
                                          </div>
                                        </div>
                                    </div>
                                    
                                        <?php endwhile;
                                            } else {
                                                echo __( 'No products found' );
                                            }
                                            wp_reset_postdata(); ?>
                                            <?php
                                                   $args = array(
                                                               'taxonomy' => 'product_cat',
                                                               'orderby' => 'name',
                                                               'order'   => 'ASC'
                                                           );

                                                   $cats = get_categories($args);

                                                   foreach($cats as $cat) {
                                                ?>
                                                      <a href="<?php echo get_category_link( $cat->term_id ) ?>">
                                                           <?php echo $cat->name.'->ID:'.$cat->term_id; ?>
                                                      </a>
                                                <?php
                                                   }
                                                ?>
                                            <div class="row">
                                                <div class="col">
                                                <?php echo do_shortcode( '[sale_products limit="6" columns="3"]'); ?>
                                                </div>
                                            </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>

<?php get_footer(); ?>