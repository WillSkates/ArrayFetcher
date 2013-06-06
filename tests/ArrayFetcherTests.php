<?php

use WillSkates\ArrayFetcher\ArrayFetcher;

class ArrayFetcherTests extends PHPUnit_Framework_TestCase
{

	protected function make($dir = null)
	{
		return new ArrayFetcher($dir);
	}

	public function testCreate()
	{
		$this->make();
	}

	protected function assertTypeValueMatch($orig, $loaded)
	{

		if ( is_string($orig) ) {

			$this->assertTrue(is_string($loaded));

		} else if ( is_array($orig) ) {

			$this->assertTrue(is_array($loaded));

			$keys = array_keys($orig);
			$fetched = array_keys($loaded);

			$this->assertCount(count($keys), $fetched, 'The loaded array should have just as many entries as the original.');

			foreach ( $keys as $key ) {
				$this->assertArrayHasKey($key, $loaded);
				$this->assertTypeValueMatch($orig[$key], $loaded[$key]);
			}


		} else if ( is_object($orig) ) {

			$class = get_class($orig);

			$this->assertInstanceOf($class, $loaded);

			$orig = get_object_vars($orig);
			$loaded = get_object_vars($loaded);

			$this->assertTypeValueMatch($orig, $loaded);

		}

	}

	public function testLoadArray()
	{

		$array = require __DIR__ . '/_resources/array.php';

		$fetcher = $this->make();

		$fetched = $fetcher->fetch(__DIR__ . '/_resources/array.php');

		$this->assertTypeValueMatch($array, $fetched);

		//From within a directory...
		$fetcher = $this->make(__DIR__ . '/_resources/');
		$fetched = $fetcher->fetch('array.php');

		$this->assertTypeValueMatch($array, $fetched);

	}

	public function testLoadYaml()
	{

		$array = require __DIR__ . '/_resources/array.php';

		$fetcher = $this->make();

		$fetched = $fetcher->fetch(__DIR__ . '/_resources/array.yml');

		$this->assertTypeValueMatch($array, $fetched);

		//From within a directory...
		$fetcher = $this->make(__DIR__ . '/_resources/');
		$fetched = $fetcher->fetch('array.yml');

		$this->assertTypeValueMatch($array, $fetched);

	}

	public function testLoadJson()
	{

		$array = require __DIR__ . '/_resources/array.php';

		$fetcher = $this->make();

		$fetched = $fetcher->fetch(__DIR__ . '/_resources/array.json');

		$this->assertTypeValueMatch($array, $fetched);

		//From within a directory...
		$fetcher = $this->make(__DIR__ . '/_resources/');
		$fetched = $fetcher->fetch('array.json');

		$this->assertTypeValueMatch($array, $fetched);

	}

}