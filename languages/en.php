<?php
$translation = array(
	'todos' => "To-dos",
	'todos:all:no_results' => "There are currently no to-do lists. You can add one to start writing to-dos.",
	'todos:filter:active' => "Active lists",
	'todos:filter:completed' => "Completed lists",
	'todos:filter:assigned' => "Assigned to-dos",
	'todos:todolist:add' => "Add to-do list",
	'todos:todolist:title' => "Enter the name for the to-do list",

	'todos:todoitem:add' => "Add a to-do",
	'todos:todoitem:error:missing_container' => "Missing to-do list",
	
	'todos:todoitem:title' => "Enter the title of the to-do",
	'todos:todoitem:assignee' => "Assignee",
	'todos:todoitem:due' => "Due",
	
	// actions
	'todos:action:error:title' => "Please enter a title",
	
	'todos:action:todolist:edit:success' => "Todolist saved",
	'todos:action:todolist:edit:error' => "An error occured during the save of the todolist",
	
	'todos:action:todoitem:edit:cant_write' => "You're not allowed to add todo items to this list",
	'todos:action:todoitem:edit:assignee' => "You can only assign a todo item to one person",
	
	'todos:action:todoitem:edit:success' => "Todoitem saved",
	'todos:action:todoitem:edit:error' => "An error occured during the save of the todoitem",
	
);

add_translation('en', $translation);