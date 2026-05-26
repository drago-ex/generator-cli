<?php

declare(strict_types=1);

namespace App;

use Nette\Bootstrap\Configurator;
use Nette\DI\Container;
use Throwable;


/** The Bootstrap class configures the application. */
final class Bootstrap
{
	private Configurator $configurator;
	private string $rootDir;


	public function __construct()
	{
		$this->rootDir = dirname(__DIR__);
		$this->configurator = new Configurator;
		$this->configurator->setTempDirectory($this->rootDir . '/var');
	}


	public function initializeEnvironment(): void
	{
		$this->configurator->setDebugMode(true);
		$this->configurator->enableTracy($this->rootDir . '/var/log');
		$this->configurator->createRobotLoader()
			->addDirectory(__DIR__)
			->register();
	}


	/**
	 * @throws Throwable
	 */
	private function setupContainer(): void
	{
		$this->configurator->addConfig($this->rootDir . '/config.neon');
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
		$this->configurator->setDebugMode(false);
		$this->initializeEnvironment();
		$this->setupContainer();
		return $this->configurator->createContainer();
	}
}
