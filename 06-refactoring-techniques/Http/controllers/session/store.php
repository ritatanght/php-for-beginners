<?php

use Core\Authenticator;
use Http\Forms\LoginForm;


$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if ($form->validate($email, $password)) {

  if ((new Authenticator)->attempt($email, $password)) {
    redirect('/');
  }

  $form->error('email', 'No matching account found for that email address and password.');
}

$_SESSION['_flash']['errors'] = $form->errors();
return redirect('/login');
