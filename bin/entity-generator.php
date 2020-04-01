#!/usr/bin/env php
<?php declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

exit(Bootstrap::boot()
	->createContainer()
	->getByType(Symfony\Component\Console\Application::class)
	->run());
