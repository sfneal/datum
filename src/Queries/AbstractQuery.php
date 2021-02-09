<?php

namespace Sfneal\Queries;

abstract class AbstractQuery
{
    /**
     * Execute a DB query.
     *
     * @return mixed
     */
    abstract public function execute();
}
