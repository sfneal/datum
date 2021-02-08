# Changelog

All notable changes to `datum` will be documented in this file

## 0.1.0 - 2021-02-03
- initial release
- merge sfneal/filters & sfneal/queries packages


## 0.2.0 - 2021-02-03
- add registration of service providers for testing caching
- improved test suite
- fix issues with FilterListString applying intval to strings


## 0.3.0 - 2021-02-08
- add isCached() method to AbstractQueryCacheAttribute
- refactor FilterListString's default handling of 'list string'
- refactor FilterInterface::apply method to no longer be static
- fix FilterListString::stringValueClause() method to type cast strings to arrays


## 0.4.0 - 2021-02-08
- cut FilterNullableInterface
