<?php

/*
 * This file is part of Laralum.
 *
 * (c) Erik Campobadal <soc@erik.cat>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Laralum\Laralum;

use Illuminate\Support\Facades\Facade;

/**
 * This is the packages facade class.
 *
 * @author Erik Campobadal <soc@erik.cat>
 */
class Packages extends Facade
{
    /**
     * Returns an array of all the installed packages.
     */
    public static function all()
    {
        // Check for Laralum packages
        $packages = [];
        $location = __DIR__.'/../../';

        $files = is_dir($location) ? scandir($location) : [];

        foreach ($files as $package) {
            if ($package != '.' and $package != '..' and ucfirst($package) != 'Laralum') {
                array_push($packages, $package);
            }
        }

        return $packages;
    }

    /**
     * Returns the package service provider if exists.
     *
     * @param string $package
     */
    public static function provider($package)
    {
        $location = __DIR__.'/../../'.$package.'/src';

        $files = is_dir($location) ? scandir($location) : [];

        foreach ($files as $file) {
            if (strpos($file, 'ServiceProvider') !== false) {
                return str_replace('.php', '', $file);
            }
        }

        return false;
    }

    /**
     * Returns the if the package is installed.
     *
     * @param string $package
     */
    public static function installed($package)
    {
        return in_array($package, static::all());
    }

    /**
     * Returns the package menu if exists.
     *
     * @param string $package
     */
    public static function menu($package)
    {
        $dir = __DIR__.'/../../'.$package.'/src';
        $files = is_dir($dir) ? scandir($dir) : [];

        foreach ($files as $file) {
            if ($file == 'Menu.json') {
                $file_r = file_get_contents($dir . '/' . $file);
                return json_decode($file_r, true);
            }
        }

        return [];
    }

    /**
     * Returns the package submenu if exists.
     *
     * @param string $package
     */
    public static function submenu($package)
    {
        $dir = __DIR__.'/../../'.$package.'/src';
        $files = is_dir($dir) ? scandir($dir) : [];
        
        foreach ($files as $file) {
            if ($file == 'Submenu.json') {
                $file_r = file_get_contents($dir . '/' . $file);
                return json_decode($file_r, true);
            }
        }

        return [];
    }
}
