<?php

require 'functions.php';

// require 'router.php';
require 'Database.php';

$config = [
  'host' => '127.0.0.1',
  'port' => 3306,
  'dbname' => 'myapp',
  'charset' => 'utf8mb4'
];

$db = new Database($config);

$posts = $db->query("select * from posts")->fetchAll();



foreach ($posts as $post) {
  echo ("<li>" . $post['title'] . "</li>");
}
