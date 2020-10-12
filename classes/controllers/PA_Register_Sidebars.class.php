<?php 

class PA_Register_Sidebars {

	public function __construct(){
		// Page - Front Page
		register_sidebar( array(
			'name'	=> __('Front Page', 'pa_iasd'),
			'id'	=> 'front-page',
			'before_widget' => '<div class="pa-widget %2$s col">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		) );

		// Index
		register_sidebar( array(
			'name'	=> __('Index', 'pa_iasd'),
			'id'	=> 'index',
			'before_widget' => '<div class="pa-widget %2$s col">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		) );

		// Archive
		register_sidebar( array(
			'name'	=> __('Archive', 'pa_iasd'),
			'id'	=> 'archive',
			'before_widget' => '<div class="pa-widget %2$s col">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		) );

		// Single
		register_sidebar( array(
			'name'	=> __('Single', 'pa_iasd'),
			'id'	=> 'single',
			'before_widget' => '<div class="pa-widget %2$s col">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
		) );
	}
}
add_action('widgets_init', new PA_Register_Sidebars(), 1);