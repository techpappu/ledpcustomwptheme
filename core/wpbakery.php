<?php
//print all catagoryes
function print_product_all_category(){
  $args = array(
  'taxonomy' => 'product_cat',
  'orderby' => 'name',
  'order'   => 'ASC'
  );
  $html='<div class="print_all_product_cat">';
  $cats = get_categories($args);
  foreach($cats as $cat) {
   $html.= '<div class="sinlgle_product_cat">'.$cat->name.'->ID:'.$cat->term_id.' </div> ';
  
  }
  $html.='</div>';
  return $html;
}                                            
//testing the shortcode
function mytesting($product_per_page,$product_cat,$background,$column){
?>
<div class="row" style="background:<?php echo $background; ?>">
  <?php
  $args = array(
  'post_type' => 'product',
  'posts_per_page' => $product_per_page,
  );
  if(!empty($product_cat)){
    $args = array(
  'post_type' => 'product',
  'posts_per_page' => $product_per_page,
  'tax_query' => array(
        array(
            'taxonomy' => 'product_cat',
            'terms' => explode(",",$product_cat),
            'operator' => 'IN',
        )
    ),
  );
  }
  $loop = new WP_Query( $args );
  if ( $loop->have_posts() ) {
  while ( $loop->have_posts() ) : $loop->the_post();
  $product = wc_get_product(get_the_ID() );
  $reguler_price=$product->get_regular_price();
  $sale_price= $product->get_sale_price();?>
  <div class="col-md-<?php if($column==3){echo 4;}else{echo 3; }  ?>   col-sm-6 col-6 ourcustomgrid">
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


function myproduct( $atts = array() ) {
  
    // set up default parameters
    extract(shortcode_atts(array(
      'product_per_pages'     =>'',
      'category'              =>'',
      'background_color'      =>'#fff',
      'column_number'         =>3,
    ), $atts));
    
    return mytesting($product_per_pages,$category,$background_color,$column_number);
}
add_shortcode('woodmart_categories', 'myproduct');


if(function_exists('vc_map')){
  add_action( 'vc_before_init', 'your_name_integrateWithVC' );
function your_name_integrateWithVC() {
 vc_map( array(
  "name" => __( "Woocoomerce product Grid", "my-text-domain" ),
  "base" => 'woodmart_categories',
  "class" => "",
  'admin_enqueue_css'=>get_template_directory_uri().'/css/admin_wp_css.css',
  "category" => __( "Mythemes", "my-text-domain"),
  "params" => array(
       array(
        "type" => "textfield",
        "heading" => __( "number of product to show in grid", "my-text-domain" ),
        "param_name" => "product_per_pages",
        "value" =>'12',
        "description" => __( "Set the number of post you want to show in grid", "my-text-domain" )
       ),
       array(
        "type" => "textfield",
        "class" => "",
        "heading" => __( "Enter the Product category ID here", "my-text-domain" ),
        "param_name" => "category",
        "value" => __( null, "my-text-domain" ),
        "description" => __( "Print multi category separate ID with a (,) comma.To bring post from all catagories leave it blank. Here are all category with ID:".print_product_all_category()."", "my-text-domain" )
        ),
       array(
        "type" => "colorpicker",
        "class" => "",
        "heading" => __( "Select background color of the grid", "my-text-domain" ),
        "param_name" => "background_color",
        "value" => __( "#fff", "my-text-domain" ),
        "heading" => __( "Select background color of the grid", "my-text-domain" ),
        "description" => __( "", "my-text-domain" )
        ),
       array(
        "type" => "dropdown",
        "class" => "",
        "heading" => __( "select column", "my-text-domain" ),
        "param_name" => "column_number",
        "value" => array(3,4),
        "heading" => __( "select column", "my-text-domain" ),
        "description" => __( "select column in grid you want to show", "my-text-domain" )
        ),



  )
 ) );
}
}