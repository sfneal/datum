<?php


namespace Sfneal\Queries\Traits;


trait HasKeyParam
{
    /**
     * @var int|array|null
     */
    private $modelKey;

    /**
     * @var array
     */
    private $params;

    /**
     * ArticleQuery constructor.
     *
     * @param int|array|null $modelKey
     * @param mixed ...$params
     */
    public function __construct($modelKey = null, ...$params)
    {
        $this->modelKey = $modelKey;
        $this->params = $params;
    }
}
