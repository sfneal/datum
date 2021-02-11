<?php

namespace Sfneal\Queries;

interface Query
{
    /**
     * Execute a DB query.
     *
     * @return mixed
     */
    public function execute();
}
