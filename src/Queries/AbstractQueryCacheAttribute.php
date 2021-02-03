<?php

namespace Sfneal\Queries;

use Illuminate\Database\Eloquent\Model;
use Sfneal\Caching\Traits\Cacheable;
use Sfneal\Helpers\Redis\RedisCache;

abstract class AbstractQueryCacheAttribute extends AbstractQuery
{
    /**
     * Inherit cache methods.
     */
    use Cacheable;

    /**
     * Target Model.
     *
     * @var Model
     */
    protected $model;

    /**
     * Model's attribute to cache.
     *
     * @var string
     */
    protected $attribute;

    /**
     * Model ID.
     *
     * @var int
     */
    public $model_key;

    /**
     * QueryCacheAttribute constructor.
     *
     * @param int $model_key
     */
    public function __construct(int $model_key)
    {
        $this->model_key = $model_key;
    }

    /**
     * Retrieve a Service's title.
     *
     * @return string
     */
    public function execute(): string
    {
        return $this->model::query()->find($this->model_key)->getAttribute($this->attribute);
    }

    /**
     * Key to use for cache store.
     *
     * @return string
     */
    public function cacheKey(): string
    {
        $table = (new $this->model)->getTable();

        return "{$table}:{$this->model_key}:{$this->attribute}";
    }

    /**
     * Determine if the query is currently cached
     *
     * @return bool
     */
    public function isCached(): bool
    {
        return RedisCache::exists($this->cacheKey());
    }
}
