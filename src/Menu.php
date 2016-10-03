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
use Request;

/**
 * This is the menu facade class.
 *
 * @author Erik Campobadal <soc@erik.cat>
 */
class Menu extends Facade
{
    public static function add($data)
    {
        $value = session('laralum_menu');

        if(!$value){
            $value = [];
        }

        array_push($value, $data);
        session(['laralum_menu' => $value]);
    }
}
