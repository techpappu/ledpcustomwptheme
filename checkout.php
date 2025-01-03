<?php
	/*
		template name:check out
	*/
 get_header(); ?>


        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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