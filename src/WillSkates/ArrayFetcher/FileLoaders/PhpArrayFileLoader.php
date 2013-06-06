<?php
/*
 * This file is part of Array Fetcher
 *
 * (c) William Skates <will@stuffby.ws>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WillSkates\ArrayFetcher\FileLoaders;

use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\Yaml\Yaml;

/**
 * A class that allows us to load in an array contained within a php file.
 *
 * @author Will Skates <will@stuffby.ws>
 */
class PhpArrayFileLoader extends FileLoader
{

    /**
     * {@inheritdoc}
     */
    public function load($resource, $type = null)
    {
        return include $this->locator->locate($resource);
    }

    /**
     * {@inheritdoc}
     */
    public function supports($resource, $type = null)
    {
        return is_string($resource) && 'php' === pathinfo(
            $resource,
            PATHINFO_EXTENSION
        );
    }
}