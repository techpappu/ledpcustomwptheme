<?php 
	/*
	 template name:home
	*/

 ?>
 <?php get_header(); ?>
 <?php if(is_front_page() and !is_paged() ): ?>
        <section id="cta" class="section" style="background-image: url(<?php the_field('slide_background'); ?>)">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 align-self-center">
                        <h2><?php the_field('home_title'); ?></h2>
                        <p class="lead">
                           <?php the_field('home_text'); ?>
                           
                        </p>
                        <a href="<?php  the_field('link_url');?>" class="btn btn-primary">Try for free</a>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                            <div class="blog-custom-build">
                                <?php
                                 $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; 
                                    $args = array(
                                        'post_type' => 'post',
                                        'paged' => $paged
                                    );
                                    $query = new WP_Query( $args );
                                    $temp_query = $wp_query;
                                    $wp_query = null;
                                    $wp_query = $query;

                                 ?>
                                <?php if($query->have_posts()):
                                      while($query->have_posts()): $query->the_post();  
                                 ?>
                                <div class="blog-box wow fadeIn">
                                    <div class="post-media">
                                        <a href="<?php the_permalink(); ?>" title="">
                                            <img src="<?php the_post_thumbnail_url(); ?>" alt="" class="img-fluid">
                                            <div class="hovereffect">
                                                <span></span>
                                            </div>
                                            <!-- end hover -->
                                        </a>
                                    </div>
                                    <!-- end media -->
                                    <div class="blog-meta big-meta text-center">
                                        <div class="post-sharing">
                                            <ul class="list-inline">
                                                <li> <?php echo do_shortcode('[DISPLAY_ULTIMATE_SOCIAL_ICONS]'); ?>
                                                    
                                                </li>
                                            </ul>
                                        </div><!-- end post-sharing -->
                                        <h4><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h4>
                                        <p>
                                            <?php echo wp_trim_words(get_the_content(),30); ?>
                                        </p>
                                        <small>
                                           <?php the_category( ', ' ); ?>  
                                        </small>
                                        <small><?php the_time('j F, Y'); ?></small>
                                        <small><a href="#" title="">by </a>
                                            <?php the_author_posts_link(); ?></small>
                                        <small><a href="#" title=""><i class="fa fa-eye"></i> 2291</a></small>
                                    </div><!-- end meta -->
                                </div><!-- end blog-box -->

                                <hr class="invis">
                                        <?php endwhile; ?>
                                <?php else: echo "No Post here";
                                      endif; 
                                      wp_reset_postdata(); 
                                  ?>
                            </div>
                        </div>

                        <hr class="invis">

                        <div class="row">
                            <div class="col-md-12">
                                <nav aria-label="Page navigation">
                                    <div class="pagination justify-content-center">
                                        <?php echo paginate_links(array(
                                        'total' => $query->max_num_pages,
                                        'type'  =>'list'
                                             )); ?>
                                         <?php 
                                        $wp_query = NULL;
                                        $wp_query = $temp_query;
                                          ?>
                                    </div>
                                </nav>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end col -->

                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <?php get_sidebar(); ?>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>

<?php get_footer(); ?>