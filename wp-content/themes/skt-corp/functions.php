
<?php
/**
 * SKT Corp functions and definitions
 *
 * @package SKT Corp
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! function_exists( 'skt_corp_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function skt_corp_setup() {
	if ( ! isset( $content_width ) )
		$content_width = 680; /* pixels */

	load_theme_textdomain( 'skt-corp', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('woocommerce');
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_image_size('homepage-thumb',240,145,true);
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'skt-corp' ),
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => '#7ab040'
	) );
	add_editor_style( 'editor-style.css' );
}
endif; // skt_corp_setup
add_action( 'after_setup_theme', 'skt_corp_setup' );

function theme_options_panel(){
  //add_menu_page('Orders', 'List host orders', 'manage_options', 'theme-options', 'wps_theme_func');
  add_menu_page('List orders', 'List orders', 'manage_options', 'theme-options', 'wps_theme_func');
  add_submenu_page( 'theme-options', 'List host orders', 'List host orders', 'manage_options', 'theme-options', 'wps_theme_func');
 add_submenu_page( 'theme-options', 'List tour orders', 'List tour orders', 'manage_options', 'tour-orders', 'wps_theme_func_settings');
 add_submenu_page( 'theme-options', 'List house orders', 'List house order', 'manage_options', 'house-orders', 'wps_theme_func_faq');
}
add_action('admin_menu', 'theme_options_panel');

function wps_theme_func(){

	if (isset($_GET['order_host_id'])){
    global  $wpdb;
    $wpdb->delete( 'host_reg',array( 'id' => $_GET['order_host_id']) );
    }
                echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div>
                <h2>List host orders</h2></div>
				<style>
				table, th, td {
       border: 1px solid black;
       border-collapse: collapse;
      border-color: #ad9e9e;
       padding: 4px;
}
				</style>
				';
				global  $wpdb;
				echo '<table style="width:95%;margin-top:20px;"><thead>
				 <tr style="background:#738e96; color:#fff"><th>Name host</th><th>Email host</th><th>Phone host</th><th>Postalcode1</th><th>Postalcode2</th><th>Districts</th><th>Provincial</th><th>Address</th><th>Payed</th><th>money amount</th><th></th><tr></thead>';
				foreach( $wpdb->get_results("SELECT * FROM  host_reg") as $key => $row) {
					 echo '
					 <tr><td>'.$row->name_host.'</td><td>'
					 .$row->email_host.'</td><td>'
					 .$row->phone_host.'</td><td>'
					 .$row->code1_host.'</td><td>'
					 .$row->code2_host.'</td><td>'
					 .$row->quan_host.'</td><td>'
					 .$row->tinh_host.'</td><td>'
					 .$row->add_guest.'</td><td>'
					 .$row->status.'</td><td style="text-align:right">'
					 .$row->money_amount.'</td><td>'
					 .'<a href="?page=theme-options&order_host_id='.$row->id.'">Xóa</a></td><tr>';
				}
				echo '</table>';
// each column in your row will be accessible like this
//$my_column = $row->column_name;}
}
function wps_theme_func_settings(){

	if (isset($_GET['order_tour_id'])){
    global  $wpdb;
    $wpdb->delete( 'tour_reg',array( 'id' => $_GET['order_tour_id']) );
    }
                echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div>
                <h2>List tour orders</h2></div><style>
				table, th, td {
       border: 1px solid black;
       border-collapse: collapse;
      border-color: #ad9e9e;
       padding: 4px;
}
				</style>
				';
				global  $wpdb;
				echo '<table style="width:95%;margin-top:20px;"><thead>
				 <tr style="background:#738e96; color:#fff"><th>Name tour</th><th>Email tour</th><th>Phone tour</th><th>Postalcode1</th><th>Postalcode2</th><th>Districts</th><th>Provincial</th><th>Address</th><th>Payed</th><th>money amount</th><th></th><tr></thead>';
				foreach( $wpdb->get_results("SELECT * FROM  tour_reg") as $key => $row) {
					 echo '
					 <tr><td>'.$row->name_tour.'</td><td>'
					 .$row->mail_address.'</td><td>'
					 .$row->phone_number.'</td><td>'
					 .$row->zone1.'</td><td>'
					 .$row->zone2.'</td><td>'
					 .$row->quan_guest.'</td><td>'
					 .$row->tinh_guest.'</td><td>'
					 .$row->add_guest.'</td><td>'
					 .$row->status.'</td><td style="text-align:right">'
					 .$row->money_amount.'</td><td>'
					 .'<a href="?page=tour-orders&order_tour_id='.$row->id.'">Xóa</a></td><tr>';
				}
				echo '</table>';
}


