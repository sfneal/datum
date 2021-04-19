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
     * @var int
     */
    private $take;

    /**
     * RandomModelAttributeQuery constructor.
     *
     * @param string $modelClass
     * @param string $attribute
     * @param int $take
     */
    public function __construct(string $modelClass, string $attribute, int $take = 1)
    {
        $this->modelClass = $modelClass;
        $this->attribute = $attribute;
        $this->take = $take;
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
        $attributes = $this->builder()
            ->distinct()
            ->get($this->attribute)
            ->shuffle()
            ->take($this->take)
            ->pluck($this->attribute);

        // Return a single attribute
        if ($attributes->count() == 1) {
            return $attributes->first();
        }
        // Return an array of attributes if more than '1' is being taken
        else {
            return $attributes->toArray();
        }
    }
}
