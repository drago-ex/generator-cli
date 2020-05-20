<?php

declare(strict_types = 1);

use Nette\Configurator;


class Bootstrap
{

	public static function boot(): Configurator
	{
		$conf = new Configurator;
		$conf->setDebugMode(true);
		$conf->enableTracy(__DIR__ . '/log');
		$conf->setTempDirectory(__DIR__ . '/storage');
		$conf->addConfig(__DIR__ . '/config.neon');
		return $conf;
	}
}