function wps_theme_func_faq(){
	
		if (isset($_GET['order_house_id'])){
    global  $wpdb;
    $wpdb->delete( 'house_reg',array( 'id' => $_GET['order_house_id']) );
    }
                echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div>
                <h2>List house orders</h2></div><style>
				table, th, td {
       border: 1px solid black;
       border-collapse: collapse;
      border-color: #ad9e9e;
       padding: 4px;
}
				</style>
				';
				global  $wpdb;
				echo '<table style="width:95%;margin-top:20px;"><thead>
				 <tr style="background:#738e96; color:#fff"><th>Name house</th><th>Email house</th><th>Phone house</th><th>Postalcode1</th><th>Postalcode2</th><th>Districts</th><th>Provincial</th><th>Address</th><th>Payed</th><th>money amount</th><th></th><tr></thead>';
				foreach( $wpdb->get_results("SELECT * FROM  house_reg") as $key => $row) {
					 echo '
					 <tr><td>'.$row->name_house.'</td><td>'
					 .$row->mail_address.'</td><td>'
					 .$row->phone_number.'</td><td>'
					 .$row->zone1.'</td><td>'
					 .$row->zone1.'</td><td>'
					 .$row->quan_guest.'</td><td>'
					 .$row->tinh_guest.'</td><td>'
					 .$row->add_guest.'</td><td>'
					 .$row->status.'</td><td style="text-align:right">'
					 .$row->money_amount.'</td><td>'
					 .'<a href="?page=house-orders&order_house_id='.$row->id.'">Xóa</a></td><tr>';
				}
				echo '</table>';
}
function skt_corp_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'skt-corp' ),
		'description'   => __( 'Appears on blog page sidebar', 'skt-corp' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget 1', 'skt-corp' ),
		'description'   => __( 'Appears on footer of the page', 'skt-corp' ),
		'id'            => 'footer-1',
		'before_widget' => '',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget 2', 'skt-corp' ),
		'description'   => __( 'Appears on footer of the page', 'skt-corp' ),
		'id'            => 'footer-2',
		'before_widget' => '',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget 3', 'skt-corp' ),
		'description'   => __( 'Appears on footer of the page', 'skt-corp' ),
		'id'            => 'footer-3',
		'before_widget' => '',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
}
add_action( 'widgets_init', 'skt_corp_widgets_init' );

add_filter('widget_text', 'do_shortcode');

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
require_once dirname( __FILE__ ) . '/inc/options-framework.php';

// Loads options.php from child or parent theme
$optionsfile = locate_template( 'options.php' );
load_template( $optionsfile );

function skt_corp_font_url(){
		$font_url = '';
		
	/* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
	$open_sans = _x('on', 'Open Sans font:on or off', 'skt-corp');
	
	if('off' !== $open_sans){
		$font_families = 'Open Sans:400,600,700,800';
		}
		$query_args = array(
			'family'	=> $font_families,
		);
		$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	
		return $font_url;
	
	}

function skt_corp_scripts() {
	wp_enqueue_style('skt-corp-fonts', skt_corp_font_url(), array());
	wp_enqueue_style( 'skt_corp-basic-style', get_stylesheet_uri() );
	wp_enqueue_style( 'skt_corp-editor-style', get_template_directory_uri()."/editor-style.css" );
	wp_enqueue_style( 'skt_corp-nivoslider-style', get_template_directory_uri()."/css/nivo-slider.css" );	
	wp_enqueue_style( 'skt_corp-base-style', get_template_directory_uri()."/css/style_base.css" );
	wp_enqueue_style('skt-corp-responsive', get_template_directory_uri().'/css/responsive.css');
	wp_enqueue_style( 'skt_corp-icomoon-style', get_template_directory_uri()."/css/icomoon.css" );
	wp_enqueue_script( 'skt_corp-nivo-script', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery') );
	wp_enqueue_script( 'skt_corp-custom_js', get_template_directory_uri() . '/js/custom.js' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'skt_corp_scripts' );

function skt_corp_favicon() { 
	if( of_get_option('favicon',true) != '') {
	echo '<link rel="icon" type="image/x-icon" href="'.of_get_option('favicon',true).'" >';
	}
 }
add_action('wp_head', 'skt_corp_favicon');


function skt_corp_ie_stylesheet(){
	global $wp_styles;
	
	/** Load our IE-only stylesheet for all versions of IE.
	*   <!--[if lt IE 9]> ... <![endif]-->
	*
	*  Note: It is also possible to just check and see if the $is_IE global in WordPress is set to true before
	*  calling the wp_enqueue_style() function. If you are trying to load a stylesheet for all browsers
	*  EXCEPT for IE, then you would HAVE to check the $is_IE global since WordPress doesn't have a way to
	*  properly handle non-IE conditional comments.
	*/
	wp_enqueue_style('skt-corp-ie', get_template_directory_uri().'/css/ie.css', array('skt-corp-style'));
	$wp_styles->add_data('skt-corp-ie','conditional','IE');
	}
