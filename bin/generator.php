#!/usr/bin/env php
<?php declare(strict_types = 1);

use Contributte\Console\Application;

require __DIR__ . '/../vendor/autoload.php';

exit(Bootstrap::boot()
	->createContainer()
	->getByType(Application::class)
	->run());
