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
                        <div class="sidebar">
                            <?php dynamic_sidebar('woo-widget'); ?>
                        </div>
                    </div><!-- end col -->
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                            <div class="blog-custom-build woocommerce">
                                <?php if(is_shop()): ?>
                                <div class="row">
                                    <?php
                                        $args = array(
                                            'post_type' => 'product',
                                            'posts_per_page' => 12
                                            );
                                        $loop = new WP_Query( $args );
                                        if ( $loop->have_posts() ) {
                                            while ( $loop->have_posts() ) : $loop->the_post();?>
                                                <?php $product = wc_get_product( get_the_ID() );

                                                $reguler_price=$product->get_regular_price();
                                                $sale_price= $product->get_sale_price();
                                                ?>
                                    <div class=" col-md-4 col-sm-6 col-6 woo-single-grid">
                                        <div class="card" >
                                            <a href="<?php the_permalink(); ?>">
                                          <img src="<?php the_post_thumbnail_url(); ?>" class="card-img-top">
                                          <?php if(!empty($sale_price)): ?>
                                          <span class="sale_circle">Sale!</span>
                                            <?php endif; ?>
                                          <div class="card-body">
                                            <h5 class="card-title"><?php the_title(); ?></h5>
                                            <p class="card-text"><?php echo $product->get_price_html(); ?>
                                                
                                                <?php
                                                    if(!empty($sale_price)):
                                                        $yousave=$reguler_price-$sale_price;
                                                        $yousave=(100/$reguler_price)*$yousave;
                                                        echo '<span class="yousave"> you save: '.number_format($yousave, 2).'%<span>';
                                                    endif;
                                                 ?>
                                            </p>
                                            </a>
                                            <?php echo do_shortcode( '[add_to_cart id="'.get_the_ID().'" class="myAddToCart" show_price="false" style=""]'); ?>
                                          </div>
                                        </div>
                                    </div>
                                    <?php endwhile;
                                        } else {
                                            echo __( 'No products found' );
                                        }
                                        wp_reset_postdata();
                                    ?>
                                <?php endif; ?>

                                </div> 
                                <?php woocommerce_content(); ?>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>

<?php get_footer(); ?>