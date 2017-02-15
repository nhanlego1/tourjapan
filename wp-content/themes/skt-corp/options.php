<?php 

/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */ 

function optionsframework_option_name() {
	// Change this to use your theme slug
	return 'skt-corp';
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'skt-corp'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	//array of all custom font types.
	$font_types = array( 'Arial' => 'Arial',
		'Comic Sans MS' => 'Comic Sans MS',
		'FreeSans' => 'FreeSans',
		'Georgia' => 'Georgia',
		'Lucida Sans Unicode' => 'Lucida Sans Unicode',
		'Palatino Linotype' => 'Palatino Linotype',
		'Symbol' => 'Symbol',
		'Tahoma' => 'Tahoma',
		'Trebuchet MS' => 'Trebuchet MS',
		'Verdana' => 'Verdana',
		'ABeeZee' => 'ABeeZee',
		'Abel' => 'Abel',
		'Abril Fatface' => 'Abril Fatface',
		'Aclonica' => 'Aclonica',
		'Acme' => 'Acme',
		'Actor' => 'Actor',
		'Adamina' => 'Adamina',
		'Advent Pro' => 'Advent Pro',
		'Aguafina Script' => 'Aguafina Script',
		'Akronim' => 'Akronim',
		'Aladin' => 'Aladin',
		'Aldrich' => 'Aldrich',
		'Alegreya' => 'Alegreya',
		'Alegreya SC' => 'Alegreya SC',
		'Alex Brush' => 'Alex Brush',
		'Alfa Slab One' => 'Alfa Slab One',
		'Alice' => 'Alice',
		'Alike' => 'Alike',
		'Alike Angular' => 'Alike Angular',
		'Allan' => 'Allan',
		'Allerta' => 'Allerta',
		'Allerta Stencil' => 'Allerta Stencil',
		'Allura' => 'Allura',
		'Almendra' => 'Almendra',
		'Almendra Display' => 'Almendra Display',
		'Almendra SC' => 'Almendra SC',
		'Amarante' => 'Amarante',
		'Amaranth' => 'Amaranth',
		'Amatic SC' => 'Amatic SC',
		'Amethysta' => 'Amethysta',
		'Anaheim' => 'Anaheim',
		'Andada' => 'Andada',
		'Andika' => 'Andika',
		'Annie Use Your Telescope' => 'Annie Use Your Telescope',
		'Anonymous Pro' => 'Anonymous Pro',
		'Antic' => 'Antic',
		'Antic Didone' => 'Antic Didone',
		'Antic Slab' => 'Antic Slab',
		'Anton' => 'Anton',
		'Arapey' => 'Arapey',
		'Arbutus' => 'Arbutus',
		'Arbutus Slab' => 'Arbutus Slab',
		'Architects Daughter' => 'Architects Daughter',
		'Archivo Black' => 'Archivo Black',
		'Archivo Narrow' => 'Archivo Narrow',
		'Arimo' => 'Arimo',
		'Arizonia' => 'Arizonia',
		'Armata' => 'Armata',
		'Artifika' => 'Artifika',
		'Arvo' => 'Arvo',
		'Asap' => 'Asap',
		'Asset' => 'Asset',
		'Astloch' => 'Astloch',
		'Asul' => 'Asul',
		'Atomic Age' => 'Atomic Age',
		'Aubrey' => 'Aubrey',
		'Audiowide' => 'Audiowide',
		'Autour One' => 'Autour One',
		'Average' => 'Average',
		'Average Sans' => 'Average Sans',
		'Averia Gruesa Libre' => 'Averia Gruesa Libre',
		'Averia Libre' => 'Averia Libre',
		'Averia Sans Libre' => 'Averia Sans Libre',
		'Averia Serif Libre' => 'Averia Serif Libre',
		'Bad Script' => 'Bad Script',
		'Balthazar' => 'Balthazar',
		'Bangers' => 'Bangers',
		'Basic' => 'Basic',
		'Baumans' => 'Baumans',
		'Belgrano' => 'Belgrano',
		'Belleza' => 'Belleza',
		'BenchNine' => 'BenchNine',
		'Bentham' => 'Bentham',
		'Berkshire Swash' => 'Berkshire Swash',
		'Bevan' => 'Bevan',
		'Bigelow Rules' => 'Bigelow Rules',
		'Bigshot One' => 'Bigshot One',
		'Bilbo' => 'Bilbo',
		'Bilbo Swash Caps' => 'Bilbo Swash Caps',
		'Bitter' => 'Bitter',
		'Black Ops One' => 'Black Ops One',
		'Bonbon' => 'Bonbon',
		'Boogaloo' => 'Boogaloo',
		'Bowlby One' => 'Bowlby One',
		'Bowlby One SC' => 'Bowlby One SC',
		'Brawler' => 'Brawler',
		'Bree Serif' => 'Bree Serif',
		'Bubblegum Sans' => 'Bubblegum Sans',
		'Bubbler One' => 'Bubbler One',
		'Buda' => 'Buda',
		'Buenard' => 'Buenard',
		'Butcherman' => 'Butcherman',
		'Butcherman Caps' => 'Butcherman Caps',
		'Butterfly Kids' => 'Butterfly Kids',
		'Cabin' => 'Cabin',
		'Cabin Condensed' => 'Cabin Condensed',
		'Cabin Sketch' => 'Cabin Sketch',
		'Cabin' => 'Cabin',
		'Caesar Dressing' => 'Caesar Dressing',
		'Cagliostro' => 'Cagliostro',
		'Calligraffitti' => 'Calligraffitti',
		'Cambo' => 'Cambo',
		'Candal' => 'Candal',
		'Cantarell' => 'Cantarell',
		'Cantata One' => 'Cantata One',
		'Cantora One' => 'Cantora One',
		'Capriola' => 'Capriola',
		'Cardo' => 'Cardo',
		'Carme' => 'Carme',
		'Carrois Gothic' => 'Carrois Gothic',
		'Carrois Gothic SC' => 'Carrois Gothic SC',
		'Carter One' => 'Carter One',
		'Caudex' => 'Caudex',
		'Cedarville Cursive' => 'Cedarville Cursive',
		'Ceviche One' => 'Ceviche One',
		'Changa One' => 'Changa One',
		'Chango' => 'Chango',
		'Chau Philomene One' => 'Chau Philomene One',
		'Chela One' => 'Chela One',
		'Chelsea Market' => 'Chelsea Market',
		'Cherry Cream Soda' => 'Cherry Cream Soda',
		'Cherry Swash' => 'Cherry Swash',
		'Chewy' => 'Chewy',
		'Chicle' => 'Chicle',
		'Chivo' => 'Chivo',
		'Cinzel' => 'Cinzel',
		'Cinzel Decorative' => 'Cinzel Decorative',
		'Clicker Script' => 'Clicker Script',
		'Coda' => 'Coda',
		'Codystar' => 'Codystar',
		'Combo' => 'Combo',
		'Comfortaa' => 'Comfortaa',
		'Coming Soon' => 'Coming Soon',
		'Condiment' => 'Condiment',
		'Contrail One' => 'Contrail One',
		'Convergence' => 'Convergence',
		'Cookie' => 'Cookie',
		'Copse' => 'Copse',
		'Corben' => 'Corben',
		'Courgette' => 'Courgette',
		'Cousine' => 'Cousine',
		'Coustard' => 'Coustard',
		'Covered By Your Grace' => 'Covered By Your Grace',
		'Crafty Girls' => 'Crafty Girls',
		'Creepster' => 'Creepster',
		'Creepster Caps' => 'Creepster Caps',
		'Crete Round' => 'Crete Round',
		'Crimson' => 'Crimson',
		'Croissant One' => 'Croissant One',
		'Crushed' => 'Crushed',
		'Cuprum' => 'Cuprum',
		'Cutive' => 'Cutive',
		'Cutive Mono' => 'Cutive Mono',
		'Damion' => 'Damion',
		'Dancing Script' => 'Dancing Script',
		'Dawning of a New Day' => 'Dawning of a New Day',
		'Days One' => 'Days One',
		'Delius' => 'Delius',
		'Delius Swash Caps' => 'Delius Swash Caps',
		'Delius Unicase' => 'Delius Unicase',
		'Della Respira' => 'Della Respira',
		'Denk One' => 'Denk One',
		'Devonshire' => 'Devonshire',
		'Didact Gothic' => 'Didact Gothic',
		'Diplomata' => 'Diplomata',
		'Diplomata SC' => 'Diplomata SC',
		'Domine' => 'Domine',
		'Donegal One' => 'Donegal One',
		'Doppio One' => 'Doppio One',
		'Dorsa' => 'Dorsa',
		'Dosis' => 'Dosis',
		'Dr Sugiyama' => 'Dr Sugiyama',
		'Droid Sans' => 'Droid Sans',
		'Droid Sans Mono' => 'Droid Sans Mono',
		'Droid Serif' => 'Droid Serif',
		'Duru Sans' => 'Duru Sans',
		'Dynalight' => 'Dynalight',
		'EB Garamond' => 'EB Garamond',
		'Eagle Lake' => 'Eagle Lake',
		'Eater' => 'Eater',
		'Eater Caps' => 'Eater Caps',
		'Economica' => 'Economica',
		'Electrolize' => 'Electrolize',
		'Elsie' => 'Elsie',
		'Elsie Swash Caps' => 'Elsie Swash Caps',
		'Emblema One' => 'Emblema One',
		'Emilys Candy' => 'Emilys Candy',
		'Engagement' => 'Engagement',
		'Englebert' => 'Englebert',
		'Enriqueta' => 'Enriqueta',
		'Erica One' => 'Erica One',
		'Esteban' => 'Esteban',
		'Euphoria Script' => 'Euphoria Script',
		'Ewert' => 'Ewert',
		'Exo' => 'Exo',
		'Expletus Sans' => 'Expletus Sans',
		'Fanwood Text' => 'Fanwood Text',
		'Fascinate' => 'Fascinate',
		'Fascinate Inline' => 'Fascinate Inline',
		'Faster One' => 'Faster One',
		'Federant' => 'Federant',
		'Federo' => 'Federo',
		'Felipa' => 'Felipa',
		'Fenix' => 'Fenix',
		'Finger Paint' => 'Finger Paint',
		'Fjalla One' => 'Fjalla One',
		'Fjord One' => 'Fjord One',
		'Flamenco' => 'Flamenco',
		'Flavors' => 'Flavors',
		'Fondamento' => 'Fondamento',
		'Fontdiner Swanky' => 'Fontdiner Swanky',
		'Forum' => 'Forum',
		'Francois One' => 'Francois One',
		'Freckle Face' => 'Freckle Face',
		'Fredericka the Great' => 'Fredericka the Great',
		'Fredoka One' => 'Fredoka One',
		'Fresca' => 'Fresca',
		'Frijole' => 'Frijole',
		'Fruktur' => 'Fruktur',
		'Fugaz One' => 'Fugaz One',
		'Gafata' => 'Gafata',
		'Galdeano' => 'Galdeano',
		'Galindo' => 'Galindo',
		'Gentium Basic' => 'Gentium Basic',
		'Gentium Book Basic' => 'Gentium Book Basic',
		'Geo' => 'Geo',
		'Geostar' => 'Geostar',
		'Geostar Fill' => 'Geostar Fill',
		'Germania One' => 'Germania One',
		'Gilda Display' => 'Gilda Display',
		'Give You Glory' => 'Give You Glory',
		'Glass Antiqua' => 'Glass Antiqua',
		'Glegoo' => 'Glegoo',
		'Gloria Hallelujah' => 'Gloria Hallelujah',
		'Goblin One' => 'Goblin One',
		'Gochi Hand' => 'Gochi Hand',
		'Gorditas' => 'Gorditas',
		'Goudy Bookletter 1911' => 'Goudy Bookletter 1911',
		'Graduate' => 'Graduate',
		'Grand Hotel' => 'Grand Hotel',
		'Gravitas One' => 'Gravitas One',
		'Great Vibes' => 'Great Vibes',
		'Griffy' => 'Griffy',
		'Gruppo' => 'Gruppo',
		'Gudea' => 'Gudea',
		'Habibi' => 'Habibi',
		'Hammersmith One' => 'Hammersmith One',
		'Hanalei' => 'Hanalei',
		'Hanalei Fill' => 'Hanalei Fill',
		'Handlee' => 'Handlee',
		'Happy Monkey' => 'Happy Monkey',
		'Headland One' => 'Headland One',
		'Henny Penny' => 'Henny Penny',
		'Herr Von Muellerhoff' => 'Herr Von Muellerhoff',
		'Holtwood One SC' => 'Holtwood One SC',
		'Homemade Apple' => 'Homemade Apple',
		'Homenaje' => 'Homenaje',
		'IM Fell' => 'IM Fell',
		'Iceberg' => 'Iceberg',
		'Iceland' => 'Iceland',
		'Imprima' => 'Imprima',
		'Inconsolata' => 'Inconsolata',
		'Inder' => 'Inder',
		'Indie Flower' => 'Indie Flower',
		'Inika' => 'Inika',
		'Irish Growler' => 'Irish Growler',
		'Istok Web' => 'Istok Web',
		'Italiana' => 'Italiana',
		'Italianno' => 'Italianno',
		'Jacques Francois' => 'Jacques Francois',
		'Jacques Francois Shadow' => 'Jacques Francois Shadow',
		'Jim Nightshade' => 'Jim Nightshade',
		'Jockey One' => 'Jockey One',
		'Jolly Lodger' => 'Jolly Lodger',
		'Josefin Sans' => 'Josefin Sans',
		'Josefin Sans' => 'Josefin Sans',
		'Josefin Slab' => 'Josefin Slab',
		'Joti One' => 'Joti One',
		'Judson' => 'Judson',
		'Julee' => 'Julee',
		'Julius Sans One' => 'Julius Sans One',
		'Junge' => 'Junge',
		'Jura' => 'Jura',
		'Just Another Hand' => 'Just Another Hand',
		'Just Me Again Down Here' => 'Just Me Again Down Here',
		'Kameron' => 'Kameron',
		'Karla' => 'Karla',
		'Kaushan Script' => 'Kaushan Script',
		'Kavoon' => 'Kavoon',
		'Keania One' => 'Keania One',
		'Kelly Slab' => 'Kelly Slab',
		'Kenia' => 'Kenia',
		'Kite One' => 'Kite One',
		'Knewave' => 'Knewave',
		'Kotta One' => 'Kotta One',
		'Kranky' => 'Kranky',
		'Kreon' => 'Kreon',
		'Kristi' => 'Kristi',
		'Krona One' => 'Krona One',
		'La Belle Aurore' => 'La Belle Aurore',
		'Lancelot' => 'Lancelot',
		'Lato' => 'Lato',
		'League Script' => 'League Script',
		'Leckerli One' => 'Leckerli One',
		'Ledger' => 'Ledger',
		'Lekton' => 'Lekton',
		'Lemon' => 'Lemon',
		'Libre Baskerville' => 'Libre Baskerville',
		'Life Savers' => 'Life Savers',
		'Lilita One' => 'Lilita One',
		'Limelight' => 'Limelight',
		'Linden Hill' => 'Linden Hill',
		'Lobster' => 'Lobster',
		'Lobster Two' => 'Lobster Two',
		'Londrina Outline' => 'Londrina Outline',
		'Londrina Shadow' => 'Londrina Shadow',
		'Londrina Sketch' => 'Londrina Sketch',
		'Londrina Solid' => 'Londrina Solid',
		'Lora' => 'Lora',
		'Love Ya Like A Sister' => 'Love Ya Like A Sister',
		'Loved by the King' => 'Loved by the King',
		'Lovers Quarrel' => 'Lovers Quarrel',
		'Luckiest Guy' => 'Luckiest Guy',
		'Lusitana' => 'Lusitana',
		'Lustria' => 'Lustria',
		'Macondo' => 'Macondo',
		'Macondo Swash Caps' => 'Macondo Swash Caps',
		'Magra' => 'Magra',
		'Maiden Orange' => 'Maiden Orange',
		'Mako' => 'Mako',
		'Marcellus' => 'Marcellus',
		'Marcellus SC' => 'Marcellus SC',
		'Marck Script' => 'Marck Script',
		'Margarine' => 'Margarine',
		'Marko One' => 'Marko One',
		'Marmelad' => 'Marmelad',
		'Marvel' => 'Marvel',
		'Mate' => 'Mate',
		'Mate SC' => 'Mate SC',
		'Maven Pro' => 'Maven Pro',
		'McLaren' => 'McLaren',
		'Meddon' => 'Meddon',
		'MedievalSharp' => 'MedievalSharp',
		'Medula One' => 'Medula One',
		'Megrim' => 'Megrim',
		'Meie Script' => 'Meie Script',
		'Merienda' => 'Merienda',
		'Merienda One' => 'Merienda One',
		'Merriweather' => 'Merriweather',
		'Metal Mania' => 'Metal Mania',
		'Metamorphous' => 'Metamorphous',
		'Metrophobic' => 'Metrophobic',
		'Michroma' => 'Michroma',
		'Milonga' => 'Milonga',
		'Miltonian' => 'Miltonian',
		'Miltonian Tattoo' => 'Miltonian Tattoo',
		'Miniver' => 'Miniver',
		'Miss Fajardose' => 'Miss Fajardose',
		'Miss Saint Delafield' => 'Miss Saint Delafield',
		'Modern Antiqua' => 'Modern Antiqua',
		'Molengo' => 'Molengo',
		'Molle' => 'Molle',
		'Monda' => 'Monda',
		'Monofett' => 'Monofett',
		'Monoton' => 'Monoton',
		'Monsieur La Doulaise' => 'Monsieur La Doulaise',
		'Montaga' => 'Montaga',
		'Montez' => 'Montez',
		'Montserrat' => 'Montserrat',
		'Montserrat Alternates' => 'Montserrat Alternates',
		'Montserrat Subrayada' => 'Montserrat Subrayada',
		'Mountains of Christmas' => 'Mountains of Christmas',
		'Mouse Memoirs' => 'Mouse Memoirs',
		'Mr Bedford' => 'Mr Bedford',
		'Mr Bedfort' => 'Mr Bedfort',
		'Mr Dafoe' => 'Mr Dafoe',
		'Mr De Haviland' => 'Mr De Haviland',
		'Mrs Saint Delafield' => 'Mrs Saint Delafield',
		'Mrs Sheppards' => 'Mrs Sheppards',
		'Muli' => 'Muli',
		'Mystery Quest' => 'Mystery Quest',
		'Neucha' => 'Neucha',
		'Neuton' => 'Neuton',
		'New Rocker' => 'New Rocker',
		'News Cycle' => 'News Cycle',
		'Niconne' => 'Niconne',
		'Nixie One' => 'Nixie One',
		'Nobile' => 'Nobile',
		'Norican' => 'Norican',
		'Nosifer' => 'Nosifer',
		'Nosifer Caps' => 'Nosifer Caps',
		'Noticia Text' => 'Noticia Text',
		'Nova Round' => 'Nova Round',
		'Numans' => 'Numans',
		'Nunito' => 'Nunito',
		'Offside' => 'Offside',
		'Oldenburg' => 'Oldenburg',
		'Oleo Script' => 'Oleo Script',
		'Oleo Script Swash Caps' => 'Oleo Script Swash Caps',
		'Open Sans' => 'Open Sans',
		'Open Sans Condensed' => 'Open Sans Condensed',
		'Oranienbaum' => 'Oranienbaum',
		'Orbitron' => 'Orbitron',
		'Oregano' => 'Oregano',
		'Orienta' => 'Orienta',
		'Original Surfer' => 'Original Surfer',
		'Oswald' => 'Oswald',
		'Over the Rainbow' => 'Over the Rainbow',
		'Overlock' => 'Overlock',
		'Overlock SC' => 'Overlock SC',
		'Ovo' => 'Ovo',
		'Oxygen' => 'Oxygen',
		'Oxygen Mono' => 'Oxygen Mono',
		'PT Mono' => 'PT Mono',
		'PT Sans' => 'PT Sans',
		'PT Sans Narrow' => 'PT Sans Narrow',
		'PT Serif' => 'PT Serif',
		'PT Serif Caption' => 'PT Serif Caption',
		'Pacifico' => 'Pacifico',
		'Paprika' => 'Paprika',
		'Parisienne' => 'Parisienne',
		'Passero One' => 'Passero One',
		'Passion One' => 'Passion One',
		'Patrick Hand' => 'Patrick Hand',
		'Patua One' => 'Patua One',
		'Paytone One' => 'Paytone One',
		'Peralta' => 'Peralta',
		'Permanent Marker' => 'Permanent Marker',
		'Petit Formal Script' => 'Petit Formal Script',
		'Petrona' => 'Petrona',
		'Philosopher' => 'Philosopher',
		'Piedra' => 'Piedra',
		'Pinyon Script' => 'Pinyon Script',
		'Pirata One' => 'Pirata One',
		'Plaster' => 'Plaster',
		'Play' => 'Play',
		'Playball' => 'Playball',
		'Playfair Display' => 'Playfair Display',
		'Playfair Display SC' => 'Playfair Display SC',
		'Podkova' => 'Podkova',
		'Poiret One' => 'Poiret One',
		'Poller One' => 'Poller One',
		'Poly' => 'Poly',
		'Pompiere' => 'Pompiere',
		'Pontano Sans' => 'Pontano Sans',
		'Port Lligat Sans' => 'Port Lligat Sans',
		'Port Lligat Slab' => 'Port Lligat Slab',
		'Prata' => 'Prata',
		'Press Start 2P' => 'Press Start 2P',
		'Princess Sofia' => 'Princess Sofia',
		'Prociono' => 'Prociono',
		'Prosto One' => 'Prosto One',
		'Puritan' => 'Puritan',
		'Purple Purse' => 'Purple Purse',
		'Quando' => 'Quando',
		'Quantico' => 'Quantico',
		'Quattrocento' => 'Quattrocento',
		'Quattrocento Sans' => 'Quattrocento Sans',
		'Questrial' => 'Questrial',
		'Quicksand' => 'Quicksand',
		'Quintessential' => 'Quintessential',
		'Qwigley' => 'Qwigley',
		'Racing Sans One' => 'Racing Sans One',
		'Radley' => 'Radley',
		'Raleway Dots' => 'Raleway Dots',
		'Raleway' => 'Raleway',
		'Rambla' => 'Rambla',
		'Rammetto One' => 'Rammetto One',
		'Ranchers' => 'Ranchers',
		'Rancho' => 'Rancho',
		'Rationale' => 'Rationale',
		'Redressed' => 'Redressed',
		'Reenie Beanie' => 'Reenie Beanie',
		'Revalia' => 'Revalia',
		'Ribeye' => 'Ribeye',
		'Ribeye Marrow' => 'Ribeye Marrow',
		'Righteous' => 'Righteous',
		'Risque' => 'Risque',
		'Roboto' => 'Roboto',
		'Roboto Condensed' => 'Roboto Condensed',
		'Rochester' => 'Rochester',
		'Rock Salt' => 'Rock Salt',
		'Rokkitt' => 'Rokkitt',
		'Romanesco' => 'Romanesco',
		'Ropa Sans' => 'Ropa Sans',
		'Rosario' => 'Rosario',
		'Rosarivo' => 'Rosarivo',
		'Rouge Script' => 'Rouge Script',
		'Ruda' => 'Ruda',
		'Rufina' => 'Rufina',
		'Ruge Boogie' => 'Ruge Boogie',
		'Ruluko' => 'Ruluko',
		'Rum Raisin' => 'Rum Raisin',
		'Ruslan Display' => 'Ruslan Display',
		'Russo One' => 'Russo One',
		'Ruthie' => 'Ruthie',
		'Rye' => 'Rye',
		'Sacramento' => 'Sacramento',
		'Sail' => 'Sail',
		'Salsa' => 'Salsa',
		'Sanchez' => 'Sanchez',
		'Sancreek' => 'Sancreek',
		'Sansita One' => 'Sansita One',
		'Sarina' => 'Sarina',
		'Satisfy' => 'Satisfy',
		'Scada' => 'Scada',
		'Schoolbell' => 'Schoolbell',
		'Seaweed Script' => 'Seaweed Script',
		'Sevillana' => 'Sevillana',
		'Seymour One' => 'Seymour One',
		'Shadows Into Light' => 'Shadows Into Light',
		'Shadows Into Light Two' => 'Shadows Into Light Two',
		'Shanti' => 'Shanti',
		'Share' => 'Share',
		'Share Tech' => 'Share Tech',
		'Share Tech Mono' => 'Share Tech Mono',
		'Shojumaru' => 'Shojumaru',
		'Short Stack' => 'Short Stack',
		'Sigmar One' => 'Sigmar One',
		'Signika' => 'Signika',
		'Signika Negative' => 'Signika Negative',
		'Simonetta' => 'Simonetta',
		'Sirin Stencil' => 'Sirin Stencil',
		'Six Caps' => 'Six Caps',
		'Skranji' => 'Skranji',
		'Slackey' => 'Slackey',
		'Smokum' => 'Smokum',
		'Smythe' => 'Smythe',
		'Sniglet' => 'Sniglet',
		'Snippet' => 'Snippet',
		'Snowburst One' => 'Snowburst One',
		'Sofadi One' => 'Sofadi One',
		'Sofia' => 'Sofia',
		'Sonsie One' => 'Sonsie One',
		'Sorts Mill Goudy' => 'Sorts Mill Goudy',
		'Sorts Mill Goudy' => 'Sorts Mill Goudy',
		'Source Code Pro' => 'Source Code Pro',
		'Source Sans Pro' => 'Source Sans Pro',
		'Special Elite' => 'Special Elite',
		'Spicy Rice' => 'Spicy Rice',
		'Spinnaker' => 'Spinnaker',
		'Spirax' => 'Spirax',
		'Squada One' => 'Squada One',
		'Stalemate' => 'Stalemate',
		'Stalinist One' => 'Stalinist One',
		'Stardos Stencil' => 'Stardos Stencil',
		'Stint Ultra Condensed' => 'Stint Ultra Condensed',
		'Stint Ultra Expanded' => 'Stint Ultra Expanded',
		'Stoke' => 'Stoke',
		'Stoke' => 'Stoke',
		'Strait' => 'Strait',
		'Sue Ellen Francisco' => 'Sue Ellen Francisco',
		'Sunshiney' => 'Sunshiney',
		'Supermercado One' => 'Supermercado One',
		'Swanky and Moo Moo' => 'Swanky and Moo Moo',
		'Syncopate' => 'Syncopate',
		'Tangerine' => 'Tangerine',
		'Telex' => 'Telex',
		'Tenor Sans' => 'Tenor Sans',
		'Terminal Dosis' => 'Terminal Dosis',
		'Terminal Dosis Light' => 'Terminal Dosis Light',
		'Text Me One' => 'Text Me One',
		'The Girl Next Door' => 'The Girl Next Door',
		'Tienne' => 'Tienne',
		'Tinos' => 'Tinos',
		'Titan One' => 'Titan One',
		'Titillium Web' => 'Titillium Web',
		'Trade Winds' => 'Trade Winds',
		'Trocchi' => 'Trocchi',
		'Trochut' => 'Trochut',
		'Trykker' => 'Trykker',
		'Tulpen One' => 'Tulpen One',
		'Ubuntu' => 'Ubuntu',
		'Ubuntu Condensed' => 'Ubuntu Condensed',
		'Ubuntu Mono' => 'Ubuntu Mono',
		'Ultra' => 'Ultra',
		'Uncial Antiqua' => 'Uncial Antiqua',
		'Underdog' => 'Underdog',
		'Unica One' => 'Unica One',
		'UnifrakturCook' => 'UnifrakturCook',
		'UnifrakturMaguntia' => 'UnifrakturMaguntia',
		'Unkempt' => 'Unkempt',
		'Unlock' => 'Unlock',
		'Unna' => 'Unna',
		'VT323' => 'VT323',
		'Vampiro One' => 'Vampiro One',
		'Varela' => 'Varela',
		'Varela Round' => 'Varela Round',
		'Vast Shadow' => 'Vast Shadow',
		'Vibur' => 'Vibur',
		'Vidaloka' => 'Vidaloka',
		'Viga' => 'Viga',
		'Voces' => 'Voces',
		'Volkhov' => 'Volkhov',
		'Vollkorn' => 'Vollkorn',
		'Voltaire' => 'Voltaire',
		'Waiting for the Sunrise' => 'Waiting for the Sunrise',
		'Wallpoet' => 'Wallpoet',
		'Walter Turncoat' => 'Walter Turncoat',
		'Warnes' => 'Warnes',
		'Wellfleet' => 'Wellfleet',
		'Wendy One' => 'Wendy One',
		'Wire One' => 'Wire One',
		'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
		'Yellowtail' => 'Yellowtail',
		'Yeseva One' => 'Yeseva One',
		'Yesteryear' => 'Yesteryear',
		'Zeyada' => 'Zeyada'
	);

	//array of all font sizes.
	$font_sizes = array( 
		'10px' => '10px',
		'11px' => '11px',
	);
	for($n=12;$n<=100;$n+=2){
		$font_sizes[$n.'px'] = $n.'px';
	}

	// array of section content.
	$section_text = array(
		1 => array(
			'section_title'	=> '',
			'bgcolor' 		=> '#ffffff',
			'bgimage'		=> '',
			'class'			=> 'welcome_text1',
			'content'		=> '<section id="aboutUs">
<div class="container">
<div class="row">
<!-- Start about us area -->
<div class="col-lg-6 col-md-6 col-sm-6 tab_left">
  <div class="aboutus_area wow fadeInLeft animated" style="visibility: visible; animation-name: fadeInLeft;">
    <h2 class="titile">JAPAN TRAVEL GUIDE.navi！？ </h2>
    <p class="bg_red">ジャパントラベルガイド.naviは、日本を訪れる訪日外国人（ゲスト）とあなたの”ふるさと”や”街”を案内する通訳ガイド（ホスト）のマッチング・ポータルサイトです。
    <br><b>「地元の人しか知らないおいしいラーメン屋さんに連れてって！」<br> 「1日予定が空いたので、ぶらりと街を案内して欲しい！」<br> 「田舎に行って、人とのふれあいを感じられる体験や交流がしたい！」<br> 「ガイドブックには載っていない、日本の穴場スポットを紹介して！」 </b><br>
    などなど、そんな外国人の皆様のためのサイトです。ホストは友人感覚で日本の旅のお手伝いをいたします。
    <br>
    また、旅行代理店や各地方自治体と提携し”日本らしい！日本でしか体験することのできない♪”体験ツアーや各種アクティビティの紹介も行います。<br>
    その他、せっかく日本に来てみたものの「宿泊先がない！！」なんていう外国人の皆様に対し、宿泊先（ゲストハウス）のご紹介もしています。現在、日本では宿泊先が不足しています。特に”東京・大阪・名古屋”などの首都圏での宿泊先不足は深刻です。ジャパントラベルガイド.naviはホテルや旅館に代わる宿泊先の情報も提供いたします。
　　　　魅力あふれる日本の旅を是非お楽しみ下さい！！</p>
  </div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 tab_right">
  <div class="newsfeed_area wow fadeInRight animated" style="visibility: visible; animation-name: fadeInRight;">
    <ul class="nav nav-tabs feed_tabs" id="myTab2">
      <li class=""><a href="#notice" data-toggle="tab" aria-expanded="false">Blog</a>
      </li><li class=""><a href="#news" data-toggle="tab" aria-expanded="false">News</a>  
      </li><li class="active"><a href="#events" data-toggle="tab" aria-expanded="true">Events</a> 
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content bg_red_tab">
      <!-- Start notice tab content -->
      <div class="tab-pane fade" id="notice">
       <ul class="news_tab">
          <li>
          <div class="media">
            <div class="media-left"><a class="news_img" href="#"><img class="media-object" src="img/food1.jpg" alt="img"> </a></div>
            <div class="media-body"><a href="blog-archive2.html" tabindex="0"><b>日本全国ラーメン特集！！</b></a><br>
              <p class="food_des">日本全国の寿司をご紹介！！食べ方からご当地ネタ、専門用語まで外国人向け寿司パーフェクトガイド！！</p>
              </div>
          </div>
          </li><li>
          <div class="media">
            <div class="media-left"><a class="news_img" href="#"><img class="media-object" src="img/food2.jpg" alt="img"> </a></div>
            <div class="media-body"><a href="blog-archive2.html" tabindex="0"><b>日本寿司特集！！</b></a><br>
              <p class="food_des">日本全国のご当地ラーメンを写真付きでご紹介！！外国人向けラーメンパーフェクトガイド！！</p>
              </div>
          </div>
          </li><li>
          <div class="media">
            <div class="media-left"><a class="news_img" href="#"><img class="media-object" src="img/food3.jpg" alt="img"> </a></div>
            <div class="media-body"><a href="blog-archive2.html" tabindex="0"><b>日本酒特集！！</b></a><br>
              <p class="food_des">日本酒を写真付きでご紹介！！外国人向け日本酒パーフェクトガイド！！</p>
              </div>
          </div>
        </li></ul>
      </div>
      <!-- Start news tab content -->
      <div class="tab-pane fade" id="news">
        <ul class="news_tab">
          <li>
          <div class="media">
            <div class="media-left"><a class="news_img" href="#"><img class="media-object" src="img/news1.jpg" alt="img"> </a></div>
            <div class="media-body"><a href="tour_details">温泉がいい値！　群馬　草津温泉</a> <span class="feed_date">27.02.15</span> </div>
          </div>
          </li><li>
          <div class="media">
            <div class="media-left"><a class="news_img" href="#"><img class="media-object" src="img/news2.jpg" alt="img"> </a></div>
            <div class="media-body"><a href="tour_details">温泉がいい値！　群馬　草津温泉</a> <span class="feed_date">28.02.15</span> </div>
          </div>
          </li><li>
          <div class="media">
            <div class="media-left"><a class="news_img" href="#"><img class="media-object" src="img/news3.jpg" alt="img"> </a></div>
            <div class="media-body"><a href="tour_details">南風！残波でバラエティ豊富なダイビング！</a> <span class="feed_date">28.02.15</span> </div>
          </div>
        </li></ul>
        <a class="see_all" href="tour_list.html">ツアーリスト</a>
      </div>
      <!-- Start events tab content -->
      <div class="tab-pane fade active in" id="events">
        <ul class="events_tab">
          <li>
          <div class="media">
            <div class="media-left"><a class="news_img" href="#"><img class="media-object" src="img/event.jpg" alt="img"> </a></div>
            <div class="media-body"><a href="#">温泉がいい値！　群馬　草津温泉 </a> <span class="feed_date">27.02.15</span> </div>
          </div>
          </li><li>
          <div class="media">
            <div class="media-left"><a class="news_img" href="#"><img class="media-object" src="img/event.jpg" alt="img"> </a></div>
            <div class="media-body"><a href="#">温泉がいい値！　群馬　草津温泉 </a> <span class="feed_date">28.02.15</span> </div>
          </div>
          </li><li>
          <div class="media">
            <div class="media-left"><a class="news_img" href="#"><img class="media-object" src="img/event.jpg" alt="img"> </a></div>
            <div class="media-body"><a href="#">温泉がいい値！　群馬　草津温泉 </a> <span class="feed_date">28.02.15</span> </div>
          </div>
        </li></ul>
        <a class="see_all" href="#">See All</a>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</section>'
		),
		
		2 => array(
			'section_title'	=> '',
			'bgcolor' 		=> '#7ab040',
			'bgimage'		=> '',
			'class'			=> 'buy_theme',
			'content'		=> '<h2><span><a target="_blank" href="'.esc_url(SKT_THEME_URL_DIRECT).'">BUY PRO VERSION</a></span></h2>'
		),
		
		3 => array(
			'section_title'	=> '<span>SKTCORP</span> : Lorem ipsum dolor sit amet consectetur',
			'bgcolor' 		=> '#f5f6f8',
			'bgimage'		=> '',
			'class'			=> 'about_text',
			'content'		=> '<div class="one_half"><img src="'.get_template_directory_uri().'/images/about_img.png"></div>
			<div class="one_half last_column">
			
				Nunc rhoncus ipsum eget quam vestibulum porttitor. Ut nec arcu eget arcu faucibus iaculis. Donec in tellus ac erat dignissim semper sed vehicula nulla. Vestibulum tortor dolor, egestas eget lectus id, molestie suscipit dolor. Pellentesque consequat et sem nec faucibus. Phasellus libero nunc, elementum ac massa eget, scelerisque aliquam nibh. Curabitur sed placerat eros.
			
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque mattis eleifend cursus. Proin eget ultricies libero, non tristique est. Phasellus dictum, felis ac dapibus molestie, leo nisi viverra urna, sit amet congue odio leo id neque. Cras neque neque, rutrum at diam id.
<ul>
<li>Quisque mattis eleifend cursus</li>
<li>Sodales molestie orci. Nunc tempus neque id</li>
<li>Nunc condimentum tempor feugiat. </li>
<li>Proin quis eros eu arcu euismod feugiat</li>
<li>Quisque malesuada neque eu mi</li>
</ul>
</div><div class="clear"></div>'
		),
		
		4 => array(
			'section_title'	=> '',
			'bgcolor' 		=> '#ffffff',
			'bgimage'		=> '',
			'class'			=> 'testimonial',
			'content'		=> '<h3 class="testimonial-title">Why Choose Us</h3>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et dui scelerisque, eleifend nibh finibus, semper velit. Donec ac leo non risus bibendum commodo. Nullam vitae venenatis odio, id euismod ex. Donec scelerisque orci quis leo mattis, et rutrum arcu egestas. Nullam sed dui ullamcorper, euismod sapien non, aliquet enim. Aliquam ultricies egestas lacinia. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec gravida lobortis nisi. Ut molestie erat id tristique feugiat. In arcu ante, vulputate sit amet vehicula a, vehicula in velit. In eu porttitor ipsum. Fusce sit amet diam sapien. Cras gravida est neque, in consectetur enim feugiat sed. Maecenas volutpat sapien vitae eleifend posuere. Suspendisse fermentum, diam et finibus venenatis, nisl leo consectetur magna, eu gravida augue lectus sit amet sem. Aenean finibus ligula id dui eleifend, non blandit dui maximus. 
				
				Phasellus placerat tortor orci, a malesuada ex interdum vitae. Phasellus egestas sit amet diam sit amet auctor. Pellentesque id sem eget arcu elementum fermentum vel sit amet enim. Donec eu elementum ipsum. Morbi nibh tortor, molestie ut bibendum sed, vestibulum non libero. Mauris dolor nulla, venenatis eget est sed, cursus sollicitudin est. Nulla rhoncus nisi in sem dignissim, vel dignissim eros sodales. Nunc quis consectetur massa, quis euismod ex. Aenean suscipit, tellus at pulvinar lobortis, tortor purus ultrices quam, a tincidunt ligula urna sit amet purus. Donec maximus nunc sed tortor congue euismod. '
		),
		
		
      
		5 => array(
			'section_title'	=> '',
			'bgcolor' 		=> '#7ab040',
			'bgimage'		=> '',
			'class'			=> 'clients',
			'content'		=> '<img src="'.get_template_directory_uri().'/images/wp-logo.png"><img src="'.get_template_directory_uri().'/images/woo-logo.png"><img class="/" src="'.get_template_directory_uri().'/images/jQuery-logo.png"><img class="yes" src="'.get_template_directory_uri().'/images/bb-logo.png">'
		),
	);

	$options = array();

	//Basic Settings
	$options[] = array(
		'name' => __('Basic Settings', 'skt-corp'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Logo', 'skt-corp'),
		'desc' => __('Upload your main logo here', 'skt-corp'),
		'id' => 'logo',
		'class' => '',
		'std'	=> '',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Favicon', 'skt-corp'),
		'desc' => __('Upload favicon for website', 'skt-corp'),
		'id' => 'favicon',
		'class' => '',
		'std'	=> '',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Footer Left Copyright Text', 'skt-corp'),
		'desc' => __('Some text for footer of your site, you would like to display in the footer.', 'skt-corp'),
		'id' => 'footertext',
		'std' => 'Copyright &copy; 2014 SKT-Corp. Theme by <a href="'.SKT_THEME_URL.'" target="_blank">SKT Themes</a>.',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Footer Right Links / Text', 'skt-corp'),
		'desc' => __('Some text for footer of your site, you would like to display in the footer.', 'skt-corp'),
		'id' => 'footerlinks',
		'std' => '<a href="#">Home</a> | <a href="#">Contact Us</a> | <a href="#">Sitemap</a>',
		'type' => 'textarea');

	//Layout Settings
	$options[] = array(
		'name' => __('Sections', 'skt-corp'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Number of Sections', 'skt-corp'),
		'desc' => __('Select number of sections', 'skt-corp'),
		'id' => 'numsection',
		'type' => 'select',
		'std' => '5',
		'options' => array_combine(range(1,20), range(1,20)) );

	$numsecs = of_get_option( 'numsection', 5);

	for( $n=1; $n<=$numsecs; $n++){
		$options[] = array(
			'desc' => __("<h3>Section</h3>", 'skt-corp'),
			'class' => 'toggle_title',
			'type' => 'info');	
	
		$options[] = array(
			'name' => __('Section Title', 'skt-corp'),
			'id' => 'sectiontitle'.$n,
			'std' => ( ( isset($section_text[$n]['section_title']) ) ? $section_text[$n]['section_title'] : '' ),
			'type' => 'text');

		$options[] = array(
			'name' => __('Section Background Color', 'skt-corp'),
			'desc' => __('Select background color for section', 'skt-corp'),
			'id' => 'sectionbgcolor'.$n,
			'std' => ( ( isset($section_text[$n]['bgcolor']) ) ? $section_text[$n]['bgcolor'] : '' ),
			'type' => 'color');

		$options[] = array(
			'name' => __('Section CSS Class', 'skt-corp'),
			'desc' => __('Set class for this section.', 'skt-corp'),
			'id' => 'sectionclass'.$n,
			'std' => ( ( isset($section_text[$n]['class']) ) ? $section_text[$n]['class'] : '' ),
			'type' => 'text');

		$options[] = array(
			'name' => __('Section Content', 'skt-corp'),
			'id' => 'sectioncontent'.$n,
			'std' => ( ( isset($section_text[$n]['content']) ) ? $section_text[$n]['content'] : '' ),
			'type' => 'editor');
	}


	//SLIDER SETTINGS
	$options[] = array(
		'name' => __('Slider Images', 'skt-corp'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Inner Page Slider', 'skt-corp'),
		'desc' => __('Show / Hide inner page slider', 'skt-corp'),
		'id' => 'innerpageslider',
		'type' => 'select',
		'std' => 'hide',
		'options' => array('show'=>'Show', 'hide'=>'Hide') );

	$options[] = array(
		'name' => __('Slider Image 1', 'skt-corp'),
		'desc' => __('Upload / select image for slide 1', 'skt-corp'),
		'id' => 'slide1',
		'class' => '',
		'std' => get_template_directory_uri()."/images/slides/slide1.jpg",
		'type' => 'upload');

	$options[] = array(
		'desc' => __('Title 1', 'skt-corp'),
		'id' => 'slidetitle1',
		'std' => 'Free Business WordPress Theme',
		'type' => 'text');

	$options[] = array(
		'desc' => __('Slide Descrition 1', 'skt-corp'),
		'id' => 'slidedesc1',
		'std' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut leo augue, posuere id commodo quis, malesuada in justo. Nulla nunc purus, interdum quis imperdiet in, placerat id felis. Duis sodales iaculis mauris.',
		'type' => 'textarea');			
		
	$options[] = array(
		'desc' => __('Link / Url 1', 'skt-corp'),
		'id' => 'slideurl1',
		'std' => '#link1',
		'type' => 'text',
		'subtype' => 'url');

	$options[] = array(
		'name' => __('Slider Image 2', 'skt-corp'),
		'desc' => __('Upload / select image for slide 2', 'skt-corp'),
		'id' => 'slide2',
		'class' => '',
		'std' => get_template_directory_uri()."/images/slides/slide2.jpg",
		'type' => 'upload');

	$options[] = array(
		'desc' => __('Title 2', 'skt-corp'),
		'id' => 'slidetitle2',
		'std' => 'Fully Responsive WordPress Theme',
		'type' => 'text');

	$options[] = array(
		'desc' => __('Slide Descrition 2', 'skt-corp'),
		'id' => 'slidedesc2',
		'std' => 'Ut leo augue, posuere id commodo quis, malesuada in justo. Nulla nunc purus, interdum quis imperdiet in, placerat id felis. Duis sodales iaculis mauris. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
		'type' => 'textarea');			
		
	$options[] = array(
		'desc' => __('Link / Url 2', 'skt-corp'),
		'id' => 'slideurl2',
		'std' => '#link2',
		'type' => 'text',
		'subtype' => 'url');

	$options[] = array(
		'name' => __('Slider Image 3', 'skt-corp'),
		'desc' => __('Upload / select image for slide 3', 'skt-corp'),
		'id' => 'slide3',
		'class' => '',
		'std' => get_template_directory_uri()."/images/slides/slide3.jpg",
		'type' => 'upload');

	$options[] = array(
		'desc' => __('Title 3', 'skt-corp'),
		'id' => 'slidetitle3',
		'std' => 'Easy to Use',
		'type' => 'text');

	$options[] = array(
		'desc' => __('Slide Descrition 3', 'skt-corp'),
		'id' => 'slidedesc3',
		'std' => 'Nulla nunc purus, interdum quis imperdiet in, placerat id felis. Duis sodales iaculis mauris. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut leo augue, posuere id commodo quis, malesuada in justo.',
		'type' => 'textarea');			
		
	$options[] = array(
		'desc' => __('Link / Url 3', 'skt-corp'),
		'id' => 'slideurl3',
		'std' => '#link3',
		'type' => 'text',
		'subtype' => 'url');
	//4
	$options[] = array(
		'name' => __('Slider Image 4', 'skt-corp'),
		'desc' => __('Upload / select image for slide 4', 'skt-corp'),
		'id' => 'slide4',
		'class' => '',
		'std' => '',
		'type' => 'upload');

	$options[] = array(
		'desc' => __('Title 4', 'skt-corp'),
		'id' => 'slidetitle4',
		'std' => 'Easy to Use',
		'type' => 'text');

	$options[] = array(
		'desc' => __('Slide Descrition 4', 'skt-corp'),
		'id' => 'slidedesc4',
		'std' => 'Nulla nunc purus, interdum quis imperdiet in, placerat id felis. Duis sodales iaculis mauris. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut leo augue, posuere id commodo quis, malesuada in justo.',
		'type' => 'textarea');			
		
	$options[] = array(
		'desc' => __('Link / Url 4', 'skt-corp'),
		'id' => 'slideurl4',
		'std' => '#link4',
		'type' => 'text',
		'subtype' => 'url');
	//end 4
	
	//5
	$options[] = array(
		'name' => __('Slider Image 5', 'skt-corp'),
		'desc' => __('Upload / select image for slide 5', 'skt-corp'),
		'id' => 'slide5',
		'class' => '',
		'std' => "",
		'type' => 'upload');

	$options[] = array(
		'desc' => __('Title 5', 'skt-corp'),
		'id' => 'slidetitle5',
		'std' => 'Easy to Use',
		'type' => 'text');

	$options[] = array(
		'desc' => __('Slide Descrition 5', 'skt-corp'),
		'id' => 'slidedesc5',
		'std' => 'Nulla nunc purus, interdum quis imperdiet in, placerat id felis. Duis sodales iaculis mauris. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut leo augue, posuere id commodo quis, malesuada in justo.',
		'type' => 'textarea');			
		
	$options[] = array(
		'desc' => __('Link / Url 5', 'skt-corp'),
		'id' => 'slideurl5',
		'std' => '#link5',
		'type' => 'text',
		'subtype' => 'url');
	//end 5
	//6
	$options[] = array(
		'name' => __('Slider Image 6', 'skt-corp'),
		'desc' => __('Upload / select image for slide 6', 'skt-corp'),
		'id' => 'slide6',
		'class' => '',
		'std' => '',
		'type' => 'upload');

	$options[] = array(
		'desc' => __('Title 6', 'skt-corp'),
		'id' => 'slidetitle6',
		'std' => 'Easy to Use',
		'type' => 'text');

	$options[] = array(
		'desc' => __('Slide Descrition 6', 'skt-corp'),
		'id' => 'slidedesc6',
		'std' => 'Nulla nunc purus, interdum quis imperdiet in, placerat id felis. Duis sodales iaculis mauris. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut leo augue, posuere id commodo quis, malesuada in justo.',
		'type' => 'textarea');			
		
	$options[] = array(
		'desc' => __('Link / Url 6', 'skt-corp'),
		'id' => 'slideurl6',
		'std' => '#link6',
		'type' => 'text',
		'subtype' => 'url');
	//end 6
	//7
	$options[] = array(
		'name' => __('Slider Image 7', 'skt-corp'),
		'desc' => __('Upload / select image for slide 7', 'skt-corp'),
		'id' => 'slide7',
		'class' => '',
		'std' => '',
		'type' => 'upload');

	$options[] = array(
		'desc' => __('Title 7', 'skt-corp'),
		'id' => 'slidetitle7',
		'std' => 'Easy to Use',
		'type' => 'text');

	$options[] = array(
		'desc' => __('Slide Descrition 7', 'skt-corp'),
		'id' => 'slidedesc7',
		'std' => 'Nulla nunc purus, interdum quis imperdiet in, placerat id felis. Duis sodales iaculis mauris. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut leo augue, posuere id commodo quis, malesuada in justo.',
		'type' => 'textarea');			
		
	$options[] = array(
		'desc' => __('Link / Url 7', 'skt-corp'),
		'id' => 'slideurl7',
		'std' => '#link7',
		'type' => 'text',
		'subtype' => 'url');
	//end 7
	//8
	$options[] = array(
		'name' => __('Slider Image 8', 'skt-corp'),
		'desc' => __('Upload / select image for slide 8', 'skt-corp'),
		'id' => 'slide8',
		'class' => '',
		'std' => '',
		'type' => 'upload');

	$options[] = array(
		'desc' => __('Title 8', 'skt-corp'),
		'id' => 'slidetitle8',
		'std' => 'Easy to Use',
		'type' => 'text');

	$options[] = array(
		'desc' => __('Slide Descrition 8', 'skt-corp'),
		'id' => 'slidedesc8',
		'std' => 'Nulla nunc purus, interdum quis imperdiet in, placerat id felis. Duis sodales iaculis mauris. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut leo augue, posuere id commodo quis, malesuada in justo.',
		'type' => 'textarea');			
		
	$options[] = array(
		'desc' => __('Link / Url 8', 'skt-corp'),
		'id' => 'slideurl8',
		'std' => '#link8',
		'type' => 'text',
		'subtype' => 'url');
	//end 8
	
	// Support					
	$options[] = array(
		'name' => __('Our Themes', 'skt-corp'),
		'type' => 'heading');

	$options[] = array(
		'desc' => __('SKT Corp WordPress theme has been Designed and Created by SKT Themes.', 'skt-corp'),
		'type' => 'info');	

	 $options[] = array(
		'desc' => '<a href="'.esc_url(SKT_THEME_URL).'" target="_blank"><img src="'.get_template_directory_uri().'/images/sktskill.jpg"></a><p><em><a target="_blank" href="'.esc_url(SKT_THEME_URL_DIRECT).'">'.__('Buy PRO version for only $39 with more features.','skt-corp').'</a></em></p>',
		'type' => 'info');	

	return $options;
}