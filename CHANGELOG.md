Changelog
=========

# 0.x

* 0.0.x
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
