<?php


namespace Golivephpsdk;

use Golivephpsdk\Kernel\Support\Str;


/**
 * Class Factory
 *
 * @method static \Golivephpsdk\GoliveJavaCard\Application   goliveJavaCard(array $config)
 *
 * @package Golivephpsdk
 */
class Factory
{

    /**
     * @param string $name
     * @param array  $config
     */
    public static function make($name, array $config)
    {
        $namespace = Str::studly($name);
        $application = "Golivephpsdk\\{$namespace}\\Application";
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