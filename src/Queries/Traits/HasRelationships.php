<?php

namespace Sfneal\Queries\Traits;

// todo: add tests with relationship
use Illuminate\Database\Eloquent\Builder;

trait HasRelationships
{
    /**
     * @var array
     */
    protected $relationships = [];

    /**
     * Scope Plan search results to only plans that are 'public'.
     *
     * @param array $relationships
     * @return $this
     */
    public function withRelationships(array $relationships = []): self
    {
        $this->relationships = $relationships;

        return $this;
    }

    /**
     * Retrieve a Query builder.
     *
     * @return Builder
     */
    abstract protected function newBuilder(): Builder;

    /**
     * Retrieve a Query builder.
     *
     * @return Builder
     */
    protected function builder(): Builder
    {
        $builder = $this->newBuilder();

        if ($this->relationships) {
            $builder->with($this->relationships);
        }

        return $builder;
    }
}
