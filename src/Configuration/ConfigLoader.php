<?php

namespace Ixa\WordPress\Configuration;


interface ConfigLoaderInterface
{

    function __construct($dir, $filename = null);

    /**
     * Load
     * Parse and save file into $this->params
     * @return void
     */
    function load();

    /**
     * Save
     * Register all params as constants
     * @return void
     */
    function save();

    /**
     * @return \ArrayIterator
     */
    function getParams();

    function getParam($name, $default = null);

    function getFileName();

    function getDir();

}