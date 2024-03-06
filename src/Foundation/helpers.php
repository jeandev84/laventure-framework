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


use Laventure\Foundation\Application;

if (! function_exists('app')) {

    function app(): Application
    {
        return Application::getInstance();
    }
}


/*
|------------------------------------------------------------------
|   Get application
|   app_name()
|------------------------------------------------------------------
*/

if(! function_exists('app_name')) {

    function app_name(): string
    {
        return app()->get('app.name');
    }
}




/*
|------------------------------------------------------------------
|   Get base path using in template
|------------------------------------------------------------------
*/

if(! function_exists('base_path')) {

    /**
     * Base Path
     * @param string $path
     * @return string
    */
    function base_path(string $path = ''): string
    {
        return app()->path($path);
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
