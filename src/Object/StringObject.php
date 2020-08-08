<?php

namespace Papier\Object\Base;

use Papier\Base\IndirectObject;
use Papier\Validator\StringValidator;

use InvalidArgumentException;

class StringObject extends IndirectObject
{
    /**
    * Set object's value.
    *
    * @param  mixed  $value
    * @throws InvalidArgumentException if the provided argument is not of type 'string'.
    * @return \Papier\Object\StringObject
    */
    public function setValue($value)
    {
        if (!StringValidator::isValid($value)) {
            throw new InvalidArgumentException("String is incorrect. See ".get_class($this)." class's documentation for possible values.");
        }

        return parent::setValue($value);
    } 
}