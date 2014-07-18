<?php

namespace Artprima\WordPress\Ixa\Configuration;

use Artprima\WordPress\Ixa\Configuration\Exceptions\FileNotFoundException;

use Symfony\Component\Yaml\Parser;

class EnvironmentConfig implements ConfigLoaderInterface
{
    const EXT = '.yml';
    const DEFAULT_FILE_NAME = '.env';

    const PARAMS_KEY = 'parameters';

    /*
    static $validKeys = array(
        'auth_key',
        'secure_auth_key',
        'logged_in_key',
        'nonce_key',
        'auth_salt',
        'secure_auth_salt',
        'logged_in_salt',
        'nonce_salt',
        'environment',
        'db_user',
        'db_name',
        'db_host',
        'db_password',
        'wp_home'
    );
    */

    protected $dir;
    protected $fileName;

    /**
     * @var \ArrayIterator
     */
    protected $params;

    public function __construct($dir, $fileName = null){
        $this->setDir($dir);
        $this->setFileName($fileName);
        $this->setParser(new Parser());
        $this->params = new \ArrayIterator();
    }


    /**
     * Load
     * Parse and save file into $this->params
     * @throws Exceptions\FileNotFoundException
     * @return void
     */
    public function load(){

        $path = $this->getFilePath();

        if(! file_exists($path)){
            throw new FileNotFoundException('Environment', $path);
        }

        $content = file_get_contents($this->getFilePath());

        $this->setParams($this->parser->parse($content));
    }


    /**
     * Save
     * Register all params as constants
     * @return void
     */
    public function save(){
    }


    public function getFilePath()
    {
        return $this->getDir() . $this->getFileName();
    }

    /**
     * @return \ArrayIterator
     */
    public function getParams()
    {
        return $this->params;
    }

    public function getParam($name, $default = null)
    {
        $value = $default;
        if ($this->params->offsetExists($name)) {
            $value = $this->params->offsetGet($name);
        }

        return $value;
    }

    /**
     * @param array $params
     */
    public function setParams(array $params)
    {
        if (array_key_exists(self::PARAMS_KEY, $params) && is_array($params[self::PARAMS_KEY])) {
            $object = new \ArrayObject($params[self::PARAMS_KEY]);
            $this->params = $object->getIterator();
        }
    }


    public function getFileName()
    {
        $name = ($this->fileName) ? $this->fileName : self::DEFAULT_FILE_NAME;
        return $name . self::EXT;
    }

    public function getDir()
    {
        return $this->dir;
    }


    public function setParser(Parser $parser)
    {
        $this->parser = $parser;
    }

    protected function setDir($dir)
    {
        $this->dir = $dir;
    }

    protected function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }
}
