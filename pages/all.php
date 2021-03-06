<?php

gatekeeper();

$filter = get_input('filter', 'active');
if (!in_array($filter, array('active', 'completed'))) {
	$filter = 'active';
}

$page_owner = elgg_get_page_owner_entity();
if (empty($page_owner)) {
	$page_owner = elgg_get_logged_in_user_entity();
}

$container_guid = $page_owner->getGUID();
elgg_set_page_owner_guid($container_guid);

if (!todos_enabled_for_container($page_owner)) {
	forward(REFERER);
}

if (elgg_instanceof($page_owner, 'group')) {
	elgg_push_breadcrumb(elgg_echo('todos'), "todos/group/{$page_owner->getGUID()}/all");
	elgg_push_breadcrumb($page_owner->name);
}

$options = array(
	'type' => 'object',
	'subtype' => 'todolist',
	'container_guid' => $container_guid,
	'limit' => false,
	'full_view' => false,
	'item_class' => 'mbl',
	'list_class' => 'todos-list todos-list-todolist',
	'order_by_metadata' => array(
		'name' => 'order',
		'as' => 'integer'
	),
);

if (can_write_to_container(null, $container_guid)) {
	$options['list_class'] .= ' todos-sortable';
}

switch ($filter) {
	case 'active':
		
		if ($page_owner->canWriteToContainer(0, 'object', TodoList::SUBTYPE)) {
			elgg_load_js("lightbox");
			elgg_load_css("lightbox");
			
			$item = ElggMenuItem::factory([
				'text' => elgg_echo('todos:todolist:add'),
				'href' => "ajax/view/todos/todolist/form?container_guid={$page_owner->getGUID()}",
				'name' => 'todolist_add',
				'class' => 'elgg-button elgg-button-action elgg-lightbox'
			]);
			elgg_register_menu_item('title', $item);
		}
		
		$options['metadata_name_value_pairs'] = array('active' => true);
		break;
	case 'completed':
		$options['metadata_name_value_pairs'] = array('active' => false);
		$options['show_completed'] = true;
		break;
}

$title = elgg_echo("todos:filter:$filter");

$content = elgg_list_entities_from_metadata($options);
if (empty($content)) {
	$content = elgg_echo('todos:all:no_results');
}

$filter = elgg_view_menu('filter', array('sort_by' => 'priority', 'class' => 'elgg-menu-hz'));

$body = elgg_view_layout('content', array(
	'title' => $title,
	'filter' => $filter,
	'content' => $content,
	'sidebar' => elgg_view('todos/sidebar')
));

echo elgg_view_page($title, $body);
