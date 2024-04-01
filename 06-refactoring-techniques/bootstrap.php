<?php

use Core\App;
use Core\Container;
use Core\Database;

$container = new Container();

// associate the builder function with the string 'Core\Database'
$container->bind('Core\Database', function () {
  $config = require base_path('config.php');
  return new Database($config['database']);
});

App::setContainer($container);