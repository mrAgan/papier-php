<?php

namespace Papier\Type;

use Papier\Object\DictionaryObject;
use Papier\Object\NameObject;
use Papier\Object\IntegerObject;
use Papier\Object\ArrayObject;
use Papier\Object\StreamObject;

use Papier\Type\DateType;
use Papier\Type\ByteStringType;
use Papier\Type\NumberType;

use Papier\Validator\BoolValidator;
use Papier\Validator\TabOrderValidator;
use Papier\Validator\IntValidator;
use Papier\Validator\RealValidator;

use Papier\Factory\Factory;


use InvalidArgumentException;

class PageObjectType extends DictionaryObject
{
    /**
     * Set parent.
     *  
     * @param  \Papier\Type\PageTreeNodeType  $parent
     * @throws InvalidArgumentException if the provided argument is not of type 'PageTreeNodeType'.
     * @return \Papier\Type\PageObjectType
     */
    public function setParent($parent)
    {
        if (!$parent instanceof PageTreeNodeType) {
            throw new InvalidArgumentException("Parent is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $this->setEntry('Parent', $parent);
        return $this;
    } 

     /**
     * Get parent.
     *  
     * @return \Papier\Type\PageObjectType
     */
    public function getParent()
    {
        return $this->getEntry('Parent');
    } 

    /**
     * Set date and time of last object's modification.
     *  
     * @param  \Papier\Type\DateType  $date
     * @throws InvalidArgumentException if the provided argument is not of type 'DateType'.
     * @return \Papier\Type\PageObjectType
     */
    public function setLastModified($date)
    {
        if (!$date instanceof DateType) {
            throw new InvalidArgumentException("ExtGState is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $this->setEntry('LastModified', $date);
        return $this;
    } 

    /**
     * Set resources.
     *  
     * @param  \Papier\Object\DictionaryObject  $resources
     * @throws InvalidArgumentException if the provided argument is not of type 'DictionaryObject'.
     * @return \Papier\Type\PageObjectType
     */
    public function setResources($resources)
    {
        if (!$resources instanceof DictionaryObject) {
            throw new InvalidArgumentException("Resources is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $this->setEntry('Resources', $resources);
        return $this;
    } 

    /**
     * Set boundaries of the physical medium on which the page shall be displayed or printed.
     *  
     * @param  \Papier\Type\RectangleType  $mediabox
     * @throws InvalidArgumentException if the provided argument is not of type 'RectangleType'.
     * @return \Papier\Type\PageObjectType
     */
    public function setMediaBox($mediabox)
    {
        if (!$mediabox instanceof RectangleType) {
            throw new InvalidArgumentException("MediaBox is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $this->setEntry('MediaxBox', $mediabox);
        return $this;
    }

    /**
     * Set the visible region of default user space.
     *  
     * @param  \Papier\Type\RectangleType  $cropbox
     * @throws InvalidArgumentException if the provided argument is not of type 'RectangleType'.
     * @return \Papier\Type\PageObjectType
     */
    public function setCropBox($cropbox)
    {
        if (!$cropbox instanceof RectangleType) {
            throw new InvalidArgumentException("CropBox is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $this->setEntry('CropBox', $cropbox);
        return $this;
    }

    /**
     * Set region to which the contents of the page shall be clipped when output in a production enviroment.
     *  
     * @param  \Papier\Type\RectangleType  $bleedbox
     * @throws InvalidArgumentException if the provided argument is not of type 'RectangleType'.
     * @return \Papier\Type\PageObjectType
     */
    public function setBleedBox($bleedbox)
    {
        if (!$bleedbox instanceof RectangleType) {
            throw new InvalidArgumentException("BleedBox is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $this->setEntry('BleedBox', $bleedbox);
        return $this;
    }

    /**
     * Set intended dimensions of the finished page after trimming.
     *  
     * @param  \Papier\Type\RectangleType  $trimbox
     * @throws InvalidArgumentException if the provided argument is not of type 'RectangleType'.
     * @return \Papier\Type\PageObjectType
     */
    public function setTrimBox($trimbox)
    {
        if (!$trimbox instanceof RectangleType) {
            throw new InvalidArgumentException("TrimBox is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $this->setEntry('TrimBox', $trimbox);
        return $this;
    }

    /**
     * Set extend of the page's meaningful content.
     *  
     * @param  \Papier\Type\RectangleType  $artbox
     * @throws InvalidArgumentException if the provided argument is not of type 'RectangleType'.
     * @return \Papier\Type\PageObjectType
     */
    public function setArtBox($artbox)
    {
        if (!$artbox instanceof RectangleType) {
            throw new InvalidArgumentException("ArtBox is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $this->setEntry('ArtBox', $artbox);
        return $this;
    }

    /**
     * Set colours and other visual characteristics.
     *  
     * @param  \Papier\Object\DictionaryObject  $boxcolorinfo
     * @throws InvalidArgumentException if the provided argument is not of type 'DictionaryObject'.
     * @return \Papier\Type\PageObjectType
     */
    public function setBoxColorInfo($boxcolorinfo)
    {
        if (!$boxcolorinfo instanceof DictionaryObject) {
            throw new InvalidArgumentException("BoxColorInfo is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $this->setEntry('BoxColorInfo', $boxcolorinfo);
        return $this;
    }


    /**
     * Set the contents of the page.
     *  
     * @param  mixed  $contents
     * @throws InvalidArgumentException if the provided argument is not of type 'StreamObject' or 'ArrayObject'.
     * @return \Papier\Type\PageObjectType
     */
    public function setContents($contents)
    {
        if (!$contents instanceof StreamObject && !$contents instanceof ArrayObject) {
            throw new InvalidArgumentException("Contents is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $this->setEntry('Contents', $contents);
        return $this;
    }

    /**
     * Set the number of degrees by which the page should be rotated before printed or displayed.
     *  
     * @param  int  $rotate
     * @throws InvalidArgumentException if the provided argument is not of type int.
     * @return \Papier\Type\PageObjectType
     */
    public function setRotate($rotate)
    {
        if (!IntValidator::isValid($rotate)) {
            throw new InvalidArgumentException("Rotate is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $value = new IntegerObject();
        $value->setValue($rotate);

        $this->setEntry('Rotate', $value);
        return $this;
    }

    /**
     * Set attributes of the page's page group for use in the transparent imaging model.
     *  
     * @param  \Papier\Object\DictionaryObject  $boxcolorinfo
     * @throws InvalidArgumentException if the provided argument is not of type 'DictionaryObject'.
     * @return \Papier\Type\PageObjectType
     */
    public function setGroup($group)
    {
        if (!$group instanceof DictionaryObject) {
            throw new InvalidArgumentException("Group is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $this->setEntry('Group', $group);
        return $this;
    }


    /**
     * Set the thumbnail image of the page.
     *  
     * @param  \Papier\Object\StreamObject  $contents
     * @throws InvalidArgumentException if the provided argument is not of type 'StreamObject'.
     * @return \Papier\Type\PageObjectType
     */
    public function setThumb($thumb)
    {
        if (!$thumb instanceof StreamObject) {
            throw new InvalidArgumentException("Thumb is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $this->setEntry('Thumb', $thumb);
        return $this;
    }

    /**
     * Set references to articles beads.
     *  
     * @param  \Papier\Object\ArrayObject  $b
     * @throws InvalidArgumentException if the provided argument is not of type 'ArrayObject'.
     * @return \Papier\Type\PageObjectType
     */
    public function setB($b)
    {
        if (!$b instanceof ArrayObject) {
            throw new InvalidArgumentException("B is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $this->setEntry('B', $b);
        return $this;
    }

    /**
     * Set maxium display duration (in seconds).
     *  
     * @param  float  $b
     * @throws InvalidArgumentException if the provided argument is not of type 'float'.
     * @return \Papier\Type\PageObjectType
     */
    public function setDur($dur)
    {
        if (!RealValidator::isValid($dur)) {
            throw new InvalidArgumentException("Dur is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $value = new RealObject();
        $value->setValue($dur);

        $this->setEntry('Dur', $value);
        return $this;
    }

    /**
     * Set transition effect.
     *  
     * @param  \Papier\Object\DictionaryObject  $trans
     * @throws InvalidArgumentException if the provided argument is not of type 'DictionaryObject'.
     * @return \Papier\Type\PageObjectType
     */
    public function setTrans($trans)
    {
        if (!$trans instanceof DictionaryObject) {
            throw new InvalidArgumentException("Trans is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $this->setEntry('Trans', $trans);
        return $this;
    }

    /**
     * Set annotations.
     *  
     * @param  \Papier\Object\ArrayObject  $annots
     * @throws InvalidArgumentException if the provided argument is not of type 'ArrayObject'.
     * @return \Papier\Type\PageObjectType
     */
    public function setAnnots($annots)
    {
        if (!$annots instanceof ArrayObject) {
            throw new InvalidArgumentException("Annots is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $this->setEntry('Annots', $annots);
        return $this;
    }

    /**
     * Set additional actions.
     *  
     * @param  \Papier\Object\DictionaryObject  $aa
     * @throws InvalidArgumentException if the provided argument is not of type 'DictionaryObject'.
     * @return \Papier\Type\PageObjectType
     */
    public function setAA($aa)
    {
        if (!$aa instanceof DictionaryObject) {
            throw new InvalidArgumentException("AA is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $this->setEntry('AA', $aa);
        return $this;
    }

    /**
     * Set additional actions.
     *  
     * @param  \Papier\Object\StreamObject  $aa
     * @throws InvalidArgumentException if the provided argument is not of type 'StreamObject'.
     * @return \Papier\Type\PageObjectType
     */
    public function setMetadata($metadata)
    {
        if (!$metadata instanceof StreamObject) {
            throw new InvalidArgumentException("Metadata is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $this->setEntry('Metadata', $metadata);
        return $this;
    }

    /**
     * Set page-piece dictionary.
     *  
     * @param  \Papier\Object\DictionaryObject  $pieceinfo
     * @throws InvalidArgumentException if the provided argument is not of type 'DictionaryObject'.
     * @return \Papier\Type\PageObjectType
     */
    public function setPieceInfo($pieceinfo)
    {
        if (!$pieceinfo instanceof DictionaryObject) {
            throw new InvalidArgumentException("PieceInfo is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $this->setEntry('PieceInfo', $pieceinfo);
        return $this;
    }

    /**
     * Set integer key of this page in structural parent tree.
     *  
     * @param  int  $struct
     * @throws InvalidArgumentException if the provided argument is not of type 'int'.
     * @return \Papier\Type\PageObjectType
     */
    public function setStructParents($struct)
    {
        if (!IntValidator::isValid($struct)) {
            throw new InvalidArgumentException("StructParents is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $value = new IntegerObject();
        $value->setValue($struct);

        $this->setEntry('StructParents', $value);
        return $this;
    }

    /**
     * Set digital identifier of the page's parent web capture content set.
     *  
     * @param  \Papier\Type\ByteStringType  $id
     * @throws InvalidArgumentException if the provided argument is not of type 'ByteStringType'.
     * @return \Papier\Type\PageObjectType
     */
    public function setID($id)
    {
        if (!$id instanceof ByteStringType) {
            throw new InvalidArgumentException("ID is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $this->setEntry('ID', $id);
        return $this;
    }

    /**
     * Set preferred zoom.
     *  
     * @param  float  $pz
     * @throws InvalidArgumentException if the provided argument is not of type 'float'.
     * @return \Papier\Type\PageObjectType
     */
    public function setPZ($pz)
    {
        if (!RealValidator::isValid($pz)) {
            throw new InvalidArgumentException("PZ is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $value = new RealObject();
        $value->setValue($pz);

        $this->setEntry('PZ', $value);
        return $this;
    }

    /**
     * Set colour separations.
     *  
     * @param  \Papier\Object\DictionaryObject  $separationinfo
     * @throws InvalidArgumentException if the provided argument is not of type 'DictionaryObject'.
     * @return \Papier\Type\PageObjectType
     */
    public function setSeparationInfo($separationinfo)
    {
        if (!$separationinfo instanceof DictionaryObject) {
            throw new InvalidArgumentException("SeparationInfo is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $this->setEntry('SeparationInfo', $separationinfo);
        return $this;
    }

    /**
     * Set tab order.
     *  
     * @param  string  $tabs
     * @throws InvalidArgumentException if the provided argument is not a valid tab order.
     * @return \Papier\Type\PageObjectType
     */
    public function setTabs($tabs)
    {
        if (!TabOrderValidator::isValid($tabs)) {
            throw new InvalidArgumentException("Tabs is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $value = Factory::getInstance()->createObject('Name')->setIndirect(false)->setValue($tabs);
        $this->setEntry('Tabs', $value);
        return $this;
    }

    /**
     * Set name of the originating page object.
     *  
     * @param  \Papier\Object\NameObject  $pressteps
     * @throws InvalidArgumentException if the provided argument is not of type 'NameObject'.
     * @return \Papier\Type\PageObjectType
     */
    public function setTemplateInstantiated($template)
    {
        if (!$template instanceof DictionaryObject) {
            throw new InvalidArgumentException("TemplateInstantiated is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $this->setEntry('TemplateInstantiated', $template);
        return $this;
    }

    /**
     * Set navigation node dictionary.
     *  
     * @param  \Papier\Object\DictionaryObject  $pressteps
     * @throws InvalidArgumentException if the provided argument is not of type 'DictionaryObject'.
     * @return \Papier\Type\PageObjectType
     */
    public function setPresSteps($pressteps)
    {
        if (!$pressteps instanceof DictionaryObject) {
            throw new InvalidArgumentException("PresSteps is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $this->setEntry('PresSteps', $pressteps);
        return $this;
    }

    /**
     * Set default user space units (in multiple of 1/72 inch).
     *  
     * @param  float  $userunit
     * @throws InvalidArgumentException if the provided argument is not of type 'float'.
     * @return \Papier\Type\PageObjectType
     */
    public function setUserUnit($userunit)
    {
        if (!RealValidator::isValid($userunit)) {
            throw new InvalidArgumentException("UserUnit is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $value = new RealObject();
        $value->setValue($userunit);

        $this->setEntry('UserUnit', $value);
        return $this;
    }

     /**
     * Set viewport dictionaries.
     *  
     * @param  \Papier\Object\DictionaryObject  $vp
     * @throws InvalidArgumentException if the provided argument is not of type 'DictionaryObject'.
     * @return \Papier\Type\PageObjectType
     */
    public function setVP($vp)
    {
        if (!$vp instanceof DictionaryObject) {
            throw new InvalidArgumentException("VP is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $this->setEntry('VP', $vp);
        return $this;
    }

    /**
     * Format catalog's content.
     *
     * @return string
     */
    public function format()
    {
        /*if (!$this->hasEntry('UserUnit')) {
            $userunit = Factory::getInstance()->createObject('Real')->setIndirect(false)->setValue(1.0);
            $this->setUserUnit($userunit);
        }*/
        
        return parent::format();
    }
}