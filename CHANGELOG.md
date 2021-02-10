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


## 0.5.0 - 2021-02-08
- cut PublicStatusFilter class
- refactor Sfneal\Filters\FilterListString to Sfneal\Filters\AbstractFilter


## 0.6.0 - 2021-02-09
- refactor Sfneal\Queries\AbstractQueryCacheAttribute to Sfneal\Queries\CacheModel & expanded functionality
- add tests for evaluating AbstractQueryWithFilter functionality


## 0.7.0 - 2021-02-09
- cut AbstractStaticQuery as it provides no additional functionality compared to AbstractQuery (and use cases result in inconsistent method params & returns)
- add abstract execute() method to AbstractQuery that will force child classes to conform


## 0.7.1 - 2021-02-09
- make Sfneal\Queries\Traits\HasKeyParam trait for AbstractQuery extensions that require a $modelKey param
- add improved type hinting to test Filters & Queries


## 0.7.2 - 2021-02-10
- bump min sfneal/caching version to 1.2 to make use of isCached() method provided by the Cacheable trait
- optimize return type hinting in NextOrPreviousModel::execute() method
