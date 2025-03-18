<?php

declare(strict_types=1);

use Nette\Bootstrap\Configurator;
use Symfony\Component\Console\Application;


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


	/**
	 * @throws Exception
	 */
	public static function console(): Application
	{
		return self::boot()
			->createContainer()
			->getByType(Application::class)
			->run();
	}
}
