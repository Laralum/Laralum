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

use Auth;
use Laralum\Users\Models\User;

/**
 * This is the menu facade class.
 *
 * @author Erik Campobadal <soc@erik.cat>
 */
class Menu
{
    public $name;
    public $items = [];

    /**
     * Set the name of the menu.
     *
     * @param string $name
     *
     * @return Menu
     */
    public function name($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Adds the item to the menu.
     *
     * @param Item $item
     *
     * @return Menu
     */
    public function item($item)
    {
        array_push($this->items, $item);

        return $this;
    }
    
    /**
     * Generates a full menu with all packages / permissions.
     *
     * @return array
     */
    public static function generate()
    {
        $user = User::findOrFail(Auth::id());
        $m = new self();

        foreach (Packages::all() as $package) {
            $pm = new self();
            $pm->name(ucfirst($package));
            $pma = Packages::menu($package);

            if (array_key_exists('items', $pma)) {
                $pm->items = array_merge($pm->items, static::getPackageMenuItems($pma, $user));
            }

            if (count($pm->items) > 0) {
                $m->item($pm);
            }
        }

        $m->items = array_merge($m->items, static::getCustomMenuItems($user));

        return $m->items;
    }

    /**
     * Get custom menus defined in the laralum config.
     * 
     * @return [type] [description]
     */
    public static function getCustomMenuItems($user)
    {
        $menuItems = [];

        if (array_key_exists('menu', config('laralum'))) {
            foreach (config('laralum.menu') as $custom_menu) {
                $pm = new self();
                $pm->name(ucfirst($custom_menu['title']));
                $pm->items = array_merge($pm->items, static::getPackageMenuItems($custom_menu, $user));

                if (count($pm->items) > 0) {
                    array_push($menuItems, $pm);
                }
            }
        }

        return $menuItems;
    }

    /**
     * Get package menu Items.
     * 
     * @param  [type] $packageMenu [description]
     * @param  [type] $items       [description]
     * @return [type]              [description]
     */
    public static function getPackageMenuItems($menu, $user)
    {
        $packageItems = [];

        foreach ($menu['items'] as $i) {
            $item = new Item();
            $item->text = array_key_exists('trans', $i) ? __($i['trans']) : $i['text'];
            $item->url = array_key_exists('route', $i) ? route($i['route']) : url($i['link']);

            if (array_key_exists('permission', $i) && !$user->superAdmin()) {
                if (!$user->hasPermission($i['permission'])) {
                    continue;
                }
            }

            array_push($packageItems, $item);
        }

        return $packageItems;
    }
}
