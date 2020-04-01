#!/usr/bin/env php
<?php

require __DIR__ . '/../vendor/autoload.php';

exit(Bootstrap::boot()
	->createContainer()
	->getByType(Symfony\Component\Console\Application::class)
	->run());
