<?php declare(strict_types=1);

namespace App;

use Nette\Bootstrap\Configurator;
use Nette\DI\Container;
use Throwable;
use function dirname;


final class Bootstrap
{
	private Configurator $configurator;
	private string $rootDir;


	public function __construct()
	{
		$this->rootDir = dirname(__DIR__);
		$this->configurator = new Configurator;
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


	/** @throws Throwable */
	public function bootWebApplication(): Container
	{
		$this->initializeEnvironment();
		$this->setupContainer();

		return $this->configurator->createContainer();
	}


	/** @throws Throwable */
	public function bootConsoleApplication(): Container
	{
		// debug mode stays on: the container is rebuilt when config.neon changes (e.g. suffixDataClass)
		$this->initializeEnvironment();
		$this->setupContainer();
		return $this->configurator->createContainer();
	}


	/**
	 * The settings of the generator (config.neon) and the database connection (local/db.neon from project-docker-db).
	 * @throws Throwable
	 */
	private function setupContainer(): void
	{
		$this->configurator->addConfig($this->rootDir . '/config.neon');
		$this->configurator->addConfig($this->rootDir . '/local/db.neon');
	}
}
