# CMS Health Definition

## Introduction

This package provides a collection if interfaces and enums defining the
required information required to build the final json structure. It does
not provide a concrete implementation.

## Usage

To use this definition require it to your project:

```terminal
conmposer require "cms-health-project/health-check-rfc":"^0.0.1"
```

## Contribution

This package contains for now only a cgl check based on `php-cs-fixer`.

```terminal
composer install
composer cgl:fix
```