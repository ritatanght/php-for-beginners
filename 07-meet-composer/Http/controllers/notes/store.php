<?php

use Core\Validator;
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$errors = [];

// validations
if (!Validator::string($_POST['body'], 1, 1000)) {
  $errors['body'] = 'A body of no more than 1.000 charas is required.';
}

if (!empty($errors)) {
  // validation issue
  return view("notes/create.view.php", [
    'heading' => 'Create Note',
    'errors' => $errors
  ]);
}

// only insert into the database when there is no errors
$db->query('INSERT INTO notes(body, user_id) VALUES (:body, :user_id)', [
  'body' => $_POST['body'],
  'user_id' => 1
]);

header('location: /notes');
die();
