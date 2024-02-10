<?php

/*
|------------------------------------------------------------------
|   Functions helpers of application
|------------------------------------------------------------------
*/

/*
|------------------------------------------------------------------
|   Get environment param
|   env('SECRET_KEY', 'some_hash')
|------------------------------------------------------------------
*/


use Laventure\Component\Container\Container;

if (! function_exists('app')) {

    function app(): Container
    {
        return Container::getInstance();
    }
}


if(! function_exists('env')) {
    /**
     * Get item from environment or default value
     *
     * @param $key
     * @param null $default
     * @return array|string|null
     */
    function env($key, $default = null)
    {
        $value = getenv($key);

        if(! $value) {
            return $default;
        }

        return $value;
    }
}
