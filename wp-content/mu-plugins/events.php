<?php


defined('ABSPATH') or die('Direct access not allowed.');

add_action("init", "university_post_types");

function university_post_types() {
	register_post_type("event", array(
		"public" => true,
		'show_in_rest' => true,
		"labels" => array(
			"name"=>"Events",
			"add_new_item"=>"Add new event",
			"edit_item"=>"Edit Event",
			"all_items"=>"All events",
		),
		"menu_icon" => "dashicons-calendar-alt",
		"supports" => array('title', 'editor', 'comments', 'custom-fields')
	));
}