add_action('wp_enqueue_scripts','skt_corp_ie_stylesheet');


// add ie conditional html5 to header
function skt_corp_add_ie_html5() {
global $is_IE;
if ($is_IE)
echo '<!--[if lt IE 9]>';
echo '<script src="'.get_template_directory_uri().'/js/html5.js"></script>';
echo '<![endif]-->';
}
add_action('wp_head', 'skt_corp_add_ie_html5');


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Load custom functions file.
 */
require get_template_directory() . '/inc/custom-functions.php';


function skt_corp_custom_blogpost_pagination( $wp_query ){
	$big = 999999999; // need an unlikely integer
	if ( get_query_var('paged') ) { $pageVar = 'paged'; }
	elseif ( get_query_var('page') ) { $pageVar = 'page'; }
	else { $pageVar = 'paged'; }
	$pagin = paginate_links( array(
		'base' 			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' 		=> '?'.$pageVar.'=%#%',
		'current' 		=> max( 1, get_query_var($pageVar) ),
		'total' 		=> $wp_query->max_num_pages,
		'prev_text'		=> '&laquo; Prev',
		'next_text' 	=> 'Next &raquo;',
		'type'  => 'array'
	) ); 
	if( is_array($pagin) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
		echo '<div class="pagination"><div><ul>';
		echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
		foreach ( $pagin as $page ) {
			echo "<li>$page</li>";
		}
		echo '</ul></div></div>';
	} 
}

function skt_corp_pagination() {
	global $wp_query;
	$big = 12345678;
	$page_format = paginate_links( array(
	    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	    'format' => '?paged=%#%',
	    'current' => max( 1, get_query_var('paged') ),
	    'total' => $wp_query->max_num_pages,
	    'type'  => 'array'
	) );
	if( is_array($page_format) ) {
		$paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
		echo '<div class="pagination"><div><ul>';
		echo '<li><span>'. $paged . ' of ' . $wp_query->max_num_pages .'</span></li>';
		foreach ( $page_format as $page ) {
			echo "<li>$page</li>";
		}
		echo '</ul></div></div>';
	}
}


//tour tag
function tao_taxonomyss() {
 
        /* Biến $label chứa các tham số thiết lập tên hiển thị của Taxonomy
         */
        $labels = array(
                'name' => 'Tour',
                'singular' => 'Tour',
                'menu_name' => 'Tour'
        );
 
        /* Biến $args khai báo các tham số trong custom taxonomy cần tạo
         */
        $args = array(
                'labels'                     => $labels,
                'hierarchical'               => false,
                'public'                     => true,
                'show_ui'                    => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'show_tagcloud'              => true,
'hierarchical' => true
        );
 
        /* Hàm register_taxonomy để khởi tạo taxonomy
         */
        register_taxonomy('hokkaido-okinawa', 'post', $args);
 
}
 
// Hook into the 'init' action
add_action( 'init', 'tao_taxonomyss', 0 );




function tao_taxonomys() {
 
        /* Biến $label chứa các tham số thiết lập tên hiển thị của Taxonomy
         */
        $labels = array(
                'name' => 'テーマ& カテゴリー',
                'singular' => 'テーマ& カテゴリー',
                'menu_name' => 'テーマ& カテゴリー'
        );
 
        /* Biến $args khai báo các tham số trong custom taxonomy cần tạo
         */
        $args = array(
                'labels'                     => $labels,
                'hierarchical'               => false,
                'public'                     => true,
                'show_ui'                    => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'show_tagcloud'              => true,
'hierarchical' => true
        );
 
        /* Hàm register_taxonomy để khởi tạo taxonomy
         */
        register_taxonomy('theme-category', 'post', $args);
 
}
 
// Hook into the 'init' action
add_action( 'init', 'tao_taxonomys', 0 );

