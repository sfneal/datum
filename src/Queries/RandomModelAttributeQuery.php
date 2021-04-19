<?php

namespace Sfneal\Queries;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class RandomModelAttributeQuery extends Query
{
    /**
     * @var Model|string
     */
    private $modelClass;

    /**
     * @var string
     */
    private $attribute;

    /**
     * RandomModelAttributeQuery constructor.
     *
     * @param string $modelClass
     * @param string $attribute
     */
    public function __construct(string $modelClass, string $attribute)
    {
        $this->modelClass = $modelClass;
        $this->attribute = $attribute;
    }

    /**
     * Retrieve a Query builder.
     *
     * @return Builder
     */
    protected function builder(): Builder
    {
        return $this->modelClass::query();
    }

    /**
     * Retrieve a random model attribute from all of the model records.
     *
     * @return mixed
     */
    public function execute()
    {
        return $this->builder()
            ->get($this->attribute)
            ->shuffle()
            ->first()
            ->{$this->attribute};
    }
}
