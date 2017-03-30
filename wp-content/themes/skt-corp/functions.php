<?php
/**
 * SKT Corp functions and definitions
 *
 * @package SKT Corp
 */
define('HOST_TERM_ID', 30);
define('TOUR_TERM_ID', 29);
/**
 * Set the content width based on the theme's design and stylesheet.
 */

add_action( 'init', 'setting_my_first_cookie' );

function setting_my_first_cookie() {
    setcookie( 'tour', '123', 30 * 6000, COOKIEPATH, COOKIE_DOMAIN );
}

if (!function_exists('skt_corp_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which runs
     * before the init hook. The init hook is too late for some features, such as indicating
     * support post thumbnails.
     */
    function skt_corp_setup()
    {
        if (!isset($content_width))
            $content_width = 680; /* pixels */

        load_theme_textdomain('skt-corp', get_template_directory() . '/languages');
        add_theme_support('automatic-feed-links');
        add_theme_support('woocommerce');
        add_theme_support('post-thumbnails');
        add_theme_support('title-tag');
        add_image_size('homepage-thumb', 240, 145, true);
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'skt-corp'),
        ));
        add_theme_support('custom-background', array(
            'default-color' => '#7ab040'
        ));
        add_editor_style('editor-style.css');
    }
endif; // skt_corp_setup
add_action('after_setup_theme', 'skt_corp_setup');

function theme_options_panel()
{
    //add_menu_page('Orders', 'List host orders', 'manage_options', 'theme-options', 'wps_theme_func');
    add_menu_page('List orders', 'List orders', 'manage_options', 'theme-options', 'wps_theme_func');
    add_submenu_page('theme-options', 'List host orders', 'List host orders', 'manage_options', 'theme-options', 'wps_theme_func');
    add_submenu_page('theme-options', 'List tour orders', 'List tour orders', 'manage_options', 'tour-orders', 'wps_theme_func_settings');
    add_submenu_page('theme-options', 'List house orders', 'List house order', 'manage_options', 'house-orders', 'wps_theme_func_faq');
}

add_action('admin_menu', 'theme_options_panel');

