#!/usr/bin/env php
<?php

use Contributte\Console\Application;

require __DIR__ . '/../vendor/autoload.php';

exit(Bootstrap::boot()
	->createContainer()
	->getByType(Application::class)
	->run());
