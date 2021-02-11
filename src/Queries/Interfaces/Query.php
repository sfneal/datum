<?php

namespace Sfneal\Queries\Interfaces;

interface Query
{
    /**
     * Execute a DB query.
     *
     * @return mixed
     */
    public function execute();
}
