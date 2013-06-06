#Array Fetcher

A simple library that allows you to get an array of information from a file.

##Build Status
[![Build Status](https://travis-ci.org/willskates/arrayfetcher.png?branch=master)](https://travis-ci.org/willskates/arrayfetcher) ![project status](http://stillmaintained.com/willskates/arrayfetcher.png) #

##Requirements

	PHP 5.4

##Installation

	You should install Array Fetcher using composer.

```JSON
{
    "require": {
        "willskates/arrayfetcher": "1.*"
    }
}
```
##Usage

###Getting an array from a file.

```php
use WillSkates\ArrayFetcher\ArrayFetcher;

$fetcher = new ArrayFetcher();
$array = $fetcher->fetch('/path/to/filename.extension');
```

###Getting an array from a file contained within a base directrory.

```php
use WillSkates\ArrayFetcher\ArrayFetcher;

$dir = new ArrayFetcher('/path/to/dir');
$array = $dir->fetch('filename.extension');
```