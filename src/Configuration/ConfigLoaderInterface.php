<?php

namespace Artprima\WordPress\Ixa\Configuration;


interface ConfigLoaderInterface
{
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