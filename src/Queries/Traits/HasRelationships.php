<?php


namespace Sfneal\Queries\Traits;


trait HasRelationships
{
    /**
     * @var array
     */
    protected $relationships = [];

    /**
     * Scope Plan search results to only plans that are 'public'
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