function wps_theme_func()
{

    if (isset($_GET['order_host_id'])) {
        global $wpdb;
        $wpdb->delete('host_reg', array('id' => $_GET['order_host_id']));
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
    global $wpdb;
    echo '<table style="width:95%;margin-top:20px;"><thead>
				 <tr style="background:#738e96; color:#fff">
				 <th>Name</th>
				 <th>Nickname</th>
				 <th>Name (Romaji)</th>
				 <th>Street address</th>
				 <th>Birthday</th>
				 <th>Cellphone number</th>
				 <th>Supported languages</th>
				 <th>Profile</th>
				 <th>Mail address</th>
				 <th>Basic guide uptime</th>
				 <th>Minimum guide time</th>
				 <th>Hourly wages for the minimum guide time</th>
				 <th>Permitted early / late night operation</th>
				 <th>Hourly early in the morning / late at night</th>
				 <th>Guidable area</th>
				 <th>Moving means at guidance</th>
				 <th>Current occupation</th>
				 <th>Recommended spot</th> 
				 <th>Recommended gourmet</th>
				 <th>Payed</th>
				 <th>money amount</th>
				 <th></th><tr></thead>';


    foreach ($wpdb->get_results("SELECT * FROM  host_reg") as $key => $row) {

        $file = '';
        $file2 = '';
        if ($row->file_zone1 != null) $file .= '<img src="' . wp_get_attachment_image_src($row->file_zone1, 'thumbnail')[0] . '"/>';
        if ($row->file_note1 != null) $file .= '<div>Spot name ①: ' . $row->file_note1 . '</div> <hr>';
        if ($row->file_zone2 != null) $file .= '<img src="' . wp_get_attachment_image_src($row->file_zone2, 'thumbnail')[0] . '"/>';
        if ($row->file_note2 != null) $file .= '<div>Spot name ②: ' . $row->file_note2 . '</div> <hr>';
        if ($row->file_zone3 != null) $file .= '<img src="' . wp_get_attachment_image_src($row->file_zone3, 'thumbnail')[0] . '"/>';
        if ($row->file_note3 != null) $file .= '<div>Spot name ③: ' . $row->file_note2 . '</div> <hr>';


        if ($row->file_eat1 != null) $file2 .= '<img src="' . wp_get_attachment_image_src($row->file_eat1, 'thumbnail')[0] . '"/>';
        if ($row->file_eat_note1 != null) $file2 .= '<div> Recommended gourmet name 1: ' . $row->file_eat_note1 . '</div> <hr>';
        if ($row->file_eat2 != null) $file2 .= '<img src="' . wp_get_attachment_image_src($row->file_eat2, 'thumbnail')[0] . '"/>';
        if ($row->file_eat_note2 != null) $file2 .= '<div> Recommended gourmet name 2: ' . $row->file_eat_note2 . '</div> <hr>';
        if ($row->file_eat3 != null) $file2 .= '<img src="' . wp_get_attachment_image_src($row->file_eat3, 'thumbnail')[0] . '"/>';
        if ($row->file_eat_note3 != null) $file2 .= '<div> Recommended gourmet name 3: ' . $row->file_eat_note3 . '</div> <hr>';


        echo '
					 <tr><td>'
            . $row->name_host . '</td><td>'
            . $row->alias_host . '</td><td>'
            . $row->name2_host . '</td><td>'
            . $row->quan_host . '-' . $row->tinh_host . '-' . $row->add_host . '</td><td>'
            . $row->birth1_host . '-' . $row->birth_month . '-' . $row->birth_year . '</td><td>'
            . $row->phone_host . '</td><td>'
            . $row->language . '</td><td>'
            . '[' . $row->profile1 . ']' . '[' . $row->profile2 . ']' . '</td><td>'
            . $row->email_host . '</td><td>'
            . $row->time_action . '</td><td>'
            . $row->time_minimum . '</td><td>'
            . $row->time_salary . '</td><td>'
            . $row->night_maybe . '</td><td>'
            . $rows->salary_min_max . '<td>'
            . $row->zone1 . '-' . $row->zone2 . '-' . $row->zone3 . '-' . $row->zone4 . '-' . $row->zone5 . '</td><td>'
            . $row->phuong_tien . '</td><td>'
            . $row->career . '</td><td>'
            . $file . '</td><td>'
            . $file2 . '</td><td>'
            . $row->status . '</td><td style="text-align:right">'
            . $row->money_amount . '</td><td>'
            . '<a href="?page=theme-options&order_host_id=' . $row->id . '">Delete</a></td><tr>';
    }
    echo '</table>';
// each column in your row will be accessible like this
//$my_column = $row->column_name;}
}

function wps_theme_func_settings()
{

    if (isset($_GET['order_tour_id'])) {
        global $wpdb;
        $wpdb->delete('tour_reg', array('id' => $_GET['order_tour_id']));
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
    global $wpdb;
    echo '<table style="width:95%;margin-top:20px;"><thead>
				 <tr style="background:#738e96; color:#fff">
				 <th>Tour title</th>
                 <th>Tour theme</th>
                 <th>Tour outline· PR</th>
                 <th>Tour schedule image</th>
                 <th>Point of departure</th>
                 <th>Target age</th>
                 <th>Tour fee</th>
                 <th>Included in price</th>
                 <th>Time required</th>
                 <th>Supported languages</th>
                 <th>Presence of meals</th>
                 <th>Pick up or not</th>
                 <th>Holidays</th>
                 <th>Minimum performers</th>
                 <th>Notes</th>
				 <th>Remarks</th>
				  <th>Inquiries</th>
				   <th>Name of person in charge</th>
				    <th>Street address</th>
				     <th>phone number</th>
				 <th>mail address</th>
				 <th>Cellphone number</th>
				 <th>Image photo</th>
                 <th>Payed</th>
				 <th>money amount</th>
				 <th></th>
				 <tr>
				 </thead>';
    foreach ($wpdb->get_results("SELECT * FROM  tour_reg") as $key => $row) {

        $file = '';

        if ($row->file_zone1 != null) $file .= '<img src="' . wp_get_attachment_image_src($row->file_zone1, 'thumbnail')[0] . '"/>';

        if ($row->file_zone2 != null) $file .= '<img src="' . wp_get_attachment_image_src($row->file_zone2, 'thumbnail')[0] . '"/>';

        if ($row->file_zone3 != null) $file .= '<img src="' . wp_get_attachment_image_src($row->file_zone3, 'thumbnail')[0] . '"/>';
        if ($row->file_zone4 != null) $file .= '<img src="' . wp_get_attachment_image_src($row->file_zone4, 'thumbnail')[0] . '"/>';

        if ($row->file_zone5 != null) $file .= '<img src="' . wp_get_attachment_image_src($row->file_zone5, 'thumbnail')[0] . '"/>';


        echo '
					 <tr><td>'
            . $row->topic_tour . '</td><td>'
            . $row->nametour . '</td><td>'
            . $row->outline_tour . '</td><td>'
            . $row->schedule_tour . '</td><td>'
            . $row->start_tour . '</td><td>'
            . $row->age_taget . '</td><td>'
            . $row->price_tour . '</td><td>'
            . $row->include_tour . '</td><td>'
            . $row->time_need . '</td><td>'
            . $row->language_tour . '</td><td>'
            . $row->food . '</td><td>'
            . $row->pickup . '</td><td>'
            . $row->holidays . '</td><td>'
            . $row->minimum_performers . '</td><td>'
            . $row->notes . '</td><td>'
            . $row->remarks . '</td><td>'
            . $row->inquiries . '</td><td>'
            . $row->person_charge . '</td><td>'
            . $row->zone1 . '-' . $row->zone2 . '-' . $row->zone3 . '-' . $row->zone4 . '-' . $row->zone5 . '</td><td>'
            . $row->phone_number . '</td><td>'
            . $row->mail_address . '</td><td>'
            . $row->phone_number2 . '</td><td>'
            . $file . '</td><td>'
            . $row->status . '</td><td style="text-align:right">'
            . $row->money_amount . '</td><td>'
            . '<a href="?page=tour-orders&order_tour_id=' . $row->id . '">Delete</a></td><tr>';
    }
    echo '</table>';
}


function wps_theme_func_faq()
{

    if (isset($_GET['order_house_id'])) {
        global $wpdb;
        $wpdb->delete('house_reg', array('id' => $_GET['order_house_id']));
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
    global $wpdb;
    echo '<table style="width:95%;margin-top:20px;"><thead>
				 <tr style="background:#738e96; color:#fff">
				<th>Name</th>
                 <th>Phonetic</th>
                 	<th>Price (per night)</th>
                 <th>Property address</th>
                 	<th>Phone number</th>
                 <th>Email</th>
                 	<th>Cellphone number</th>
                 <th>Property type</th>
                 	<th>Bet type</th>
                 <th>Number of guests allowed</th>
                 	<th>Bathroom</th>
                 <th>Bet number</th>
                 	<th>Amenity</th>
                 <th>Facility</th>
                 	<th>Other</th>
                 <th>Minimum stay</th>
                 	<th>check-in</th>
                 <th>check out</th>
                 <th>Cleaning fee</th>
                 	<th>Charges for separate cleaning fee</th>
                 <th>Homepage URL</th>
                 <th>Photo</th>
                  <th>Payed</th>
				 <th>money amount</th>
				 <th></th>
				 <tr></thead>';
    foreach ($wpdb->get_results("SELECT * FROM  house_reg") as $key => $row) {

        $file = '';

        if ($row->file_zone1 != null) $file .= '<img src="' . wp_get_attachment_image_src($row->file_zone1, 'thumbnail')[0] . '"/>';

        if ($row->file_zone2 != null) $file .= '<img src="' . wp_get_attachment_image_src($row->file_zone2, 'thumbnail')[0] . '"/>';

        if ($row->file_zone3 != null) $file .= '<img src="' . wp_get_attachment_image_src($row->file_zone3, 'thumbnail')[0] . '"/>';
        if ($row->file_zone4 != null) $file .= '<img src="' . wp_get_attachment_image_src($row->file_zone4, 'thumbnail')[0] . '"/>';

        if ($row->file_zone5 != null) $file .= '<img src="' . wp_get_attachment_image_src($row->file_zone5, 'thumbnail')[0] . '"/>';
        if ($row->file_zone6 != null) $file .= '<img src="' . wp_get_attachment_image_src($row->file_zone6, 'thumbnail')[0] . '"/>';

        if ($row->file_zone7 != null) $file .= '<img src="' . wp_get_attachment_image_src($row->file_zone7, 'thumbnail')[0] . '"/>';

        if ($row->file_zone8 != null) $file .= '<img src="' . wp_get_attachment_image_src($row->file_zone8, 'thumbnail')[0] . '"/>';
        if ($row->file_zone9 != null) $file .= '<img src="' . wp_get_attachment_image_src($row->file_zone9, 'thumbnail')[0] . '"/>';

        if ($row->file_zone10 != null) $file .= '<img src="' . wp_get_attachment_image_src($row->file_zone10, 'thumbnail')[0] . '"/>';
        if ($row->file_zone11 != null) $file .= '<img src="' . wp_get_attachment_image_src($row->file_zone11, 'thumbnail')[0] . '"/>';

        if ($row->file_zone12 != null) $file .= '<img src="' . wp_get_attachment_image_src($row->file_zone12, 'thumbnail')[0] . '"/>';

        if ($row->file_zone13 != null) $file .= '<img src="' . wp_get_attachment_image_src($row->file_zone13, 'thumbnail')[0] . '"/>';
        if ($row->file_zone14 != null) $file .= '<img src="' . wp_get_attachment_image_src($row->file_zone4, 'thumbnail')[0] . '"/>';

        if ($row->file_zone15 != null) $file .= '<img src="' . wp_get_attachment_image_src($row->file_zone15, 'thumbnail')[0] . '"/>';
        echo '
					 <tr><td>'
            . $row->name_house . '</td><td>'
            . $row->ngu_am . '</td><td>'
            . $row->price_one_night . '</td><td>'
            . $row->zone1 . '-' . $row->zone2 . '-' . $row->zone3 . '-' . $row->zone4 . '-' . $row->zone5 . '</td><td>'
            . $row->phone_number . '</td><td>'
            . $row->mail_address . '</td><td>'
            . $row->phone_number2 . '</td><td>'
            . $row->property_type . '</td><td>'
            . $row->bet_type . '</td><td>'
            . $row->guests_allowed . '</td><td>'
            . $row->bathroom . '</td><td>'
            . $row->bet_number . '</td><td>'
            . $row->amenity . '</td><td>'
            . $row->facility . '</td><td>'
            . $row->other . '</td><td>'
            . $row->minimum_nights . '</td><td>'
            . $row->check_in . '</td><td>'
            . $row->check_out . '</td><td>'
            . $row->cleaning_fee . '</td><td>'
            . $row->separate_cleaning_fee . '</td><td>'
            . $row->homepage_url . '</td><td>'
            . $file . '</td><td>'
            . $row->status . '</td><td style="text-align:right">'
            . $row->money_amount . '</td><td>'
            . '<a href="?page=house-orders&order_house_id=' . $row->id . '">Delete</a></td><tr>';
    }
    echo '</table>';
}

function skt_corp_widgets_init()
{
    register_sidebar(array(
        'name' => __('Blog Sidebar', 'skt-corp'),
        'description' => __('Appears on blog page sidebar', 'skt-corp'),
        'id' => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => __('Footer Widget 1', 'skt-corp'),
        'description' => __('Appears on footer of the page', 'skt-corp'),
        'id' => 'footer-1',
        'before_widget' => '',
        'before_title' => '<h2 class="widget-title"><span>',
        'after_title' => '</span></h2>',
    ));
    register_sidebar(array(
        'name' => __('Footer Widget 2', 'skt-corp'),
        'description' => __('Appears on footer of the page', 'skt-corp'),
        'id' => 'footer-2',
        'before_widget' => '',
        'before_title' => '<h2 class="widget-title"><span>',
        'after_title' => '</span></h2>',
    ));
    register_sidebar(array(
        'name' => __('Footer Widget 3', 'skt-corp'),
        'description' => __('Appears on footer of the page', 'skt-corp'),
        'id' => 'footer-3',
        'before_widget' => '',
        'before_title' => '<h2 class="widget-title"><span>',
        'after_title' => '</span></h2>',
    ));
}

add_action('widgets_init', 'skt_corp_widgets_init');

add_filter('widget_text', 'do_shortcode');

define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/');
require_once dirname(__FILE__) . '/inc/options-framework.php';

// Loads options.php from child or parent theme
$optionsfile = locate_template('options.php');
load_template($optionsfile);

function skt_corp_font_url()
{
    $font_url = '';

    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $open_sans = _x('on', 'Open Sans font:on or off', 'skt-corp');

    if ('off' !== $open_sans) {
        $font_families = 'Open Sans:400,600,700,800';
    }
    $query_args = array(
        'family' => $font_families,
    );
    $font_url = add_query_arg($query_args, '//fonts.googleapis.com/css');

    return $font_url;

}

function skt_corp_scripts()
{
    wp_enqueue_style('skt-corp-fonts', skt_corp_font_url(), array());
    wp_enqueue_style('skt_corp-basic-style', get_stylesheet_uri());
    wp_enqueue_style('skt_corp-editor-style', get_template_directory_uri() . "/editor-style.css");
    wp_enqueue_style('skt_corp-nivoslider-style', get_template_directory_uri() . "/css/nivo-slider.css");
    wp_enqueue_style('skt_corp-base-style', get_template_directory_uri() . "/css/style_base.css");
    wp_enqueue_style('skt-corp-responsive', get_template_directory_uri() . '/css/responsive.css');
    wp_enqueue_style('skt_corp-icomoon-style', get_template_directory_uri() . "/css/icomoon.css");
    wp_enqueue_script('skt_corp-nivo-script', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery'));
    wp_enqueue_script('skt_corp-custom_js', get_template_directory_uri() . '/js/custom.js');
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'skt_corp_scripts');

function skt_corp_favicon()
{
    if (of_get_option('favicon', true) != '') {
        echo '<link rel="icon" type="image/x-icon" href="' . of_get_option('favicon', true) . '" >';
    }
}

add_action('wp_head', 'skt_corp_favicon');


function skt_corp_ie_stylesheet()
{
    global $wp_styles;

    /** Load our IE-only stylesheet for all versions of IE.
     *   <!--[if lt IE 9]> ... <![endif]-->
     *
     *  Note: It is also possible to just check and see if the $is_IE global in WordPress is set to true before
     *  calling the wp_enqueue_style() function. If you are trying to load a stylesheet for all browsers
     *  EXCEPT for IE, then you would HAVE to check the $is_IE global since WordPress doesn't have a way to
     *  properly handle non-IE conditional comments.
     */
    wp_enqueue_style('skt-corp-ie', get_template_directory_uri() . '/css/ie.css', array('skt-corp-style'));
    $wp_styles->add_data('skt-corp-ie', 'conditional', 'IE');
}

add_action('wp_enqueue_scripts', 'skt_corp_ie_stylesheet');


// add ie conditional html5 to header
function skt_corp_add_ie_html5()
{
    global $is_IE;
    if ($is_IE)
        echo '<!--[if lt IE 9]>';
    echo '<script src="' . get_template_directory_uri() . '/js/html5.js"></script>';
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


function skt_corp_custom_blogpost_pagination($wp_query)
{
    $big = 999999999; // need an unlikely integer
    if (get_query_var('paged')) {
        $pageVar = 'paged';
    } elseif (get_query_var('page')) {
        $pageVar = 'page';
    } else {
        $pageVar = 'paged';
    }
    $pagin = paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?' . $pageVar . '=%#%',
        'current' => max(1, get_query_var($pageVar)),
        'total' => $wp_query->max_num_pages,
        'prev_text' => '&laquo; Prev',
        'next_text' => 'Next &raquo;',
        'type' => 'array'
    ));
    if (is_array($pagin)) {
        $paged = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');
        echo '<div class="pagination"><div><ul>';
        echo '<li><span>' . $paged . ' of ' . $wp_query->max_num_pages . '</span></li>';
        foreach ($pagin as $page) {
            echo "<li>$page</li>";
        }
        echo '</ul></div></div>';
    }
}

function skt_corp_pagination()
{
    global $wp_query;
    $big = 12345678;
    $page_format = paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'type' => 'array'
    ));
    if (is_array($page_format)) {
        $paged = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');
        echo '<div class="pagination"><div><ul>';
        echo '<li><span>' . $paged . ' of ' . $wp_query->max_num_pages . '</span></li>';
        foreach ($page_format as $page) {
            echo "<li>$page</li>";
        }
        echo '</ul></div></div>';
    }
}


//tour tag
function tao_taxonomyss()
{

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
        'labels' => $labels,
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'hierarchical' => true
    );

    /* Hàm register_taxonomy để khởi tạo taxonomy
     */
    register_taxonomy('hokkaido-okinawa', 'post', $args);

}

