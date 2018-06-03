<?php
Router::connect('/', 			array('controller' => 'pages', 'action' => 'display', 'home'));
Router::connect('/pages/*',		array('controller' => 'pages', 'action' => 'display'));
Router::connect('/band',		array('controller' => 'pages', 'action' => 'display', 'band'));
Router::connect('/shows',		array('controller' => 'shows', 'action' => 'index'));
Router::connect('/contact',		array('controller' => 'pages', 'action' => 'display', 'contact'));
Router::connect('/links',		array('controller' => 'links', 'action' => 'index'));
Router::connect('/login',		array('controller' => 'users', 'action' => 'login'));
Router::connect('/impressum',		array('controller' => 'pages', 'action' => 'display', 'impressum'));
Router::connect('/music',		array('controller' => 'releases', 'action' => 'index'));
Router::connect('/videos',		array('controller' => 'videos', 'action' => 'index'));

//route to switch locale
Router::connect('/lang/*', array('controller' => 'p28n', 'action' => 'change'));

//forgiving routes that allow users to change the lang of any page
Router::connect('/eng?/*', array(
	'controller' => 'p28n',
	'action' => 'shuntRequest',
	'lang' => 'eng'
));
Router::connect('/deu?/*', array(
	'controller' => 'p28n',
	'action' => 'shuntRequest',
	'lang' => 'deu'
));

Router::connect('/blog/*', array('controller' => 'blog_posts', 'action' => 'view', 'admin' => false));
Router::connect('/shows/:slug', array(
		'controller' => 'shows',
		'action' => 'view'
	),
	array(
		'pass' => array('id', 'slug'),
		'slug' => '[0-9]{4}-[0-9]{2}-[0-9]{2}-[a-zA-Z\-]*'
	));

Router::connect('/tram', array('plugin' => 'tram', 'controller' => 'orders', 'action' => 'index', 'admin' => false));

// Dirty-Rock: Download codes

// Variant 1: Without trailing slash
Router::connect ('/dirty', ['controller' => 'download_codes', 'action' => 'index']);

// Variant 2: Without trailing slash and/or following code directly passed in URL
Router::connect(
	'/dirty',
	[
		'controller' => 'download_codes',
		'action' => 'index'
	],
	[
		'pass' => [ 'code' ],
		'code' => '([a-zA-Z0-9]{8})?'
	]
);

Router::parseExtensions('rss', 'xml', 'csv');

/**
 * Load all plugin routes.  See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';