function tao_taxonomy() {
 
        /* Biến $label chứa các tham số thiết lập tên hiển thị của Taxonomy
         */
        $labels = array(
                'name' => ' 通訳言語',
                'singular' => ' 通訳言語',
                'menu_name' => ' 通訳言語'
        );
 
        /* Biến $args khai báo các tham số trong custom taxonomy cần tạo
         */
        $args = array(
                'labels'                     => $labels,
                'hierarchical'               => false,
                'public'                     => true,
                'show_ui'                    => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'show_tagcloud'              => true,
'hierarchical' => true
        );
 
        /* Hàm register_taxonomy để khởi tạo taxonomy
         */
        register_taxonomy('language', 'post', $args);
 
}
 
// Hook into the 'init' action
add_action( 'init', 'tao_taxonomy', 0 );


//host tag
function tao_taxonomysHost1() {
 
        /* Biến $label chứa các tham số thiết lập tên hiển thị của Taxonomy
         */
        $labels = array(
                'name' => 'Host',
                'singular' => 'Host',
                'menu_name' => 'Host'
        );
 
        /* Biến $args khai báo các tham số trong custom taxonomy cần tạo
         */
        $args = array(
                'labels'                     => $labels,
                'hierarchical'               => false,
                'public'                     => true,
                'show_ui'                    => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'show_tagcloud'              => true,
'hierarchical' => true
        );
 
        /* Hàm register_taxonomy để khởi tạo taxonomy
         */
        register_taxonomy('hokkaido-okinawa-host', 'post', $args);
 
}
 
// Hook into the 'init' action
add_action( 'init', 'tao_taxonomysHost1', 0 );

//end tour tag


function tao_taxonomysHost2() {
 
        /* Biến $label chứa các tham số thiết lập tên hiển thị của Taxonomy
         */
        $labels = array(
                'name' => 'テーマ& カテゴリー (Host)',
                'singular' => 'テーマ& カテゴリー (Host)',
                'menu_name' => 'テーマ& カテゴリー (Host)'
        );
 
        /* Biến $args khai báo các tham số trong custom taxonomy cần tạo
         */
        $args = array(
                'labels'                     => $labels,
                'hierarchical'               => false,
                'public'                     => true,
                'show_ui'                    => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'show_tagcloud'              => true,
'hierarchical' => true
        );
 
        /* Hàm register_taxonomy để khởi tạo taxonomy
         */
        register_taxonomy('theme-category-host', 'post', $args);
 
}
 
// Hook into the 'init' action
add_action( 'init', 'tao_taxonomysHost2', 0 );

function tao_taxonomysHost3() {
 
        /* Biến $label chứa các tham số thiết lập tên hiển thị của Taxonomy
         */
        $labels = array(
                'name' => ' 通訳言語 (Host)',
                'singular' => '通訳言語 (Host)',
                'menu_name' => '通訳言語 (Host)'
        );
 
        /* Biến $args khai báo các tham số trong custom taxonomy cần tạo
         */
        $args = array(
                'labels'                     => $labels,
                'hierarchical'               => false,
                'public'                     => true,
                'show_ui'                    => true,
                'show_admin_column'          => true,
                'show_in_nav_menus'          => true,
                'show_tagcloud'              => true,
'hierarchical' => true
        );
 
        /* Hàm register_taxonomy để khởi tạo taxonomy
         */
        register_taxonomy('language-host', 'post', $args);
 
}
 
// Hook into the 'init' action
add_action( 'init', 'tao_taxonomysHost3', 0 );


