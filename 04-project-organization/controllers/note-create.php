<?php

require 'Validator.php';

$config = require 'config.php';
$db = new Database($config['database']);

$heading = 'Create Note';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $errors = [];

  // validations
  $validator = new Validator();
  if (!$validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1.000 charas is required.';
  }

  // only insert into the database when there is no errors
  if (empty($errors)) {
    $db->query('INSERT INTO notes(body, user_id) VALUES (:body, :user_id)', [
      'body' => $_POST['body'],
      'user_id' => 1
    ]);
  }
}

require "views/note-create.view.php";
