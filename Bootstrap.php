<?php

declare(strict_types=1);

use Nette\Bootstrap\Configurator;


class Bootstrap
{
	public static function boot(): Configurator
	{
		$conf = new Configurator;
		$conf->setDebugMode(true);
		$conf->enableTracy(__DIR__ . '/var/log');
		$conf->setTempDirectory(__DIR__ . '/var');
		$conf->addConfig(__DIR__ . '/config.neon');
		return $conf;
	}
}
