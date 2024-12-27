<?php

namespace Papier\Font\TrueType;

use Papier\Font\TrueType\Base\TrueTypeFontTable;
use Papier\Validator\IntegerValidator;
use InvalidArgumentException;
use Papier\Validator\StringValidator;

class TrueTypeFontNameTable extends TrueTypeFontTable
{
	/**
	 * The version of the name table.
	 *
	 * @var int
	 */
	protected int $version;

	/**
	 * Number of name records.
	 *
	 * @var int
	 */
	protected int $count;

	/**
	 * Offset to start of string storage (from start of table).
	 *
	 * @var int
	 */
	protected int $storageOffset;

	/**
	 * The Postscript name
	 *
	 * @var string
	 */
	protected string $postscriptName;

	/**
	 * Copyright name ID
	 *
	 * @var int
	 */
	const COPYRIGHT_NAME_ID = 0;

	/**
	 * Font family name ID
	 *
	 * @var int
	 */
	const FAMILY_NAME_ID = 1;

	/**
	 * Font subfamily name ID
	 *
	 * @var int
	 */
	const SUBFAMILY_NAME_ID = 2;

	/**
	 * Unique font identifier
	 *
	 * @var int
	 */
	const IDENTIFIER_NAME_ID = 3;

	/**
	 * Font full name ID
	 *
	 * @var int
	 */
	const FULL_NAME_ID = 4;

	/**
	 * Font version ID
	 *
	 * @var int
	 */
	const VERSION_NAME_ID = 5;

	/**
	 * Font Postscript ID
	 *
	 * @var int
	 */
	const POSTSCRIPT_NAME_ID = 6;

	/**
	 * Font trademark name ID
	 *
	 * @var int
	 */
	const TRADEMARK_NAME_ID = 7;

	/**
	 * Font Manufacturer name ID
	 *
	 * @var int
	 */
	const MANUFACTURER_NAME_ID = 8;

	/**
	 * Font designer name ID
	 *
	 * @var int
	 */
	const DESIGNER_NAME_ID = 9;

	/**
	 * Font description name ID
	 *
	 * @var int
	 */
	const DESCRIPTION_NAME_ID = 10;

	/**
	 * Font Vendor URL name ID
	 *
	 * @var int
	 */
	const VENDOR_URL_NAME_ID = 11;

	/**
	 * Font designer URL name ID
	 *
	 * @var int
	 */
	const DESIGNER_URL_NAME_ID = 12;

	/**
	 * Font licence description name ID
	 *
	 * @var int
	 */
	const LICENCE_DESCRIPTION_NAME_ID = 13;


	/**
	 * Font licence info URL name ID
	 *
	 * @var int
	 */
	const LICENCE_INFO_URL_NAME_ID = 14;

	/**
	 * Font typographic family name ID
	 *
	 * @var int
	 */
	const TYPOGRAPHIC_FAMILY_NAME_ID = 16;


	/**
	 * Extract table's data
	 *
	 */
	public function parse(): void
	{
		$stream = $this->getHelper();

		$offset = $this->getOffset();
		$stream->setOffset($offset);


		$this->setVersion($stream->unpackUnsignedShortInteger());
		$this->setCount($stream->unpackUnsignedShortInteger());
		$this->setStorageOffset($stream->unpackOffset16());

		$count = $this->getCount();
		$storageOffset = $this->getStorageOffset();

		for ($i = 0; $i < $count; $i++) {
			$platformID = $stream->unpackUnsignedShortInteger();
			$encodingID = $stream->unpackUnsignedShortInteger();
			$languageID = $stream->unpackUnsignedShortInteger();
			$nameID = $stream->unpackUnsignedShortInteger();
			$length = $stream->unpackUnsignedShortInteger();
			$stringOffset = $stream->unpackOffset16();

			$position = $stream->getOffset();

			$stream->setOffset($offset + $storageOffset + $stringOffset);
			$chunk = $stream->unpackString($length);
			$value = mb_convert_encoding($chunk, 'UTF-8', 'UTF-16BE');

			if ($nameID == self::POSTSCRIPT_NAME_ID) {
				$this->setPostscriptName($value);
			}


			$stream->setOffset($position);
		}
	}

	/**
	 * Sets the version of the name table.
	 *
	 * @param int $version The version number.
	 * @return TrueTypeFontNameTable
	 * @throws InvalidArgumentException If the version is not valid.
	 */
	public function setVersion(int $version): TrueTypeFontNameTable
	{
		if (!IntegerValidator::isValid($version)) {
			throw new InvalidArgumentException("Version is not valid. See ".__CLASS__." class's documentation for possible values.");
		}
		$this->version = $version;
		return $this;
	}

	/**
	 * Gets the version of the name table.
	 *
	 * @return int
	 */
	public function getVersion(): int
	{
		return $this->version;
	}

	/**
	 * Sets the count of the records.
	 *
	 * @param int $count The number of records.
	 * @return TrueTypeFontNameTable
	 * @throws InvalidArgumentException If the version is not valid.
	 */
	public function setCount(int $count): TrueTypeFontNameTable
	{
		if (!IntegerValidator::isValid($count)) {
			throw new InvalidArgumentException("Count is not valid. See ".__CLASS__." class's documentation for possible values.");
		}
		$this->count = $count;
		return $this;
	}

	/**
	 * Gets the count of records.
	 *
	 * @return int
	 */
	public function getCount(): int
	{
		return $this->count;
	}

	/**
	 * Sets the storage offset of the name table.
	 *
	 * @param int $storageOffset The storage offset.
	 * @return TrueTypeFontNameTable
	 * @throws InvalidArgumentException If the version is not valid.
	 */
	public function setStorageOffset(int $storageOffset): TrueTypeFontNameTable
	{
		if (!IntegerValidator::isValid($storageOffset)) {
			throw new InvalidArgumentException("Storage offset is not valid. See ".__CLASS__." class's documentation for possible values.");
		}
		$this->storageOffset = $storageOffset;
		return $this;
	}

	/**
	 * Gets the version of the name table.
	 *
	 * @return int
	 */
	public function getStorageOffset(): int
	{
		return $this->storageOffset;
	}

	/**
	 * Sets the Postscript name.
	 *
	 * @param string $postscriptName The Postscript name.
	 * @return TrueTypeFontNameTable
	 * @throws InvalidArgumentException If the value is not valid.
	 */
	public function setPostscriptName(string $postscriptName): TrueTypeFontNameTable
	{
		if (!StringValidator::isValid($postscriptName)) {
			throw new InvalidArgumentException("Postscript name is not valid. See ".__CLASS__." class's documentation for possible values.");
		}

		$this->postscriptName = $postscriptName;
		return $this;
	}

	/**
	 * Gets the Panose classification.
	 *
	 * @return string|null
	 */
	public function getPostscriptName(): ?string
	{
		return $this->postscriptName;
	}
}