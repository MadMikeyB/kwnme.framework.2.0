<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();

// Database

$capsule->addConnection( 

	array(
			'driver'	=> 'mysql',
			'host'		=> 'localhost',
			'username'	=> 'root',
			'password'	=> 'root',
			'database'	=> 'kwnnew',
			'charset'	=> 'utf8',
			'collation'	=> 'utf8_unicode_ci',
			'prefix'	=> '',
	)

);

// Pagination

$capsule->getContainer()->bind('paginator', function() {
        // View initialization
        $views = __DIR__ . '/views';
        $cache = __DIR__ . '/cache';
        $blade = new \Philo\Blade\Blade($views, $cache);

        return new \Illuminate\Pagination\Factory(
            // Initialize and setup Request
            \Illuminate\Http\Request::createFromGlobals(),
            // Get ViewFactory instance
            $blade->view(),
            // Initialize Translator
            new \Symfony\Component\Translation\Translator('en')
        );
    });

$capsule->setAsGlobal();

$capsule->bootEloquent();