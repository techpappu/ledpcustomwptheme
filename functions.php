<?php 
global $current_post_ID;
	function myBlog_Scripts(){
			 //Design google fonts
        wp_register_style('google-fonts','https://fonts.googleapis.com/css?family=Roboto+Slab:400,700');
        //Bootstrap core CSS
        wp_register_style('bootstrap-css',get_template_directory_uri().'/css/bootstrap.min.css',array(),NULL,NULL);
        // FontAwesome Icons core CSS
        wp_register_style('font-awesome-css',get_template_directory_uri().'/css/font-awesome.min.css',array(),NULL,NULL);
         //Custom styles for this template
         wp_register_style('style-css', get_template_directory_uri().'/style.css',array(),NULL,NULL);
        //Animate styles for this template 
        wp_register_style('animate-css',get_template_directory_uri().'/css/animate.min.css',array(),NULL,NULL);
        //Responsive styles for this template
        wp_register_style('responsive-css',get_template_directory_uri().'/css/responsive.css',array(),NULL,NULL);
        //Colors for this template
        wp_register_style('colors-css',get_template_directory_uri().'/css/colors.css',array(),NULL,NULL);
        //Version Marketing CSS for this template
        wp_register_style('version-css',get_template_directory_uri().'/css/version/marketing.css',array(),NULL,NULL);


			
        //wp enqueue  style
      wp_enqueue_style('google-fonts');
      wp_enqueue_style('bootstrap-css');
      wp_enqueue_style('font-awesome-css');
      wp_enqueue_style('style-css');
      wp_enqueue_style('animate-css');
      wp_enqueue_style('responsive-css');
      wp_enqueue_style('colors-css');
      wp_enqueue_style('version-css');


    //wp register scripts

        //tether js
        wp_register_script('tether-js', get_template_directory_uri().'/js/tether.min.js',array('jquery'),NULL,true);
        //bootstrap js
      wp_register_script('bootstrap-js', get_template_directory_uri().'/js/bootstrap.min.js',array('jquery'),NULL,true);
      //amimate js
      wp_register_script('animate-js', get_template_directory_uri().'/js/animate.js',array('jquery'),NULL,true);
      //my custom js
      wp_register_script('custom-js', get_template_directory_uri().'/js/custom.js',array('jquery'),NULL,true);


     //wp enqueue scripts
      wp_enqueue_script( 'jquery');
      wp_enqueue_script('tether-js');
      wp_enqueue_script('bootstrap-js');
      wp_enqueue_script('animate-js');
      wp_enqueue_script('custom-js');


	}
	add_action( 'wp_enqueue_scripts','myBlog_Scripts' );

	require_once('class-wp-bootstrap-navwalker.php');

	function myBlog(){
		register_nav_menus( array(
			'main-menu' =>  'Header Menu',
			'footer-menu'=> 'Footer Menu',

		) );


	}
	add_action('init','myBlog');



  //theme supports 

  function themeSupports(){
    add_theme_support('post-thumbnails');
    add_theme_support( 'title-tag');
    add_image_size( 'single-author-img',270, 170);
  }
  add_action( 'after_setup_theme', 'themeSupports');




  function ourwidgets(){
  	register_sidebar( array( 
        
        'name'           => __( 'primary sidebar','myBlog'),
        'id'             => 'primary-widget',
        'description'    => 'must use 3 widgets',
        'before_widget'  => '<div class="widget">',
        'before_title'   => '<h2 class="widget-title">',
        'after_title'    => '</h2><div class="blog-list-widget"><div class="list-group">',
        'after_widget'   => '</div></div></div>',
  		 ) );
    register_sidebar( array( 
        
        'name'           => __( 'primary woocommerce sidebar','myBlog'),
        'id'             => 'woo-widget',
        'description'    => 'use widgets',
        'before_widget'  => '<div id="%1$s" class="widget %2$s">',
        'before_title'   => '<h2 class="widget-title">',
        'after_title'    => '</h2><div class="blog-list-widget"><div class="list-group">',
        'after_widget'   => '</div></div></div>',
       ) );
    register_sidebar( array( 
        
        'name'           => __( 'cart for menu sidebar','myBlog'),
        'id'             => 'total_cart',
        'description'    => 'use widgets',
        'before_widget'  => '<div id="%1$s" class="menu_cart %2$s">',
        'after_widget'   => '</div>',
       ) );
  }
add_action( 'widgets_init', 'ourwidgets');



 function wpb_move_comment_field_to_bottom( $fields ) {
      $comment_field = $fields['comment'];
      unset( $fields['comment'] );
      $fields['comment'] = $comment_field;
      return $fields;
      }
