<?php
// подключаем стили родительской темы
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
	wp_enqueue_style( 'unite-bootstrap', get_template_directory_uri() . '/inc/css/bootstrap.min.css' );
    wp_enqueue_style( 'unite-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css'  );
}

// регистрируем custom post types
add_action( 'init', 'child_custom_post_types' );
function child_custom_post_types() {
  // custom post type для фильмов
  register_post_type( 'films',
    array(
	'has_archive' => true,
		'labels' => array(
        'name' => 'Films',
		'singular_name' => 'Film',
		'add_new' => 'Добавить фильм', 
		'add_new_item' => 'Добавить новый фильм',
		'new_item' => 'Новый фильм',
		'all_items' => 'Все фильмы',
		'edit_item' => 'Редактировать фильм',
	),
	'public' => true,
	'show_ui' => true,
	'show_in_menu' => true,
	'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
	'menu_icon' => 'dashicons-video-alt3',
	'menu_position' => 5 
    )
  );
}
// регистрируем таксономии (страны, жанры, актёры, год выпуска)
function add_new_taxonomies() {		
	register_taxonomy('country',
		array('films'),
		array(
			'hierarchical' => true, // разрешить вложенность
			'labels' => array(
				'name' => 'Страны',
				'singular_name' => 'Страна',
				'all_items' => 'Все страны',
				'edit_item' => 'Редактировать', 
				'add_new_item' => 'Добавить новую страну',
				'menu_name' => 'Страны'
			),
			'public' => true, 
			/* каждый может использовать таксономию, либо
			только администраторы, по умолчанию - true */
			'show_in_nav_menus' => true,
			/* добавить на страницу создания меню */
			'show_ui' => true,
			/* добавить интерфейс создания и редактирования */
			'show_tagcloud' => true,
			/* нужно ли разрешить облако тегов для этой таксономии */
			'update_count_callback' => '_update_post_term_count',
			/* callback-функция для обновления счетчика $object_type */
			'query_var' => true,
			/* разрешено ли использование query_var, также можно 
			указать строку, которая будет использоваться в качестве 
			него, по умолчанию - имя таксономии */
			'rewrite' => array(
				'slug' => 'country', // ярлык
				'hierarchical' => true // разрешить вложенность
 
			),
		)
	);
register_taxonomy('genre',
		array('films'),
		array(
			'hierarchical' => true, // разрешить вложенность
			'labels' => array(
				'name' => 'Жанры',
				'singular_name' => 'Жанр',
				'all_items' => 'Все жанры',
				'edit_item' => 'Редактировать', 
				'add_new_item' => 'Добавить новый жанр',
				'menu_name' => 'Жанры'
			),
			'public' => true, 
			/* каждый может использовать таксономию, либо
			только администраторы, по умолчанию - true */
			'show_in_nav_menus' => true,
			/* добавить на страницу создания меню */
			'show_ui' => true,
			/* добавить интерфейс создания и редактирования */
			'show_tagcloud' => true,
			/* нужно ли разрешить облако тегов для этой таксономии */
			'update_count_callback' => '_update_post_term_count',
			/* callback-функция для обновления счетчика $object_type */
			'query_var' => true,
			/* разрешено ли использование query_var, также можно 
			указать строку, которая будет использоваться в качестве 
			него, по умолчанию - имя таксономии */
			'rewrite' => array(
				'slug' => 'genre', // ярлык
				'hierarchical' => true // разрешить вложенность
 
			),
		)
	);
register_taxonomy('actors',
		array('films'),
		array(
			'hierarchical' => true, // разрешить вложенность
			'labels' => array(
				'name' => 'Актёры',
				'singular_name' => 'Актёр',
				'all_items' => 'Все актёры',
				'edit_item' => 'Редактировать', 
				'add_new_item' => 'Добавить нового актёра',
				'menu_name' => 'Актёры'
			),
			'public' => true, 
			/* каждый может использовать таксономию, либо
			только администраторы, по умолчанию - true */
			'show_in_nav_menus' => true,
			/* добавить на страницу создания меню */
			'show_ui' => true,
			/* добавить интерфейс создания и редактирования */
			'show_tagcloud' => true,
			/* нужно ли разрешить облако тегов для этой таксономии */
			'update_count_callback' => '_update_post_term_count',
			/* callback-функция для обновления счетчика $object_type */
			'query_var' => true,
			/* разрешено ли использование query_var, также можно 
			указать строку, которая будет использоваться в качестве 
			него, по умолчанию - имя таксономии */
			'rewrite' => array(
				'slug' => 'actors', // ярлык
				'hierarchical' => true // разрешить вложенность
 
			),
		)
	);
register_taxonomy('year',
		array('films'),
		array(
			'hierarchical' => true, // разрешить вложенность
			'labels' => array(
				'name' => 'Годы экранизации',
				'singular_name' => 'Год',
				'all_items' => 'Все года',
				'edit_item' => 'Редактировать', 
				'add_new_item' => 'Добавить год выпуска',
				'menu_name' => 'Годы экранизации'
			),
			'public' => true, 
			/* каждый может использовать таксономию, либо
			только администраторы, по умолчанию - true */
			'show_in_nav_menus' => true,
			/* добавить на страницу создания меню */
			'show_ui' => true,
			/* добавить интерфейс создания и редактирования */
			'show_tagcloud' => true,
			/* нужно ли разрешить облако тегов для этой таксономии */
			'update_count_callback' => '_update_post_term_count',
			/* callback-функция для обновления счетчика $object_type */
			'query_var' => true,
			/* разрешено ли использование query_var, также можно 
			указать строку, которая будет использоваться в качестве 
			него, по умолчанию - имя таксономии */
			'rewrite' => array(
				'slug' => 'year', // ярлык
				'hierarchical' => true // разрешить вложенность
 
			),
		)
	);
}
add_action( 'init', 'add_new_taxonomies', 0 );

