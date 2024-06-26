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


## 0.8.0 - 2021-02-11
- cut __construct method from FilterDynamic because changing the column during runtime was unneeded
- refactor Sfneal\Filters\FilterInterface to Sfneal\Filters\Filter
- refactor Sfneal\Filters\AbstractFilter to Sfneal\Filters\FilterDynamic because its not a general abstraction
- refactor Sfneal\Queries\Interfaces\DynamicQuery to Sfneal\Queries\Query


## 0.9.0 - 2021-02-11
- add abstract queryFilters() method to ApplyFilter for declaring an array of Filters 
- cut $attribute_filters properties from AbstractQueryWithFilter(s) and replaced with queryFilters() methods.


## 0.9.1 - 2021-02-11
- make Sfneal\Queries\Traits\HasRelationships trait for dynamically adding relationships to a query


## 0.10.0 - 2021-02-12
- add builder() method to Query interface for dynamically declaring a Query Builder instance
- refactor AbstractQueryWithFilter & AbstractQueryWithFilters to single AbstractFilterableQuery class that can handle single Filters or arrays of Filters
- add overridable default execute() method to AbstractFilterableQuery that apply's the Filters to the Query Builder
- add filterQuery() method to HasFilters trait (and in turn AbstractFilterableQuery) that either applies a Single filter or an array of Filters to the Query


## 0.10.1 - 2021-02-12
- fix AbstractFilterableQuery::execute methods return type hinting


## 0.10.2 - 2021-02-12
- fix visibility of $filter & $filters properties in AbstractFilterableQuery


## 0.11.0 - 2021-02-15
- refactor Query interface to abstract class in order to make builder methods protected


## 0.12.0 - 2021-02-15
- refactor FilterDynamic to DynamicFilter
- refactor AbstractFilterableQuery to FilterableQuery


## 1.0.0 - 2021-02-15
- initial production release
- add basic & advanced use explanations to docs


## 1.1.0 - 2021-04-06
- fix sfneal packages version constraints to ^1.0


## 1.2.0 - 2021-04-07
- bump sfneal/models min version to v2.0
- refactor use of Eloquent `Model` to Sfneal `AbstractModel`
- bump sfneal/caching min version to v1.3 to avoid conflicts with sfneal/actions v2.0


## 1.3.0 - 2021-04-08
- optimize Travis CI config & enable code coverage uploading to Scrutinizer
- make `HasFilter` & `DoesntHaveFilter` for dynamically adding relationship scopes to queries
- bump sfneal/models min version


## 1.3.1 - 2021-04-19
- reformat `HasRelationships` traits phpdocs


## 1.4.0 - 2021-04-19
- make `RandomModelAttributeQuery` for retrieving a random model attribute in test suites


## 1.4.1 - 2021-04-19
- add ability to retrieve more than one attribute using `RandomModelAttributeQuery`


## 1.5.0 - 2021-04-21
- make 'Sfneal\Requests' namespace & abstract `FormRequest` class


## 1.5.1 - 2021-06-17
- optimize test suite by refactoring into 'Feature' & 'Unit' directories
 
 
## 1.5.2 - 2021-08-18
- add explicit sfneal/address dev requirement because it was removed as a dependency of sfneal/models


## 1.5.3 - 2021-08-31
- add support for sfneal/caching v2.0
- fix use of '#' cache key id suffix delimiter with ':'


## 1.6.0 - 2022-02-28
- add support for running test suite inside Docker containers & using GitHub actions
- bump composer package constraints to support latest versions


## 2.0.0 - 2024-04-01
- cut support for PHP 7
- add support for PHP 8.2 & 8.3
- bump composer package constraints to latest versions


## 2.0.1 - 2024-04-25
- add new GitHub actions to the CI pipline
- add support for sfneal/caching v4.0


## 2.0.2 - 2024-05-06
- bump sfneal/models to v4
- bump sfneal/address requirement from ^2.0 to ^2.0 || ^3.0
