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
                                <?php if(have_posts()):
                                      while(have_posts()):the_post();  
                                 ?>
                                <div class="blog-box wow fadeIn">
                                <?php the_content(); ?>
                                </div><!-- end blog-box -->

                                <hr class="invis">
                                        <?php endwhile; ?>
                                <?php else: echo "No Post here";
                                      endif;
                                  ?>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>

<?php get_footer(); ?>