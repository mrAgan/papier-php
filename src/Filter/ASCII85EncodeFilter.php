<?php

namespace Papier\Filter;

use Papier\Filter\Base\Filter;
use Papier\Object\DictionaryObject;

class ASCII85EncodeFilter extends Filter
{
    /**
     * Process value.
     *
     * @param string $value
     * @param DictionaryObject|null $param
     * @return string
     */
    public static function process(string $value, DictionaryObject $param = null): string
    {
        return ASCII85Filter::decode($value, $param);
    }
}