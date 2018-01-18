<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options(){
	
// VARIABLES
//$themename = get_theme_data(STYLESHEETPATH . '/style.css');
$themename = wp_get_theme(STYLESHEETPATH); 
$themename = $themename['Name'];
$themename = 'Theme Options';
$shortname = "of";

// Populate OptionsFramework option in array for use in theme
global $of_options;
$of_options = get_option('of_options');

$GLOBALS['template_path'] = OF_DIRECTORY;

//Access the WordPress Categories via an Array
$of_categories = array();  
$of_categories_obj = get_categories('hide_empty=0');
foreach ($of_categories_obj as $of_cat) {
    $of_categories[$of_cat->cat_name] = $of_cat->cat_name;}
$categories_tmp = array_unshift($of_categories, "All Categories");    
       
//Access the WordPress Pages via an Array
$of_pages = array();
$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($of_pages_obj as $of_page) {
    $of_pages[$of_page->ID] = $of_page->post_name; }
$of_pages_tmp = array_unshift($of_pages, "Select a page:");       

// Image Alignment radio box
$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 

// Image Links to Options
$options_image_link_to = array("image" => "The Image","post" => "The Post"); 

/* Uncomment this to dynamically get the list of fonts from Google fonts
 $fontsSeraliazed = file_get_contents('http://phat-reaction.com/googlefonts.php?format=php');
 $fontArray = unserialize($fontsSeraliazed);
 $options_googlefonts = array("Arial" => "Arial", "Georgia" => "Georgia", "Tahoma" => "Tahoma", "Verdana" => "Verdana", "Helvetica" => "Helvetica");
 
foreach ($fontArray as $innerArray) {
	
	$fontvalue = $innerArray['font-name'];
	$options_googlefonts[$fontvalue] = $fontvalue;

} */

$options_select = array("one","two","three","four","five"); 
$options_radio = array("Top" => "Top","Upper Middle" => "Upper Middle","Lower Middle" => "Lower Middle","Bottom" => "Bottom","Off" => "Off"); 
$options_googlefonts = array(
	"Arial" => "Arial",
    "Georgia" => "Georgia",
    "Tahoma" => "Tahoma",
    "Verdana" => "Verdana",
    "Helvetica" => "Helvetica",
    "Abel" => "Abel",
    "Abril Fatface" => "Abril Fatface",
    "Aclonica" => "Aclonica",
    "Actor" => "Actor",
    "Adamina" => "Adamina",
    "Aguafina Script" => "Aguafina Script",
    "Aladin" => "Aladin",
    "Aldrich" => "Aldrich",
    "Alice" => "Alice",
    "Alike Angular" => "Alike Angular",
    "Alike" => "Alike",
    "Allan" => "Allan",
    "Allerta Stencil" => "Allerta Stencil",
    "Allerta" => "Allerta",
    "Amaranth" => "Amaranth",
    "Amatic SC" => "Amatic SC",
    "Andada" => "Andada",
    "Andika" => "Andika",
    "Annie Use Your Telescope" => "Annie Use Your Telescope",
    "Anonymous Pro" => "Anonymous Pro",
    "Antic" => "Antic",
    "Anton" => "Anton",
    "Arapey" => "Arapey",
    "Architects Daughter" => "Architects Daughter",
    "Arimo" => "Arimo",
    "Artifika" => "Artifika",
    "Arvo" => "Arvo",
    "Asset" => "Asset",
    "Astloch" => "Astloch",
    "Atomic Age" => "Atomic Age",
    "Aubrey" => "Aubrey",
    "Bangers" => "Bangers",
    "Bentham" => "Bentham",
    "Bevan" => "Bevan",
    "Bigshot One" => "Bigshot One",
    "Bitter" => "Bitter",
    "Black Ops One" => "Black Ops One",
    "Bowlby One SC" => "Bowlby One SC",
    "Bowlby One" => "Bowlby One",
    "Brawler" => "Brawler",
    "Bubblegum Sans" => "Bubblegum Sans",
    "Buda" => "Buda",
    "Butcherman Caps" => "Butcherman Caps",
    "Cabin Condensed" => "Cabin Condensed",
    "Cabin Sketch" => "Cabin Sketch",
    "Cabin" => "Cabin",
    "Cagliostro" => "Cagliostro",
    "Calligraffitti" => "Calligraffitti",
    "Candal" => "Candal",
    "Cantarell" => "Cantarell",
    "Cardo" => "Cardo",
    "Carme" => "Carme",
    "Carter One" => "Carter One",
    "Caudex" => "Caudex",
    "Cedarville Cursive" => "Cedarville Cursive",
    "Changa One" => "Changa One",
    "Cherry Cream Soda" => "Cherry Cream Soda",
    "Chewy" => "Chewy",
    "Chicle" => "Chicle",
    "Chivo" => "Chivo",
    "Coda Caption" => "Coda Caption",
    "Coda" => "Coda",
    "Comfortaa" => "Comfortaa",
    "Coming Soon" => "Coming Soon",
    "Contrail One" => "Contrail One",
    "Convergence" => "Convergence",
    "Cookie" => "Cookie",
    "Copse" => "Copse",
    "Corben" => "Corben",
    "Cousine" => "Cousine",
    "Coustard" => "Coustard",
    "Covered By Your Grace" => "Covered By Your Grace",
    "Crafty Girls" => "Crafty Girls",
    "Creepster Caps" => "Creepster Caps",
    "Crimson Text" => "Crimson Text",
    "Crushed" => "Crushed",
    "Cuprum" => "Cuprum",
    "Damion" => "Damion",
    "Dancing Script" => "Dancing Script",
    "Dawning of a New Day" => "Dawning of a New Day",
    "Days One" => "Days One",
    "Delius Swash Caps" => "Delius Swash Caps",
    "Delius Unicase" => "Delius Unicase",
    "Delius" => "Delius",
    "Devonshire" => "Devonshire",
    "Didact Gothic" => "Didact Gothic",
    "Dorsa" => "Dorsa",
    "Dr Sugiyama" => "Dr Sugiyama",
    "Droid Sans Mono" => "Droid Sans Mono",
    "Droid Sans" => "Droid Sans",
    "Droid Serif" => "Droid Serif",
    "EB Garamond" => "EB Garamond",
    "Eater Caps" => "Eater Caps",
    "Expletus Sans" => "Expletus Sans",
    "Fanwood Text" => "Fanwood Text",
    "Federant" => "Federant",
    "Federo" => "Federo",
    "Fjord One" => "Fjord One",
    "Fondamento" => "Fondamento",
    "Fontdiner Swanky" => "Fontdiner Swanky",
    "Forum" => "Forum",
    "Francois One" => "Francois One",
    "Gentium Basic" => "Gentium Basic",
    "Gentium Book Basic" => "Gentium Book Basic",
    "Geo" => "Geo",
    "Geostar Fill" => "Geostar Fill",
    "Geostar" => "Geostar",
    "Give You Glory" => "Give You Glory",
    "Gloria Hallelujah" => "Gloria Hallelujah",
    "Goblin One" => "Goblin One",
    "Gochi Hand" => "Gochi Hand",
    "Goudy Bookletter 1911" => "Goudy Bookletter 1911",
    "Gravitas One" => "Gravitas One",
    "Gruppo" => "Gruppo",
    "Hammersmith One" => "Hammersmith One",
    "Herr Von Muellerhoff" => "Herr Von Muellerhoff",
    "Holtwood One SC" => "Holtwood One SC",
    "Homemade Apple" => "Homemade Apple",
    "IM Fell DW Pica SC" => "IM Fell DW Pica SC",
    "IM Fell DW Pica" => "IM Fell DW Pica",
    "IM Fell Double Pica SC" => "IM Fell Double Pica SC",
    "IM Fell Double Pica" => "IM Fell Double Pica",
    "IM Fell English SC" => "IM Fell English SC",
    "IM Fell English" => "IM Fell English",
    "IM Fell French Canon SC" => "IM Fell French Canon SC",
    "IM Fell French Canon" => "IM Fell French Canon",
    "IM Fell Great Primer SC" => "IM Fell Great Primer SC",
    "IM Fell Great Primer" => "IM Fell Great Primer",
    "Iceland" => "Iceland",
    "Inconsolata" => "Inconsolata",
    "Indie Flower" => "Indie Flower",
    "Irish Grover" => "Irish Grover",
    "Istok Web" => "Istok Web",
    "Jockey One" => "Jockey One",
    "Josefin Sans" => "Josefin Sans",
    "Josefin Slab" => "Josefin Slab",
    "Judson" => "Judson",
    "Julee" => "Julee",
    "Jura" => "Jura",
    "Just Another Hand" => "Just Another Hand",
    "Just Me Again Down Here" => "Just Me Again Down Here",
    "Kameron" => "Kameron",
    "Kelly Slab" => "Kelly Slab",
    "Kenia" => "Kenia",
    "Knewave" => "Knewave",
    "Kranky" => "Kranky",
    "Kreon" => "Kreon",
    "Kristi" => "Kristi",
    "La Belle Aurore" => "La Belle Aurore",
    "Lancelot" => "Lancelot",
    "Lato" => "Lato",
    "League Script" => "League Script",
    "Leckerli One" => "Leckerli One",
    "Lekton" => "Lekton",
    "Lemon" => "Lemon",
    "Limelight" => "Limelight",
    "Linden Hill" => "Linden Hill",
    "Lobster Two" => "Lobster Two",
    "Lobster" => "Lobster",
    "Lora" => "Lora",
    "Love Ya Like A Sister" => "Love Ya Like A Sister",
    "Loved by the King" => "Loved by the King",
    "Luckiest Guy" => "Luckiest Guy",
    "Maiden Orange" => "Maiden Orange",
    "Mako" => "Mako",
    "Marck Script" => "Marck Script",
    "Marvel" => "Marvel",
    "Mate SC" => "Mate SC",
    "Mate" => "Mate",
    "Maven Pro" => "Maven Pro",
    "Meddon" => "Meddon",
    "MedievalSharp" => "MedievalSharp",
    "Megrim" => "Megrim",
    "Merienda One" => "Merienda One",
    "Merriweather" => "Merriweather",
    "Metrophobic" => "Metrophobic",
    "Michroma" => "Michroma",
    "Miltonian Tattoo" => "Miltonian Tattoo",
    "Miltonian" => "Miltonian",
    "Miss Fajardose" => "Miss Fajardose",
    "Miss Saint Delafield" => "Miss Saint Delafield",
    "Modern Antiqua" => "Modern Antiqua",
    "Molengo" => "Molengo",
    "Monofett" => "Monofett",
    "Monoton" => "Monoton",
    "Monsieur La Doulaise" => "Monsieur La Doulaise",
    "Montez" => "Montez",
    "Mountains of Christmas" => "Mountains of Christmas",
    "Mr Bedford" => "Mr Bedford",
    "Mr Dafoe" => "Mr Dafoe",
    "Mr De Haviland" => "Mr De Haviland",
    "Mrs Sheppards" => "Mrs Sheppards",
    "Muli" => "Muli",
    "Neucha" => "Neucha",
    "Neuton" => "Neuton",
    "News Cycle" => "News Cycle",
    "Niconne" => "Niconne",
    "Nixie One" => "Nixie One",
    "Nobile" => "Nobile",
    "Nosifer Caps" => "Nosifer Caps",
    "Nothing You Could Do" => "Nothing You Could Do",
    "Nova Cut" => "Nova Cut",
    "Nova Flat" => "Nova Flat",
    "Nova Mono" => "Nova Mono",
    "Nova Oval" => "Nova Oval",
    "Nova Round" => "Nova Round",
    "Nova Script" => "Nova Script",
    "Nova Slim" => "Nova Slim",
    "Nova Square" => "Nova Square",
    "Numans" => "Numans",
    "Nunito" => "Nunito",
    "Old Standard TT" => "Old Standard TT",
    "Open Sans Condensed" => "Open Sans Condensed",
    "Open Sans" => "Open Sans",
    "Orbitron" => "Orbitron",
    "Oswald" => "Oswald",
    "Over the Rainbow" => "Over the Rainbow",
    "Ovo" => "Ovo",
    "PT Sans Caption" => "PT Sans Caption",
    "PT Sans Narrow" => "PT Sans Narrow",
    "PT Sans" => "PT Sans",
    "PT Serif Caption" => "PT Serif Caption",
    "PT Serif" => "PT Serif",
    "Pacifico" => "Pacifico",
    "Passero One" => "Passero One",
    "Patrick Hand" => "Patrick Hand",
    "Paytone One" => "Paytone One",
    "Permanent Marker" => "Permanent Marker",
    "Petrona" => "Petrona",
    "Philosopher" => "Philosopher",
    "Piedra" => "Piedra",
    "Pinyon Script" => "Pinyon Script",
    "Play" => "Play",
    "Playfair Display" => "Playfair Display",
    "Podkova" => "Podkova",
    "Poller One" => "Poller One",
    "Poly" => "Poly",
    "Pompiere" => "Pompiere",
    "Prata" => "Prata",
    "Prociono" => "Prociono",
    "Puritan" => "Puritan",
    "Quattrocento Sans" => "Quattrocento Sans",
    "Quattrocento" => "Quattrocento",
    "Questrial" => "Questrial",
    "Quicksand" => "Quicksand",
    "Radley" => "Radley",
    "Raleway" => "Raleway",
    "Rammetto One" => "Rammetto One",
    "Rancho" => "Rancho",
    "Rationale" => "Rationale",
    "Redressed" => "Redressed",
    "Reenie Beanie" => "Reenie Beanie",
    "Ribeye Marrow" => "Ribeye Marrow",
    "Ribeye" => "Ribeye",
    "Righteous" => "Righteous",
    "Rochester" => "Rochester",
    "Rock Salt" => "Rock Salt",
    "Rokkitt" => "Rokkitt",
    "Rosario" => "Rosario",
    "Ruslan Display" => "Ruslan Display",
    "Salsa" => "Salsa",
    "Sancreek" => "Sancreek",
    "Sansita One" => "Sansita One",
    "Satisfy" => "Satisfy",
    "Schoolbell" => "Schoolbell",
    "Shadows Into Light" => "Shadows Into Light",
    "Shanti" => "Shanti",
    "Short Stack" => "Short Stack",
    "Sigmar One" => "Sigmar One",
    "Signika Negative" => "Signika Negative",
    "Signika" => "Signika",
    "Six Caps" => "Six Caps",
    "Slackey" => "Slackey",
    "Smokum" => "Smokum",
    "Smythe" => "Smythe",
    "Sniglet" => "Sniglet",
    "Snippet" => "Snippet",
    "Sorts Mill Goudy" => "Sorts Mill Goudy",
    "Source Sans Pro" => "Source Sans Pro",
    "Special Elite" => "Special Elite",
    "Spinnaker" => "Spinnaker",
    "Spirax" => "Spirax",
    "Stardos Stencil" => "Stardos Stencil",
    "Sue Ellen Francisco" => "Sue Ellen Francisco",
    "Sunshiney" => "Sunshiney",
    "Supermercado One" => "Supermercado One",
    "Swanky and Moo Moo" => "Swanky and Moo Moo",
    "Syncopate" => "Syncopate",
    "Tangerine" => "Tangerine",
    "Tenor Sans" => "Tenor Sans",
    "Terminal Dosis" => "Terminal Dosis",
    "The Girl Next Door" => "The Girl Next Door",
    "Tienne" => "Tienne",
    "Tinos" => "Tinos",
    "Tulpen One" => "Tulpen One",
    "Ubuntu Condensed" => "Ubuntu Condensed",
    "Ubuntu Mono" => "Ubuntu Mono",
    "Ubuntu" => "Ubuntu",
    "Ultra" => "Ultra",
    "UnifrakturCook" => "UnifrakturCook",
    "UnifrakturMaguntia" => "UnifrakturMaguntia",
    "Unkempt" => "Unkempt",
    "Unlock" => "Unlock",
    "Unna" => "Unna",
    "VT323" => "VT323",
    "Varela Round" => "Varela Round",
    "Varela" => "Varela",
    "Vast Shadow" => "Vast Shadow",
    "Vibur" => "Vibur",
    "Vidaloka" => "Vidaloka",
    "Volkhov" => "Volkhov",
    "Vollkorn" => "Vollkorn",
    "Voltaire" => "Voltaire",
    "Waiting for the Sunrise" => "Waiting for the Sunrise",
    "Wallpoet" => "Wallpoet",
    "Walter Turncoat" => "Walter Turncoat",
    "Wire One" => "Wire One",
    "Yanone Kaffeesatz" => "Yanone Kaffeesatz",
    "Yellowtail" => "Yellowtail",
    "Yeseva One" => "Yeseva One",
    "Zeyada" => "Zeyada"
);



//Stylesheets Reader
$alt_stylesheet_path = OF_FILEPATH . '/styles/';
$alt_stylesheets = array();

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}

