# Agent Guide

Use this file as package-specific guidance when working in this repository. Keep changes aligned with the existing public API, project conventions, and supported PHP range.

## Package Overview
- **Package**: `drago-ex/generator-cli`
- **Type**: project
- **Purpose**: Basic configuration for Drago Generator
- **PHP**: >=8.3 <9
- **Runtime dependencies**: nette/bootstrap (^3.2), drago-ex/generator (^2.0), drago-ex/project-docker (^1.0), drago-ex/project-docker-db (^1.0), tracy/tracy (^2.10)
- **License**: MIT

## Repository Layout
- `app/`: project application configuration and code.
- `docker/`: Docker configuration installed into created projects by drago-install (not part of this repository, see Key Parts).
- `.github/`: CI workflows; keep their PHP versions and commands consistent with Composer and the package scripts.
- `composer.json`: package metadata, dependency constraints, autoloading, and available Composer scripts.

## Key Parts
- `Bootstrap::setupContainer()` loads exactly `config.neon` and `local/db.neon` by `addConfig()`, no search (`app/` has no neon files; a search of the whole root loaded the neon files of `vendor/` and the generator could not start). Debug mode stays on in the console, so a change of `config.neon` rebuilds the container. The `generate:*` scripts use `docker compose exec -T` (no TTY needed, e.g. the PhpStorm Composer runner).
- `config.neon` registers the console and generator extensions and lists all generator options; `app/Bootstrap.php` provides `bootConsoleApplication()` for `vendor/bin/generator`.
- `docker/`, `docker-compose*.yaml` and `local/db.neon` are installed by drago-install from project-docker and project-docker-db: never commit them to this repository (`copy` does not overwrite existing files, so a committed copy kept new projects on old Dockerfiles); delete them after a local composer install. `docker/` and `docker-compose*.yaml` are not git-ignored, because the .gitignore goes into the created projects, which keep them; `local/` is git-ignored (files of one environment, drago-install copies `db.neon` again after a clone).
- The database host is `db` (Docker network), so the `generate:*` Composer scripts run the generator in the `server` container (`docker compose exec server ...`).

## Dependencies

Composer constraints describe the package contract. Before changing integration behavior, inspect the source and the actual call sites in this package; do not infer runtime usage solely from dependency declarations.
Development dependencies include phpstan/phpstan-nette (^2.0), drago-ex/project-tools (^1.0).

## Essential Commands

```bash
composer phpstan                # phpstan analyse
```

## Tests

This repository does not currently define a test script in `composer.json` or contain a `tests/` directory.
Do not claim behavior is covered by tests unless you find and run a relevant suite. When adding a test suite, follow the package’s existing Nette Tester setup if one is present and add an explicit Composer script.

## Installation Hooks

Composer install and update hooks invoke Drago project setup/cleanup commands. Inspect those scripts and their effects before invoking Composer operations that trigger them; they may modify generated project files.

## Conventions & Rules

- Preserve backward compatibility unless the task explicitly permits a breaking change. Check callers and public signatures before changing behavior.
- Follow the existing PHP style: strict types, explicit parameter and return types, tabs for indentation, and single-quoted strings where practical. Match nearby code when a convention is unclear.
- Keep package-specific configuration, resources, and migrations in their established directories. Do not edit generated or consuming-project files without confirming they are part of this repository’s intended output.
- Add or update focused tests for behavioral changes when this package has a runnable test setup. Do not invent test commands; use only the scripts and configuration present here.
- Update README examples and Composer metadata when a public API or supported requirement changes.
