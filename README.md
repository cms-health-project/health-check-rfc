# CMS Health Definition

## Introduction

This package provides a collection if interfaces and enums defining the
required information required to build the final json structure. It does
not provide a concrete implementation.

## Usage

To use this definition require it to your project:

```terminal
composer require "cms-health-project/health-check-rfc"
```

## JSON Schema Definition

A  [JSON Schema Definition [health-check-schema.json]](./health-check-schema.json) is provided, which can be used
to validate a json value against that schema, for example using [https://www.jsonschemavalidator.net/](https://www.jsonschemavalidator.net/).

You can find a demo to validate the example json against this definition here: https://www.jsonschemavalidator.net/s/HK5eMqkh

## Contribution

This package contains for now only a cgl check based on `php-cs-fixer`.

```terminal
composer install
composer cgl:fix
```