//More Options
$uploads_arr = wp_upload_dir();
$all_uploads_path = $uploads_arr['path'];
$all_uploads = get_option('of_uploads');
$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");

// Set the Options Array
$options = array();
$url =  get_template_directory_uri() .'/admin/images/icons/';
$options[] = array( "name" => "<img src='".$url."wrench.png' class='headingicon'>General",				 
					"type" => "heading");
					

$options[] = array( "name" => "Custom Logo",
					"desc" => "Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png).<br /><br /> Image-size should be 300px x 65px.",
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload");
					
$options[] = array( "name" => "Custom Favicon",
					"desc" => "Upload a 16px x 16px Png/Gif image that will represent your website's favicon.",
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload"); 

                                               
$options[] = array( "name" => "Tracking Code",
					"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");    

$url =  get_template_directory_uri() .'/admin/images/icons/';
$options[] = array( "name" => "<img src='".$url."paintcan.png' class='headingicon'>Skin",				 
					"type" => "heading");


$url =  get_template_directory_uri() .'/images/';
$options[] = array( "name" => __('Theme Skin', 'framework'),
					"desc" => "Select the Theme Skin.",
					"id" => $shortname."_theme_skin",
					"std" => "Light",
					"type" => "images",
					"options" => array(
						'Light' => $url . 'light-skin.png',			   
						'Dark' => $url . 'dark-skin.png',			   
						));
					//"options" => $alt_stylesheets);
					
					$url =  get_template_directory_uri() .'/images/skins/dividers/';
					
					
$url =  get_template_directory_uri() .'/admin/images/icons/';
$options[] = array( "name" => "<img src='".$url."palette.png' class='headingicon'>Customize",				 
					"type" => "heading"); 

$url =  get_template_directory_uri() .'/images/skins/textures/';
$options[] = array( "name" => "Background Texture",
					"desc" => "Choose a texture overlay for your background.",
					"id" => $shortname."_texture_bg",
					"std" => "",
					"type" => "images",
					"options" => array(
						'none' => $url . 'call-none.png',
						$url . 'grain.png' => $url . 'grainthumb.png',
						$url . 'canvas.png' => $url . 'canvasthumb.png',
						$url . 'linen.png' => $url . 'linenthumb.png',
						$url . 'graphy.png' => $url . 'graphythumb.png',
						$url . 'vertical-stripes.png' => $url . 'vertical-stripesthumb.png',
						$url . 'cubes.png' => $url . 'cubesthumb.png'
						));

$options[] = array( "name" => "Custom Background Image",
					"desc" => "Upload a custom background image for your theme, or specify the image address of your online background image. (http://yoursite.com/background.png).<br /><br /> Image will be centered and horizontally tile in the featured background area.",
					"id" => $shortname."_background_image",
					"std" => "",
					"type" => "upload");

$options[] = array( "name" => "Top Logo Padding",
					"desc" => "Top Padding for the Logo Section.",
					"id" => $shortname."_logo_padding",
					"std" => "50",
					"type" => "text"); 

$options[] = array( "name" => "Top Navigation Padding",
					"desc" => "Top Padding for the Navigation Section.",
					"id" => $shortname."_content_padding",
					"std" => "50",
					"type" => "text"); 

$options[] = array( "name" => "Bottom Navigation Padding",
					"desc" => "Bottom Padding for the Navigation Section.",
					"id" => $shortname."_navbottom_padding",
					"std" => "32",
					"type" => "text"); 

$options[] = array( "name" => "Dropdown Menu Text",
					"desc" => "Default Text Displayed in the Mobile Dropdown Menu",
					"id" => $shortname."_menu_text",
					"std" => "Select a Page:",
					"type" => "text");

$options[] = array( "name" => "Top Panel Drawer",
					"desc" => "Select whether you want and expandable top panel. You'll need to fill it with content by creating a page and giving it the 'Top Panel' template.",
					"id" => $shortname."_top_bar",
					"std" => "On",
					"type" => "radio",
					"options" =>  array(
						'On' => 'On',
						'Off' => 'Off'
						));
					
$options[] = array( "name" => "Custom CSS",
                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");

$url =  get_template_directory_uri() .'/admin/images/icons/';
$options[] = array( "name" => "<img src='".$url."color_wheel.png' class='headingicon'>Buttons &amp; Links",				 
					"type" => "heading");   

$options[] = array( "name" => "Button Color",
					"desc" => "Select Your Top Section Font Color. Overwrites theme color.",
					"id" => $shortname."_button_color",
					"std" => "#212121",
					"type" => "color"); 

$options[] = array( "name" => "Button Hover Color",
					"desc" => "Select Your Top Section Font Color. Overwrites theme color.",
					"id" => $shortname."_button_hover_color",
					"std" => "#555555",
					"type" => "color"); 

$options[] = array( "name" => "Link Color",
					"desc" => "Select Your Top Section Font Color. Overwrites theme color.",
					"id" => $shortname."_link_color",
					"std" => "#212121",
					"type" => "color"); 

$options[] = array( "name" => "Link Hover Color",
					"desc" => "Select Your Top Section Font Color. Overwrites theme color.",
					"id" => $shortname."_link_hover_color",
					"std" => "#555555",
					"type" => "color"); 


$url =  get_template_directory_uri() .'/admin/images/icons/';
$options[] = array( "name" => "<img src='".$url."house.png' class='headingicon'>Homepage",				 
					"type" => "heading");

$options[] = array( "name" => "Site Tagline",
					"desc" => "This is a tagline for your site beneath the logo.",
					"id" => $shortname."_site_tagline",
					"std" => "My Ultra Interactive Online Portfolio.",
					"type" => "text"); 

$options[] = array( "name" => "Homepage Thumbnail Slideshows",
					"desc" => "Select whether you want the homepage thumbnails to automatically play as slideshows.",
					"id" => $shortname."_autoplay",
					"std" => "true",
					"type" => "radio",
					"options" =>  array(
						'true' => 'On',
						'false' => 'Off'
						));

$options[] = array( "name" => "Initial Slideshow State",
					"desc" => "Select whether the slideshow should appear open on page load. The first project will display.",
					"id" => $shortname."_slideshow_state",
					"std" => "Closed",
					"type" => "radio",
					"options" =>  array(
						'Closed' => 'Closed',
						'Open' => 'Open'
					)); 

$options[] = array( "name" => "Portfolio Thumbnail Hover",
					"desc" => "Choose whether to display the post title on hover or a minimal expand image.",
					"id" => $shortname."_thumb_hover",
					"std" => "Image",
					"type" => "radio",
					"options" =>  array(
						'Title' => 'Project Title',
						'Image' => 'Expand Image'
					)); 


$options[] = array( "name" => "Portfolio Filter Action",
                    "desc" => "Choose your style of filtering homepage thumbnails",
                    "id" => $shortname."_filter_action",
                    "std" => "Fade",
                    "type" => "radio",
                    "options" =>  array(
                        'Shuffle' => 'Re-Shuffle',
                        'Fade' => 'Fade White'
                    )); 

$options[] = array( "name" => "Portfolio Item Padding",
					"desc" => "Add a small amount of padding in-between portfolio thumbnails.",
					"id" => $shortname."_thumb_padding",
					"std" => "Off",
					"type" => "radio",
					"options" =>  array(
						'On' => 'On',
						'Off' => 'Off'
					)); 

$options[] = array( "name" => "Number of Homepage Portfolio Thumbnails",
					"desc" => "Keep this as low as you can for to ensure your site loads as fast as possible. :)",
					"id" => $shortname."_homepage_number",
					"std" => "30",
					"type" => "text"); 

$options[] = array( "name" => "Homepage Latest News",
					"desc" => "Select whether the latest three news posts should appear open on page load. AT LEAST three posts are needed.",
					"id" => $shortname."_home_news",
					"std" => "Off",
					"type" => "radio",
					"options" =>  array(
						'On' => 'On',
						'Off' => 'Off'
					)); 

$options[] = array( "name" => "Homepage News Category",
					"desc" => "Display news from a specific category.",
					"id" => $shortname."_news_category",
					"std" => "",
					"type" => "select2",
					"options" => $of_categories); 

$options[] = array( "name" => "Homepage News Intro Title",
					"desc" => "Enter the title of your news section intro for the homepage.",
					"id" => $shortname."_news_title",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Homepage News Intro Description",
					"desc" => "Enter the description of your news section intro for the homepage. HTML is allowed.",
					"id" => $shortname."_news_desc",
					"std" => "",
					"type" => "textarea"); 

$options[] = array( "name" => "Homepage News Button Text",
					"desc" => "Leave this blank and no button will appear. The button links to your blog page.",
					"id" => $shortname."_news_button",
					"std" => "",
					"type" => "text");


$url =  get_template_directory_uri() .'/admin/images/icons/';
$options[] = array( "name" => "<img src='".$url."photos.png' class='headingicon'>Portfolio",				 
					"type" => "heading");

$options[] = array( "name" => "Portfolio Title",
					"desc" => "Title of the portfolio section.",
					"id" => $shortname."_portfolio_title",
					"std" => "Featured Projects",
					"type" => "text"); 

$options[] = array( "name" => "Number of Portfolio Slides per Project",
					"desc" => "Keep this as low as you can for memory reasons to keep your load time fast.",
					"id" => $shortname."_thumbnail_number",
					"std" => "6",
					"type" => "text"); 

$options[] = array( "name" => "Crop Portfolio Slides",
					"desc" => "Crop will Make All Slides the Same Height and Automatically Crop.",
					"id" => $shortname."_slide_crop",
					"std" => "Crop",
					"type" => "radio",
					"options" =>  array(
						'Crop' => 'Crop',
						'No Crop' => 'No Crop'
					)); 

$options[] = array( "name" => "Project Slideshows Autoplay",
					"desc" => "Select whether you want your project slideshows to automatically play.",
					"id" => $shortname."_portfolio_autoplay",
					"std" => "true",
					"type" => "radio",
					"options" =>  array(
						'true' => 'On',
						'false' => 'Off'
						));

$options[] = array( "name" => "Portfolio Slideshow Speed",
					"desc" => "Speed of the slideshow autoplay in seconds. Whole numbers only.",
					"id" => $shortname."_project_autoplay_delay",
					"std" => "7",
					"type" => "text"); 

$options[] = array( "name" => "Portfolio Slideshow Lightbox",
					"desc" => "Select whether you want full-size lightbox images to display upon clicking of slide images.",
					"id" => $shortname."_slideshow_popup",
					"std" => "Off",
					"type" => "radio",
					"options" =>  array(
						'On' => 'On',
						'Off' => 'Off'
						));

$options[] = array( "name" => "PrettyPhoto Skin",
					"desc" => "Choose the skin for your PrettyPhoto popups.",
					"id" => $shortname."_prettyphoto_skin",
					"std" => "pp_default",
					"type" => "select2",
					"options" => array(
					'pp_default' => 'Default',	
					'facebook' => 'Facebook',	
					'dark_rounded' => 'Dark Rounded',	
					'dark_square' => 'Dark Square',	
					'light_rounded' => 'Light Rounded',	
					'light_square' => 'Light Square'	
					));

$url =  get_template_directory_uri() .'/admin/images/icons/';
$options[] = array( "name" => "<img src='".$url."email.png' class='headingicon'>Forms",				 
					"type" => "heading");

$options[] = array( "name" => "Contact Email Address",
					"desc" => "Type in the email address you want the contact and quote request forms to mail to.",
					"id" => $shortname."_mail_address",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "Successfully Sent Heading",
					"desc" => "Heading for a successfully sent contact or quote form.",
					"id" => $shortname."_sent_heading",
					"std" => "Thank you for your email.",
					"type" => "text"); 

$options[] = array( "name" => "Successfully Sent Description",
					"desc" => "Heading for a successfully sent contact or quote form.",
					"id" => $shortname."_sent_description",
					"std" => "It will be answered as soon as possible.",
					"type" => "text"); 
	
$options[] = array( "name" => __("Basic Spam Question", "framework"),
				"desc" => "Do you want to add a basic spam question to your form?",
				"id" => $shortname."_spam_question",
				"std" => "off",
				"type" => "radio",
				"options" => array(
					'on' => 'On',	
					'off' => 'Off'	
				));
	
$url =  get_template_directory_uri() .'/admin/images/icons/';
$options[] = array( "name" => "<img src='".$url."font.png' class='headingicon'>Fonts",				 
					"type" => "heading");

$options[] = array( "name" => "Heading Font",
					"desc" => "Font Settings for sitewide fonts excluding the Top Featured Area. For previews, visit <a href='http://www.google.com/webfonts' target='_blank'>The Google Fonts Homepage</a>",
					"id" => $shortname."_heading_font",
					"std" => "Open Sans",
					"type" => "select2",
					"options" => $options_googlefonts); 

$options[] = array( "name" => "Secondary Heading Font",
					"desc" => "Font Settings for sitewide fonts excluding the Top Featured Area. For previews, visit <a href='http://www.google.com/webfonts' target='_blank'>The Google Fonts Homepage</a>",
					"id" => $shortname."_secondary_font",
					"std" => "Open Sans",
					"type" => "select2",	
					"options" => $options_googlefonts);

$options[] = array( "name" => "Tiny Details Font",
					"desc" => "Font Settings for sitewide fonts excluding the Top Featured Area. For previews, visit <a href='http://www.google.com/webfonts' target='_blank'>The Google Fonts Homepage</a>",
					"id" => $shortname."_tiny_font",
					"std" => "Open Sans",
					"type" => "select2",
					"options" => $options_googlefonts); 

$options[] = array( "name" => "Paragraph Font",
					"desc" => "Font Settings for sitewide fonts excluding the Top Featured Area. For previews, visit <a href='http://www.google.com/webfonts' target='_blank'>The Google Fonts Homepage</a>",
					"id" => $shortname."_p_font",
					"std" => "Open Sans",
					"type" => "select2",
					"options" => $options_googlefonts); 


$options[] = array( "name" => "Latin/Cyrillic Character Support",
					"desc" => "Select whether you want Latin/Cyrillic characters in your fonts. Note that some Google fonts don't have these characters, so you'll need to choose ones that do.",
					"id" => $shortname."_cyrillic_chars",
					"std" => "No",
					"type" => "radio",
					"options" =>  array(
						'No' => 'No',
						'Yes' => 'Yes'
						));

$url =  get_template_directory_uri() .'/admin/images/icons/';
$options[] = array( "name" => "<img src='".$url."help.png' class='headingicon'>FAQ",				 
					"type" => "heading");

$options[] = array( "name" => "How do I set up the homepage?",
				    "desc" => "Be sure to check out the documentation included with your theme download for more information (including pictures!)",
					"std" => "To set up the homepage you must create a new page. Navigate to Pages > Add New. 
					You can give this page any title and you do not have to include any content. Select from 'Homepage'
					from the 'Page Attributes' section. Once you've selected 'Homepage' for the 'Page Attributes' section, 
					click publish. Now that you have created your new page which uses a homepage template, navigate to 
					Settings > Reading and configure the 'Front Page Displays' setting. Select the static page option 
					and choose the page you just created as your front page. Your homepage is now created and can be 
					viewed by visiting your root URL. <br /><br />Then you'll just need to add portfolio items, and they will automatically show up on the homepage.",
					"type" => "information"); 

$options[] = array( "name" => "How do I add the 'Read More' buttons?",
					"desc" => "More information here: <br /><a href='http://en.support.wordpress.com/splitting-content/more-tag/'>The Wordpress 'More' Tag</a>",
					"std" => "The 'read more' button is just created by inserting the 'more' tag 
					in the WYSIWYG editor of your post. It's part of wordpress default functionality
				    - just look for the button on the top row near the end of the WYSIWYG editor. 
					That will automatically create the break between the post overview and 
					single post with a 'read more' button that links the two.",
					"type" => "information"); 

$options[] = array( "name" => "How do I add skill pages / skills to the menu?",
					"std" => "When you add 'skills' to the menu the link automatically creates a page for you.  
					Go to Appearance > Menus.  In the upper right hand corner, select 'screen options'.  Check the 'sort' box.  
					Once you have checked off 'sort' then skills will show up as an option on the left hand side of the
					Appearance > Menus page. Simply click off the SKILLS you want and then ADD TO MENU. Don't forget to save the menu. 
					Now, when you click those links on the front-end of the site, the theme will automatically display projects with those skill-types.",
					"type" => "information"); 

$options[] = array( "name" => "Why aren't any projects showing up on the homepage?",
					"std" => "First, be sure that you've added 'Portfolio' items to your theme, and have included a 'featured image' for each one.
					If they still aren't showing up on the homepage, chances are there's a javascript conflict with an enabled plugin. Try disabling
					all plugins momentarily to see if that fixes the issue.",
					"type" => "information"); 

$options[] = array( "name" => "Why am I getting a 404 error for portfolio pages?",
					"std" => "You can't have the same Category Prefix or Page Slug as the slug of a custom post type (portfolio). 
					If you do, Wordpress won't know which you're referring to (the page, post type, or category prefix). 
					You'll have to remove anything from your category prefix, and also change the url of your 'portfolio' page to anything except for '/portfolio'.",
					"type" => "information"); 

$options[] = array( "name" => "Why are my homepage thumbnails different sizes",
					"std" => "Chances are your wordpress install isn't creating thumbnails properly. This can be caused by a few things:<br /><br />
					1) Your uploads folder needs 777 (read, write, execute) permissions for wordpress to make thumbnails 
					for you. Double check your uploads folder in your wordpress install to make sure it has the proper permissions.
					<br /><br />
					2) Your php version needs 'GD' to create thumbnails (and is a wordpress requirement). Double check to 
					make sure that your hosting provider has the latest version of php with 'GD'.",
					"type" => "information"); 
					
$options[] = array( "name" => "Why am I seeing 'top_nav_menu is undefined'? or <br />How can I get rid of 'Top Panel' from the navigation menu?",
					"std" => "To setup your custom menus, navigate to Appearance > Menus. Give your menu a name and 
					create your menu items using the items on the left-hand side. You can add a variety of items including pages, categories, custom links. 
					Once you've added all your items to your menu, be sure to click 'Save Menu'.  Then, set your menu by selecting it for the Top Navigation Menu in the 'Theme Locations' box in the upper left hand side of the screen and click 'Save'.",
					"type" => "information"); 

$options[] = array( "name" => "Additional Questions",
					"std" => "To provide you with more efficient, searchable support topics, I've set up an <a href='http://themewich.com/forum' target='_blank'>Online Support Forum</a>. Feel free to start a new thread over there and I'd be happy to assist!  
 					<br /><br />
<a href='http://themewich.com/forum' target='_blank'>Support Forum</a> |  <a href='http://themewich.com/account/create/' target='_blank'>Create an Account</a> | <a href='http://dl.dropbox.com/u/32356665/item-code.jpg' target='_blank'>Find your Item 'Purchase  Code'</a>",
					"type" => "information"); 
	
$options[] = array( "name" => "<img src='".$url."update.png' class='headingicon'>".__("Updates", "framework"),				 
					"type" => "heading");

$options[] = array( "name" => __("Themeforest Username", "framework"),
					"desc" => "Enter your Themeforest Username that you used to purchase the this theme.",
					"id" => $shortname."_tf_username",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => __("Themeforest API Key", "framework"),
					"desc" => "You can find your API key by Logging into Themeforest, visiting your Dashboard page then clicking the My Settings tab. At the bottom of the page you will find your account API key and a button to regenerate it as needed.",
					"id" => $shortname."_tf_api",
					"std" => "",
					"type" => "text"); 




update_option('of_template',$options); 					  
update_option('of_themename',$themename);   
update_option('of_shortname',$shortname);

}
}
?>
