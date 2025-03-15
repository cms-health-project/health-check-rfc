# CMS Health Definition

## Introduction

This package provides a collection of interfaces and enums defining the
required information required to build the final json structure. It does
not provide a concrete implementation.

## Usage

To use this definition require it to your project:

```terminal
composer require "cms-health-project/health-check-rfc"
```

## Project Definition and Goals

In the realm of application hosting, uptime monitoring has always been the traditional approach to safeguard websites and e-commerce stores. While this is indeed efficient and straightforward, the increasing complexity of modern applications makes this method inadequate in professional settings.

To address this flaw in modern application operation, our focus extends beyond mere uptime monitoring to encompass the true vital aspects of an online application, such as updates, user management, shop orders, and other crucial health metrics. The lack of functionality in parts of an application can often go unnoticed with standard monitoring practices.

The project aims to collect, analyze, and provide additional data from websites with a better understanding of their health to the respective operator. The website operator or hosting company is often expected to keep the overview, but the absence of a standardized format for health checks across the manifold CMS landscape makes this a hard challenge to solve.

Based on this idea, a first Proof of Concept was created at CloudFest Hackathon 2024 with the goal to jointly develop a health check format that works for open-source systems like Drupal, TYPO3, Joomla!, WordPress, and frameworks. The initial phase involves the ideation and development of a standardized format for the CMS health checks, that accommodates the unique requirements of different open-source systems and offers flexibility and extensibility. Additionally, we’re aiming to have the first basic implementation for the participating CMS systems in place that can report basic health data in a secure and privacy-friendly way.

## Format

