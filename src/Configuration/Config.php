<?php

namespace Ixa\WordPress\Configuration;

class Config{

    protected $dir;
    protected $loaders;


    protected static $defaultLoaders = array(
        'environment' => 'Ixa\WordPress\Configuration\EnvironmentConfig'
    );

    public function __construct($dir){
        $this->setDir($dir);
        $this->bindDefaultLoaders();
    }

    /**
     * Load
     * Call all registered Config Loaders
     * @return void 
     */
    public function load(){
        foreach ($this->loaders as $loader){
            $loader->load();
            $loader->save();
        }
    }


    public function getDir(){
        return $this->dir;
    }


    public function bind($name, $function){
        $this->addLoader($name, call_user_func($function, $this->getDir()));
    }


    /**
     * @param string $name
     * @return \Ixa\WordPress\Configuration\ConfigLoaderInterface
     */
    public function getLoader($name){
        return $this->loaders[$name];
    }

    /**
     * @param string $name
     * @param ConfigLoaderInterface $obj
     */
    protected function addLoader($name, ConfigLoaderInterface $obj){
        $this->loaders[$name] = $obj;
    }

    public function setDir($dir){
        $this->dir = rtrim($dir, '/') . '/';
    }

    protected function bindDefaultLoaders(){
        $this->loaders = array();

        foreach (self::$defaultLoaders as $key => $clazz) {
            $this->addLoader($key, new $clazz($this->getDir()));
        }
    }


}