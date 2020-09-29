<?php

namespace Papier\Object;

use Papier\Base\IndirectObject;
use Papier\Validator\StringValidator;

use InvalidArgumentException;

class NameObject extends IndirectObject
{
    /**
     * Set object's value.
     *
     * @param mixed $value
     * @return NameObject
     * @throws InvalidArgumentException if the provided argument is not of type 'string'.
     */
    public function setValue($value)
    {
        if (!StringValidator::isValid($value)) {
            throw new InvalidArgumentException("String is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        return parent::setValue($value);
    } 
    

    /**
     * Format object's value.
     *
     * @return string
     */
    public function format()
    {
        $value = $this->getValue();

        $trans = array(
            ' ' => '#20', '(' => '#28', ')' => '#29', '#' => '#23', '<' => '#3C', '>' => '#3E', 
            '[' => '#5B', ']' => '#5D', '{' => '#7B', '}' => '#7D', '/' => '#2F', '%' => '#25'
        );

        $value = strtr($value, $trans);

        return '/' .$value;
    }
}