The interface is based on HTTP communication with responses in JSON format. However, the standard for the response does
not require the request to be HTTP-based. It can also be a CLI command or similar. The format is based on the IETF draft
"Health Check Response Format for HTTP APIs" (https://datatracker.ietf.org/doc/html/draft-inadarei-api-health-check-06).
Please see the following example and explanation for the response:

```json
{
  "status": "pass",
  "version": "1",
  "serviceId": "example.org",
  "description": "Health of WordPress website example.org",
  "checks": {
    "WordPress:Version": [
      {
        "componentId": "dfd6cf2b-1b6e-4412-a0b8-f6f7797a60d1",
        "componentType": "system",
        "observedValue": "6.4.3",
        "status": "info",
        "time": "2018-01-17T03:36:48Z",
        "output": ""
      }
    ],
    "WordPress:DirectorySize": [
      {
        "componentId": "dfd6cf2b-1b6e-4412-a0b8-f6f7797a60d1",
        "componentType": "system",
        "observedValue": "25",
        "observedUnit": "GB",
        "status": "warn",
        "time": "2018-01-17T03:36:48Z",
        "output": "Directory size of installation exceeds defined threshold"
      }
    ],
    "WordPress:FailedLogins": [
      {
        "componentId": "dfd6cf2b-1b6e-4412-a0b8-f6f7797a60d1",
        "componentType": "system",
        "observedValue": "20",
        "status": "warn",
        "time": "2018-01-17T03:36:48Z",
        "output": "Number of failed login attempts in the last 24 hours exceeded defined threshold"
      }
    ],
    "WordPress:OutdatedPlugins": [
      {
        "componentId": "dfd6cf2b-1b6e-4412-a0b8-f6f7797a60d1",
        "componentType": "system",
        "observedValue": "5",
        "status": "fail",
        "time": "2018-01-17T03:36:48Z",
        "output": "Some plugins are outdated and need to be updated"
      }
    ],
    "WordPress:UserMfaActivated": [
      {
        "componentId": "dfd6cf2b-1b6e-4412-a0b8-f6f7797a60d1",
        "componentType": "system",
        "observedValue": "username1",
        "status": "pass",
        "time": "2018-01-17T03:36:48Z",
        "output": ""
      },
      {
        "componentId": "dfd6cf2b-1b6e-4412-a0b8-f6f7797a60d1",
        "componentType": "system",
        "observedValue": "username2",
        "status": "warn",
        "time": "2018-01-17T03:36:48Z",
        "output": "User username2 has not activated MFA"
      }
    ],
    "WordPress:LastUserLoginTime": [
      {
        "componentId": "identifier7",
        "componentType": "system",
        "observedValue": "2018-01-17T03:36:48Z",
        "observedUnit": "time",
        "status": "info",
        "time": "2018-01-17T03:36:48Z",
        "output": ""
      }
    ],
    "Yoast:Check1": [
      {
        "componentId": "identifier6",
        "componentType": "component",
        "status": "pass",
        "time": "2018-01-17T03:36:48Z",
        "output": ""
      }
    ],
    "SecurityPlugin:FilePermissions": [
      {
        "componentId": "identifier6",
        "componentType": "component",
        "status": "fail",
        "time": "2018-01-17T03:36:48Z",
        "output": "File permissions are not correctly set"
      }
    ]
  }
}
```

### Field explanation

#### status
*(required)* The overall status of all checks. It has a value of "pass", "fail" or "warn".

The status should be set to:
* "pass" if the CMS is fully operational and all checks also pass,
* "fail" if the CMS is not working or one or more checks fail,
* "warn" if the CMS has issues the admin should care about, but is still operational or one or more checks warn and no checks fail. 

#### version
*(optional)* public version of the health check API.

#### serviceId
*(optional)* a unique identifier of the service, in this case the URL of the website responsing.

#### description
*(optional)* a human-friendly description of the service.

#### checks
*(required)* The checks object containing all single check data. "checks" contains one or more check results as an array.

##### name
*(required)* The name of the check. It is built as "componentName:checkName", where "componentName" is the name of a single component or category and "checkName" is the name of the check itself.

##### componentId
*(optional)* The unique ID of the component.

##### componentType
*(optional)* Should be present, if the name has a "componentName". One of "system" or "component".

##### observedValue
*(optional)* The value which was determined by the check as a valid JSON value.

##### observedUnit
*(optional)* The unit of measurement the observedValue is reported in.

##### status
*(required)* The status of this check with the values "pass", "fail", "warn" or "info".

##### time
*(optional)* is the date-time, in ISO8601 format, at which the reading of the observedValue was recorded or the check itself happened.

##### output
*(optional)* the raw error or warn message, possibly human-readable. Should be ommitted for status "pass". Can also contain additional information for the status "info".

## JSON Schema Definition

A  [JSON Schema Definition [health-check-schema.json]](./health-check-schema.json) is provided, which can be used
to validate a json value against that schema, for example using [https://www.jsonschemavalidator.net/](https://www.jsonschemavalidator.net/).

You can find a demo to validate the example json against this definition here: https://www.jsonschemavalidator.net/s/HK5eMqkh

## Requesting Health data

Requesting health check data is done via HTTP to a predefined endpoint. By default, this endpoint—the CMS
implementation—must return a report containing all health checks. However, specific checks can be requested using
the `names` GET parameter to limit the response to a selected set of checks.

Implementations should also respect this parameter when processing requests made through alternative methods, such
as CLI commands executed on the same server.

## Security

For security reasons, any implementation receiving an HTTP request should only respond if the request is made over HTTPS
and includes a valid security token. The token must be at least 16 characters long and contain at least one uppercase
letter, one lowercase letter, and one digit.

The security token must be sent via the Authorization header as a JWT bearer token. The CMS implementation should
provide functions to generate and revoke security tokens as needed.

Example HTTP request:

```
GET https://example.com/health-checks?names[]=WordPress:LastUserLoginTime
Authorization: Bearer eyJjbGllbnRfaWQiOiJZekV6TUdkb01ISm5PSEJpT0cxaWJEaHlOVEE9IiwicmVzcG9uc2Vf
Content-Type: application/json
```

## CMS Integration

To handle CMS integrations, different client plugins / extensions / modules could be used. These define the endpoints
needed for the communication to the monitoring server and deliver the application-based check results based on the
checks that are implemented in the client component or CMS - might be filtered by the `names` argument.

### WordPress

For WordPress, a "Site Health Check" already exists as a core component. The implementation of the client plugin aims
to adopt that and gives the possibility to deliver all results of the WordPress Site Health Check also via the CMS
Health Check API. New checks can directly be registered as WordPress Site Health Checks and can than automatically be
used in the CMS Health Check API.

For more information about the WordPress Site Health Check see https://wordpress.org/documentation/article/site-health-screen/.

### TYPO3

TYPO3 is using the [reactions API](https://docs.typo3.org/c/typo3/cms-reactions/main/en-us/Index.html) (availbale since TYPO3 v12) to generate the health check responses. By
creating a corresponding reaction in the TYPO3 backend, administrators are free in choosing which individual checks
should be executed and included in the health check response. Additionally, due to the use of the reactions API is
the security token already generated automatically and can be changed or revoked via the corresponding reaction record.

A first implementation can be found in the public [health-checks](https://github.com/o-ba/health-checks) extension. 

## Contribution

This package contains for now only a cgl check based on `php-cs-fixer`.

```terminal
composer install
composer cgl:fix
```
