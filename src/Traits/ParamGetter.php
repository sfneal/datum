<?php


namespace Sfneal\Queries\Traits;


use Illuminate\Http\Request;

trait ParamGetter
{
    /**
     * Retrieve a parameter that can be set by a variable or request input
     *
     * @param Request|null $request
     * @param array $parameters
     * @param null $key
     * @return mixed|null
     */
    private static function getParam(Request $request = null, array $parameters = [], $key = null) {
        // Parameter is specified
        if (array_key_exists($key, $parameters)) {
            return $parameters[$key];
        }

        // Param is not specified but the $request has the $key
        elseif ($request && $request->has($key)) {
            return $request->input($key);
        }

        // Not parameter passed
        else {
            return null;
        }
    }
}
