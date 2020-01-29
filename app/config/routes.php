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
];
