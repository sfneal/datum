<?php

namespace Sfneal\Queries;

use Illuminate\Database\Eloquent\Model;
use Sfneal\Caching\Traits\Cacheable;

class CacheModelQuery extends AbstractQuery
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
     * @param string|null $model
     * @param string|null $attribute
     */
    public function __construct(int $model_key, string $model = null, string $attribute = null)
    {
        $this->model_key = $model_key;
        $this->model = $this->model ?? $model;
        $this->attribute = $this->attribute ?? $attribute;
    }

    /**
     * Retrieve a Service's title.
     *
     * @return Model|string
     */
    public function execute()
    {
        // Retrieve the model
        $model = $this->model::query()->find($this->model_key);

        // Return the entire model if no attribute is set
        if (is_null($this->attribute)) {
            return $model;
        }

        // Return a specific model
        else {
            return $model->getAttribute($this->attribute);
        }
    }

    /**
     * Key to use for cache store.
     *
     * @return string
     */
    public function cacheKey(): string
    {
        $table = (new $this->model)->getTable();
        $key = "{$table}:{$this->model_key}";

        return $key.(is_null($this->attribute) ? '' : ":{$this->attribute}");
    }
}
