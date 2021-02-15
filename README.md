# Datum

[![Packagist PHP support](https://img.shields.io/packagist/php-v/sfneal/datum)](https://packagist.org/packages/sfneal/datum)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/sfneal/datum.svg?style=flat-square)](https://packagist.org/packages/sfneal/datum)
[![Build Status](https://travis-ci.com/sfneal/datum.svg?branch=master&style=flat-square)](https://travis-ci.com/sfneal/datum)
[![StyleCI](https://github.styleci.io/repos/335684072/shield?branch=master)](https://github.styleci.io/repos/335684072?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sfneal/datum/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sfneal/datum/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/sfneal/datum.svg?style=flat-square)](https://packagist.org/packages/sfneal/datum)

Construct reusable & cacheable Eloquent queries with custom filters.

## Installation

You can install the package via composer:

```bash
composer require sfneal/datum
```

## Usage

### Basic Query
The Query abstract class requires a `builder()` & `execute()` method must be implemented.  The `builder()` method retrieves a
Builder instance for constructing the query (useful for adding or removing scopes).  The `execute()` method is where the
remainder of the query params can be added.  Expected return type is a Builder but this can be overwritten to be a
Collection, array, string, etc.  In this case we're using the HasKeyParam to accept a `$modelKey` param in the Query's
__construct method.

``` php
use Illuminate\Database\Eloquent\Builder;
use Sfneal\Queries\Query;
use Sfneal\Queries\Traits\HasKeyParam;

class PeopleQuery extends Query
{
    use HasKeyParam;
    
    /**
     * Retrieve a Query builder.
     *
     * @return Builder
     */
    protected function builder(): Builder
    {
        return People::query();
    }

    /**
     * Execute a DB query.
     *
     * @return Builder
     */
    public function execute(): Builder
    {
        return $this->builder()
            ->where('person_id', '=', $this->modelKey);
    }
}


// Example use
$model = (new PeopleQuery($id))->execute()->get()
```


### Advanced Query (with filters)
The FilterableQuery abstract class extends the previously mentioned Query abstract class while providing additional 
functionality by using Filters.  The `execute` method that is required by the abstract Query is pre-defined but a
`builder` method must still be implemented.  Additionally, FilterableQuery requires a `queryFilters()` method be
implemented that returns an array of Filter classes that can be used to add predefined filters to a query.

Before creating a FilterableQuery extension, the Filters that Query will use should be created.

``` php
use Illuminate\Database\Eloquent\Builder;
use Sfneal\Filters\Filter;

class NameLastFilter implements Filter
{
    /**
     * Apply a given search value to the builder instance.
     *
     * @param Builder $query
     * @param mixed $value
     * @return Builder $query
     */
    public function apply(Builder $query, $value): Builder
    {
        $query->whereIn('name_last', (array) $value);

        return $query;
    }
}


class CityFilter implements Filter
{
    /**
     * Apply a given search value to the builder instance.
     *
     * @param Builder $query
     * @param mixed $value
     * @return Builder $query
     */
    public function apply(Builder $query, $value): Builder
    {
        $query->whereIn('city', (array) $value);

        return $query;
    }
}
```

Now that we've created our Filters, a FilterableQuery extension can be created that uses them.

``` php
use CityFilter;
use NameLastFilter;
use Sfneal\Queries\FilterableQuery;

class PeopleFilterableQuery extends FilterableQuery
{
    /**
     * Retrieve a Query builder.
     *
     * @return Builder
     */
    protected function builder(): Builder
    {
        return People::query();
    }

    /**
     * Retrieve an array of model attribute keys & corresponding Filter class values.
     *
     * @return array
     */
    protected function queryFilters(): array
    {
        return [
            'city' => CityFilter::class,
            'name_last' => NameLastFilter::class,
        ];
    }
}
```

With the FilterableQuery finally created, we can pass filter params to it and receive results.

``` php
$filters = [
    'name_last' => 'Brady'
    'city' => 'Brookline',
];

$results = (new PeopleQueryWithFilters($filters))->execute()->get();
```

Since we built the Filter implementations to mutate filter $values to arrays, we can pass an array of valid filters to
retrieve more results.

``` php
$filters = [
    'name_last' => [
        'Neal',
        'Brady',
    ],
    'city' => [
        'Brookline',
        'Boston',
    ],
];

$results = (new PeopleQueryWithFilters($filters))->execute()->get();
```


## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email stephen.neal14@gmail.com instead of using the issue tracker.

## Credits

- [Stephen Neal](https://github.com/sfneal)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## PHP Package Boilerplate

This package was generated using the [PHP Package Boilerplate](https://laravelpackageboilerplate.com).
