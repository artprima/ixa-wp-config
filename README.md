Ixa WP-Config
-------------

[![Build Status](https://travis-ci.org/cesarhdz/ixa-wp-config.png?branch=develop)](https://travis-ci.org/cesarhdz/ixa-wp-config)

Consistent WordPress configuration across environments.


## Installation

It can be installed using Composer:

    $ composer require ixa/wp-config 0.2


## Usage

Ixa Wp-Config is meant to be used in `wp-config.php` file, this is the recommended way to use it:

`````php

use Ixa\WordPress\Configuration\Config;

require_once 'vendor/autoload.php';

// Load Config from config/ folder
$config = new Config(__DIR__ . '/config');
$config->load();

// ... define all variables and require wp-settings

````

## Configuration Folder

Ixa Wp-Config requires to define a folder in which the configuration will be placed.


### Environment Configuration

The configuration folder must contain a file named `.env.yml` with the following variables. 


````yaml
parameters:
  
  # Environment
  environment:    dev

  # Database Credentials
  db_name:        wordpress
  db_user:        root
  db_password:    ""
  db_host:        localhost

  # Site URL
  wp_home:        http://localhost:1234/

````

All variables are required and must be placed under `parameters`. This is because the `.env.yml`  file can be generated dynamically using [Incenteev/ParameterHandler](https://github.com/Incenteev/ParameterHandler).


### Core Configuration

The `config.php` file is also required and must return array with the constants that will be declared, e.g.

  <?php

  return array(

    'WP_LANG' => 'es_ES',

    'FS_METHOD' => 'direct'

    // ... more constants

  );


All keys will be defined as constants by Ixa Wp-Config in order to properly configure WordPress. If there is a file called `config.test.php` and we are in _test enviroment_ this file will be loaded and its key will take precedence over `config.php`.