add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom');


require get_template_directory() . '/inc/comment-helper.php';
require_once get_theme_file_path() .'/inc/codestar-framework-master/codestar-framework.php';
require_once get_theme_file_path() .'/inc/theme-options.php';


function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 150,
        'single_image_width'    => 300,

        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 3,
            'max_rows'        => 3,
            'default_columns' => 3,
            'min_columns'     => 3,
            'max_columns'     => 3,
        ),
    ) );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}

add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );


/**
 * Show cart contents / total Ajax
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
  global $woocommerce;

  ob_start();

  ?>
        <a href="<?php echo wc_get_cart_url(); ?>" class="btn-primary our_custom_cart"><i class="fa fa-shopping-bag"><span class="cart_item_cout">
          <?php echo WC()->cart->get_cart_contents_count(); ?>
        </span></i>
        <span class="cart_total_amount">
          <?php echo WC()->cart->get_cart_total(); ?>
        </span>
        </a>
  <?php
  $fragments['a.our_custom_cart'] = ob_get_clean();
  return $fragments;
}




function WP_themes_login() {
  if(is_user_logged_in()):
    $html='
    <div class="mycustomcode">
      <i aria-hidden="true" class="far fa-address-card"></i>
      <a href="'.home_url( '/wp-admin').'">Dashboard</a>
    </div>';
  else:
    $html='
    <div class="mycustomcode">
      <i aria-hidden="true" class="far fa-address-card"></i>
      <a href="'.home_url( '/wp-admin').'">Login/Registration</a>
    </div>';
  endif;
     return $html;
}

add_shortcode( 'Login_link', 'WP_themes_login' );

function ournewsshortcode(){
  $html='
  <h1>this is testing for our shortcode</h1>
  ';
  return $html;

}
add_shortcode( 'tesing_shortocde','ournewsshortcode' );


function dotirating_function( $atts = array(),$content ) {
    // set up default parameters
    extract(shortcode_atts(array(
     'design' => 'info',
    ), $atts));
    
    return '<div class="alert alert-'.$design.'" role="alert" sytle="width:'.$width.'">
  '.$content.'</div>';
}
add_shortcode('print_alert', 'dotirating_function');
//testing

if(function_exists('vc_map')){
  add_action( 'vc_before_init', 'Our_new_wpbakery_El' );
function Our_new_wpbakery_El() {
 vc_map( array(
  "name" => __( "Print Alert", "my-text-domain" ),
  "base" => "print_alert",
  "category" => __( "Mythemes", "my-text-domain"),
  "params" => array(
       array(
        "type" => "textfield",
        "heading" => __( "write the type of alert box you want", "my-text-domain" ),
        "param_name" => "design",
        "value" => __( "info", "my-text-domain" ),
        "description" => __( "select priamry,success,denger,info one of those alert box", "my-text-domain" )
       ),
       array(
        "type" => "textarea_html",
        "heading" => __( "write the content in the box", "my-text-domain" ),
        "param_name" => "content",
        "value" => __( "This some demo text", "my-text-domain" ),
        "description" => __( "write content you want", "my-text-domain" )
       )
  )
 ) );
}
}


function prdocut_cat_function( $atts = array(),$content ) {
    // set up default parameters
    extract(shortcode_atts(array(
      'font_color' =>'#000',
      'font_weight' =>'500',
      'select_taxonomy' => 'category',

    ), $atts));
    $args = array(
      'taxonomy' => $select_taxonomy,
      'orderby' => 'name',
      'order'   => 'ASC'
      );
    $html='<div class="print_all_product_cat">';
    $cats = get_categories($args);
    foreach($cats as $cat) {
     $html.= '<div class="sinlgle_product_cat" style="color:'.$font_color.';font-weight:'.$font_weight.'">'.$cat->name.'->ID:'.$cat->term_id.' </div> ';
  
  }
  $html.='</div>';
  return $html;
}
add_shortcode('print_product_cat', 'prdocut_cat_function');

if(function_exists('vc_map')){
  add_action( 'vc_before_init', 'print_all_cat_function' );
function print_all_cat_function() {
 vc_map( array(
  "name" => __( "Print all Cat with ID", "my-text-domain" ),
  "base" => "print_product_cat",
  "category" => __( "Mythemes", "my-text-domain"),
  "params" => array(
       array(
        "type" => "dropdown",
        "heading" => __( "select the post type you want to print it's all category", "my-text-domain" ),
        "param_name" => "select_taxonomy",
        "value" => array(
    __( 'Blog Post Category',  "my-text-domain"  ) => 'category',
    __( 'Product Category',  "my-text-domain"  ) => 'product_cat',
  ),
        "description" => __( "selec to print all it's category", "my-text-domain" )
       ),
  )
 ) );
}
}

if (!function_exists('our_custom_grid')){
  function our_custom_grid($post_per_pages,$columns,$product_cat){
    ?>
<div class="row">
    <?php
    $args = array(
    'post_type' => 'product',
    'posts_per_page' => $post_per_pages,
    'tax_query' => array(
        array(
            'taxonomy'  => 'product_cat',
            'terms'     =>explode(",",$product_cat),
            'operator'  => 'IN',
        )
    ),
    );
    $loop = new WP_Query( $args );
    if ( $loop->have_posts() ) {
    while ( $loop->have_posts() ) : $loop->the_post();
    $product = wc_get_product(get_the_ID() );
    $reguler_price=$product->get_regular_price();
    $sale_price= $product->get_sale_price();
    ?>
<div class="col-md-<?php if($columns==3){echo 4;} else{echo 3;}  ?> col-sm-6 col-6 ourcustomgrid">
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

</div>
<?php
  }
}

function Our_custom_shorcode( $atts = array(),$content ) {
    // set up default parameters
    extract(shortcode_atts(array(
      'post_per_page' =>6,
      'grid_column'    =>3,
      'category'      =>'',

    ), $atts));
    
    return our_custom_grid($post_per_page,$grid_column,$category);
}
add_shortcode('MyFirst_custom_grid', 'Our_custom_shorcode');


if(function_exists('vc_map')){
  add_action( 'vc_before_init', 'our_product_grid' );
function our_product_grid() {
 vc_map( array(
  "name" => __( "Classic Grid for woo product", "my-text-domain" ),
  "base" => "MyFirst_custom_grid",
  "category" => __( "Mythemes", "my-text-domain"),
  "params" => array(
       array(
        "type" => "textfield",
        "heading" => __( "number of product", "my-text-domain" ),
        "param_name" => "post_per_page",
        "value" => __( "6", "my-text-domain" ),
        "description" => __( "type the number you want to print in the grid", "my-text-domain" )
       ),
        array(
        "type" => "dropdown",
        "heading" => __( "select the number of column", "my-text-domain" ),
        "param_name" => "grid_column",
        "value" => array(
    __( 'column 3',  "my-text-domain"  ) => 3,
    __( 'column 4',  "my-text-domain"  ) => 4,
  ),
        "description" => __( "select the number of column", "my-text-domain" )
       ),
        array(
        "type" => "textfield",
        "heading" => __( "Enter the category ID", "my-text-domain" ),
        "param_name" => "category",
        "value" => __( "", "my-text-domain" ),
        "description" => __( "type category ID here and separeted by comma (,). all available category:".do_shortcode('[print_product_cat select_taxonomy="product_cat"]')."", "my-text-domain" )
       ),
  )
 ) );
}
}
//show count number of processing order in queue.
add_action( 'woocommerce_single_product_summary', 'pappupc_func_orderInqueue', 8 );
  
function pappupc_func_orderInqueue() {
   global $product;
    
   // GET LAST WEEK ORDERS
   $all_orders = wc_get_orders(
      array(
         'limit' => -1,
         'status' => 'wc-processing',
         //'date_after' => date( 'Y-m-d', strtotime( '-1 week' ) ),
         'return' => 'ids',
      )
   );
     
   // LOOP THROUGH ORDERS AND SUM QUANTITIES PURCHASED
   $count = 0;
   foreach ( $all_orders as $all_order ) {
      $order = wc_get_order( $all_order );
      $items = $order->get_items();
      foreach ( $items as $item ) {
         $product_id = $item->get_product_id();
         if ( $product_id == $product->get_id() ) {
            $count = $count + absint( $item['qty'] ); 
         }
      }
   }
    
   if ( $count > 0 ) echo '<p class="numberOrderInQueue">'.$count.' Orders in queue</p>';
}

/**
 * ------------------------------------------------------------------------------------------------
 * Enqueue style for justify
 * ------------------------------------------------------------------------------------------------
 */

function myTheme_style(){
    
    
   
    wp_register_style('justifiedGallery',get_template_directory_uri().'/css/my/justifiedGallery.min.css',array(),'1.0');


    wp_register_script( 'justifiedGalleryjs',get_template_directory_uri().'/js/my/jquery.justifiedGallery.min.js', array('jquery'), '1.0.0',true );

    
    wp_enqueue_style('justifiedGallery');

    //script
    wp_enqueue_script( 'justifiedGalleryjs');
}
add_action('wp_enqueue_scripts','myTheme_style');