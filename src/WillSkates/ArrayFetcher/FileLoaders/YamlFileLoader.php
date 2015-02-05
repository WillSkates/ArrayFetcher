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

use Symfony\Component\Config\FileLocatorInterface;
use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\Yaml\Parser;

/**
 * A class that allows us to load in an array contained within a yaml file.
 *
 * @author Will Skates <will@stuffby.ws>
 */
class YamlFileLoader extends FileLoader
{

    const PARSER_SYMFONY = 1;
    const PARSER_EXTENSION = 2;

    /**
     * The type of parser to use.
     * @var int
     */
    protected $parserType;

    public function __construct(FileLocatorInterface $locator)
    {
        parent::__construct($locator);
        if(extension_loaded('yaml')) {
            $this->parserType = self::PARSER_EXTENSION;
        } else {
            $this->parserType = self::PARSER_SYMFONY;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function load($resource, $type = null)
    {

        $content = file_get_contents($this->locator->locate($resource));

        if($this->parserType == self::PARSER_SYMFONY) {
            $parser = new Parser();
            $parsed = $parser->parse($content);
            return $parsed;
        } else if($this->parserType == self::PARSER_EXTENSION) {
            $parsed = yaml_parse($content);
            return $parsed;
        }

        return false;
        
    }

    /**
     * {@inheritdoc}
     */
    public function supports($resource, $type = null)
    {
        return is_string($resource) && 'yml' === pathinfo(
            $resource,
            PATHINFO_EXTENSION
        );
    }

}