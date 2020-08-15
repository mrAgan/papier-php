<?php

namespace Papier\Type;

use Papier\Type\TreeNodeType;
use Papier\Object\LiteralStringKeyArrayObject;
use Papier\Object\LiteralStringObject;
use Papier\Object\LimitsArrayObject;

use Papier\Factory\Factory;

use InvalidArgumentException;
use RunTimeException;

class NameTreeNodeType extends TreeNodeType
{ 
    /**
     * Add kid to node.
     *  
     * @return \Papier\Type\NameTreeNodeType
     */
    public function addKid()
    {
        $node = Factory::getInstance()->createType('NameTreeNode');
        $this->getKids()->append($node);

        return $node;
    }

    /**
     * Add name to node.
     *  
     * @param  mixed  $object
     * @param  string  $key
     * @return \Papier\Type\NameTreeNodeType
     */
    public function addName($key, $object)
    {
        $this->getNames()->setEntry($key, $object);
        return $this;
    }

    /**
     * Set names.
     *  
     * @param  \Papier\Object\LiteralStringKeyArrayObject  $names
     * @throws InvalidArgumentException if the provided argument is not of type 'ArrayObject'.
     * @throws RunTimeException if node already contains 'Names' key.
     * @return \Papier\Document\DocumentCatalog
     */
    protected function setNames($names)
    {
        if (!$names instanceof LiteralStringKeyArrayObject) {
            throw new InvalidArgumentException("Names is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        if ($this->hasEntry('Kids')) {
            throw new RunTimeException("Kids is already present. See ".__CLASS__." class's documentation for possible values.");  
        }

        return $this->setEntry('Names', $names);
    } 

    /**
     * Get kids.
     *  
     * @throws RunTimeException if node already contains 'Kids' key.
     * @return \Papier\Object\LiteralStringKeyArrayObject
     */
    protected function getNames()
    {
        if ($this->hasEntry('Kids')) {
            throw new RunTimeException("Kids is already present. See ".__CLASS__." class's documentation for possible values.");  
        }

        if (!$this->hasEntry('Names')) {
            $names = new LiteralStringKeyArrayObject();
            $this->setEntry('Names', $names);
        }

        return $this->getEntry('Names');
    }

    /**
     * Get names from node.
     *
     * @param  \Papier\Type\TreeNodeType  $node
     * @return array
     */    
    protected function collectNames($node)
    {        
        if (!$node instanceof TreeNodeType) {
            throw new InvalidArgumentException("Node is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }  

        $objects = array();

        if ($node->hasEntry('Names')) {
            $names = $node->getEntry('Names')->getKeys();
            $objects = array_merge($objects, $names);
        } else {
            $kids = $node->getEntry('Kids');
            
            if (count($kids) > 0) {
                foreach ($kids as $kid) {
                    $names = $this->collectNames($kid);
                    $objects = array_merge($objects, $names);
                }
            }
        }

        return $objects;
    }

    /**
     * Format object's value.
     *
     * @return string
     */
    public function format()
    {
        if (!$this->isRoot()) {
            // Compute limits
            $limits = new LimitsArrayObject();
            $objects = $this->collectNames($this);

            if (count($objects)) {
                sort($objects);

                $first = new LiteralStringObject();
                $last = new LiteralStringObject();
                            
                $first->setValue(array_shift($objects));
                $last->setValue(array_pop($objects));
                
                $limits->append($first);
                $limits->append($last);
        
                $this->setLimits($limits);
            }
        }
        
        return parent::format();
    }
}