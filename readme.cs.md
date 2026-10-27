# Drago Generator CLI

Připravený projekt pro Drago Generator s PHP a databází v Dockeru.

[![PHP version](https://badge.fury.io/ph/drago-ex%2Fgenerator-cli.svg)](https://badge.fury.io/ph/drago-ex%2Fgenerator-cli)
[![GitHub version](https://badge.fury.io/gh/drago-ex%2Fgenerator-cli.svg)](https://badge.fury.io/gh/drago-ex%2Fgenerator-cli)
[![Coding Style](https://github.com/drago-ex/generator-cli/actions/workflows/coding-style.yml/badge.svg)](https://github.com/drago-ex/generator-cli/actions/workflows/coding-style.yml)

## Požadavky

- PHP >= 8.3, < 9
- Nette Framework
- Composer
- Docker a Node.js (npm spouští skripty pro Docker)

## Instalace

```bash
composer create-project drago-ex/generator-cli
```

## Použití

Spusťte PHP server a databázi (připojení v `app/db.neon`; z hostitele je databáze na portu 6033) a vytvořte
tabulky v databázi `app`:

```bash
npm run docker:dev
```

Třídy generujte v kontejneru serveru, pro všechny tabulky nebo pro jednu:

```bash
composer generate:entity
composer generate:entity -- users
composer generate:data-class -- users
```

Entity se zapisují do `app/Entity`, datové třídy (hodnoty formulářů, `*Values`) do `app/Values`. Volby se nastavují v `config.neon` a
jsou popsané v [README Drago Generator](https://github.com/drago-ex/generator#options).
