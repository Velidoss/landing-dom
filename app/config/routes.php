<?php
return [
	'/' => [
		'controller' => 'main',
		'action' => 'index',
	],
	'' => [
		'controller' => 'main',
		'action' => 'index',
	],
	'user/register' => [
		'controller' => 'user',
		'action' => 'register',
	],
	'user/login' => [
		'controller' => 'user',
		'action' => 'login',
	],
	'user/logout' => [
		'controller' => 'user',
		'action' => 'logout',
	],
	'user/account' => [
		'controller' => 'user',
		'action' => 'account',
	],
	'user/domainreg' => [
		'controller' => 'user',
		'action' => 'domainreg',
	],

	'posts/postlist' => [
		'controller' => 'posts',
		'action' => 'postlist',
	],
	'posts/makepost' => [
		'controller' => 'posts',
		'action' => 'makepost',
	],
	'posts/searchpost' => [
		'controller' => 'posts',
		'action' => 'searchpost',
	],
];
