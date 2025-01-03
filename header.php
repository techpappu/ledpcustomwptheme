<!DOCTYPE html>
<html <?php language_attributes(); ?>>
     <?php $options = get_option( 'markmedia' ); 
        $header_logo=$options['header-logo'];
        $header_favicon=$options['header-favicon'];
    ?>
    <!-- Basic -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Site Metas -->
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- Site Icons -->
    <link rel="shortcut icon" href="<?php echo $header_favicon['url'] ?>" type="image/x-icon" />
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

    <div id="wrapper">
        <header class="market-header header">
            <div class="container-fluid">
                <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo home_url('/'); ?>"><img src="<?php echo $header_logo['url']; ?>" alt=""></a>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                      <?php
                            wp_nav_menu( array(
                                'theme_location'    => 'main-menu',
                                'menu_class'        => 'nav navbar-nav',
                                'walker'            => new WP_Bootstrap_Navwalker(),
                            ) );
                          ?>
                         <?php if($options['search-form']): ?>
                        <?php get_search_form(); ?>
                        <?php endif; ?>
                        <div class="woo-toolkits form-inline">
                                <?php if(is_user_logged_in()): ?>
                                <a href="<?php the_permalink(get_option( 'woocommerce_myaccount_page_id')); ?>" class="btn-primary">My Account</a>
                                <a href="<?php echo wp_logout_url(get_permalink(get_option( 'woocommerce_myaccount_page_id'))); ?>" class="btn-danger">Log Out</a>
                                <?php else: ?>
                                <a href="<?php the_permalink(get_option( 'woocommerce_myaccount_page_id')); ?>" class="btn-danger">Login/Register</a>
                                
                            <?php endif; ?>
                                <div class="total_cart_item">
                                    <a href="<?php echo wc_get_cart_url(); ?>" class="btn-primary our_custom_cart"><i class="fa fa-shopping-bag"><span class="cart_item_cout">
                                        <?php echo WC()->cart->get_cart_contents_count(); ?>
                                    </span></i> 
                                    <span class="cart_total_amount">
                                        <?php echo WC()->cart->get_cart_total(); ?>
                                    </span>
                                </a>
                                    <div class="hide-cart">
                                         <?php dynamic_sidebar('total_cart'); ?>
                                    </div>
                               </div>
                        </div>
                    </div>
                </nav>
            </div><!-- end container-fluid -->
        </header><!-- end market-header -->