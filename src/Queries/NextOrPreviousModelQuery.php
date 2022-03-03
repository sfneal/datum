<?php

namespace Sfneal\Queries;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Sfneal\Caching\Traits\Cacheable;
use Sfneal\Models\Model;

class NextOrPreviousModelQuery extends Query
{
    use Cacheable;

    /**
     * @var bool Determine if the return model should be the 'next' or 'previous'
     */
    private $next;

    /**
     * @var string Cache Key String ('next' or 'previous')
     */
    private $cache_key_string;

    /**
     * @var Model|string
     */
    private $model;

    /**
     * @var int Model ID
     */
    private $model_id;

    /**
     * NextOrPreviousModelQuery constructor.
     *
     * @param  Model|string  $model
     * @param  int  $model_id
     * @param  bool  $next
     */
    public function __construct($model, int $model_id, bool $next = true)
    {
        $this->model = $model;
        $this->model_id = $model_id;
        $this->next = $next;
        $this->cache_key_string = $next ? 'next' : 'previous';
    }

    /**
     * Retrieve a Query builder.
     *
     * @return Builder
     */
    protected function builder(): Builder
    {
        return $this->model::query();
    }

    /**
     * Retrieve the 'next' or 'previous' Model.
     *
     * @return EloquentModel|null
     */
    public function execute(): ?EloquentModel
    {
        // todo: improve return type hinting
        $query = $this->model::query();

        // Next Model
        if ($this->next == true) {
            return $query->getNextModel($this->model_id);
        }

        // Previous Model
        else {
            return $query->getPreviousModel($this->model_id);
        }
    }

    /**
     * Set the returned model to 'next'.
     *
     * @return $this
     */
    public function next(): self
    {
        $this->next = true;
        $this->cache_key_string = 'next';

        return $this;
    }

    /**
     * Set the returned model to 'previous'.
     *
     * @return $this
     */
    public function previous(): self
    {
        $this->next = false;
        $this->cache_key_string = 'previous';

        return $this;
    }

    /**
     * Retrieve the Queries Cache Key.
     *
     * @return string
     */
    public function cacheKey(): string
    {
        return $this->model::getTableName().":{$this->cache_key_string}:{$this->model_id}";
    }
}
