<?php

use Core\App;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];


$errors = [];
if (Validator::email($email)) {
  $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password, 7, 255)) {
  $errors['password'] = 'Please provide a password of at least seven characters.';
}


if (!empty($errors)) {
  return view('registration/create.view.php', [
    'errors' => $errors
  ]);
}

$db = App::resolve('Core\Database');

$user = $db->query('select * from users where email = :email', [
  'email' => $email
])->find();

if ($user) {
  header('location: /');
  exit();
} else {

  $db->query('INSERT INTO users(email, password) VALUES(:email, :password)', [
    'email' => $email,
    'password' => password_hash($password, PASSWORD_BCRYPT)
  ]);

  // mark that the user has logged in
  login($user);

  header('location: /');
  exit();
}