// Hook into the 'init' action
add_action('init', 'tao_taxonomyss', 0);


function tao_taxonomys()
{

    /* Biến $label chứa các tham số thiết lập tên hiển thị của Taxonomy
     */
    $labels = array(
        'name' => 'テーマ& カテゴリー (Tour)',
        'singular' => 'テーマ& カテゴリー (Tour)',
        'menu_name' => 'テーマ& カテゴリー (Tour)'
    );

    /* Biến $args khai báo các tham số trong custom taxonomy cần tạo
     */
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'hierarchical' => true
    );

    /* Hàm register_taxonomy để khởi tạo taxonomy
     */
    register_taxonomy('theme-category', 'post', $args);

}

// Hook into the 'init' action
add_action('init', 'tao_taxonomys', 0);

function tao_taxonomy()
{

    /* Biến $label chứa các tham số thiết lập tên hiển thị của Taxonomy
     */
    $labels = array(
        'name' => ' 通訳言語 (Tour)',
        'singular' => ' 通訳言語 (Tour)',
        'menu_name' => ' 通訳言語 (Tour)'
    );

    /* Biến $args khai báo các tham số trong custom taxonomy cần tạo
     */
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'hierarchical' => true
    );

    /* Hàm register_taxonomy để khởi tạo taxonomy
     */
    register_taxonomy('language', 'post', $args);

}

