<?php

declare(strict_types=1);

namespace App;

use Nette\Bootstrap\Configurator;
use Nette\DI\Container;
use Throwable;


/**
 * The Bootstrap class configures the application.
 * It sets up the configurator, enables debug mode, configures robot loader,
 * and prepares the container for dependency injection.
 */
final class Bootstrap
{
	private Configurator $configurator;
	private string $rootDir;


	public function __construct()
	{
		// Root directory of the project.
		$this->rootDir = dirname(__DIR__);

		// Initialize ExtraConfigurator and set temporary directory.
		$this->configurator = new Configurator;
		$this->configurator->setTempDirectory($this->rootDir . '/var');
	}


	public function initializeEnvironment(): void
	{
		// Enable debug mode.
		$this->configurator->setDebugMode(true);

		// Enable Tracy logging in the specified directory.
		$this->configurator->enableTracy($this->rootDir . '/var/log');

		// Register the current directory with the robot loader.
		$this->configurator->createRobotLoader()
			->addDirectory(__DIR__)
			->register();
	}


	/**
	 * @throws Throwable
	 */
	private function setupContainer(): void
	{
		// Adding configuration files from the current directory excluding the 'Translate' directory.
		$this->configurator->addConfig($this->rootDir . '/config.neon');
	}


	/**
	 * @throws Throwable
	 */
	public function bootWebApplication(): Container
	{
		// Perform initialization and configuration before creating the container.
		$this->initializeEnvironment();
		$this->setupContainer();

		// Create and return the DI container.
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
