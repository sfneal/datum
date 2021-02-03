<?php

namespace Sfneal\Queries\Interfaces;

interface DynamicQuery
{
    /**
     * Pass an array of filters to be used in query.
     *
     * Query constructor.
     * @param array $filters
     */
    public function __construct(array $filters);

    /**
     * Execute a DB query using filter parameters.
     */
    public function execute();
}
