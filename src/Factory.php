<?php


namespace Alfredluck\Golivephpsdk;

use Alfredluck\Kernel\Support\Str;


class Factory
{

    /**
     * @param string $name
     * @param array  $config
     */
    public static function make($name, array $config)
    {
        $namespace = Str::studly($name);
        $application = "Alfredluck\\Golivephpsdk\\{$namespace}\\Application";
        return new $application($config);
    }

    /**
     * Dynamically pass methods to the application.
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return self::make($name, ...$arguments);
    }
}