// добавляем текстовые поля только для определённого post type (films)
add_action( 'add_meta_boxes', 'my_fields' );
function my_fields() {
	add_meta_box( 'film_info', 'Дополнительная информация', 'create_info_box', 'films', 'normal', 'default' );	
}
// функция, которая выведет html метабоксов
function create_info_box( $post ) {
	// создаём nonce для верификации
	wp_nonce_field( basename( __FILE__ ), 'film_info_nonce_name' );
	
	// текстовые поля 
	$output .= '<label>Стоимость сеанса: <input type="text" name="film_price" value="' . get_post_meta($post->ID, 'film_price',true) . '" /></label> ';
	$output .= '<label>Дата выхода: <input type="text" name="film_date" value="' . get_post_meta($post->ID, 'film_date',true) . '" /></label> ';
	
	echo $output;
}
// при сохранении поста сохранем данные из метабоксов
function film_info_save( $post_id ) { 
	// проверяем nonce нашей страницы
	if ( !isset( $_POST['film_info_nonce_name'] )
	|| !wp_verify_nonce( $_POST['film_info_nonce_name'], basename( __FILE__ ) ) )
        return $post_id;
	// проверяем, является ли запрос автосохранением
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
		return $post_id;
	// для постов типа films	
	$post = get_post($post_id);
	if ($post->post_type == 'films') {
		// обновляем в базе
		update_post_meta($post_id, 'film_price', esc_attr($_POST['film_price']));
		update_post_meta($post_id, 'film_date', esc_attr($_POST['film_date']));
	}
return $post_id;	
}
add_action( 'save_post', 'film_info_save' );

// создаём шорткод для вывода 5 фильмов
function webfocus_shortcode( $atts ){
	/* шорткод может принимать 2 параметра - количество постов и тип постов
	по умолчанию 5 постов и тип - films
	*/
	$params = shortcode_atts( array(
	'number' => 5,
	'type' => 'films'
	), $atts );
	global $post;
	$args = array(
		'posts_per_page' => $params['number'],
		'post_type' => $params['type'],
	);
	$posts = get_posts($args);
	foreach($posts as $post){
		setup_postdata($post);
		$output .= "<article class='hentry'>
		<header class='entry-header page-header'>
		<h2 class='entry-title'>" . get_the_title() . "</h2>
		<header>

		<div class='entry-content'>
		<img src='" . get_the_post_thumbnail_url() . "' class='thumbnail wp-post-image' />
		<p>" . get_the_content() . "</p>
		</div>
		</article>";
	}
?>	
<?php 
	wp_reset_postdata();
	return $output;
}
add_shortcode( 'latest_five', 'webfocus_shortcode' );


