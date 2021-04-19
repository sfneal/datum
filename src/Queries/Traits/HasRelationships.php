<?php

namespace Sfneal\Queries\Traits;

// todo: add tests with relationship

trait HasRelationships
{
    /**
     * @var array
     */
    protected $relationships = [];

    /**
     * Dynamically eager load model relationships.
     *
     * @param array $relationships
     * @return $this
     */
    public function withRelationships(array $relationships = []): self
    {
        $this->relationships = $relationships;

        return $this;
    }
}
