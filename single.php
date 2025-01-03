<?php get_header(); ?>
        <section class="section lb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                        <div class="page-wrapper">
                            <?php if(have_posts()):
                                    while (have_posts()):the_post();
                                 ?>
                            <div class="blog-title-area">
                                <ol class="breadcrumb hidden-xs-down">
                                    <li class="breadcrumb-item"><a href="<?php echo home_url(); ?>">Home</a></li>
                                    <li class="breadcrumb-item"><?php the_category(','); ?></li>
                                    <li class="breadcrumb-item active"><?php the_title(); ?></li>
                                </ol>

                                <span class="color-yellow"><?php the_category(','); ?></span>

                                <h3><?php the_title(); ?></h3>

                                <div class="blog-meta big-meta">
                                    <small><?php the_time('j F, Y'); ?></small>
                                    <small><?php the_author_posts_link(); ?></small>
                                    <small><a href="#" title=""><i class="fa fa-eye"></i> 2344</a></small>
                                </div><!-- end meta -->

                                <div class="post-sharing">
                                    <ul class="list-inline">
                                        <li><?php echo do_shortcode('[DISPLAY_ULTIMATE_SOCIAL_ICONS]'); ?></li>
                                    </ul>
                                </div><!-- end post-sharing -->
                            </div><!-- end title -->

                            <div class="single-post-media">
                                <img src="<?php the_post_thumbnail_url(); ?>" alt="" class="img-fluid">
                            </div><!-- end media -->
                            <div class="blog-content">
                                <?php the_content(); ?>
                            </div><!-- end content -->

                            <div class="blog-title-area">
                                <div class="tag-cloud-single">
                                    <span>Tags</span>
                                    <?php the_tags('<small>',' ' ,'</small>') ?>
                                </div><!-- end meta -->

                                <div class="post-sharing">
                                    <ul class="list-inline">
                                        <li><?php echo do_shortcode('[DISPLAY_ULTIMATE_SOCIAL_ICONS]'); ?></li>
                                    </ul>
                                </div><!-- end post-sharing -->
                            </div><!-- end title -->
                            <?php $current_post_ID=$post->ID; ?>
                        <?php endwhile;
                                endif; 
                                ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="banner-spot clearfix">
                                        <div class="banner-img">
                                            <img src="upload/banner_01.jpg" alt="" class="img-fluid">
                                        </div><!-- end banner-img -->
                                    </div><!-- end banner -->
                                </div><!-- end col -->
                            </div><!-- end row -->

                            <hr class="invis1">

                            <div class="custombox authorbox clearfix">
                                 <?php $Author_id= get_the_author_meta('ID');?>
                                <h4 class="small-title">About author</h4>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                        <?php
                                            $args=array(
                                                'force_default' =>get_template_directory_uri().'/upload/author.jpg',
                                                'class' => 'img-fluid rounded-circle',
                                            );
                                         echo get_avatar( $Author_id, '', '', '', $args ); ?>
                                    </div><!-- end col -->

                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                        <h4><a href="<?php echo get_author_posts_url($Author_id); ?>"><?php echo get_the_author_meta( 'display_name'); ?></a></h4>
                                        <p><?php echo get_the_author_meta( 'description', $Author_id ); ?></p>
                                    </div><!-- end col -->
                                </div><!-- end row -->
                            </div><!-- end author-box -->

                            <hr class="invis1">

                            <div class="custombox clearfix">
                                <h4 class="small-title">You may also like</h4>
                                <div class="row">
                                    <?php 
                                    $post_from_author=array(
                                        'post_type' =>'post',
                                        'author'    =>$Author_id,
                                        'posts_per_page' =>2,
                                        'post__not_in' => array($current_post_ID),
                                        'sort' => 'DESC',
                                        'orderby'    => 'rand'

                                    );
                                    $author_posts=new WP_Query($post_from_author);
                                    if($author_posts->have_posts()):
                                        while ($author_posts->have_posts()):$author_posts->the_post();
                                     ?>
                                    <div class="col-lg-6">
                                        <div class="blog-box">
                                            <div class="post-media">
                                                <a href="marketing-single.html" title="">
                                                    <img src="<?php the_post_thumbnail_url('single-author-img'); ?>" alt="" class="img-fluid">
                                                    <div class="hovereffect">
                                                        <span class=""></span>
                                                    </div><!-- end hover -->
                                                </a>
                                            </div><!-- end media -->
                                            <div class="blog-meta">
                                                <h4><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h4>
                                                <small><?php the_category(', '); ?></small>
                                                <small><?php the_time('j F, Y'); ?></small>
                                            </div><!-- end meta -->
                                        </div><!-- end blog-box -->
                                    </div><!-- end col -->
                                <?php endwhile;
                                    endif;
                                    wp_reset_postdata();
                                     ?>
                                </div><!-- end row -->
                            </div><!-- end custom-box -->
                            <!-- start comment area -->
                     <?php comments_template(); ?>
                            <!-- end comment area -->
                        </div><!-- end page-wrapper -->
                    </div><!-- end col -->

                    <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                        <?php get_sidebar(); ?>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </section>
<?php get_footer(); ?>