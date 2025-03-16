Changelog
=========

# 0.x

* 0.0.4
  * Make optional properties nullable

* 0.0.3
  * Added the time argument to the result.
  * Adjusted `HealthCheckInterface` to add the time argument to the result, defining it as nullable `\DateTimeInterface`.
  * Adjusted `CheckResultInterface` to make the time argument nullable.
  * Adjusted `CheckInterface`, renaming `getIdentifier()` to `getTime()` to represent the standard correctly.
  * Updated the JSON example and the JSON schema.
  * Updated the security definition to require HTTPS requests with a security token provided via the `Authorization` header as a Bearer JWT token.
  * Updated the request definition to clarify that requests are not necessarily HTTP-based.
  * Updated the definition to support the names argument for filtering health check results by specific names.
  * Added a basic HTTP request example.

* 0.0.2
  * Using an enum for the `component type` property of the `Check Result`
    entity showed as not suitable, as these value needs to be free to
    choose. Therefore, the enum class is removed and the interface return
    type to `string`.
  * Adding a JSON Schema definition with `health-check-schema.json`, which can be used to validate a json message
    against this schema, for example using [web based JSON Schema Validator](https://www.jsonschemavalidator.net/)
    or similar tools.

* 0.0.1
  * Implement first round if interfaces and enum to pave the way
    for discussions and early POC implementations
