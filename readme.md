# Drago Generator CLI

English | [Čeština](readme.cs.md)

Ready-to-use Drago Generator project with PHP and database Docker services.

[![PHP version](https://badge.fury.io/ph/drago-ex%2Fgenerator-cli.svg)](https://badge.fury.io/ph/drago-ex%2Fgenerator-cli)
[![GitHub version](https://badge.fury.io/gh/drago-ex%2Fgenerator-cli.svg)](https://badge.fury.io/gh/drago-ex%2Fgenerator-cli)
[![Coding Style](https://github.com/drago-ex/generator-cli/actions/workflows/coding-style.yml/badge.svg)](https://github.com/drago-ex/generator-cli/actions/workflows/coding-style.yml)

## Requirements

- PHP >= 8.3, < 9
- Nette Framework
- Composer
- Docker and Node.js (npm runs the Docker scripts)

## Installation

```bash
composer create-project drago-ex/generator-cli
```

## Usage

Start the PHP server and the database (connection in `app/db.neon`; from the host the database is on port 6033), then
create your tables in the database `app`:

```bash
npm run docker:dev
```

Generate the classes inside the server container, for all tables or for one:

```bash
composer generate:entity
composer generate:entity -- users
composer generate:data-class -- users
```

Entities are written to `app/Entity`, data classes (form values, `*Values`) to `app/Values`. The options are set in `config.neon` and
described in the [Drago Generator README](https://github.com/drago-ex/generator#options).