function SearchTour(){   
	$count=0;
    $f1=$_GET['tour'];
    $f2=$_GET['theme-category'];
    $f3=$_GET['language'];
    if($f1=='0') $f1 ='all';
    if($f2=='0')$f2 ='all';
     if($f3=='0')$f3 ='all';
    if(isset($f1)&&isset($f2)&&isset($f3)){
        if($f1=='all'&&$f2!='all'&&$f3!='all'){
        $args = array( 
                        'tax_query' =>array(
								array(
									'taxonomy' => 'theme-category',
									'terms' => array($f2.''),
									'field' => 'slug',
								),
								array(
									'taxonomy' => 'language',
									'terms' => array( $f3.''),
									'field' => 'slug',
								),
							),
                        'orderby'=>'date',
                        'order'=>'DESC', 
                      );
    }elseif($f1!='all'&&$f2=='all'&&$f3!='all'){
                   $args = array( 
                        'tax_query' =>array(
								array(
									'taxonomy' => 'hokkaido-okinawa',
									'terms' => array( $f1.''),
									'field' => 'slug',
								),
								array(
									'taxonomy' => 'language',
									'terms' => array( $f3.''),
									'field' => 'slug',
								),

							),
                        'orderby'=>'date',
                        'order'=>'DESC', 
                      );
    }elseif($f1!='all'&&$f2!='all'&&$f3=='all'){
    	       $args = array( 
                        'tax_query' =>array(
								array(
									'taxonomy' => 'hokkaido-okinawa',
									'terms' => array( $f1.''),
									'field' => 'slug',
								),
								array(
									'taxonomy' => 'theme-category',
									'terms' => array( $f2.''),
									'field' => 'slug',
								),
							
							),
                        'orderby'=>'date',
                        'order'=>'DESC', 
                      );
    }elseif($f1!='all'&&$f2=='all'&&$f3=='all'){ //100
    	       $args = array( 
                        'tax_query' =>array(
								array(
									'taxonomy' => 'hokkaido-okinawa',
									'terms' => array( $f1.''),
									'field' => 'slug',
								),
							
							),
                        'orderby'=>'date',
                        'order'=>'DESC', 
                      );
    }elseif($f1=='all'&&$f2=='all'&&$f3!='all'){ //001
    	       $args = array( 
                        'tax_query' =>array(
								array(
									'taxonomy' => 'language',
									'terms' => array( $f3.''),
									'field' => 'slug',
								),
							
							),
                        'orderby'=>'date',
                        'order'=>'DESC', 
                      );
    }elseif($f1=='all'&&$f2!='all'&&$f3=='all'){ //010
    	       $args = array( 
                        'tax_query' =>array(
								
								array(
									'taxonomy' => 'theme-category',
									'terms' => array( $f2.''),
									'field' => 'slug',
								),
							
							),
                        'orderby'=>'date',
                        'order'=>'DESC', 
                      );
    }elseif($f1!='all'&&$f2!='all'&&$f3!='all'){ //111
    	       $args = array( 
                        'tax_query' =>array(
								array(
									'taxonomy' => 'hokkaido-okinawa',
									'terms' => array( $f1.''),
									'field' => 'slug',
								),
								array(
									'taxonomy' => 'theme-category',
									'terms' => array( $f2.''),
									'field' => 'slug',
								),
								array(
									'taxonomy' => 'language',
									'terms' => array( $f3.''),
									'field' => 'slug',
								),
							
							),
                        'orderby'=>'date',
                        'order'=>'DESC', 
                        );
    }elseif ($f1=='all'&&$f2=='all'&&$f3=='all'){
    	$args = array( 
                        'category_name' => 'tourlist', 
                        'orderby'=>'date',
                        'order'=>'DESC', 
                      );
    }
}else
$args = array( 
                        'category_name' => 'tourlist', 
                        'orderby'=>'date',
                        'order'=>'DESC', 
                      );
    $wp_query = new WP_Query();
    $wp_query->query( $args );
    while ($wp_query->have_posts()){
     $wp_query->the_post();
         $count++; ?>
           <div class="hr-gray"></div>
          <div class="row">
                            <div class="col-xs-12 col-sm-4 col-md-3">
                                <?php echo get_the_post_thumbnail($post->ID, 'thumbnail' );?>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <p class="blue text-underline"> <?php the_title(); ?></p>
                                <p class="gray"> <?php the_content(); ?></p>
                                <div class="row">
                                    <div class="col-xs-6 red">
                                        <strong><i class="fa fa-jpy" aria-hidden="true"></i> <?php echo get_post_meta(get_the_ID(), 'price', TRUE); ?> </strong>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <a href="<?php echo get_permalink( $post->ID ); ?>"><button class="btn my-btn"> <span class="glyphicon glyphicon-search" aria-hidden="true"></span>  ツアー詳細  </button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
     <?php 
     }
     if($count==0){
     	 echo '<div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <p class="blue text-underline"> Not found!</p>
                            </div>
                        </div>
                        <div class="hr-gray"></div>';
     }
} 
function SearchHost(){   
	$count=0;
    $f1=$_GET['tour'];
    $f2=$_GET['theme-category'];
    $f3=$_GET['language'];
        if($f1=='0') $f1 ='all';
    if($f2=='0')$f2 ='all';
     if($f3=='0')$f3 ='all';
    if(isset($f1)&&isset($f2)&&isset($f3)){
        if($f1=='all'&&$f2!='all'&&$f3!='all'){
        $args = array( 
                        'tax_query' =>array(
								array(
									'taxonomy' => 'theme-category-host',
									'terms' => array($f2.''),
									'field' => 'slug',
								),
								array(
									'taxonomy' => 'language-host',
									'terms' => array( $f3.''),
									'field' => 'slug',
								),
							),
                        'orderby'=>'date',
                        'order'=>'DESC', 
                      );
    }elseif($f1!='all'&&$f2=='all'&&$f3!='all'){
                   $args = array( 
                        'tax_query' =>array(
								array(
									'taxonomy' => 'hokkaido-okinawa-host',
									'terms' => array( $f1.''),
									'field' => 'slug',
								),
								array(
									'taxonomy' => 'language-host',
									'terms' => array( $f3.''),
									'field' => 'slug',
								),

							),
                        'orderby'=>'date',
                        'order'=>'DESC', 
                      );
    }elseif($f1!='all'&&$f2!='all'&&$f3=='all'){
    	       $args = array( 
                        'tax_query' =>array(
								array(
									'taxonomy' => 'hokkaido-okinawa-host',
									'terms' => array( $f1.''),
									'field' => 'slug',
								),
								array(
									'taxonomy' => 'theme-category-host',
									'terms' => array( $f2.''),
									'field' => 'slug',
								),
							
							),
                        'orderby'=>'date',
                        'order'=>'DESC', 
                      );
    }elseif($f1!='all'&&$f2=='all'&&$f3=='all'){ //100
    	       $args = array( 
                        'tax_query' =>array(
								array(
									'taxonomy' => 'hokkaido-okinawa-host',
									'terms' => array( $f1.''),
									'field' => 'slug',
								),
							
							),
                        'orderby'=>'date',
                        'order'=>'DESC', 
                      );
    }elseif($f1=='all'&&$f2=='all'&&$f3!='all'){ //001
    	       $args = array( 
                        'tax_query' =>array(
								array(
									'taxonomy' => 'language-host',
									'terms' => array( $f3.''),
									'field' => 'slug',
								),
							
							),
                        'orderby'=>'date',
                        'order'=>'DESC', 
                      );
    }elseif($f1=='all'&&$f2!='all'&&$f3=='all'){ //010
    	       $args = array( 
                        'tax_query' =>array(
								
								array(
									'taxonomy' => 'theme-category-host',
									'terms' => array( $f2.''),
									'field' => 'slug',
								),
							
							),
                        'orderby'=>'date',
                        'order'=>'DESC', 
                      );
    }elseif($f1!='all'&&$f2!='all'&&$f3!='all'){ //111
    	       $args = array( 
                        'tax_query' =>array(
								array(
									'taxonomy' => 'hokkaido-okinawa-host',
									'terms' => array( $f1.''),
									'field' => 'slug',
								),
								array(
									'taxonomy' => 'theme-category-host',
									'terms' => array( $f2.''),
									'field' => 'slug',
								),
								array(
									'taxonomy' => 'language-host',
									'terms' => array( $f3.''),
									'field' => 'slug',
								),
							
							),
                        'orderby'=>'date',
                        'order'=>'DESC', 
                        );
    }elseif ($f1=='all'&&$f2=='all'&&$f3=='all'){
    	$args = array( 
                        'category_name' => 'hostlist', 
                        'orderby'=>'date',
                        'order'=>'DESC', 
                      );
    }
    }else
    $args = array( 
                        'category_name' => 'hostlist', 
                        'orderby'=>'date',
                        'order'=>'DESC', 
                      );


    $wp_query = new WP_Query();
    $wp_query->query( $args );
    while ($wp_query->have_posts()){
     $wp_query->the_post();
         $count++; ?>
          <div class="col-xs-12 col-sm-6 col-md-3">
                                <div class="host-avatar"><a href="../host_details?post-detail=<?php echo get_the_ID();?>"><img class="host-img" src="<?php the_post_thumbnail_url() ?>" /></a><span><strong><?php the_title(); ?> </strong></span>
                                </div>
                                  
                                  <?php the_content(); ?>
                                </div>

                                
       <?php
     }
     if($count==0){
     	 echo '<div class="col-xs-12 col-sm-6 col-md-3">
                                <p class="blue text-underline"> Not found!</p>
                           </div>';
     }
} 
        function getLabelTour($term_check, $type)
        {
        	 $terms = get_terms([
		    'taxonomy' => $type,
		    'hide_empty' => false,
		    ]);
		    foreach ($terms as $key => $term){
	        	if($term->slug==$term_check) return $term->name;
	        }
        }
