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

use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\Config\Loader\DelegatingLoader;

use Symfony\Component\Config\FileLocator;

use WillSkates\ArrayFetcher\FileLoaders\PhpArrayFileLoader;
use WillSkates\ArrayFetcher\FileLoaders\JsonFileLoader;
use WillSkates\ArrayFetcher\FileLoaders\YamlFileLoader;

trait ArrayFetcherTrait
{

	/**
	 * An object that will allow us to detect the type of file
	 * and load data in appropriately.
	 *
	 * @var Symfony\Component\Config\Loader\DelegatingLoader
	 */
	protected $fileLoader;

	/**
	 * Setup the objects that locate and load our files.
	 *
	 * @param string|null $baseFileDir (Optional) The directory containing all of your configuration files.
	 *                                 Don't pass this if you just want to use absolute paths.
	 *
	 * @return null
	 */
	protected function setUp($baseFileDir = null)
	{

		$locator = new FileLocator($baseFileDir);

		$resolver = new LoaderResolver(
			array(
				new PhpArrayFileLoader($locator),
				new JsonFileLoader($locator),
				new YamlFileLoader($locator)
			)
		);

		$this->fileLoader = new DelegatingLoader($resolver);

	}

	/**
	 * Fetch the information contained within a given file.
	 *
	 * @param  string $path The location of the file to load.
	 *
	 * @return array The data contained within the desired file.
	 */
	public function fetch($path)
	{

		return $this->fileLoader->load($path);

	}

}