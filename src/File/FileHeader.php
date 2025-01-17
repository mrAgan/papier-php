<?php

namespace Papier\File;

use InvalidArgumentException;
use Papier\Factory\Factory;
use Papier\Object\BaseObject;
use Papier\Validator\VersionValidator;

class FileHeader extends BaseObject
{
	/**
	 * Default version.
	 *
	 * @var int
	 */
	const DEFAULT_VERSION = 4;

    /**
     * Bool which indicates if file has binary data.
     *
     * @var bool
     */
    private bool $binaryData = false;

    /**
     * Format header's content.
     *
     * @return string
     */
    public function format(): string
    {
        $value = sprintf("%%PDF-1.%d", $this->getVersion());
        if ($this->hasBinaryData()) {
            $chars = array_map('chr', range(128, 131));
            $comment = Factory::create('Papier\Type\Base\CommentType', implode('', $chars));
            $value .= $comment->format();
        }
        return $value;
    }

    /**
     * Get header's version.
     *
     * @return int
     */
    protected function getVersion(): int
    {
		$value = $this->getValue();
        return is_int($value) ? $value : self::DEFAULT_VERSION;
    }

    /**
     * Set header's version.
     *  
     * @param  int  $version
     * @return FileHeader
     * @throws InvalidArgumentException if the provided argument is not of type 'int' or is outside acceptable values.
     */
    public function setVersion(int $version): FileHeader
    {
        if (!VersionValidator::isValid($version)) {
            throw new InvalidArgumentException("Version is incorrect. See ".__CLASS__." class's documentation for possible values.");
        }

        $this->setValue($version);
        return $this;
    } 

    /**
     * Get if file has binary data.
     *
     * @return bool
     */
    protected function hasBinaryData(): bool
    {
        return $this->binaryData;
    }

    /**
     * Set if file has binary data.
     *  
     * @param  bool  $binaryData
     * @return FileHeader
     */
    public function setBinaryData(bool $binaryData): FileHeader
    {
        $this->binaryData = $binaryData;
        return $this;
    } 
}