<?php 
if( class_exists( 'CSF' ) ) {
	$prefix = 'markmedia';

	  CSF::createOptions( $prefix, array(
    'menu_title' => 'Mark Media Options',
    'menu_slug'  => 'markmedia',
    'framework_title' =>'MarkMedia framework <small>By Md. Saiduzzaman</small>',
    'menu_position' => 2,
  		) );
	   // Header Options
    CSF::createSection($prefix, array(
        'id' => 'header_options',
        'title' => 'Header Options',
        'icon' => 'fas fa-address-card'
    ));
    //header logo section
    CSF::createSection($prefix,array(
      'parent' => 'header_options',
       'title'  => 'header logo',
       'fields' =>array(
          array(
        'id'      => 'header-favicon',
        'type'    => 'media',
        'title'   => 'select favicon for you website',
        'subtitle'   => 'select image in ico format e.g favicon.ico',
        'default' =>array(
            'url' =>get_template_directory_uri().'/images/favicon.ico',
          ),

        ),
       ),
    ));
	   // header  section
  CSF::createSection( $prefix, array(
    'parent' => 'header_options',
    'title'  => 'header Section',
    'fields' => array(

      //
      // A text field
      array(
        'id'    	=> 'header-logo',
        'type'  	=> 'media',
        'title' 	=> 'Select your header logo',
        'library' 	=> 'image',
        'default'	=>array(
        		'url'	=>get_template_directory_uri().'/images/version/market-logo.png',
        	),

        ),

      array(
  		'id'    => 'search-form',
  		'type'  => 'switcher',
  		'title' => 'show Search in menu bar',
	     ),

      array(
  		'id'    => 'header-color',
  		'type'  => 'color',
  		'title' => 'Select the header color',
  		 'output'      => 'header.market-header nav',
  		 'output_mode' => 'background-color',
  		 'output_important' => true,
  		  'default' => '#f9ca27',
	),


        array(
  		'id'    => 'body-color',
  		'type'  => 'color',
  		'title' => 'Select the body color',
  		 'output'      => 'section.section',
  		 'output_mode' => 'background-color',
  		 'output_important' => true,
  		  'default' => '#ddd',
	),

    )
  ) );

  CSF::createSection($prefix,array(
  	'title' 	=>'Footer Section',
  	'fields'	=>array(

  		array(
  			'id' 	=> 'footer-text',
  			'type'	=> 'wp_editor',
  			'title'	=> 'footer copy right text'
  		),
  		array(
  		'id'    => 'footer-color',
  		'type'  => 'color',
  		'title' => 'Select the footer color',
  		 'output'      => 'footer.footer',
  		 'output_mode' => 'background-color',
  		 'output_important' => true,
  		  'default' => '#000000',
	),
  	) 

  ));
}