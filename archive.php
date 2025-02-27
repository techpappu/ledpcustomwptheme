<?php get_header(); ?>
        <div class="page-title db">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                         <?php if(have_posts()):?>
                        <h2>
                            <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

                <?php /* If this is a category archive */ if (is_category()) { ?>

                    <?php _e('Archive For'); ?> '<?php echo single_cat_title(); ?>' <?php _e('Category'); ?>                                    

                <?php /* If this is a tag archive */  } elseif( is_tag() ) { ?>

                    <?php _e('Archive For'); ?> <?php single_tag_title(); ?> <?php _e('Tag'); ?>

                <?php /* If this is a daily archive */ } elseif (is_day()) { ?>

                    <?php _e(' Archive For '); ?> <?php the_time('F jS, Y'); ?>                                        

                <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>

                    <?php _e('Archive For'); ?> <?php the_time('F, Y'); ?>                                    

                <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>

                    <?php _e('Archive For'); ?> <?php the_time('Y'); ?>                                        

                <?php /* If this is a search */ } elseif (is_search()) { ?>

                    <?php _e('Search Results'); ?>                            

                <?php /* If this is an author archive */ } elseif (is_author()) { ?>

                    <?php _e('Author Archive For'); ?> '<?php echo get_the_author(); ?>' 
                <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>

                    <?php _e('Blog Archives'); ?>                                        

        <?php } ?>
                        
                </h2>
            <?php endif; ?>
                    </div><!-- end col -->
                    <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
                            <li class="breadcrumb-item active">Blog</li>
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
                                <?php if(have_posts()):
                                      while(have_posts()):the_post();  
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
                                  ?>
                            </div>
                        </div>

                        <hr class="invis">

                        <div class="row">
                            <div class="col-md-12">
                                <nav aria-label="Page navigation">
                                    <div class="pagination justify-content-center">
                                        <?php echo paginate_links(array(
                                        'type'  =>'list'
                                             )); ?>
                                    </div>
                                </nav>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>

<?php get_footer(); ?>