// Hook into the 'init' action
add_action('init', 'tao_taxonomy', 0);


//host tag
function tao_taxonomysHost1()
{

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
        'labels' => $labels,
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'hierarchical' => true
    );

    /* Hàm register_taxonomy để khởi tạo taxonomy
     */
    register_taxonomy('hokkaido-okinawa-host', 'post', $args);

}

// Hook into the 'init' action
add_action('init', 'tao_taxonomysHost1', 0);

//end tour tag


function tao_taxonomysHost2()
{

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
        'labels' => $labels,
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'hierarchical' => true
    );

    /* Hàm register_taxonomy để khởi tạo taxonomy
     */
    register_taxonomy('theme-category-host', 'post', $args);

}

// Hook into the 'init' action
add_action('init', 'tao_taxonomysHost2', 0);

function tao_taxonomysHost3()
{

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
        'labels' => $labels,
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
        'hierarchical' => true
    );

    /* Hàm register_taxonomy để khởi tạo taxonomy
     */
    register_taxonomy('language-host', 'post', $args);

}

// Hook into the 'init' action
add_action('init', 'tao_taxonomysHost3', 0);


function SearchTour()
{
    $count = 0;
    $f1 = $_GET['tour'];
    $f2 = $_GET['theme-category'];
    $f3 = $_GET['language'];
    if ($f1 == '0') $f1 = 'all';
    if ($f2 == '0') $f2 = 'all';
    if ($f3 == '0') $f3 = 'all';
    if (isset($f1) && isset($f2) && isset($f3)) {
        if ($f1 == 'all' && $f2 != 'all' && $f3 != 'all') {
            $args = array(
                'tax_query' => array(
                    array(
                        'taxonomy' => 'theme-category',
                        'terms' => array($f2 . ''),
                        'field' => 'slug',
                    ),
                    array(
                        'taxonomy' => 'language',
                        'terms' => array($f3 . ''),
                        'field' => 'slug',
                    ),
                ),
                'orderby' => 'date',
                'order' => 'DESC',
            );
        } elseif ($f1 != 'all' && $f2 == 'all' && $f3 != 'all') {
            $args = array(
                'tax_query' => array(
                    array(
                        'taxonomy' => 'hokkaido-okinawa',
                        'terms' => array($f1 . ''),
                        'field' => 'slug',
                    ),
                    array(
                        'taxonomy' => 'language',
                        'terms' => array($f3 . ''),
                        'field' => 'slug',
                    ),

                ),
                'orderby' => 'date',
                'order' => 'DESC',
            );
        } elseif ($f1 != 'all' && $f2 != 'all' && $f3 == 'all') {
            $args = array(
                'tax_query' => array(
                    array(
                        'taxonomy' => 'hokkaido-okinawa',
                        'terms' => array($f1 . ''),
                        'field' => 'slug',
                    ),
                    array(
                        'taxonomy' => 'theme-category',
                        'terms' => array($f2 . ''),
                        'field' => 'slug',
                    ),

                ),
                'orderby' => 'date',
                'order' => 'DESC',
            );
        } elseif ($f1 != 'all' && $f2 == 'all' && $f3 == 'all') { //100
            $args = array(
                'tax_query' => array(
                    array(
                        'taxonomy' => 'hokkaido-okinawa',
                        'terms' => array($f1 . ''),
                        'field' => 'slug',
                    ),

                ),
                'orderby' => 'date',
                'order' => 'DESC',
            );
        } elseif ($f1 == 'all' && $f2 == 'all' && $f3 != 'all') { //001
            $args = array(
                'tax_query' => array(
                    array(
                        'taxonomy' => 'language',
                        'terms' => array($f3 . ''),
                        'field' => 'slug',
                    ),

                ),
                'orderby' => 'date',
                'order' => 'DESC',
            );
        } elseif ($f1 == 'all' && $f2 != 'all' && $f3 == 'all') { //010
            $args = array(
                'tax_query' => array(

                    array(
                        'taxonomy' => 'theme-category',
                        'terms' => array($f2 . ''),
                        'field' => 'slug',
                    ),

                ),
                'orderby' => 'date',
                'order' => 'DESC',
            );
        } elseif ($f1 != 'all' && $f2 != 'all' && $f3 != 'all') { //111
            $args = array(
                'tax_query' => array(
                    array(
                        'taxonomy' => 'hokkaido-okinawa',
                        'terms' => array($f1 . ''),
                        'field' => 'slug',
                    ),
                    array(
                        'taxonomy' => 'theme-category',
                        'terms' => array($f2 . ''),
                        'field' => 'slug',
                    ),
                    array(
                        'taxonomy' => 'language',
                        'terms' => array($f3 . ''),
                        'field' => 'slug',
                    ),

                ),
                'orderby' => 'date',
                'order' => 'DESC',
            );
        } elseif ($f1 == 'all' && $f2 == 'all' && $f3 == 'all') {
            $args = array(
                'category_name' => 'tourlist',
                'orderby' => 'date',
                'order' => 'DESC',
            );
        }
    } else
        $args = array(
            'category_name' => 'tourlist',
            'orderby' => 'date',
            'order' => 'DESC',
        );
    $wp_query = new WP_Query();
    $wp_query->query($args);
    while ($wp_query->have_posts()) {
        $wp_query->the_post();
        $count++; ?>
        <div class="hr-gray"></div>
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3">
                <?php echo get_the_post_thumbnail($post->ID, 'thumbnail'); ?>
            </div>
            <div class="col-xs-12 col-sm-8 col-md-9">
                <p class="blue text-underline"> <?php the_title(); ?></p>
                <p class="gray"> <?php the_content(); ?></p>
                <div class="row">
                    <div class="col-xs-6 red">
                        <strong><i class="fa fa-jpy"
                                   aria-hidden="true"></i> <?php echo get_post_meta(get_the_ID(), 'price', TRUE); ?>
                        </strong>
                    </div>
                    <div class="col-xs-6 text-right">
                        <a href="<?php echo get_permalink($post->ID); ?>">
                            <button class="btn my-btn"><span class="glyphicon glyphicon-search"
                                                             aria-hidden="true"></span> ツアー詳細
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    if ($count == 0) {
        echo '<div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <p class="blue text-underline"> Not found!</p>
                            </div>
                        </div>
                        <div class="hr-gray"></div>';
    }
}

function SearchHost()
{
    global $post;
    $count = 0;
    $f1 = $_GET['tour'];
    $f2 = $_GET['theme-category'];
    $f3 = $_GET['language'];
    if ($f1 == '0') $f1 = 'all';
    if ($f2 == '0') $f2 = 'all';
    if ($f3 == '0') $f3 = 'all';
    if (isset($f1) && isset($f2) && isset($f3)) {
        if ($f1 == 'all' && $f2 != 'all' && $f3 != 'all') {
            $args = array(
                'tax_query' => array(
                    array(
                        'taxonomy' => 'theme-category-host',
                        'terms' => array($f2 . ''),
                        'field' => 'slug',
                    ),
                    array(
                        'taxonomy' => 'language-host',
                        'terms' => array($f3 . ''),
                        'field' => 'slug',
                    ),
                ),
                'orderby' => 'date',
                'order' => 'DESC',
            );
        } elseif ($f1 != 'all' && $f2 == 'all' && $f3 != 'all') {
            $args = array(
                'tax_query' => array(
                    array(
                        'taxonomy' => 'hokkaido-okinawa-host',
                        'terms' => array($f1 . ''),
                        'field' => 'slug',
                    ),
                    array(
                        'taxonomy' => 'language-host',
                        'terms' => array($f3 . ''),
                        'field' => 'slug',
                    ),

                ),
                'orderby' => 'date',
                'order' => 'DESC',
            );
        } elseif ($f1 != 'all' && $f2 != 'all' && $f3 == 'all') {
            $args = array(
                'tax_query' => array(
                    array(
                        'taxonomy' => 'hokkaido-okinawa-host',
                        'terms' => array($f1 . ''),
                        'field' => 'slug',
                    ),
                    array(
                        'taxonomy' => 'theme-category-host',
                        'terms' => array($f2 . ''),
                        'field' => 'slug',
                    ),

                ),
                'orderby' => 'date',
                'order' => 'DESC',
            );
        } elseif ($f1 != 'all' && $f2 == 'all' && $f3 == 'all') { //100
            $args = array(
                'tax_query' => array(
                    array(
                        'taxonomy' => 'hokkaido-okinawa-host',
                        'terms' => array($f1 . ''),
                        'field' => 'slug',
                    ),

                ),
                'orderby' => 'date',
                'order' => 'DESC',
            );
        } elseif ($f1 == 'all' && $f2 == 'all' && $f3 != 'all') { //001
            $args = array(
                'tax_query' => array(
                    array(
                        'taxonomy' => 'language-host',
                        'terms' => array($f3 . ''),
                        'field' => 'slug',
                    ),

                ),
                'orderby' => 'date',
                'order' => 'DESC',
            );
        } elseif ($f1 == 'all' && $f2 != 'all' && $f3 == 'all') { //010
            $args = array(
                'tax_query' => array(

                    array(
                        'taxonomy' => 'theme-category-host',
                        'terms' => array($f2 . ''),
                        'field' => 'slug',
                    ),

                ),
                'orderby' => 'date',
                'order' => 'DESC',
            );
        } elseif ($f1 != 'all' && $f2 != 'all' && $f3 != 'all') { //111
            $args = array(
                'tax_query' => array(
                    array(
                        'taxonomy' => 'hokkaido-okinawa-host',
                        'terms' => array($f1 . ''),
                        'field' => 'slug',
                    ),
                    array(
                        'taxonomy' => 'theme-category-host',
                        'terms' => array($f2 . ''),
                        'field' => 'slug',
                    ),
                    array(
                        'taxonomy' => 'language-host',
                        'terms' => array($f3 . ''),
                        'field' => 'slug',
                    ),

                ),
                'orderby' => 'date',
                'order' => 'DESC',
            );
        } elseif ($f1 == 'all' && $f2 == 'all' && $f3 == 'all') {
            $args = array(
                'category_name' => 'hostlist',
                'orderby' => 'date',
                'order' => 'DESC',
            );
        }
    } else
        $args = array(
            'category_name' => 'hostlist',
            'orderby' => 'date',
            'order' => 'DESC',
        );


    $wp_query = new WP_Query();
    $wp_query->query($args);
    while ($wp_query->have_posts()) {
        $wp_query->the_post();
        $count++; ?>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="host-avatar"><a href="<?php echo get_permalink($post->ID); ?>"><img
                        class="host-img"
                        src="<?php the_post_thumbnail_url() ?>"/></a><span><strong><?php the_title(); ?> </strong></span>
            </div>
            <p class="host-name"><?php //print_r(_get_post_meta($post->ID, 'host_tour_name')); ?><?php get_post_meta($post->ID, 'host_tour_name', TRUE) ?></p>
            <p class="host-salary">＄<?php echo get_post_meta($post->ID, 'price', TRUE) ?>
                /Per
                One Hour</p>
            <div class="host-desc">
                <p>エリア : <?php echo get_post_meta($post->ID, 'guide_area', TRUE) ?></p>
                <p>
                    通訳言語：<?php echo get_post_meta($post->ID, 'host_tour_language', TRUE) ?></p>
                <p>
                    移動手段：<?php echo get_post_meta($post->ID, 'transportration', TRUE) ?></p>
                <p><?php echo get_post_meta($post->ID, 'early_time', TRUE) ?></p>

            </div>
        </div>


        <?php
    }
    if ($count == 0) {
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
    foreach ($terms as $key => $term) {
        if ($term->slug == $term_check) return $term->name;
    }
}

/**
 * Get count host
 */

function _count_host(){
    $count = 0;
    $args = array(
        'category_name' => 'hostlist',
        'orderby'=>'date',
        'order'=>'DESC',
    );


    $wp_query = new WP_Query();
    $wp_query->query( $args );
    while ($wp_query->have_posts()){
        $count ++;
    }
    print $count;
}
