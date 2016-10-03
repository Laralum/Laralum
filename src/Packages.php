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
        $file = file_get_contents(base_path().'/composer.json');
        $json = json_decode($file, true);

        // Check for laralum packages
        $packages = [];

        foreach (scandir(__DIR__.'/../../') as $package) {
            if ($package != '.' and $package != '..' and $package != 'laralum') {
                array_push($packages, $package);
            }
        }

        return $packages;
    }

    /**
     * Returns the package service provider if exists.
     */
    public static function provider($package)
    {
        $files = scandir(__DIR__.'/../../'.$package.'/src');
        foreach ($files as $file) {
            if (strpos($file, 'ServiceProvider') !== false) {
                return str_replace('.php', '', $file);
            }
        }

        return false;
    }
}
