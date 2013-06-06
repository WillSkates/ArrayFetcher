<?php
/*
 * This file is part of Array Fetcher
 *
 * (c) William Skates <will@stuffby.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WillSkates\ArrayFetcher;

/**
 * An array fetecher object that's ready to use.
 *
 * @author Will Skates <will@stuffby.ws>
 */
class ArrayFetcher
{

	use ArrayFetcherTrait;

	/**
	 * Construct an object can load array information from files.
	 *
	 * @param string|null $baseDir (Optional) The directory containing all of your configuration files.
	 *                             Don't pass this if you just want to use absolute paths.
	 */
	public function __construct($baseDir = null)
	{
		$this->setUp($baseDir);
	}

}