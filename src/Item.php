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

/**
 * This is the menu facade class.
 *
 * @author Erik Campobadal <soc@erik.cat>
 */
class Item
{
    public $url;
    public $text;

    /**
     * Set the item URL.
     *
     * @param  string $url
     *
     * @return Item
     */
    public function url($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Set the item text.
     *
     * @param  string $text
     *
     * @return Item
     */
    public function text($text)
    {
        $this->text = $text;

        return $this;
    }

}
