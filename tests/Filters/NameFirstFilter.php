<?php

namespace Sfneal\Datum\Tests\Filters;

use Sfneal\Filters\FilterListString;

class NameFirstFilter extends FilterListString
{
    /**
     * @var string
     */
    protected $column = 'name_first';
}
