<?php


namespace Sfneal\Queries;

use Illuminate\Database\Eloquent\Model;
use Sfneal\Models\AbstractModel;
use Sfneal\Caching\Traits\Cacheable;

class NextOrPreviousModelQuery extends AbstractQuery
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
     * @var AbstractModel|string
     */
    private $model;

    /**
     * @var int Model ID
     */
    private $model_id;

    /**
     * NextOrPreviousModelQuery constructor.
     *
     * @param AbstractModel|string $model
     * @param int $model_id
     * @param bool $next
     */
    public function __construct($model, int $model_id, bool $next = true)
    {
        $this->model = $model;
        $this->model_id = $model_id;
        $this->next = $next;
        $this->cache_key_string = $next ? 'next' : 'previous';
    }

    /**
     * Retrieve the 'next' or 'previous' Model
     *
     * @return Model|null
     */
    public function execute()
    {
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
     * Set the returned model to 'next'
     *
     * @return $this
     */
    public function next(): self {
        $this->next = true;
        $this->cache_key_string = 'next';
        return $this;
    }

    /**
     * Set the returned model to 'previous'
     *
     * @return $this
     */
    public function previous(): self {
        $this->next = false;
        $this->cache_key_string = 'previous';
        return $this;
    }

    /**
     * Retrieve the Queries Cache Key
     *
     * @return string
     */
    public function cacheKey(): string
    {
        return $this->model::getTableName() . ":{$this->cache_key_string}:#{$this->model_id}";
    }
}
