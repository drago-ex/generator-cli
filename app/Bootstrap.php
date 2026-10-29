<?php declare(strict_types=1);

namespace App;

use Drago\Bootstrap\ExtraConfigurator;
use Nette\DI\Container;
use Throwable;
use function dirname;


final class Bootstrap
{
	private ExtraConfigurator $configurator;
	private string $rootDir;


	public function __construct()
	{
		$this->rootDir = dirname(__DIR__);
		$this->configurator = new ExtraConfigurator;
		$this->configurator->setTempDirectory($this->rootDir . '/temp');
	}


	public function initializeEnvironment(): void
	{
		$this->configurator->setDebugMode(true);
		$this->configurator->enableTracy($this->rootDir . '/log');
		$this->configurator->createRobotLoader()
			->addDirectory(__DIR__)
			->register();
	}


	/**
	 * @throws Throwable
	 */
	public function bootWebApplication(): Container
	{
		$this->initializeEnvironment();
		$this->setupContainer();

		return $this->configurator->createContainer();
	}


	/**
	 * @throws Throwable
	 */
	public function bootConsoleApplication(): Container
	{
		// debug mode stays on: the container is rebuilt when config.neon changes (e.g. suffixDataClass)
		$this->initializeEnvironment();
		$this->setupContainer();
		return $this->configurator->createContainer();
	}


	/**
	 * The settings of the generator (config.neon) and the configs of app/ (db.neon from project-docker-db);
	 * not a search of the whole root, which would load the neon files of vendor/ as the application config.
	 * @throws Throwable
	 */
	private function setupContainer(): void
	{
		$this->configurator->addConfig($this->rootDir . '/config.neon');
		$this->configurator->addFindConfig(__DIR__);
	}
}
