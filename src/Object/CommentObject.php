<?php

namespace Papier\Object;

use Papier\Base\BaseObject;
use Papier\Validator\StringValidator;

use InvalidArgumentException;

class CommentObject extends BaseObject
{
    /**
    * Set comment's value.
    *
    * @param  mixed  $value
    * @throws InvalidArgumentException if the provided argument is not of type 'string'.
    * @return \Papier\Base\Comment
    */
    public function setValue($value)
    {
        if (!StringValidator::isValid($value)) {
            throw new InvalidArgumentException("String is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        return parent::setValue($value);
    } 

    /**
     * Format comment's value.
     *
     * @return string
     */
    public function format()
    {
        $value = $this->getValue();

        $trans = array('%' => '\%');
        $value = strtr($value, $trans);

        return '%'.$value;
    }
}