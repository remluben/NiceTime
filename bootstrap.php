<?php

/**
 * @see https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md
 * @package Remluben/DateFormat
 * @author Benjamin Ulmer
 * @copyright GPL-3.0
 * @link https://github.com/remluben/NiceTime
 */

function autoload($className)
{
    $className = ltrim($className, '\\');
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require 'src' . DIRECTORY_SEPARATOR . $fileName;
}

spl_autoload_register('autoload');